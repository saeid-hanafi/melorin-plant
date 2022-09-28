<!-- Start Home Page Main Content -->
<div class="text-center" data-spy="scroll" data-target="#topMenuNav" data-offset="50">
    <!-- Start Products Slider -->
    <?php require_once ("productsSlider.php"); ?>
    <!-- End Products Slider -->
    <!-- Start Contact Us -->
    <h1 id="contact-us-menu" class="default-color pt-5"> تماس با ما </h1>
    <?php
    if (isset($data["contactUs"])) {
        $contactUs = Model_Main::htmlDecodeValidation($data["contactUs"]);
        if ($contactUs !== false) { ?>
            <div class="contact-us-menu-div">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-1 col-lg-2"></div>
                        <div class="col-10 col-lg-8 text-left">
                            <?php echo $contactUs; ?>
                        </div>
                        <div class="col-1 col-lg-2"></div>
                    </div>
                </div>
            </div>
        <?php }
    }
    ?>
    <!-- End Contact Us -->
    <!-- Start About Us -->
    <h1 id="about-us-menu" class="default-color pt-5"> درباره ما </h1>
    <?php
    if (isset($data["aboutUs"])) {
        $aboutUs = Model_Main::htmlDecodeValidation($data["aboutUs"]);
        if ($aboutUs !== false) {
            echo $aboutUs;
        }
    }
    ?>
    <!-- End About Us -->
</div>
<!-- End Home Page Main Content -->