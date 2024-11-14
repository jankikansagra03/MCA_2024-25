<?php
include_once("header.php");
include_once("admin_authentication.php");

unset($_SESSION['admin']);
?>
<script>
    window.location.href = "login.php";
</script>