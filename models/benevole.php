<?php
require_once('../core/Model.php');

class benevole extends Model{
    protected $table='benevole';
    protected $allowedColumns=[  
        'evenement_id',
        'membre_id',
        'status'
    ];
    public function getBenevoles() {
        return $this->where(['status' => 'en attente']);
    }

    public function addBenevole($evenementId, $membreId) {
        $data = [
            'evenement_id' => $evenementId,
            'membre_id' => $membreId,
            'status' => 'en attente'
        ];

        return $this->insert($data);
    }

}


?>








