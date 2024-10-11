<?php
include_once("header.php");
$q = "select * from sliders";
$count = mysqli_num_rows(mysqli_query($con, $q));
$result = mysqli_query($con, $q);
$q1 = "select * from best_practices";
$result1 = mysqli_query($con, $q1);
?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <?php
                    for ($i = 0; $i <= $count - 1; $i++) {
                    ?>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $i; ?>" class="active" aria-current="true" aria-label="Slide <?php echo $i + 1; ?>"></button>
                    <?php
                    }
                    ?>

                    <!-- <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button> -->
                </div>
                <div class="carousel-inner">
                    <?php
                    $i = 1;
                    while ($r = mysqli_fetch_assoc($result)) {
                    ?>
                        <div class="carousel-item <?php if ($i == 1) {
                                                        echo "active";
                                                    } ?>">
                            <img src="images/slider/<?php echo $r['img_name']; ?>" class="d-block w-100" alt="...">
                        </div>
                    <?php
                        $i++;
                    }
                    ?>

                    <!-- <div class="carousel-item">
                        <img src="images/slider/aria-slider.webp" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="images/slider/NAAC_1.webp" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="images/slider/swacch award.webp" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="images/slider/nirf-ranking-slider.webp" class="d-block w-100" alt="...">
                    </div> -->
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</div>
<br>
<div class="container">
    <div class="row text-center">
        <div class="col-12 bg-dark text-white p-2 align-center">
            <h1>Best Practices</h1>
        </div>
    </div>
    <br>
    <div class="row g-5">
        <?php

        while ($r1 = mysqli_fetch_assoc($result1)) {
        ?>
            <div class="col-xxl-3 col-xl-3 col-lg-4  col-md-2 col-xs-12 col-sm-12">
                <img src="images/best_practices/<?php echo $r1['img_name']; ?>" alt="" class="img-fluid">
            </div>
        <?php
        }
        ?>
        <!-- <div class="col-xxl-3 col-xl-3 col-lg-4  col-md-2 col-xs-12 col-sm-12">
            <img src="images/best_practices/KSPCFE_RK University.png" alt="" class="img-fluid">
        </div>
        <div class="col-xxl-3 col-xl-3 col-lg-4  col-md-2 col-xs-12 col-sm-12">
            <img src="images/best_practices/AAC_RK University.png" alt="" class="img-fluid">
        </div>
        <div class="col-xxl-3 col-xl-3 col-lg-4  col-md-2 col-xs-12 col-sm-12">
            <img src="images/best_practices/CPD_RK University.png" alt="" class="img-fluid">
        </div>
        <div class="col-xxl-3 col-xl-3 col-lg-4  col-md-2 col-xs-12 col-sm-12">
            <img src="images/best_practices/TPO_RK University.png" alt="" class="img-fluid">
        </div>
        <div class="col-xxl-3 col-xl-3 col-lg-4  col-md-2 col-xs-12 col-sm-12">
            <img src="images/best_practices/IQAC_RK University.png" alt="" class="img-fluid">
        </div>
        <div class="col-xxl-3 col-xl-3 col-lg-4  col-md-2 col-xs-12 col-sm-12">
            <img src="images/best_practices/SOAC_RK University.png" alt="" class="img-fluid">
        </div>
        <div class="col-xxl-3 col-xl-3 col-lg-4  col-md-2 col-xs-12 col-sm-12">
            <img src="images/best_practices/CDRC RK University.png" alt="" class="img-fluid">
        </div>
        <div class="col-xxl-3 col-xl-3 col-lg-4  col-md-2 col-xs-12 col-sm-12">
            <img src="images/best_practices/CESL_RK University.png" alt="" class="img-fluid">
        </div>
        <div class="col-xxl-3 col-xl-3 col-lg-4  col-md-2 col-xs-12 col-sm-12">
            <img src="images/best_practices/ARL_RK University.png" alt="" class="img-fluid">
        </div>
        <div class="col-xxl-3 col-xl-3 col-lg-4  col-md-2 col-xs-12 col-sm-12">
            <img src="images/best_practices/ACOPAS_RK University.png" alt="" class="img-fluid">
        </div>
        <div class="col-xxl-3 col-xl-3 col-lg-4  col-md-2 col-xs-12 col-sm-12">
            <img src="images/best_practices/IIIC_RK University.png" alt="" class="img-fluid">
        </div> -->



    </div>
</div>
<?php
include_once("footer.php");
