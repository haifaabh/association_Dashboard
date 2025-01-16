<?php
require_once('../models/don_model.php');
require_once('../views/admin/adminDonView.php');
require_once('../views/admin/SidebarView.php');


class AdminDonController {
    private $don_model;

    public function __construct() {
        session_start();  
        if (!isset($_SESSION['admin_id'])) {
            header("Location: ?route=admin/login");  
            exit();
        }
        $this->don_model = new don_model();
    }

    public function afficherDon() {
        $dons = $this->don_model->afficherDonEnAttente();
        $view = new adminDonView();
        $view->render($dons);
    }

    public function validerDon(){
        $donId = isset($_POST['don_id']) ? intval($_POST['don_id']) : null;
        $action = isset($_POST['action']) ? trim($_POST['action']) : null;

        $status = ($action === 'valider') ? 'valide' : 'en attente';
        
        try {
            $success = $this->don_model->update($donId, [
                'status' => $status
            ]);
            header('Location: index.php?route=admin/dons');
        }
        catch (Exception $e) {
            error_log("Error handling member action: " . $e->getMessage());
           exit; 
           }


    }

 
}