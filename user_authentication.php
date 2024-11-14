<?php
include_once("header.php");
if (!isset($_SESSION['user'])) {
?>
    <script>
        window.location.href = "login.php";
    </script>
<?php
}
?>