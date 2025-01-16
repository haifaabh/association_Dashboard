<?php
require_once('../models/membre.php');
require_once('../views/auth/LoginView.php');

class UserLoginController {
    private $membreModel;

    public function __construct() {
        $this->membreModel = new membre();
    }

    public function index() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->login();
        } 
        else {
            $this->showLoginForm(); 
        }
    }

    private function showLoginForm() {
        $loginView = new LoginView();
        $loginView->render();
    }

    private function login() {
        $membreModel = new membre();

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            header('Location:?route=user/login&error=empty_fields');
            exit();
        }

        $user = $membreModel->getWhere(['email' => $email]);

        if ($user && $this->membreModel->verifyPassword($password, $user[0]->mot_de_passe)) {
            session_start();
            $_SESSION['user_id'] = $user[0]->id;
            $_SESSION['user_name'] = $user[0]->nom;
            header('Location:?route=user/profile');

        } else {
            header('Location:?route=user/login&error=invalid_credentials');
        }
    }


    public function logout() {
        session_start();
        session_destroy();
        header('Location:index.php');
        exit;
    }
}
?>
