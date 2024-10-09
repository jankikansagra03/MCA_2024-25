<?php
include_once("header.php");

if (!isset($_SESSION['admin_user'])) {
?>
    <script>
        window.location.href = "login.php";
    </script>
<?php
}
