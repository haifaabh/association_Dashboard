<?php
require_once('../models/carte_model.php');
require_once('../models/membre.php');
require_once('../views/partenaire/cardVerificationView.php');

class cardVerificationController {
    private $carteModel;
    private $membreModel;

    public function __construct() {
        session_start();

        if (!isset($_SESSION['partenaire_id'])) {
            header('Location: index.php?route=partenaire/login');
            exit;
        }

        $this->carteModel = new carte_model();
        $this->membreModel = new membre();
    }

    public function index() {
        $view = new cardVerificationView();
        $view->render(); 
    }

    public function verify() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cardCode = $_POST['qr_code'] ?? '';
    
            if (empty($cardCode)) {
                $error = "Le code de la carte est requis.";
                $view = new cardVerificationView();
                $view->render(['error' => $error]);
                return;
            }
    
            $card = $this->carteModel->where(['qr_code' => $cardCode]);
            if (!$card || empty($card[0])) {
                $error = "Carte invalide ou introuvable.";
                $view = new cardVerificationView();
                $view->render(['error' => $error]);
                return;
            }
    
            $card = $card[0];  
    
            $membre = $this->membreModel->getWhere(['id' => $card->membre_id]);
            if (!$membre || empty($membre[0])) {
                $error = "Membre introuvable pour cette carte.";
                $view = new cardVerificationView();
                $view->render(['error' => $error]);
                return;
            }
    
            $membre = $membre[0]; 
    
            $view = new cardVerificationView();
            $view->render(['membre' => $membre, 'carte' => $card]);
        }
    }
    
}
?>
