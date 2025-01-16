<?php
require_once('../models/partenaire_model.php');
require_once('../views/home/catalogue.php');

class CatalogueController
{
    private $partenaireModel;
     private $catalogueview;

    public function __construct()
    {
        $this->partenaireModel = new partenaire_model();
        $this->catalogueview = new catalogue();
    }


    public function showCatalogue() {
        $filters = [];

        // Handle search parameter
        if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
            $filters['search'] = trim($_GET['search']);
        }

        // Handle category filter
        if (isset($_GET['category']) && !empty($_GET['category'])) {
            $filters['categorie'] = $_GET['category'];
        }

        // Handle city filter
        if (isset($_GET['city']) && !empty($_GET['city'])) {
            $filters['ville'] = $_GET['city'];
        }

        $partenaires = $this->partenaireModel->getFiltered($filters);
        $this->catalogueview->render($partenaires,$filters);
    }
    


    
}
?>
