<?php
    include("./fonction.php");
    $con = getConnection();

    if(isset($_POST['types'])) {
        $idType = getIdType($con, $_POST['types']);
        $nbChambre = $_POST['nbChambre'];
        $loyer = $_POST['loyer'];
        $quartier = $_POST['quartier'];
        $desc = $_POST['desc'];
        $photo = uploadImage($_FILES['photo']);
    
        if($photo != "non") {
            addHabitation($con, $idType, $nbChambre, $loyer, $quartier, $desc, $photo);
        }
    }
    header('location:../pages/backOffice/liste_habitation.php');
?>