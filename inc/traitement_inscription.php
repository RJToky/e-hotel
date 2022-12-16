<?php
    if(isset($_POST['email']) && isset($_POST['nom']) && isset($_POST['numTel']) && isset($_POST['mdp'])) {
        include('./fonction.php');
        $con = getConnection();

        $nom = $_POST['nom'];
        $mdp = $_POST['mdp'];
        $email = $_POST['email'];
        $numTel = $_POST['numTel'];

        inscrire($con, $nom, $mdp, $email, $numTel);
        header('location:../pages/frontOffice/liste_habitation.php');

    } else {
        header('location:../index.html');
    }

?>