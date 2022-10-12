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
        
        $personne=pg_query('SELECT
            "NUD","MAT","CIV","NOM","PRE","MEL","DNS","LNS","SIF","NAT"
            ,"CNE","NEF","PAC","PRM","NTC","FLN"
        FROM 
        public.pos_tab_index_prs WHERE "NOM" IS NOT NULL AND  "NUD"='.$numero_poseidon.' ORDER BY "NOM" ASC   ');
        while ($rowc = pg_fetch_array($personne)) {
        
            $retour["results"][] = array( 
                "id" => $rowc[0],
                "matricule" => $rowc[1],
                "civilite" => $rowc[2],
                "nom" => $rowc[3],
                "prenoms"   => $rowc[4],
                "email"   => $rowc[5],
                "date_naissance"   => $rowc[6],
                "lieu_naissance"   => $rowc[7],
                "sit_mat"   => $rowc[8],
                "nationalite"   => strtoupper($rowc[9]),
                "domicile"   => $rowc[10],
                "nbre_enfts"   => $rowc[11],
                'pers_a_contacter'=>[
                    'nom'=>$rowc[12],
                    'prenoms'=>$rowc[13],
                    'telephone'=>$rowc[14],
                    'filiation'=>$rowc[15]
                ]
            );
        }
       
    

       
        //$retour["data"]=$params ;
      // $retour["data"]=$nom_rq ;
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