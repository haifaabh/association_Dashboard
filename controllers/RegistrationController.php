<?php
require_once("../models/membre.php");

class RegistrationController{
   private $membre;

   public function __construct(){
      $this->membre = new membre();
    }

    public function display(){
        $this->render('auth/registerMember');
    }

    public function register($data)
    {
        $requiredFields = ['nom', 'prenom', 'email', 'mot_de_passe', 'piece_identite', 'recu', 'telephone', 'photo', 'type_carte'];
        foreach ($requiredFields as $field) {
            if (empty($data[$field])) {
                return ["success" => false, "message" => "$field is required"];
            }
        }

        $uploadDirectory = __DIR__ . '/../uploads/';  // Absolute path to the uploads directory

        if (!is_dir($uploadDirectory)) {
            mkdir($uploadDirectory, 0777, true);  
        }
        
    // Store only the file name
    $photoFileName = basename($_FILES['photo']['name']); 
    $photoPath = $uploadDirectory . $photoFileName;
    
    if (move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath)) {
        $data['photo'] = $photoFileName; // Store only the file name
    } else {
        return ["success" => false, "message" => "Failed to upload the photo"];
    }
    
    // Upload recu and store only the file name
    $recuFileName = basename($_FILES['recu']['name']);
    $recuPath = $uploadDirectory . $recuFileName;
    
    if (move_uploaded_file($_FILES['recu']['tmp_name'], $recuPath)) {
        $data['recu'] = $recuFileName; // Store only the file name
    } else {
        return ["success" => false, "message" => "Failed to upload the receipt"];
    }

        // email verification
        $existingMember = $this->membre->where(['email' => $data['email']]);
        if (!empty($existingMember)) {
            return ["success" => false, "message" => "Email already exists"];
        }

        // champs automatiques
        $currentDate = date('Y-m-d'); // date courante
        $expirationDate = date('Y-m-d', strtotime('+1 year')); // date courante + 1 ans
        $data['date_inscription'] = $currentDate;
        $data['date_expiration'] = $expirationDate;
        $data['status_abonnement'] = 'pending';

        // inserer un nouveau membre
        $this->membre->insert($data);
        $this->render('auth/registerMember', ["message" => "Registration successful!"]);
    }

    protected function render($view, $data = [])
    {
        extract($data); 
        require_once("../views/$view.php");
    }
}




?>