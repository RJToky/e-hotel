<?php
    if(isset($_POST['set'])) {
        include("./fonction.php");
        $con = getConnection();

        $set = $_POST['set'];
        $idHabitation = $_POST['idHabitation'];
        if($set == "Edit") {
            $idType = getIdType($con, $_POST['types']);
            $nbChambre = $_POST['nbChambre'];
            $loyer = $_POST['loyer'];
            $quartier = $_POST['quartier'];
            $desc = $_POST['desc'];

            setHabitation($con, $idHabitation, $idType, $nbChambre, $loyer, $quartier, $desc);
            header('location:../pages/backOffice/detail_habitation.php?idHabitation='.$idHabitation);

        } else if($set == "Delete") {
            deleteHabitation($con, $idHabitation);
            header('location:../pages/backOffice/liste_habitation.php');
        }

    } else {
        header('location:../index.html');
    }
?>