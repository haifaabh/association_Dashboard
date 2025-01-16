<?php
require_once('../core/Model.php');

class partenaire_model extends Model
{
    protected $table = 'partenaire';

    protected $allowedColumns = [
        'nom',
        'categorie',
        'ville',
        'detail_reduction',
        'lien_site_web',
        'email',
        'mot_de_passe'
    ];


    // Récupérer les partenaires avec des filtres personnalisés
    public function getFiltered($filters = [])
    {
        $query = "SELECT * FROM {$this->table} WHERE 1=1";
        $params = [];
        
        // keywords dans la barre de recherche
        if (!empty($filters['search'])) {
            $query .= " AND (nom LIKE :search 
                       OR categorie LIKE :search 
                       OR ville LIKE :search 
                       OR detail_reduction LIKE :search)";
            $params['search'] = '%' . $filters['search'] . '%';
        }
        
        //  categorie filter
        if (!empty($filters['categorie'])) {
            $query .= " AND categorie = :categorie";
            $params['categorie'] = $filters['categorie'];
        }
        
        //  ville filter
        if (!empty($filters['ville'])) {
            $query .= " AND ville = :ville";
            $params['ville'] = $filters['ville'];
        }
        
        // Add ordering and pagination
        $query .= " ORDER BY {$this->order_column} {$this->order_type} 
                   LIMIT {$this->limit} OFFSET {$this->offset}";
        
        return $this->query($query, $params);
    }


    // Ajouter un nouveau partenaire
    public function addPartenaire($data)
    {
        return $this->insert($data);
    }

    // Mettre à jour un partenaire existant
    public function updatePartenaire($id, $data)
    {
        return $this->update($id, $data);
    }

    // Supprimer un partenaire
    public function deletePartenaire($id)
    {
        return $this->delete($id);
    }
}
?>
