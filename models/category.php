<?php
require_once('../core/Model.php');

class category extends Model{
    protected $table='category';
    protected $allowedColumns=[  
        'nom',
        'description'
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
