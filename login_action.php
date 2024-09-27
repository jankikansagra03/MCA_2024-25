<?php
include_once('header.php');

if (isset($_POST['lgn_btn'])) {
    $em = $_POST['email'];
    $pwd = $_POST['pswd'];

    $q = "SELECT * FROM `registration` WHERE `email`='$em'";
    $result = mysqli_query($con, $q);
    $count = mysqli_num_rows($result);
    if ($count == 1) {
        while ($r = mysqli_fetch_assoc($result)) {
            if ($r['password'] == $pwd) {
                if ($r['status'] == 'Active') {
                    if ($r['role'] == 'Admin') {
                        setcookie('success', 'Login Successful', time() + 5, "/");
                        $_SESSION['admin_user'] = $em;
?>
                        <script>
                            window.location.href = "admin_dashboard.php";
                        </script>
                    <?php
                    } else {
                        $_SESSION['user_uname'] = $email;
                        setcookie('success', 'Login Successful', time() + 5, "/");
                    ?>
                        <script>
                            window.location.href = "user_dashboard.php";
                        </script>
                    <?php
                    }
                } else {
                    setcookie("error", "Email is not verified", time() + 5, "/");
                    ?>
                    <script>
                        window.location.href = "login.php";
                    </script>
                <?php
                }
            } else {
                setcookie("error", "Incorrect Password", time() + 5, "/");
                ?>
                <script>
                    window.location.href = "login.php";
                </script>
        <?php
            }
        }
    } else {
        setcookie("error", "Email is not registered", time() + 5, "/");
        ?>
        <script>
            window.location.href = "login.php"
        </script>

<?php
    }
    $row = mysqli_fetch_array($result);
}
