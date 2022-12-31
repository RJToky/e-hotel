<?php
session_start();
if (!isset($_SESSION['idAdmin'])) {
  header('location:../../index.html');
}

include("../../inc/fonction.php");

$con = getConnection();

$tab = null;
if (isset($_GET['tab'])) {
  $tab = $_GET['tab'];
}

if (isset($_GET['query'])) {
  $listHabitation = searchQuery($con, $_GET['query']);
} else {
  $listHabitation = getAllHabitation($con);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../../assets/css/style.css" />
  <link rel="stylesheet" href="../../assets/css/recherche.css" />
  <link rel="stylesheet" href="../../assets/css/_header.css">
  <link rel="stylesheet" href="../../assets/boot/bootstrap.css" />
  <link rel="stylesheet" href="../../assets/fontawesome-5/css/all.css">
  <link rel="stylesheet" href="../../assets/css/_footer.css">
  <title>Listes</title>
</head>

<body>
  <header>
    <div class="logo">E-HOTEL</div>
    <form action="./liste_habitation.php" method="get">
      <div class="search-bar">
        <input class="search-text" type="text" name="query" placeholder="Search about travel" />
        <button class="search-logo">
          <span>
            <i class="fas fa-search"></i>
          </span>
        </button>
      </div>
    </form>
    <h3 class="username">Utilisateur : <?php echo (getNomAdmin($con, $_SESSION['idAdmin'])); ?></h3>
  </header>
  <main>
    <div class="container">
      <form action="../../inc/traitement_search.php" method="get">
        <div class="desc">
          <input type="text" name="desc" placeholder="Description">
        </div>
        <div class="montant">
          <input type="text" name="montant1" placeholder="Montant minimum">
          <input type="text" name="montant2" placeholder="Montant maximum">
        </div>
        <div class="date">
          <input type="date" name="date1" placeholder="Date arrivée">
          <input type="date" name="date2" placeholder="Date départ">
        </div>
        <div class="button_valider">
          <input type="submit" name="valider" value="Search" style="padding: 7%;">
        </div>
      </form>

      <?php for ($i = 0; $i < count($tab); $i++) { ?>
        <a href="./detail_habitation.php?idHabitation=<?php echo ($listHabitation[$i]['idHabitation']); ?>">
          <div class="col-md-3">
            <div class="box">
              <div class="imgbx">
                <img src="../../assets/img/<?php echo (getOnePhoto($con, $listHabitation[$i]['idHabitation'])); ?>" />
              </div>
              <div class="content">
                <h4><?php echo ($listHabitation[$i]['quartier']); ?></h4>
                <h4><?php echo ($listHabitation[$i]['loyer'] . "$"); ?></h4>
                <p>
                  <?php echo ($listHabitation[$i]['descHabitation']); ?>
                </p>
              </div>
            </div>
          </div>
        </a>
      <?php } ?>
    </div>

  </main>
  <footer>
    <div class="ambony">
      <div class="about">
        <p>About</p>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod eveniet fuga quibusdam minima? Quaerat beatae fugiat nemo, voluptas facere, quia, eaque nihil adipisci tempore totam nesciunt natus quae? Expedita, sint.
      </div>
      <div class="categorie">
        <p>Categorie</p>
        PHP <br>
        Web Design <br>
        JS <br>
        HTML <br>
        CSS
      </div>
      <div class="quickLink">
        <p>Quick Link</p>
        <a href=""> About us </a> <br>
        <a href=""> Contact us </a><br>
        <a href=""> Contribute </a><br>
        <a href=""> Privacy Policy </a><br>
        <a href=""> Sitemap </a>
      </div>
    </div>
    <hr>
    <div class="ambany">
      <div class="ambany_gauche">
        Copyright () 2022 All Rights Reserved by e-Hotel
      </div>
      <div class="ambany_droite">
        Logo kely
      </div>
    </div>
  </footer>
</body>

</html>