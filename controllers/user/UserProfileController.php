<?php
require_once('../models/membre.php');
require_once('../views/user/profileView.php');

class UserProfileController {
    private $membreModel;

    public function __construct() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?route=user/login');
            exit;
        }

        $this->membreModel = new membre();
    }

    public function index() {
        $userId = $_SESSION['user_id'];
        $user = $this->membreModel->getWhere(['id' => $userId]);
        if ($user) {
            $user = $user[0]; 
        } else {
            die('User not found.');
        }

        $view = new profileView();
        $view->render($user);
    }

    public function update() {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user_id'];
            $data = [
                'nom' => $_POST['nom'],
                'prenom' => $_POST['prenom'],
                'email' => $_POST['email'],
                'telephone' => $_POST['telephone'],
                'photo' => $this->handleFileUpload($_FILES['photo'])
            ];
            $this->membreModel->update($userId, $data);
            header('Location: index.php?route=user/profile&status=success');
            exit;
        }
    }

    private function handleFileUpload($file) {
        if (!empty($file['name'])) {
            $targetDir = "../uploads/";
            $fileName = uniqid() . basename($file['name']);
            $targetFilePath = $targetDir . $fileName;

            if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
                return $fileName;
            }
        }
        return null;
    }
}
?>
