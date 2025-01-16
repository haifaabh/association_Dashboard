<?php
require_once("../models/don_model.php");
require_once("../views/home/DonView.php");

class DonController
{
    private $don;
    private $view;

    public function __construct()
    {
        $this->don = new don_model();
        $this->view = new DonView();
    }

    public function effectuerDon()
    {
        $data = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'] ?? null;
            $prenom = $_POST['prenom'] ?? null;
            $montant = $_POST['montant'] ?? null;
            $category = $_POST['category'] ?? '';
            $recu = $_FILES['recu'] ?? null;

            if ($recu && $recu['error'] === 0) {
                $uploadDir = '../uploads/';
                $uploadFile = $uploadDir . basename($recu['name']);
                if (move_uploaded_file($recu['tmp_name'], $uploadFile)) {
                    $data['message'] = "Don enregistré avec succès.";
                } else {
                    $data['message'] = "Erreur lors de l'upload du reçu.";
                }
            }
            if(!empty($recu)  && !empty($category)){
                           // Check if the membre exists
            if (!empty($nom) && !empty($prenom)) {
                require_once("../models/membre.php");
                $membreModel = new membre();
                $membre = $membreModel->first(['nom' => $nom, 'prenom' => $prenom]);

                 if ($membre) {
                    $this->don->insert([
                        'membre_id' => $membre->id,
                        'nom' => $nom,
                        'prenom' => $prenom,
                        'montant'=>$montant,
                        'categorie' => $category,
                        'recu' => $recu['name'],
                        'date_don' => date('Y-m-d'),
                    ]);
                } else {
                    $this->don->insert([
                        'nom' => $nom,
                        'prenom' => $prenom,
                        'montant'=>$montant,
                        'categorie' => $category,
                        'recu' => $recu['name'],
                        'date_don' => date('Y-m-d'),
                    ]);
                    //echo 'membre non trouver';
                }
            }

            else{
                  $this->don->insert([
                        'montant'=>$montant,
                        'categorie' => $category,
                        'recu' => $recu['name'],
                        'date_don' => date('Y-m-d'),
                    ]);
            }
 
            }


        }

        // Render the form
        $this->view->render($data);
    }
}
?>
