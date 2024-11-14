<?php
include_once('header.php');
include_once("user_authentication.php");
?>
<div class="container">
    <h2>Welcome,
        <?php
        echo $_SESSION['user'];
        ?>
    </h2>
</div>

<?php
include_once('admin_footer.php');
