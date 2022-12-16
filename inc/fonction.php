<?php

    function getConnection() {
        $user = "postgres";
        $pass = "root";
        $dbname = "hotel";
        $dsn = 'pgsql:host=localhost;port=5432;dbname='.$dbname;

        $connex = new PDO($dsn, $user, $pass);
        return $connex;
    }

    function checkLogin($con, $email, $mdp) {
        $sql = "SELECT * FROM Client WHERE email = '%s' AND mdp = '%s'";
        $sql = sprintf($sql, $email, $mdp);
        $res = $con->query($sql);

        $res->setFetchMode(PDO::FETCH_OBJ);

        while($line = $res->fetch()) {
            session_start();
            $_SESSION['idClient'] = $line->idclient;
            return true;
        }

        return false;
    }

    function estAdmin($con, $email, $mdp) {
        $sql = "SELECT * FROM Admin WHERE email = '%s' AND mdp = '%s'";
        $sql = sprintf($sql, $email, $mdp);
        $res = $con->query($sql);

        $res->setFetchMode(PDO::FETCH_OBJ);

        while($line = $res->fetch()) {
            session_start();
            $_SESSION['idAdmin'] = $line->idadmin;
            return true;
        }

        return false;
    }

    function inscrire($con, $nom, $mdp, $email, $numTel) {
        $sql = "INSERT INTO Client VALUES (nextVal('seqClient'), '%s', '%s', '%s', '%s')";
        $sql = sprintf($sql, $nom, $mdp, $email, $numTel);

        $con->exec($sql);
    }

    function getAllHabitation($con) {
        $sql = "SELECT * FROM Habitation";
        $res = $con->query($sql);

        $res->setFetchMode(PDO::FETCH_OBJ);

        $i = 0;
        $tab = array();
        while($line = $res->fetch()) {
            $tab[$i]['idHabitation'] = $line->idhabitation;
            $tab[$i]['idType'] = $line->idtype;
            $tab[$i]['nbChambre'] = $line->nbchambre;
            $tab[$i]['loyer'] = $line->loyer;
            $tab[$i]['quartier'] = $line->quartier;
            $tab[$i]['descHabitation'] = $line->deschabitation;
            $i++;
        }

        return $tab;
    }

    function addHabitation($con, $idType, $nbChambre, $loyer, $quartier, $descHabitation, $nomPhoto) {
        $sql = "INSERT INTO Habitation VALUES (nextVal('seqHabitation'), %s, %s, %s, '%s', '%s')";
        $sql = sprintf($sql, $idType, $nbChambre, $loyer, $quartier, $descHabitation);

        $con->exec($sql);

        $sql = "INSERT INTO Photo VALUES (nextVal('seqPhoto'), currVal('seqHabitation'), '%s')";
        $sql = sprintf($sql, $nomPhoto);

        $con->exec($sql);
    }

    function setHabitation($con, $idHabitation, $idType, $nbChambre, $loyer, $quartier, $descHabitation) {
        $sql = "UPDATE Habitation SET idType = %s, nbChambre = %s, loyer = %s, quartier = '%s', descHabitation = '%s' WHERE idHabitation = %s";
        $sql = sprintf($sql, $idType, $nbChambre, $loyer, $quartier, $descHabitation, $idHabitation);

        $con->exec($sql);
    }

    function deleteHabitation($con, $idHabitation) {
        $sql = "DELETE FROM Habitation WHERE idHabitation = %s";
        $sql = sprintf($sql, $idHabitation);

        $con->exec($sql);
    }

    function getOneHabitation($con , $idHabitation) {
        $sql = "SELECT * FROM Habitation WHERE idHabitation = %s";
        $sql = sprintf($sql, $idHabitation);
        $res = $con->query($sql);

        $res->setFetchMode(PDO::FETCH_OBJ);

        $tab = array();
        while($line = $res->fetch()) {
            $tab['idHabitation'] = $line->idhabitation;
            $tab['idType'] = $line->idtype;
            $tab['nbChambre'] = $line->nbchambre;
            $tab['loyer'] = $line->loyer;
            $tab['quartier'] = $line->quartier;
            $tab['descHabitation'] = $line->deschabitation;
        }

        return $tab;
    }

    function getOnePhoto($con , $idHabitation) {
        $sql = "SELECT * FROM Photo WHERE idHabitation = %s";
        $sql = sprintf($sql, $idHabitation);
        $res = $con->query($sql);

        $res->setFetchMode(PDO::FETCH_OBJ);

        $tab = array();
        while($line = $res->fetch()) {
            $tab = $line->nomphoto;
            break;
        }

        return $tab;
    }

    function getNomClient($con, $idClient) {
        $sql = "SELECT * FROM Client WHERE idClient = %s";
        $sql = sprintf($sql, $idClient);
        $res = $con->query($sql);

        $res->setFetchMode(PDO::FETCH_OBJ);

        $tab = array();
        while($line = $res->fetch()) {
            $tab = $line->nom;
        }

        return $tab;
    }

    function getNomAdmin($con, $idAdmin) {
        $sql = "SELECT * FROM Admin WHERE idAdmin = %s";
        $sql = sprintf($sql, $idAdmin);
        $res = $con->query($sql);

        $res->setFetchMode(PDO::FETCH_OBJ);

        $tab = array();
        while($line = $res->fetch()) {
            $tab = $line->nom;
        }

        return $tab;
    }

    function reserver($con, $idClient, $date_depart, $date_arrive) {
        $sql = "INSERT INTO Reservation VALUES (nextVal('seqReservation'), %s, '%s', '%s')";
        $sql = sprintf($sql, $idClient, $date_depart, $date_arrive);

        $con->exec($sql);
    }

    function searchQuery($con, $query) {
        $sql = "SELECT * FROM Habitation WHERE descHabitation LIKE '%s%s%s'";
        $sql = sprintf($sql, "%", $query, "%");
        $res = $con->query($sql);

        $res->setFetchMode(PDO::FETCH_OBJ);

        $i = 0;
        $tab = array();
        while($line = $res->fetch()) {
            $tab[$i]['idHabitation'] = $line->idhabitation;
            $tab[$i]['idType'] = $line->idtype;
            $tab[$i]['nbChambre'] = $line->nbchambre;
            $tab[$i]['loyer'] = $line->loyer;
            $tab[$i]['quartier'] = $line->quartier;
            $tab[$i]['descHabitation'] = $line->deschabitation;
            $i++;
        }

        return $tab;
    }
?>