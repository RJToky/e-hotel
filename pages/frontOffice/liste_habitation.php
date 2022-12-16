<?php
  session_start();
  if(!isset($_SESSION['idClient'])) {
    header('location:../../index.html');
  }

  include("../../inc/fonction.php");

  $con = getConnection();
  $listHabitation = getAllHabitation($con);
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
    <header>
      <div class="logo">E-HOTEL</div>
      <form action="" method="get">
        <div class="search-bar">
            <input
              class="search-text"
              type="text"
              name="search"
              placeholder="Search about travel"
            />
            <button class="search-logo">
              <span>
                <i class="fas fa-search"></i>
              </span>
            </button>
        </div>
      </form>

      <h3 class="username">Utilisateur : <?php echo(getNomClient($con, $_SESSION['idClient'])); ?></h3>
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
</html>
