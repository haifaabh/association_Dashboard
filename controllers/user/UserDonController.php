<?php
require_once('../models/don_model.php');
require_once('../views/user/userDonView.php');
require_once('../views/user/SidebarUserView.php');


class UserDonController {
    private $don_model;

    public function __construct() {
        session_start();  
        if (!isset($_SESSION['user_id'])) {
            header("Location: ?route=user/login");  // Redirect to login page si non authentifié
            exit();
        }
        $this->don_model = new don_model();
    }

    public function afficherDon() {
        $userId = $_SESSION['user_id'];
        $dons = $this->don_model->where(['membre_id' => $userId]);
        $view = new UserDonView();
        $view->render($dons);
    }


 
}