<?php
require_once('../models/partenaire_model.php');
require_once('../views/home/remiseView.php');

class remiseController {
    private $model;
    private $view;

    public function __construct() {
 
        $this->model = new partenaire_model();
        $this->view = new remiseView();
    }

    // afiicher les partenaires with search and filtering
    public function index() {
        $filters = [];

        //  search parameter filtre
        if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
            $filters['search'] = trim($_GET['search']);
        }

        //  category filter
        if (isset($_GET['category']) && !empty($_GET['category'])) {
            $filters['categorie'] = $_GET['category'];
        }

        //  city filter
        if (isset($_GET['city']) && !empty($_GET['city'])) {
            $filters['ville'] = $_GET['city'];
        }

        $partenaires = $this->model->getFiltered($filters);

        // view render
        $this->view->render($partenaires, $filters);
    }


}
?>
