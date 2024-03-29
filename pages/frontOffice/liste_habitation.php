<?php
session_start();
if (!isset($_SESSION['idClient'])) {
  header('location:../../index.html');
}

include("../../inc/fonction.php");

$con = getConnection();

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
  <link rel="stylesheet" href="../../assets/css/liste_habitation.css" />
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

    <h3 class="username">Utilisateur : <?php echo (getNomClient($con, $_SESSION['idClient'])); ?></h3>
  </header>
  <main>
    <div class="container">

      <div class="head">
        <div class="rechercheMulti">
          <a href="recherche_habitation.php"> Plus de recherches ? </a>
        </div>
        <div class="btn_logOut"><a href="../../inc/traitement_logOut.php">Log out</a></div>
      </div>

      <?php for ($i = 0; $i < count($listHabitation); $i++) { ?>

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