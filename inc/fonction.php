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
        checkLogin($con, $email, $mdp);
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
        $sql = "DELETE FROM Photo WHERE idHabitation = %s";
        $sql = sprintf($sql, $idHabitation);
        $con->exec($sql);

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

        $tab = null;
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

    function reserver($con, $idClient, $idHabitation, $date_depart, $date_arrive) {
        $sql = "INSERT INTO Reservation VALUES (nextVal('seqReservation'), %s, %s, '%s', '%s')";
        $sql = sprintf($sql, $idClient, $idHabitation, $date_depart, $date_arrive);

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

    function getIdType($con, $value) {
        $sql = "SELECT * FROM Type WHERE value = '%s'";
        $sql = sprintf($sql, $value);
        $res = $con->query($sql);

        $res->setFetchMode(PDO::FETCH_OBJ);

        $tab = null;
        while($line = $res->fetch()) {
            $tab = $line->idtype;
            break;
        }

        return $tab;
    }

    function uploadImage($file) {
        $dossier = '../assets/img/';

        $newNamer = randomName().".jpg";

        if(move_uploaded_file($file['tmp_name'], $dossier . $newNamer)) {
            return $newNamer;
        }
        return "non";
    }

    function randomName() {
        $lettreMaj = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
        $lettreMin = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
        
        $ret = "";
        $i = 0;
        while($i < 5) {
            $ret = $ret.$lettreMaj[rand(0, 25)];
            $ret = $ret.$lettreMin[rand(0, 25)];
            $i++;
        }

        return $ret;
    }

    function selectReservation($con, $idHabitation) {
        $sql = "SELECT * FROM Reservation WHERE idHabitation = %s";
        $sql = sprintf($sql, $idHabitation);
        $res = $con->query($sql);

        $res->setFetchMode(PDO::FETCH_OBJ);

        $i = 0;
        $tab = array();
        while($line = $res->fetch()) {
            $tab[$i]['idreservation'] = $line->idreservation;
            $tab[$i]['idclient'] = $line->idclient;
            $tab[$i]['idhabitation'] = $line->idhabitation;
            $tab[$i]['datedebut'] = $line->datedebut;
            $tab[$i]['datefin'] = $line->datefin;
            $i++;
        }

        return $tab;
    }

    function isDisponible($con, $idHabitation, $arriver, $depart) {
        $reservation = selectReservation($con, $idHabitation);

        foreach ($reservation as $element) {
            if (
                $element['datedebut'] <= $arriver && $arriver <= $element['datefin'] ||
                $element['datedebut'] <= $depart && $depart <= $element['datefin'] ||
                $arriver < $element['datedebut'] && $element['datefin'] < $depart
                ) {
                return false;
            }
        }
        return true;
    }

    function searchMutli($con,$string, $montant1 ,$montant2, $date1 ,$date2) {
        $habit = array();
        $req = ("SELECT * FROM habitation where descriptionh like '%s%s%s' and loyer>%s and loyer<%s %%s%");
        $req = sprintf($req, $string, $montant1, $montant2);
        $result = $con->query($req);
        $result->setFetchMode(PDO::FETCH_OBJ);
        $i = 0;
        while ($ligne = $result->fetch()) {
            $id = $ligne->idhabitation;
           if (isDisponible($con,$id,$date1,$date2)){
                $habit[$i]['idhabitation']= $id;
                $habit[$i]['idtypeh']= $ligne->idtypeh;
                $habit[$i]['nbrchambre']= $ligne->nbrchambre;
                $habit[$i]['loyer']= $ligne->loyer;
                $habit[$i]['idquartier']= $ligne->idquartier;
                $i++;
           }
        }
        $result->closeCursor();
        return $habit;
    }
