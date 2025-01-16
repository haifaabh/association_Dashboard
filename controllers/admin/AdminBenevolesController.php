<?php
require_once('../models/benevole.php');
require_once('../models/membre.php');
require_once('../models/newseventactivity.php');
require_once('../views/admin/adminBenevolesView.php');

class AdminBenevolesController {
    private $benevoleModel;
    private $membreModel;
    private $activityModel;

    public function __construct() {
        session_start();  
        if (!isset($_SESSION['admin_id'])) {
            header("Location: ?route=admin/login");  
            exit();
        }
        $this->benevoleModel = new benevole();
        $this->membreModel = new membre();
        $this->activityModel = new newseventactivity();
    }

    public function AfficherBenevoles() {
        $volunteers = $this->benevoleModel->getBenevoles();

        $volunteerData = [];
        foreach ($volunteers as $volunteer) {
            $member = $this->membreModel->getWhere(['id' => $volunteer->membre_id])[0];
            $event = $this->activityModel->getById($volunteer->evenement_id);

            $volunteerData[] = [
                'id' => $volunteer->id,
                'nom' => $member->nom,
                'prenom' => $member->prenom,
                'email' => $member->email,
                'titre' => $event->titre,
                'date' => $event->date,
                'status' => $volunteer->status,
            ];
        }

        $view = new adminBenevolesView();
        $view->render($volunteerData);
    }

    public function updateBenevoleStatus() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $volunteerId = $_POST['id'];
            $status = $_POST['action'] === 'accepte' ? 'accepté' : 'refusé';

            $this->benevoleModel->update($volunteerId, ['status' => $status]);

            header('Location: ?route=admin/benevoles');
            exit;
        }
    }
}
?>
