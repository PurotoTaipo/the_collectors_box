<?php
class AuthController extends Controller
{
    public function login(): void
    {
        if (Auth::isLoggedIn()) {
            $this->redirectTo('dashboard');
        }

        $this->view('auth/login', ['title' => 'Sign In', 'error' => Auth::getFlash()]);
    }

    public function handle(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirectTo('auth', 'login');
        }

        $email    = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (is_bool(strpos($email, '@'))) {
            $user = User::selectByName($email);
        } else {
            $user = User::selectByEmail($email);
        }

        if ($user && password_verify($password, $user->password)) {
            Auth::login($user);
            $this->redirectTo('dashboard');
        }

        Auth::setFlash('Login failed');
        $this->redirectTo('auth', 'login');
    }

    public function logout(): void
    {
        Auth::logout();
        $this->redirectTo('auth', 'login');
    }
}
