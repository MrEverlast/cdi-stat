<?php 
    $valuePlaning = $_POST['valuePlaning'];
    $idTab = $_POST['idTab'];
    $z = " NUM ";
    for($d=0; $d<6; $d++){
        $idOM=$d*4;
        $idFM=$idOM+1;
        $idOS=$idOM+2;
        $idFS=$idOM+3;
        $query = "UPDATE `t_cdi_horaire` SET `h_ouvert_m`='$valuePlaning[$idOM]',`h_fermer_m`='$valuePlaning[$idFM]',`h_ouvert_s`='$valuePlaning[$idOS]',`h_fermer_s`='$valuePlaning[$idFS]' WHERE `code`=$d";
        $bdd->requeteBDD($query);
    }

