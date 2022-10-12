<?php 
require_once 'includes/entete.php';   // Chargement du token


ini_set('display_errors', 1);

$retour=array();
try{
    $retour["success"]=200;
    $retour["message"]='Get data';
    $retour["author"]='By Ibson';

        $query_='
        SELECT
            "NUD","MAT","CIV","NOM","PRE","MEL","DNS","LNS","SIF","NAT"
            ,"CNE","NEF","PAC","PRM","NTC","FLN"
        FROM 
            public.pos_tab_index_prs
        ';

        $counter=pg_query('SELECT
        count(*) AS nbre
        FROM 
        public.pos_tab_index_prs WHERE "NOM" IS NOT NULL   ');
        $nbre=0;
        while ($rowc = pg_fetch_array($counter)) {
        $nbre=$rowc['nbre'];
        }
        $contests_= pg_query($query_) or die('Query failed: ' . pg_last_error());
        $retour["nb"]=$nbre;
        
        while ($row = pg_fetch_array($contests_)) {


            

        $retour["results"][] = array( 
            "id" => $row[0],
            "matricule" => $row[1],
            "civilite" => $row[2],
            "nom" => $row[3],
            "prenoms"   => $row[4],
            "email"   => $row[5],
            "date_naissance"   => $row[6],
            "lieu_naissance"   => $row[7],
            "sit_mat"   => $row[8],
            "nationalite"   => utf8_encode($row[9]),
            "domicile"   => $row[10],
            "nbre_enfts"   => $row[11],
            'pers_a_contacter'=>[
                'nom'=>$row[12],
                'prenoms'=>$row[13],
                'telephone'=>$row[14],
                'filiation'=>$row[15]
            ]
        );

        }
        echo json_encode($retour, TRUE ); 

}catch(Exception $e){
    $retour["error"]=400;
    $retour["message"]='Bad connexion '.$e;
}

  

?>