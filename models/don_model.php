<?php
require_once('../core/Model.php');

class don_model extends Model{
    protected $table='don';
    protected $allowedColumns=[
        'membre_id',
        'nom',
        'prenom',
        'montant',
        'date_don',
        'recu',
        'categorie',
        'status'
    ];

    public function afficherDonEnAttente() {
        return $this->where(['status' => 'en attente']);
    }

}
?>