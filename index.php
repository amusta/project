<?php
include_once 'view/header.php';
?>

<h1 id="index-text">Welcome, <?php if(isset($_SESSION['id_user'])){
        echo explode(" ", $_SESSION['first_name'])[0];
    }else{
        echo 'Guest';
    } ?> </h1>

<?php
include_once 'view/footer.php';
?>