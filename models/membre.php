<?php
require_once('../core/Model.php');

class membre extends Model
{
    protected $table='membre';
    protected $allowedColumns=[  //allowed columns to be edited
        'nom',
        'prenom',
        'piece_identite',
        'recu',
        'date_inscription',
        'date_expiration',
        'email',
        'mot_de_passe',
        'telephone',
        'photo',
        'type_carte',
        'status_abonnement'
    ];
    
    public function getWhere($conditions) {
        $sql = "SELECT * FROM {$this->table} WHERE ";
        $sql .= implode(' AND ', array_map(function ($col) {
            return "{$col} = :{$col}";
        }, array_keys($conditions)));

        return $this->query($sql, $conditions);
    }


    

  
}

?>
