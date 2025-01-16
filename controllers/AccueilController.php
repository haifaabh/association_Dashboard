<?php
require_once("../models/newseventactivity.php");

class AccueilController
{

    public function index()
    {
        $model = new newseventactivity();

        $activities = $model->where(['type' => 'activity']);
        $events = $model->where(['type' => 'event']);
        $news = $model->where(['type' => 'news']);


        $this->render('accueil', [
            'activities' => $activities,
            'events' => $events,
            'news' => $news
        ]);
    }

    private function render($view, $data)
    {
        extract($data); // Extract data to variables
        require_once("../views/home/$view.php"); // Load the view file
    }



    

}



?>