<?php
include_once("header.php");
include_once("user_authentication.php");

unset($_SESSION['user']);
?>
<script>
    window.location.href = "login.php";
</script>