<?php
require_once('../models/partenaire_model.php');
require_once('../views/admin/AdminPartnerView.php');
require_once('../views/admin/SidebarView.php');

class AdminPartnerController {
    private $model;
    private $view;
    private $sidebar;

    public function __construct() {
        session_start();  
        if (!isset($_SESSION['admin_id'])) {
            header("Location: ?route=admin/login");  
            exit();
        }
        $this->model = new partenaire_model();
        $this->view = new AdminPartnerView();
        $this->sidebar = new SidebarView();
    }

    // afficher les partenaires with search and filtering
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


    public function addPartner() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nom' => $_POST['nom'],
                'categorie' => $_POST['categorie'],
                'ville' => $_POST['ville'],
                'detail_reduction' => $_POST['detail_reduction'],
                'lien_site_web' => $_POST['lien_site_web'],
            ];
            $this->model->addPartenaire($data);
            header("Location: ?route=admin/gestion-partenaire");
            exit();
        }
        $this->view->renderAddPartnerForm();
    }
    

    public function deletePartner(){
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $partnerId = intval($_GET['id']); //convert to int
        if ($this->model->deletePartenaire($partnerId)) {
            header("Location: ?route=admin/gestion-partenaire");
        } else {
            header("Location: ?route=admin/gestion-partenaire");
        }
    } else {
        //id invalide
        header("Location: ?route=admin/gestion-partenaire&message=invalid_id");
    }

    }

    public function editPartner()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $data = [
            'nom' => $_POST['nom'],
            'categorie' => $_POST['categorie'],
            'ville' => $_POST['ville'],
            'detail_reduction' => $_POST['detail_reduction'],
            'lien_site_web' => $_POST['lien_site_web'],
        ];
        $this->model->updatePartenaire($id, $data);
        header("Location: ?route=admin/gestion-partenaire");
        exit();
    }

    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $partner = $this->model->getbyId($_GET['id']);
        if ($partner) {
            $this->view->renderEditPartnerForm($partner);
        } else {
            header("Location: ?route=admin/gestion-partenaire&message=partner_not_found");
            exit();
        }
    }
}

}
?>
