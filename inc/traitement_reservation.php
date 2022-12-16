<?php
    if(isset($_GET['date_arrive']) && isset($_GET['date_depart'])) {
        include('./fonction.php');
        $con = getConnection();

        session_start();
        $date_arrive = $_GET['date_arrive'];
        $date_depart = $_GET['date_depart'];

        reserver($con, $_SESSION['idClient'], $date_depart, $date_arrive);
        header('location:../pages/frontOffice/liste_habitation.php');

    } else {
        header('location:../index.html');
    }
?>