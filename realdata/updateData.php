<?php 
require_once 'includes/entete.php';
$retour=array();


try{
   
 
    $params = (array) json_decode(file_get_contents('php://input'), TRUE);
    
   /* pg_query("UPDATE public.pos_tab_index_prs
						SET relexterne_id='".$row[0]."', code='".$loadcode."'
						WHERE code='".$loadcode."' AND WHERE relexterne_id='".$row[0]."'  ");*/
    
    $trouve=false;
    $numero_poseidon=0;
 
    $id_rq=0;
    $id_rq_matricule='';
    $id_rq_civilite='';
    $id_rq_nom='';
    $id_rq_pre='';
    $id_rq_email='';
    $id_rq_date_naiss='';
    $id_rq_lieu_naiss='';
    $id_rq_sit_mat='';
    $id_rq_nationalite='';
    $id_rq_domicile='';
    $id_rq_nbre_enfts=0;
    $id_rq_ctc_nom='';
    $id_rq_ctc_prenom='';
    $id_rq_ctc_teleph='';
    $id_rq_ctc_fil='';


  /*  pg_query('UPDATE
        public.pos_tab_index_prs 
         SET 
             "NOM"="SAMBA KONEA"
         WHERE "NUD"=1011');*/



       
    if(!empty($params['id'])){
         
        //retrouvez les données à partir de l'id
        $numero_poseidon=$params['id'];

        $prs_id=pg_query('SELECT
            "NUD" AS id_pos,
            "MAT" AS matricule,
            "CIV" AS civilite,
            "NOM" AS nom,
            "PRE" AS prenoms,
            "MEL" AS email,
            "DNS" AS date_naissance,
            "LNS" AS lieu_naissance,
            "SIF" AS sit_mat,
            "NAT" AS nationalite,
            "CNE" AS domicile,
            "NEF" AS nbre_enfts,
            "PAC" AS ctc_nom,
            "PRM" AS ctc_prenom,
            "NTC" AS ctc_telephone,
            "FLN" AS ctc_filiation
        FROM 
        public.pos_tab_index_prs WHERE "NOM" IS NOT NULL AND  "NUD"='.$numero_poseidon.'   ');
        
        while ($rowID = pg_fetch_array($prs_id)) {
      
            $id_rq=$rowID['id_pos'];
            $id_rq_matricule=$rowID['matricule'];
            $id_rq_civilite=$rowID['civilite'];
            $id_rq_nom=$rowID['nom'];
            $id_rq_pre=$rowID['prenoms'];
            $id_rq_email=$rowID['email'];
            $id_rq_date_naiss=$rowID['date_naissance'];
            $id_rq_lieu_naiss=$rowID['lieu_naissance'];
            $id_rq_sit_mat=$rowID['sit_mat'];
            $id_rq_nationalite=$rowID['nationalite'];
            $id_rq_domicile=$rowID['domicile'];
            $id_rq_nbre_enfts=$rowID['nbre_enfts'];
            $id_rq_ctc_nom=$rowID['ctc_nom'];
            $id_rq_ctc_prenom=$rowID['ctc_prenom'];
            $id_rq_ctc_teleph=$rowID['ctc_telephone'];
            $id_rq_ctc_fil=$rowID['ctc_filiation'];
        }

        if($id_rq !=0){
            $trouve=true;
        }else{
            $trouve=false;
        }
      
    if($trouve==true){
        //cela evite de vider les champs qui ne doivent pas etre modifier leur de la requete update
      
        $matricule= $params['matricule'] ?? $id_rq_matricule;
        $civilite= $params['civilite'] ?? $id_rq_civilite;
        $nom= $params['nom'] ?? $id_rq_nom;
        $prenoms =$params['prenoms'] ?? $id_rq_pre;
        $email =$params['email'] ?? $id_rq_email;
        $date_naissance =$params['date_naissance'] ?? $id_rq_date_naiss;
        $lieu_naissance =$params['lieu_naissance'] ?? $id_rq_lieu_naiss;
        $sit_mat =$params['sit_mat'] ?? $id_rq_sit_mat;
        $nationalite =$params['nationalite'] ?? $id_rq_nationalite;
        $domicile =$params['domicile'] ?? $id_rq_domicile;
        $nbre_enfts =$params['nbre_enfts'] ?? $id_rq_nbre_enfts;
        $ctc_nom =$params['ctc_nom'] ?? $id_rq_ctc_nom;
        $ctc_prenom =$params['ctc_prenom'] ?? $id_rq_ctc_prenom;
        $ctc_telephone =$params['ctc_telephone'] ?? $id_rq_ctc_teleph;
        $ctc_filiation =$params['ctc_filiation'] ?? $id_rq_ctc_fil;  

       /*
        pg_query("UPDATE
        public.pos_tab_index_prs 
        SET 
            \"MAT\"='$matricule',
            \"CIV\"='$civilite',
            \"NOM\"='$nom' 
        WHERE  \"NUD\"=".$numero_poseidon."   ");*/

        pg_query("UPDATE
        public.pos_tab_index_prs 
        SET 
            \"MAT\"='$matricule',
            \"CIV\"='$civilite',
            \"NOM\"='$nom',
            \"PRE\"='$prenoms',
            \"MEL\"='$email',
            \"DNS\"='$date_naissance',
            \"LNS\"='$lieu_naissance',
            \"SIF\"='$sit_mat',
            \"NAT\"='$nationalite',
            \"CNE\"='$domicile',
            \"NEF\"='$nbre_enfts',
            \"PAC\"='$ctc_nom',
            \"PRM\"='$ctc_prenom',
            \"NTC\"='$ctc_telephone',
            \"FLN\"='$ctc_filiation'
            
        WHERE  \"NUD\"=".$numero_poseidon."   ");

            $retour["success"]=200;
            $retour["message"]='Update data';
            $retour["author"]='By Ibson';


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