<?php
require_once('../core/Database.php');


class Model extends Database{

    protected $table;
	protected $limit 		= 10;
	protected $offset 		= 0;
	protected $order_type 	= "desc";
	protected $order_column = "id";
	public $errors 		= [];

	public function findAll()
	{
	 
		$query = "select * from $this->table order by $this->order_column $this->order_type ";
		return $this->query($query);
	}

	public function where($data, $data_not = [])
	{
		// Récupérer les clés des données et des données "not equal"
		$keys = array_keys($data);
		$keys_not = array_keys($data_not);
	
		// Construction de la requête de base
		$query = "select * from $this->table";
	
		// Construction des conditions WHERE si elles existent
		$conditions = [];
		foreach ($data as $key => $value) {
			$conditions[] = "$key = :$key";
		}
		foreach ($data_not as $key => $value) {
			$conditions[] = "$key != :$key";
		}
	
		// Ajouter la condition WHERE seulement si elle n'est pas vide
		if (!empty($conditions)) {
			$query .= " where " . implode(" && ", $conditions);
		}
	
		// Ajouter la clause order et la pagination
		$query .= " order by $this->order_column $this->order_type limit $this->limit offset $this->offset";
	
		// Fusionner les données pour la requête
		$params = array_merge($data, $data_not);
	
		// Exécuter la requête
		return $this->query($query, $params);
	}
	

	public function first($data, $data_not = [])
	{
		$keys = array_keys($data);
		$keys_not = array_keys($data_not);
		$query = "select * from $this->table where ";

		foreach ($keys as $key) {
			$query .= $key . " = :". $key . " && ";
		}

		foreach ($keys_not as $key) {
			$query .= $key . " != :". $key . " && ";
		}
		
		$query = trim($query," && ");

		$query .= " limit $this->limit offset $this->offset";
		$data = array_merge($data, $data_not);
		
		$result = $this->query($query, $data);
		if($result)
			return $result[0];

		return false;
	}

	public function insert($data)
	{
		
		if(!empty($this->allowedColumns))
		{
			foreach ($data as $key => $value) {
				
				if(!in_array($key, $this->allowedColumns))
				{
					unset($data[$key]);
				}
			}
		}

		$keys = array_keys($data);

		$query = "insert into $this->table (".implode(",", $keys).") values (:".implode(",:", $keys).")";
		try{
			$this->query($query, $data);	
			return true;
		}
		catch(Exception $e){
			error_log("Database insert error: " . $e->getMessage());
			return false;
		}
	}

	public function update($id, $data, $id_column = 'id')
	{

		if(!empty($this->allowedColumns))
		{
			foreach ($data as $key => $value) {
				
				if(!in_array($key, $this->allowedColumns))
				{
					unset($data[$key]);
				}
			}
		}

		$keys = array_keys($data);
		$query = "update $this->table set ";

		foreach ($keys as $key) {
			$query .= $key . " = :". $key . ", ";
		}

		$query = trim($query,", ");

		$query .= " where $id_column = :$id_column ";
        $data[$id_column] = $id;

        try {
            $this->query($query, $data);
            return true; // Return true on successful update
        } catch (Exception $e) {
            error_log("Database update error: " . $e->getMessage());
            return false;
        }
    

	}

	public function delete($id, $id_column = 'id')
	{

		$data[$id_column] = $id;
		$query = "delete from $this->table where $id_column = :$id_column ";
		$this->query($query, $data);

		return false;

	}

	public function getById($id, $id_column = 'id')
    {
        $query = "SELECT * FROM $this->table WHERE $id_column = :$id_column LIMIT 1";
        $params = [$id_column => $id];

        $result = $this->query($query, $params);

        return $result ? $result[0] : false; 
    }


	public function verifyPassword($inputPassword, $storedPassword) {
        return $inputPassword === $storedPassword;
    }
}

	

?>