<?php
class Database{
    private $dbname="associationdb";
    private $host="localhost:3307";
    private $user="root";
    private $pass="";

    private function connexion($dbname,$host, $user, $pass){
        $sdn="mysql:dbname=$dbname;host=$host";
        try{
            $c=new PDO($sdn,$user,$pass);
        }
        catch(PDOException $ex){
            printf("erreur de connexion a la base de  données",$ex->getMessage());
            exit();
        }
        return  $c;
    }

    private function deconnexion($c){
        $c=null;
    }
    

    public function query($query,$data = []){
        $c=$this->connexion($this->dbname,$this->host, $this->user,$this->pass);
        $stm = $c->prepare($query);

        $check=$stm->execute($data);
        if($check)
        {
            $result=$stm->fetchAll(PDO::FETCH_OBJ);
            $this->deconnexion($c);
            if(is_array($result) && count($result))
            {
                return $result;
            }

        }
       $this->deconnexion($c);
       return false;
    }


}


?>