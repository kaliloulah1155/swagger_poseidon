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


    // Insert a new record.
    /**
     * @OA\Post(path="/API_RES_POSEIDON/api/categories/insert.php",
     * summary="Insérer une nouvelle catégorie.", tags={"Categories"},
     * security={{"bearerAuth":{}}},
     * @OA\RequestBody(
     *    @OA\MediaType(
     *        mediaType="multipart/form-data",
     *        @OA\Schema(
     *            required={"lfr","len"},
     *            @OA\Property(
     *                description="Slug",
     *                property="slu",
     *                type="string",
     *            ),
     *            @OA\Property(
     *                description="Libellé en francais",
     *                property="lfr",
     *                type="string",
     *            ),
     *            @OA\Property(
     *                description="Libellé en anglais",
     *                property="len",
     *                type="string",
     *            ),
     *            @OA\Property(
     *                description="Statut : 0:activé | 1:desactivé",
     *                property="stt",
     *                type="integer",
     *            ),
     *            @OA\Property(
     *                description="Position",
     *                property="pst",
     *                type="integer",
     *            ),
     *            @OA\Property(
     *                description="Identifiant catégorie parent",
     *                property="ica",
     *                type="string",
     *            ),
     *            @OA\Property(
     *                description="Code",
     *                property="cod",
     *                type="string",
     *            ),
     *        ),
     *    ),
     * ),
     * @OA\Response(response="200", description="Success"),
     * @OA\Response(response="404", description="Not found"),
     * )
     */
    
    public function create_new_record($params)
    {
        try
        {
            $listeCAT = liste_donnee(["COD"], "\"COD\"='".$params['COD']."'", "CAT")[0];
            $listeCA = liste_donnee(["LFR"], "\"LFR\"='" .$params['LFR']. "'", "CAT")[0];
			if($listeCAT["COD"]==NULL || $listeCA["LFR"]==NULL){
                    ajouter_donnee($params, 'CAT');
                    return true;
             }else{
                return false;
             }  
           
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

 
    // Update a new record.
    /**
     * @OA\Post(path="/API_RES_POSEIDON/api/categories/update.php",
     * summary="Mise à jour d'une catégorie.", tags={"Categories"},
     * security={{"bearerAuth":{}}},
     * @OA\RequestBody(
     *    @OA\MediaType(
     *        mediaType="multipart/form-data",
     *        @OA\Schema(
     *            required={"id"},
     *            @OA\Property(
     *                property="id",
     *                type="integer",
     *            ),
     *            @OA\Property(
     *                description="Slug",
     *                property="slu",
     *                type="string",
     *            ),
     *            @OA\Property(
     *                description="Libellé en francais",
     *                property="lfr",
     *                type="string",
     *            ),
     *            @OA\Property(
     *                description="Libellé en anglais",
     *                property="len",
     *                type="string",
     *            ),
     *            @OA\Property(
     *                description="Statut : 0:activé | 1:desactivé",
     *                property="stt",
     *                type="integer",
     *            ),
     *            @OA\Property(
     *                description="Position",
     *                property="pst",
     *                type="integer",
     *            ),
     *            @OA\Property(
     *                description="Identifiant catégorie parent",
     *                property="ica",
     *                type="string",
     *            ),
     *            @OA\Property(
     *                description="Code",
     *                property="cod",
     *                type="string",
     *            ),
     *        ),
     *    ),
     * ),
     * @OA\Response(response="200", description="Success"),
     * @OA\Response(response="404", description="Not found"),
     * )
     */
    public function update_new_record($params)
    {
        try
        {
            $record = liste_donnee(["ID"], "\"ID\"='".$params['ID']."'", "CAT")[0];
        
			if(!empty($record)){
                modifier_donnee(
                    $params,
                    ['ID' => $params["ID"]],
                    'CAT'
                );
                    return true;
             }else{
                return false;
             }  
           
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }
     
    // Delete a record.
    /**
     * @OA\Post(path="/API_RES_POSEIDON/api/categories/destroy.php",
     * summary="Supprimer une catégorie.", tags={"Categories"},
     * security={{"bearerAuth":{}}},
     * @OA\RequestBody(
     *    @OA\MediaType(
     *        mediaType="multipart/form-data",
     *        @OA\Schema(
     *            required={"id"},
     *            @OA\Property(
     *                property="id",
     *                type="integer",
     *            ),
     *        ),
     *    ),
     * ),
     * @OA\Response(response="200", description="Success"),
     * @OA\Response(response="404", description="Not found"),
     * )
     */
    public function delete_record($params)
    {
        try
        {
            $record = liste_donnee(["ID"], "\"ID\"='".$params['ID']."'", "CAT")[0];
			if(!empty($record)){
				supprimer_donnee("\"ID\"=" . $params["ID"],"CAT");
                    return true;
             }else{
                return false;
             }  
           
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }





}