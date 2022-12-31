<?php
session_start();
if (!isset($_SESSION['idAdmin']) && !isset($_GET['idHabitation'])) {
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
  <link rel="stylesheet" href="../../assets/css/_footer.css">

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

    <h3 class="username">
      Admin :
      <?php echo (getNomAdmin($con, $_SESSION['idAdmin'])); ?>
    </h3>
  </header>

  <div class="form">
    <form action="../../inc/traitement_update.php" method="post">
      <select name="types" required>
        <option value="">Type</option>
        <option value="Maison" selected="<?php if ($oneHabitation['quartier'] == "Maison") echo ("selected"); ?>">Maison</option>
        <option value="Studio" selected="<?php if ($oneHabitation['quartier'] == "Studio") echo ("selected"); ?>">Studio</option>
      </select>
      <input type="number" name="nbChambre" placeholder="Nombre de chambres" value="<?php echo ($oneHabitation['nbChambre']); ?>" required>
      <input type="text" name="loyer" placeholder="Loyer par jour" value="<?php echo ($oneHabitation['loyer']); ?>" required>
      <input type="text" name="quartier" placeholder="Quartier" value="<?php echo ($oneHabitation['quartier']); ?>" required>
      <input type="text" name="desc" placeholder="Courte description" value="<?php echo ($oneHabitation['descHabitation']); ?>" required>
      <div class="btnSubmit">
        <input type="submit" name="set" value="Edit">
      </div>
      <input type="hidden" name="idHabitation" value="<?php echo ($idHabitation); ?>">
    </form>
  </div>
  <div class="clone-body"></div>

  <form action="../../inc/traitement_update.php" method="post">
    <div class="hotel_name"><?php echo ($oneHabitation['quartier']); ?></div>
    <div class="hotel_pics">
      <img src="../../assets/img/<?php echo (getOnePhoto($con, $oneHabitation['idHabitation'])); ?>" width="100%" height="600" style="border-radius: 10px;" />
    </div>
    <div class="partie_ambany">
      <div class="desc">
        <h2>Details</h2>
        <hr />
        <?php echo ($oneHabitation['descHabitation']); ?>
      </div>
      <div class="date_sejour">
        <div class="price"><?php echo ($oneHabitation['loyer'] . "$"); ?></div>
        <div class="button_modifier">
          <input type="submit" name="set" value="Edit" />
        </div>
        <div class="button_supprimer">
          <input type="submit" name="set" value="Delete" />
        </div>
        <input type="hidden" name="idHabitation" value="<?php echo ($idHabitation); ?>">
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
<script src="../../assets/js/script2.js"></script>

</html>