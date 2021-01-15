<?php
function updateDB(){
    $curl = curl_init();
    $url = "https://coronavirusapi-france.now.sh/AllLiveData";

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);
    
    if($e = curl_error($curl)){
        echo $e;
    }else{

    include('connect.php');
    $decoded = json_decode($resp);
    $count = count($decoded->allLiveFranceData);
    $nb = 0;
    for($i = 0; $i < $count; $i++){
        $nom = $decoded->allLiveFranceData[$i]->nom;
        $code = $decoded->allLiveFranceData[$i]->code;
        $hospitalises = $decoded->allLiveFranceData[$i]->hospitalises;
        $reanimation = $decoded->allLiveFranceData[$i]->reanimation;
        $nouvellesHospitalisations = $decoded->allLiveFranceData[$i]->nouvellesHospitalisations;
        $nouvellesReanimations = $decoded->allLiveFranceData[$i]->nouvellesReanimations;
        $deces = $decoded->allLiveFranceData[$i]->deces;
        $gueris = $decoded->allLiveFranceData[$i]->gueris;
        $nb++;

        $upd = $db->prepare('UPDATE wp_dbp_tb_ct SET
        code = :code,
        nom = :nom,
        hospitalises = :hospitalises,
        gueris = :gueris,
        deces = :deces,
        nouvellesHospitalisations = :nouvellesHospitalisations,
        nouvellesReanimations = :nouvellesReanimations,
        reanimation = :reanimation
        WHERE id = :id');
        $upd->bindParam(':id', $nb, PDO::PARAM_STR);
        $upd->bindParam(':code', $code, PDO::PARAM_STR);
        $upd->bindParam(':nom', $nom, PDO::PARAM_STR);
        $upd->bindParam(':hospitalises', $hospitalises, PDO::PARAM_STR);
        $upd->bindParam(':gueris', $gueris, PDO::PARAM_STR);
        $upd->bindParam(':deces', $deces, PDO::PARAM_STR);
        $upd->bindParam(':nouvellesHospitalisations', $nouvellesHospitalisations, PDO::PARAM_STR);
        $upd->bindParam(':nouvellesReanimations', $nouvellesReanimations, PDO::PARAM_STR);
        $upd->bindParam(':reanimation', $reanimation, PDO::PARAM_STR);
           
        $upd = $upd->execute();
        }

    }
    
    curl_close($curl);
}
?>