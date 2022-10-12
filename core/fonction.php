<?php 
 
ini_set('display_errors', 1);
/**
 * Comptage des données 
 * $condition string, $table string Code Type Doc
 * return int
 */
if (!function_exists('compter_donnee')) {
    function compter_donnee($condition, $table)
    {
        global $db;
        if ($table != "public.pos_tab_para_entete")
            $table = 'public.pos_tab_index_' . strtolower($table);

        if ($condition == null || $condition == "") {
            if ($table != "public.pos_tab_para_entete")
                $q = "SELECT MAX(\"ID\") AS total FROM $table";
            else
                //$q = "SELECT MAX(inuminfo)+10000 AS total FROM $table";
                $q = "SELECT MAX(inuminfo) AS total FROM $table";
        } else {
            if ($table != "public.pos_tab_para_entete")
                $q = "SELECT MAX(\"ID\") AS total FROM $table WHERE $condition";
            else
                //$q = "SELECT MAX(inuminfo)+10000 AS total FROM $table WHERE $condition";
                $q = "SELECT MAX(inuminfo) AS total FROM $table WHERE $condition";
        }

        $result = pg_query($db, $q);
        while ($row = pg_fetch_array($result)) {
            $data = $row["total"];
        }

        return $data;
    }
}

/**
 * insertion des données 
 * $champsValeurs array associatif, $table string Code Type Doc
 * return boolean
 */
if (!function_exists('ajouter_donnee')) {
    function ajouter_donnee($champValeurs = array(), $table)
    {
        global $db;

        try {
            $inuminfo = compter_donnee(null, "public.pos_tab_para_entete") + 1;
            $inumdocactuel = compter_donnee(null, $table) + 1;


            if (count($champValeurs) != 0) {
                $tabInumdocactuel = array('inumdocactuel' => $inumdocactuel, 'ID' => $inumdocactuel);
                $champValeurs = array_merge($champValeurs, $tabInumdocactuel);

                $champs = $valeurs = "";
                foreach ($champValeurs as $key => $value) {
                    $champs .= '"' . $key . '",';
                    $valeurs .= "'" . $value . "',";
                }
                $t = $table;
                $table = 'public.pos_tab_index_' . strtolower($table);
                $champs = trim($champs, ',');
                $valeurs = trim($valeurs, ',');
                $q1 = "INSERT INTO public.pos_tab_para_entete (inuminfo,c3_typedoc) VALUES ('$inuminfo','$t')";
                $q2 = "INSERT INTO $table ($champs,inuminfo,c3_support) VALUES ($valeurs,'$inuminfo','$t')";
                // echo $q2;
                pg_query($db, $q1);
                pg_query($db, $q2);

                $data = array(
                    'status' => 1,
                    'message' => 'Element ajouté avec succès'
                );
            }
        } catch (\Throwable $th) {
            $data = array(
                'status' => 0,
                'message' => 'Echec ajout d\'élément.' . $th->getMessage()
            );
        }
        //header('Content-Type: application/json');
        return $data;
    }
}

/**
 * Suppression des données 
 * $condition string, $table string Code Type Doc
 * return boolean
 */
if (!function_exists('supprimer_donnee')) {
    function supprimer_donnee($condition, $table)
    {
        global $db;

        $result = false;
        try {

            $table = 'public.pos_tab_index_' . strtolower($table);
            if ($condition == null || $condition == "") {
                $q = "DELETE FROM $table ";
            } else {
                $q = "DELETE FROM $table WHERE $condition";
            }
   
            pg_query($db, $q);

            $data = array(
                'status' => 1,
                'message' => 'Element supprimé avec succès'
            );
        } catch (\Throwable $th) {
            $data = array(
                'status' => 0,
                'message' => 'Echec suppression d\'élément.' . $th->getMessage()
            );
        }

        //header('Content-Type: application/json');
        return $data;
    }
}


/**
 * Listage des données 
 * $champs array , $condition string, $table string Code Type Doc
 * return json data
 */
if (!function_exists('liste_donnee')) {
    function liste_donnee($champs = array(), $condition, $table)
    {
        global $db;

        $table = 'public.pos_tab_index_' . strtolower($table);
        if (count($champs) == 0) {
            if ($condition == null || $condition == "") {
                $q = "SELECT * FROM $table";
            } else {
                $q = "SELECT * FROM $table WHERE $condition";
            }
        } else {
            $champ = "";
            foreach ($champs as $key) {
                $champ .= '"' . $key . '",';
            }
            $champ = trim($champ, ',');
            if ($condition == null || $condition == "") {
                $q = "SELECT $champ FROM $table";
            } else {
                $q = "SELECT $champ FROM $table WHERE $condition";
            }
        }
        // echo $q;
        $result = pg_query($db, $q);
        $data = pg_fetch_all($result);
        return $data;
    }
}



if (!function_exists('get_date_fmt')) {
    function get_date_fmt($EXCEL_DATE){
        if(strpos($EXCEL_DATE,"/") !== false){
            return $EXCEL_DATE;
        } 
        $UNIX_DATE = ( intval($EXCEL_DATE) - 25569) * 86400;
        return gmdate("d/m/Y", $UNIX_DATE); 
    }
}


/**
 * Suppression des données 
 * $condition string, $table string Code Type Doc
 * return boolean
 */
if (!function_exists('supprimer_donnee')) {
    function supprimer_donnee($condition, $table)
    {
        global $db;

        $result = false;
        try {

            $table = 'public.pos_tab_index_' . strtolower($table);
            if ($condition == null || $condition == "") {
                $q = "DELETE FROM $table ";
            } else {
                $q = "DELETE FROM $table WHERE $condition";
            }
   
            pg_query($db, $q);

            $data = array(
                'status' => 1,
                'message' => 'Element supprimé avec succès'
            );
        } catch (\Throwable $th) {
            $data = array(
                'status' => 0,
                'message' => 'Echec suppression d\'élément.' . $th->getMessage()
            );
        }

        //header('Content-Type: application/json');
        return $data;
    }
}

