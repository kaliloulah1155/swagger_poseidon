<?php
require_once('../../core/fonction.php');
error_reporting(E_ALL);
ini_set('display_error',1);


class Category {
    

    //Categories Properties
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
        $categories = liste_donnee(["ID","LFR","LEN"],"","CAT");
        return $categories;
    }

    /*
    // Get single post.
    public function read_single_post($id)
    {
        $this->id = $id;
        // Query to get posts data.
        
        $query = 'SELECT 
            c.name as category,
            p.id,
            p.category_id,
            p.title,
            p.description,
            p.created_at
            FROM
            '.$this->table.' p LEFT JOIN
            category c 
            ON p.category_id = c.id
            WHERE p.id= ?
            LIMIT 0,1';
            
        $post = $this->connection->prepare($query);
        
        //$post->bindParam(9, $this->id);
        
        $post->execute([$this->id]);


        return $post;
       
    }


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