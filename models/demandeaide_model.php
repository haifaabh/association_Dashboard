<?php
require_once('../core/Model.php');

class demandeaide_model extends Model{
    protected $table='demandeaide';
    protected $allowedColumns=[  
        'membre_id',
        'category_id',
        'date_naissance',
        'piece_jointe',
        'date_emission',
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
