<?php
include_once('header.php');

$email = $_GET['em'];
echo $email;

$q = "select * from registration where email='$email'";
$result = mysqli_query($con, $q);
$count = mysqli_num_rows($result);

if ($count == 1) {
    while ($r = mysqli_fetch_array($result)) {
        if ($r[9] == "Active") {
            setcookie('success', "Email is already verified", time() + 5, "/");
?>
            <script>
                window.location.href = "login.php";
            </script>
            <?php
        } else {
            $update = "update registration set `status`='Active' where `email`='$email'";
            if (mysqli_query($con, $update)) {
                setcookie('success', "Email verified successfully", time() + 5, "/");
            ?>
                <script>
                    window.location.href = "login.php";
                </script>
    <?php
            }
        }
    }
} else {
    setcookie('error', "Email is not registered", time() + 5, "/");
    ?>
    <script>
        window.location.href = "register.php";
    </script>
<?php
}
