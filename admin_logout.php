<?php
session_start();

// session_destroy();
unset($_SESSION['admin_user']);
setcookie('success', "user Logged out", time() + 5, "/");
?>
<script>
    window.location.href = "login.php";
</script>