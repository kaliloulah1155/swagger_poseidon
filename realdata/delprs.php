<?php 
require_once 'includes/entete.php';
$retour=array();


try{
   
 
    $params = (array) json_decode(file_get_contents('php://input'), TRUE);
    
   /* pg_query("UPDATE public.pos_tab_index_prs
						SET relexterne_id='".$row[0]."', code='".$loadcode."'
						WHERE code='".$loadcode."' AND WHERE relexterne_id='".$row[0]."'  ");*/
    $retour["success"]=200;
    $retour["message"]='Update data';
    $retour["author"]='By Ibson';
    
    $trouve=false;
    $numero_poseidon=$params['id'];

   
   
    $id_rq=0;
  
    if(!empty($numero_poseidon)){
         
        //retrouvez les données à partir de l'id
        $prs_id=pg_query('SELECT
            "NUD"
        FROM 
        public.pos_tab_index_prs WHERE  "NUD"='.$numero_poseidon.'  ');
        
        while ($rowID = pg_fetch_row($prs_id)) {
            $id_rq=$rowID[0];
        }

         //echo  $id_rq;exit;

        if($id_rq !=0){
            $trouve=true;
        }else{
            $trouve=false;
        }
      
            if($trouve==true){
            
                $personne=pg_query(' DELETE FROM public.pos_tab_index_prs WHERE "NUD"='.$numero_poseidon.'  ');

                $retour["results"]= array( 
                     "personnel supprimé avec succès"
                );
                echo json_encode($retour, TRUE ); 

            }else{
                $retour["error"]=201;
                $retour["message"]="Numéro poseidon introuvable ";
                echo json_encode($retour, TRUE );
            }
    }else{
        $retour["error"]=401;
        $retour["message"]="Numéro poseidon inexistant ";
        echo json_encode($retour, TRUE );
    }
      
}catch(Exception $e){
    $retour["error"]=400;
    $retour["message"]='Bad connexion '.$e;
}
     
    
  

?>