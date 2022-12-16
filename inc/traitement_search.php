<?php

    include('./fonction.php');


    $con = getConnection();

    $desc = $_GET['desc'];
    $montant1 = $_GET['montant1'];
    $montant2 = $_GET['montant2'];
    $date1 = $_GET['date1'];
    $date2 = $_GET['date2'];

    $tab = array();
    $tab = searchMutli($con,$desc, $montant1 ,$montant2, $date1 ,$date2);

    header('location:../pages/frontOffice/recherche_habitation.php?tab='.$tab);

?>