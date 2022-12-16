<?php
    if(isset($_POST['set'])) {
        include("./fonction.php");
        $con = getConnection();

        $set = $_POST['set'];
        $idHabitation = $_POST['idHabitation'];
        if($set == "Edit") {

            // setHabitation($con, $idHabitation, $idType, $nbChambre, $loyer, $quartier, $descHabitation);

        } else if($set == "Delete") {
            deleteHabitation($con, $idHabitation);
        }
        header('location:../pages/backOffice/liste_habitation.php');

    } else {
        header('location:../index.html');
    }
?>