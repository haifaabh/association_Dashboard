<?php
require_once('../core/Model.php');

class Admin extends Model {
    protected $table = 'admin';
    protected $allowedColumns = ['nom_utilisateur', 'mot_de_passe', 'email'];

    public function findByEmail($email) {
        return $this->first(['email' => $email]);
    }


}

?>
