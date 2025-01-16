<?php
require_once("../models/partenaire_model.php");
require_once("../views/partenaire/partenaireLoginView.php");

class partenaireLoginController{
    private $model;
    private $view;

    public function __construct() {
        $this->model = new partenaire_model();
        $this->view = new partenaireLoginView();
    }

    public function index() {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $result = $this->model->where(['email' => $email]);
            $partenaire = $result ? $result[0] : null;

            if ($partenaire && $this->model->verifyPassword($password, $partenaire->mot_de_passe)) {
                $_SESSION['partenaire_id'] = $partenaire->id;
                $_SESSION['partenaire_email'] = $partenaire->email;
                 header("Location: ?route=partenaire/profile");
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