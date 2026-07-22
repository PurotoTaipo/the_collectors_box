<?php
class Auth
{
    private static ?User $user = null;

    public static function boot(): void
    {
        $token = $_COOKIE[COOKIE_REMEMBER] ?? null;
        if (!$token) {
            return;
        }

        $user = User::selectByToken($token);
        if ($user) {
            self::$user = $user;
        } else {
            self::clearCookie();
        }
    }

    public static function user(): ?User
    {
        return self::$user;
    }

    public static function isLoggedIn(): bool
    {
        return self::$user !== null;
    }

    public static function login(User $user): void
    {
        if ((int) $user->id === 0) {
            self::setCookie($user->token);
        } else {
            $token = $user->generateNewToken();
            self::setCookie($token);
        }
        self::$user = $user;
    }

    public static function logout(): void
    {
        $token = $_COOKIE[COOKIE_REMEMBER] ?? null;
        if ($token) {
            User::clearToken($token);
        }
        self::clearCookie();
        self::$user = null;
    }

    public static function setFlash(string $message): void
    {
        setcookie('flash', $message, [
            'expires'  => time() + 30,
            'path'     => '/',
            'httponly' => true,
            'samesite' => 'Lax',
        ]);
    }

    public static function getFlash(): ?string
    {
        $value = $_COOKIE['flash'] ?? null;
        if ($value !== null) {
            setcookie('flash', '', ['expires' => time() - 1, 'path' => '/']);
        }
        return $value;
    }

    private static function setCookie(string $token): void
    {
        setcookie(COOKIE_REMEMBER, $token, [
            'expires'  => time() + COOKIE_LIFETIME,
            'path'     => '/',
            'httponly' => true,
            'samesite' => 'Lax',
        ]);
    }

    private static function clearCookie(): void
    {
        setcookie(COOKIE_REMEMBER, '', [
            'expires'  => time() - 1,
            'path'     => '/',
            'httponly' => true,
            'samesite' => 'Lax',
        ]);
    }
}
