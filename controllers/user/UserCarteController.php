<?php
require_once('../models/carte_model.php');
require_once('../views/user/UserCarteView.php');

class UserCarteController {
    private $carteModel;

    public function __construct() {
        session_start();  
        if (!isset($_SESSION['user_id'])) {
            header("Location: ?route=user/login");  // Redirect to login page si non authentifié
            exit();
        }
        $this->carteModel = new carte_model();
    }

    public function index() {
        $userId = $_SESSION['user_id']; 
        $carte = $this->carteModel->first(['membre_id' => $userId]);

        $view = new UserCarteView();
        if ($carte) {
            $view->render($carte, false); 
        } else {
            $view->render(null, true); 
        }
    }
}
?>