<?php
if (isset($_GET['date_arrive']) && isset($_GET['date_depart'])) {
    include('./fonction.php');
    $con = getConnection();

    session_start();
    $date_arrive = $_GET['date_arrive'];
    $date_depart = $_GET['date_depart'];

    if (isDisponible($con, $_GET['idHabitation'], $date_arrive, $date_depart)) {
        reserver($con, $_SESSION['idClient'], $_GET['idHabitation'], $date_arrive, $date_depart);

?>
        <script type="text/javascript">
            alert("Reservation confirmee");
            window.location.href = "../pages/frontOffice/liste_habitation.php";
        </script>
    <?php
    } else {
    ?>
        <script type="text/javascript">
            alert("Habitation non disponible");
            window.location.href = "../pages/frontOffice/detail_habitation.php?idHabitation=<?php echo ($_GET['idHabitation']); ?>";
        </script>
<?php
    }
} else {
    header('location:../index.html');
}
?>