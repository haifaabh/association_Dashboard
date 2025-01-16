<?php
require_once("../models/category.php");
require_once("../models/demandeaide_model.php");
require_once("../views/user/DemandeAideView.php");

class UserDemandeAideController
{
    private $categoryModel;
    private $demandeAideModel;
    private $view;

    public function __construct()
    {
        session_start();  
        if (!isset($_SESSION['user_id'])) {
            header("Location: ?route=user/login");  // Redirect to login page si non authentifié
            exit();
        }
        $this->categoryModel = new category();
        $this->demandeAideModel = new demandeaide_model();
        $this->view = new DemandeAideView();
    }

    public function displayForm()
    {
        $categories = $this->categoryModel->findAll();
        $this->view->render($categories);
    }

    public function submitForm()
    { 
        $userId = $_SESSION['user_id'];
        $data = $_POST;
        $data['membre_id'] =$userId;
        $requiredFields = ['category_id', 'date_naissance'];
        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                $categories = $this->categoryModel->findAll();
                $this->view->render($categories, "$field is required");
                return;
            }
        }

        $uploadDirectory = __DIR__ . '/../folderZIP/';
        if (!is_dir($uploadDirectory)) {
            mkdir($uploadDirectory, 0777, true);
        }

        $fileName = basename($_FILES['piece_jointe']['name']);
        $filePath = $uploadDirectory . $fileName;

        if (!move_uploaded_file($_FILES['piece_jointe']['tmp_name'], $filePath)) {
            $categories = $this->categoryModel->findAll();
            $this->view->render($categories, 'Failed to upload the file');
            return;
        }

        $data['piece_jointe'] = $fileName;
        $data['date_emission'] = date('Y-m-d');

        $this->demandeAideModel->create($data);

        $categories = $this->categoryModel->findAll();
        $this->view->render($categories, 'Demande d\'aide submitted successfully');
    }

    
}
