<?php
if (isset($_POST['email']) && isset($_POST['mdp'])) {
    include('./fonction.php');
    $con = getConnection();

    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    if (checkLogin($con, $email, $mdp)) {
        header('location:../pages/frontOffice/liste_habitation.php');
    } else {
        if (estAdmin($con, $email, $mdp)) {
            header('location:../pages/backOffice/liste_habitation.php');
        } else {
            header('location:../index.html');
        }
    }
} else {
    header('location:../index.html');
}
