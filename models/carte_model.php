<?php
require_once('../core/Model.php');

class carte_model extends Model{
    protected $table='carte';
    protected $allowedColumns=[  //allowed columns to be edited
        'membre_id',
        'qr_code',
        'type_carte',
        'date_emission',
        'date_expiration',
    ];


    public function create($data) {
        foreach ($data as $key => $value) {
            if (!in_array($key, $this->allowedColumns)) {
                unset($data[$key]);
            }
        }
        return $this->insert($data);
    }

}
