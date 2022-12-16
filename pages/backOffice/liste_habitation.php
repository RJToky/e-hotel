<?php
  session_start();
  if(!isset($_SESSION['idAdmin'])) {
    header('location:../../index.html');
  }

  include("../../inc/fonction.php");

  $con = getConnection();

  if(isset($_GET['query'])) {
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
    <title>Listes</title>
  </head>
  <body>
    <div class="add">
      <span>
        <i class="fas fa-plus"></i>
      </span>
    </div>
    <div class="form">
      <form action="#">
        <input type="text" name="type" placeholder="Type" required>
        <input type="number" name="nbrChambre" placeholder="Nombre de chambres" required>
        <input type="text" name="loyer" placeholder="Loyer par jour" required>
        <input type="file" name="photo1" placeholder="Photo de l'habitation" required>
        <input type="file" name="photo2" placeholder="Photo de l'habitation" required>
        <input type="file" name="photo3" placeholder="Photo de l'habitation" required>
        <input type="text" name="quartier" placeholder="Quartier" required>
        <input type="text" name="desc" placeholder="Courte description" required>
        <div class="btnSubmit">
          <input type="submit" value="Ajouter">
        </div>
      </form>
    </div>
    <div class="clone-body"></div>
    <div class="stat">
      <span>
        <i class="fas fa-chart-line"></i>
      </span>
    </div>
    <div class="container-stat">
      <div class="content">
        <div>
          <canvas id="stat1"></canvas>
        </div>
        <div>
          <canvas id="stat2"></canvas>
        </div>
      </div>
    </div>
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

      <h3 class="username">Admin : <?php echo(getNomAdmin($con, $_SESSION['idAdmin'])); ?></h3>
    </header>
    <main>
      <div class="container">

      <?php for($i = 0; $i < count($listHabitation); $i++) { ?>

        <a href="./detail_habitation.php?idHabitation=<?php echo($listHabitation[$i]['idHabitation']); ?>">
          <div class="col-md-3">
            <div class="box">
              <div class="imgbx">
                <img src="../../assets/img/<?php echo(getOnePhoto($con, $listHabitation[$i]['idHabitation'])); ?>" />
              </div>
              <div class="content">
                <h4><?php echo($listHabitation[$i]['quartier']); ?></h4>
                <h4><?php echo($listHabitation[$i]['loyer']."$"); ?></h4>
                <p>
                  <?php echo($listHabitation[$i]['descHabitation']); ?>
                </p>
              </div>
            </div>
          </div>
        </a>
        
      <?php } ?>

      </div>
    </main>
    <footer></footer>
  </body>
  <script src="../../assets/js/chart.umd.js"></script>
  <script src="../../assets/js/script.js"></script>
</html>
