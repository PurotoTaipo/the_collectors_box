<?php
class User extends Model
{
    public function setPassword(string $password) {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public function generateNewToken(int $length = 32) {
        do {
            $token = bin2hex(random_bytes(32));
        } while (User::selectByToken($token) !== false);
        User::saveToken((int) $this->id, $token);
        return $token;
    }

    public static function selectByEmail(string $email): static|false
    {
        return static::query(
            'SELECT * FROM users WHERE email = ? LIMIT 1',
            [$email],
            single: true
        );
    }

    public static function selectByName(string $name): static|false
    {
        return static::query(
            'SELECT * FROM users WHERE name = ? LIMIT 1',
            [$name],
            single: true
        );
    }

    public static function selectById(int $id): static|false
    {
        return static::query(
            'SELECT * FROM users WHERE id = ? LIMIT 1',
            [$id],
            single: true
        );
    }

    public static function selectByToken(string $token): static|false
    {
        return static::query(
            'SELECT id, email FROM users WHERE token = ? LIMIT 1',
            [$token],
            single: true
        );
    }

    public static function saveToken(int $userId, string $token): void
    {
        static::execute('UPDATE users SET token = ? WHERE id = ?', [$token, $userId]);
    }

    public static function clearToken(string $token): void
    {
        static::execute('UPDATE users SET token = NULL WHERE token = ?', [$token]);
    }
}
