<?php
require_once('../models/newseventactivity.php');
require_once('../models/benevole.php'); 
require_once('../views/home/ActivityView.php');
require_once('../views/user/ActivityUserView.php');

class ActivityController {
    private $activityModel;

    public function __construct() {
        $this->activityModel = new Newseventactivity();
    }

    public function index() {
        session_start();
        $status = isset($_GET['status']) ? $_GET['status'] : null;
        $activities = $this->activityModel->getActivities();
        $view = new ActivityView();
        $view->render($activities, $status);
    }

    public function signup() {
        session_start();
        
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?route=login&error=not_logged_in');
            exit;
        }
    
        $userId = $_SESSION['user_id'];
        $activityId = $_GET['id'];
    
        $benevoleModel = new Benevole();
    
        $existingSignup = $benevoleModel->where([
            'evenement_id' => $activityId,
            'membre_id' => $userId
        ]);
    
        if (!empty($existingSignup)) {
            header('Location: ?route=activity&status=already_signed_up');
            exit;
        }
    
        $result = $benevoleModel->addBenevole($activityId, $userId);
    
        if ($result) {
            header('Location: ?route=activity&status=success');
        } else {
            header('Location: ?route=activity&status=error');
        }
    }

    public function getBenevolats() {
        session_start();
        
        if (!isset($_SESSION['user_id'])) {
            header('Location: ?route=login&error=not_logged_in');
            exit;
        }
    
        $userId = $_SESSION['user_id'];
    
        $benevoleModel = new Benevole();
    
        $benevolats = $benevoleModel->where([
            'membre_id' => $userId
        ]);

        $activities = [];
        if (!empty($benevolats)) {
            foreach ($benevolats as $benevolat) {
                $activity = $this->activityModel->getById($benevolat->evenement_id);
                if ($activity) {
                    $activity->status = $benevolat->status; 
                    $activities[] = $activity;
                }
            }
        }
        $view = new ActivityUserView();
        $view->renderVolunteerActivities($activities);
 
    }
    
}
?>
