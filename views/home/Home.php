<?php
// require_once('../../core/Model.php');
require_once('../../models/admin.php');
require_once('../../models/accueil_model.php');

class Home{
    public function index(){
      
        $acceuil= new accueil_model();
        $result=$acceuil->where(['type' => 'activity']);
        $acceuil->show($result);
    }


}
$home = new Home();
$home->index();
?>
