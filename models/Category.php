<?php
require_once('../../core/fonction.php');
error_reporting(E_ALL);
ini_set('display_error',1);


class Category {
    

    //Categories Properties
    public $id;
    public $slu;
    public $len;
    public $lfr;
    public $stt;
    public $pst;
    public $ica;
    public $cod;

 
    // Get all list of categories.
    /**
     * @OA\Post(
     * path="/API_RES_POSEIDON/api/categories/categories.php",
     * summary="Afficher toutes les categories",
     * tags={"Categories"},
     * security={{"bearerAuth":{}}}, 
     * @OA\Response(response="200", description="Success"),
     * @OA\Response(response="404", description="Not found"),
     * )
     */
    public function read()
    {
        // Query to get categories data.
        $categories = liste_donnee([],"","CAT");
        return $categories;
    }

    
    // Get single categories.
    /**
     * @OA\Post(path="/API_RES_POSEIDON/api/categories/single.php",
     * tags={"Categories"},
     * security={{"bearerAuth":{}}}, 
     * summary="Afficher une catégorie par id",
     * @OA\Parameter(
     *    name="id",
     *    in="query",
     *    required=true,
     *    description="The id passed to get in query string goes here",
     *    @OA\Schema(
     *       type="string"
     *    ),
     * ),
     * @OA\Response(response="200", description="Success"),
     * @OA\Response(response="404", description="Not found"),
     * )
     */
    public function read_single_category($id)
    {
        $this->id = $id;
        // Query to get posts data.

        $categorie = liste_donnee([],"\"ID\"='".$this->id."'","CAT");
        //$categorie = liste_donnee([],"\"ID\"='".$this->id."' AND  \"DEL\" IS NULL AND \"STT\"=1","CAT");
        return $categorie;
       
    }

/*
    // Insert a new record.
    
    public function create_new_record($params)
    {
        try
        {
            $this->title       = $params['title'];
            $this->description = $params['description'];
            $this->category_id = $params['category_id'];
    
            $query = 'INSERT INTO '. $this->table .' 
                SET
                  title = :title,
                  category_id = :category_id,
                  description = :details';
           
            $statement = $this->connection->prepare($query);
                    
            $statement->bindValue('title', $this->title);
            $statement->bindValue('category_id', $this->category_id);
            $statement->bindValue('details', $this->description);
            
            if($statement->execute())
            {
                return true;
            }
    
            return false;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }


    // Update a new record.
    
    public function update_new_record($params)
    {
        try
        {
            $this->id          = $params['id'];
            $this->title       = $params['title'];
            $this->description = $params['description'];
            $this->category_id = $params['category_id'];
    
            $query = 'UPDATE '. $this->table .' 
                SET
                  title = :title,
                  category_id = :category_id,
                  description = :details
                WHERE id = :id';
           
            $statement = $this->connection->prepare($query);
            
            $statement->bindValue('id', $this->id);
            $statement->bindValue('title', $this->title);
            $statement->bindValue('category_id', $this->category_id);
            $statement->bindValue('details', $this->description);
            
            if($statement->execute())
            {
                return true;
            }
    
            return false;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }
     */



}