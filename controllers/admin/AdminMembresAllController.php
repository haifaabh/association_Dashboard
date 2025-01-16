<?php
require_once('../models/membre.php');
require_once('../models/carte_model.php');
require_once('../views/admin/adminMembresAllView.php');
require_once('../views/admin/SidebarView.php');

class AdminMembresAllController {
    private $membre_model;

    public function __construct() {
        session_start();  
        if (!isset($_SESSION['admin_id'])) {
            header("Location: ?route=admin/login");  // Redirect to login page si non authentifié
            exit();
        }
        $this->membre_model = new membre();
    }

    public function afficherMembres() {
        $membres = $this->membre_model->findAll();
        $view = new adminMembresAllView();
        $view->render($membres);
    }

 
}
