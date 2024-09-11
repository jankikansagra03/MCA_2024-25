<?php
include_once("header.php");

?>

<div class="conatiner">
    <div class="row text-center">
        <div class="col-12 bg-dark text-white p-4 align-center">
            <h1>Forgot Password</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-2"></div>
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-8 col-xs-12 col-sm-12">
            <br>
            <form action="forgot_pwd_action.php" method="post" id="form1">
                <div class="form-group">
                    <label for="email"><b>Email:</b></label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                </div>
                <br>

                <input type="submit" class="btn btn-success " value="Submit" name="lgn_btn" />


            </form>
        </div>
    </div>
    <br>

</div>

<?php
include_once("footer.php");
