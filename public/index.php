<?php
require_once('../controllers/RegistrationController.php');
require_once('../controllers/AccueilController.php');
require_once('../controllers/CatalogueController.php');
require_once('../controllers/admin/loginController.php');
require_once('../controllers/admin/AdminPartnerController.php');
require_once('../controllers/admin/AdminMembresController.php');
require_once('../controllers/admin/AdminMembresAllController.php');
require_once('../controllers/admin/AdminDonController.php');
require_once('../controllers/admin/AdminBenevolesController.php');
require_once('../controllers/DonController.php');
require_once('../controllers/ActivityController.php');
require_once('../controllers/remiseController.php');
require_once('../controllers/user/UserLoginController.php');
require_once('../controllers/user/UserProfileController.php');
require_once('../controllers/user/UserCarteController.php');
require_once('../controllers/user/UserDonController.php');
require_once('../controllers/user/UserDemandeAideController.php');
require_once('../controllers/partenaire/partenaireLoginController.php');
require_once('../controllers/partenaire/partenaireProfileController.php');
require_once('../controllers/partenaire/cardVerificationController.php');

$route = $_GET['route'] ?? '';  

switch ($route) {

       case 'admin/login':
        $controller = new loginController();
        $controller->index();
        break;

        case 'admin/logout':
        $controller = new loginController();
        $controller->logout();
        break;

        case 'admin/gestion-partenaire':  
            $controller = new AdminPartnerController();
            $filters = [
                'search' => $_GET['search'] ?? '',
                'category' => $_GET['category'] ?? '',
                'city' => $_GET['city'] ?? ''
            ];

            $controller->index($filters);
            break;
    
        case 'admin/gestion-partenaire/add':  
            $controller = new AdminPartnerController();
            $controller->addPartner();  
            break;

        case 'admin/delete-partner':
           $controller = new AdminPartnerController();
           $controller->deletePartner($_GET['id']);
           break;


        case 'admin/gestion-partenaire/edit':
            $controller = new AdminPartnerController();
            $controller->editPartner();
            break;

        case 'admin/gestion-membres':
         $controller = new AdminMembresController();
         $controller->afficherMembres();
         break;

        case 'admin/gestion-membres-action':
            $controller = new AdminMembresController();
            $controller->handleMembreAction();  
            break;

        case 'admin/liste-membres':
            $controller = new AdminMembresAllController();
            $controller->afficherMembres();
            break;
        
         case 'admin/dons':
            $controller = new AdminDonController();
            $controller->afficherDon();
            break;

        case 'admin/gestion-don-action':
            $controller = new AdminDonController();
            $controller->validerDon();
            break;
        
        case 'admin/benevoles':
            $controller = new AdminBenevolesController();
            $controller->AfficherBenevoles();
        break;

        case 'admin/update-benevoles':
            $controller = new AdminBenevolesController();
            $controller->updateBenevoleStatus();
        break;

        case 'partenaire/login':
            $controller = new partenaireLoginController();
            $controller->index();
        break;

        case 'partenaire/logout':
            $controller = new partenaireLoginController();
            $controller->logout();
        break;

        case 'partenaire/profile':
            $controller = new partenaireProfileController();
            $controller->profile();
            break;
    
        case 'partenaire/updatePartenaireProfile':
            $controller = new partenaireProfileController();
            $controller->updateProfile();
            break;
            
        case 'partenaire/carte':
            $controller = new cardVerificationController();
            $controller->index();
            break;  
  
        case 'partenaire/verifyCard':
                $controller = new cardVerificationController();
                $controller->verify();
                break;  
        case 'register':
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $controller = new RegistrationController();
            $controller->display();
        }
        elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new RegistrationController();
            $controller->register(array_merge($_POST, $_FILES));  
        }
        break;

        case 'user/login':
            $controller=new UserLoginController;
            $controller->index();
        break;

        case 'user/logout':
            $controller=new UserLoginController;
            $controller->logout();
        break;

        case 'user/profile':
            $controller=new UserProfileController;
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->update();
            } else {
                $controller->index();
            }
            break;        
        
        case 'user/carte': 
          $controller = new UserCarteController();
          $controller->index();
          break;

        case 'user/dons': 
        $controller = new UserDonController();
        $controller->afficherDon();
        break;

        case 'user/benevolats': 
            $controller = new ActivityController();
            $controller->getBenevolats();
            break;

        case 'user/demande-aide':
            $controller = new UserDemandeAideController();
            $controller->displayForm();
        break;
        
        case 'user/demande-aide/submit':
            $controller = new UserDemandeAideController();
             if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                 $controller->submitForm();
             } else {
                 $controller->displayForm();
             }
        break;
       
        case 'don':
        $controller = new DonController();
        $controller->effectuerDon();
        break;


        case 'remise':
            $controller = new remiseController();
            $filters = [
                'search' => $_GET['search'] ?? '',
                'category' => $_GET['category'] ?? '',
                'city' => $_GET['city'] ?? ''
            ];
            $controller->index($filters);
            break;
        
        case 'catalogue':
            $controller = new CatalogueController();
            $filters = [
                'search' => $_GET['search'] ?? '',
                'category' => $_GET['category'] ?? '',
                'city' => $_GET['city'] ?? ''
            ];
            $controller->showCatalogue($filters);
            break;
        
        case 'activity':
            $controller = new ActivityController();
            $controller->index();
            break;
        
        case 'activity/signup':
            $controller = new ActivityController();
            $controller->signup();
            break;

        case 'home':
          default:
            $controller = new AccueilController();
            $controller->index();
            break;
}
?>
