<?php
  session_start();
  if(!isset($_SESSION['idClient']) && !isset($_GET['idHabitation'])) {
    header('location:../../index.html');
  }

  include("../../inc/fonction.php");

  $con = getConnection();

  $idHabitation = $_GET['idHabitation'];
  $oneHabitation = getOneHabitation($con, $idHabitation);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Details</title>
    <link rel="stylesheet" href="../../assets/css/style.css" />
    <link rel="stylesheet" href="../../assets/css/detail_habitation.css" />
    <link rel="stylesheet" href="../../assets/css/_header.css" />
    <link rel="stylesheet" href="../../assets/fontawesome-5/css/all.css" />
    <link rel="stylesheet" href="../../assets/css/_footer.css" />
  </head>
  <body>
    <header>
      <div class="logo">E-HOTEL</div>
      <form action="./liste_habitation.php" method="get">
        <div class="search-bar">
          <input
            class="search-text"
            type="text"
            name="query"
            placeholder="Search about travel"
          />
          <button class="search-logo">
            <span>
              <i class="fas fa-search"></i>
            </span>
          </button>
        </div>
      </form>

      <h3 class="username">
        Utilisateur :
        <?php echo(getNomClient($con, $_SESSION['idClient'])); ?>
      </h3>
    </header>
    <form action="../../inc/traitement_reservation.php" method="get">
      <div class="hotel_name"><?php echo($oneHabitation['quartier']); ?></div>
      <div class="hotel_pics">
        <img src="../../assets/img/<?php echo(getOnePhoto($con, $oneHabitation['idHabitation'])); ?>" width="100%" height="600" style="border-radius: 10px;"/>
      </div>
      <div class="partie_ambany">
        <div class="desc">
          <h2>Details</h2>
          <hr />
          <?php echo($oneHabitation['descHabitation']); ?>
        </div>
        <div class="date_sejour">
          <div class="price"><?php echo($oneHabitation['loyer']."$"); ?></div>
          <div class="choix_date">
            <div class="select_date_debut">
              <p>Arrivée</p>
              <input type="date" name="date_arrive" />
            </div>
            <div class="select_date_fin">
              <p>Départ</p>
              <input type="date" name="date_depart" />
            </div>
          </div>
          <div class="button_date_sejour">
            <input type="submit" name="valider_date" value="Valider" />
            <input type="hidden" name="idHabitation" value="<?php echo($idHabitation); ?>">
          </div>
        </div>
      </div>
    </form>
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
