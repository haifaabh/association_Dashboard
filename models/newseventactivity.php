<?php
require_once('../core/Model.php');

class newseventactivity extends Model{
    protected $table='newseventactivity';
    protected $allowedColumns=[  
        'titre',
        'image',
        'description',
        'type',
        'date',
        'location'
    ];
    public function getActivities() {
        return $this->where(['type' => 'activity']);
    }


}


?>








