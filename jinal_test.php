<form method="POST" action="jinal_test.php" onsubmit="return(validate_reg())">
    <div class="form-group">
        <label for="fullname">Full Name:</label>
        <input type="text" class="form-control" id="fullname" name="fullname">
    </div>
    <button type="submit" class="btn btn-dark" name="btn">Submit</button>
</form>

<script>
    function validate_reg() {
        var fullname = document.getElementById("fullname").value;
        if (fullname.trim() === "") {
            alert("Full Name is required.");
            return false;
        }
        return true;
    }
</script>
<?php

if (isset($_POST['btn'])) {
    $fn = $_POST['fullname'];
    echo $fn;
}
