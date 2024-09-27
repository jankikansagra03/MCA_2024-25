<?php
session_start();
if (!isset($_SESSION['user_uname'])) {
?>
    <script>
        window.location.href = "login.php";
    </script>
<?php
}
