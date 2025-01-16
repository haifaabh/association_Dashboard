<?php
require_once("../models/admin.php");
require_once("../views/admin/adminLoginView.php");

class loginController{
    private $model;
    private $view;

    public function __construct() {
        $this->model = new admin();
        $this->view = new AdminLoginView();
    }

    public function index() {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $result = $this->model->where(['email' => $email]);
            $admin = $result ? $result[0] : null;

            if ($admin && $this->model->verifyPassword($password, $admin->mot_de_passe)) {
                $_SESSION['admin_id'] = $admin->id;
                $_SESSION['admin_email'] = $admin->email;
                 header("Location:index.php?route=admin/gestion-partenaire");
                exit();
            } else {
                $this->view->render(['error' => 'Invalid email or password.']);
                return;
            }
        }

        $this->view->render();
    }   

    public function logout() {
        session_start();
        session_destroy();
        header('Location:index.php');
        exit;
    }
}
?>