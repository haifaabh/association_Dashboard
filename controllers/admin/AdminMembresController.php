<?php
require_once('../models/membre.php');
require_once('../models/carte_model.php');
require_once('../views/admin/adminMembresView.php');
require_once('../views/admin/SidebarView.php');

class AdminMembresController {
    private $membre_model;

    public function __construct() {
        session_start();  
        if (!isset($_SESSION['admin_id'])) {
            header("Location: ?route=admin/login");  
            exit();
        }
        $this->membre_model = new membre();
    }

    public function index() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleMembreAction();
        } 
        $this->afficherMembres();
    }

    public function afficherMembres() {
        $membres = $this->membre_model->getWhere(['status_abonnement' => 'pending']);
        $view = new adminMembresView();
        $view->render($membres);
    }

    public function handleMembreAction() {
        $membreId = isset($_POST['membre_id']) ? intval($_POST['membre_id']) : null;
        $action = isset($_POST['action']) ? trim($_POST['action']) : null;
    
        $status = ($action === 'accepter') ? 'active' : 'declined';
        
        try {
            $success = $this->membre_model->update($membreId, [
                'status_abonnement' => $status
            ]);
            if ($success && $status === 'active') {
                $carteModel = new carte_model();
                $membre = $this->membre_model->getById($membreId);

                $cardData = [
                    'membre_id' => $membreId,
                    'qr_code' => uniqid('QR_'),
                    'type_carte' => $membre->type_carte, 
                    'date_emission' => date('Y-m-d'),
                    'date_expiration' => date('Y-m-d', strtotime('+1 year')) 
                ];
    
                $carteSuccess = $carteModel->create($cardData);
    
                if (!$carteSuccess) {
                    throw new Exception("Failed to create card for member ID: $membreId");
                }
            }
        
          header('Location: index.php?route=admin/gestion-membres&status=success');
          exit;
        }
        catch (Exception $e) {
         error_log("Error handling member action: " . $e->getMessage());
         header('Location: index.php?route=admin/gestion-membres&status=error');
        exit; 
        }
}
}
