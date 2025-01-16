<?php
require_once '../models/partenaire_model.php';
require_once '../views/partenaire/profilePartenaireView.php';

class partenaireProfileController {
    private $model;

    public function __construct() {
        session_start();
        if (!isset($_SESSION['partenaire_id'])) {
            header('Location: index.php?route=partenaire/login');
            exit;
        }

        $this->model = new partenaire_model();
    }

    public function profile() {
        $partenaireId = $_SESSION['partenaire_id'];
        $partenaire = $this->model->where(['id' => $partenaireId]); 

        if ($partenaire) {
            $partenaire = $partenaire[0]; 
        } else {
            die('User not found.');
        }

            $view = new profilePartenaireView();
            $view->render($partenaire);
     
    }

    public function updateProfile() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $partenaireId = $_SESSION['partenaire_id'];
            $data = [
                'nom' => $_POST['nom'],
                'categorie' => $_POST['categorie'],
                'ville' => $_POST['ville'],
                'detail_reduction' => $_POST['detail_reduction'],
                'lien_site_web' => $_POST['lien_site_web'],
                'email' => $_POST['email'],
                'mot_de_passe' => $_POST['mot_de_passe']
                                
            ];

            $data = array_filter($data, function ($value) {
                return $value !== null;
            });

            foreach (['nom', 'categorie', 'ville', 'email'] as $field) {
                if (empty($data[$field])) {
                    header("Location: index.php?route=partenaire/profile&error=empty_fields");
                    exit;
                }
            }

            if ($this->model->updatePartenaire($partenaireId, $data)) {
                header("Location: index.php?route=partenaire/profile&status=success");
            } else {
                header("Location: index.php?route=partenaire/profile&error=update_failed");
            }
        }
    }
}
?>
