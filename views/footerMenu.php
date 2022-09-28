<div class="container-fluid bg-white border-top border-top-1 border-success">
    <?php
    if (isset($data["contactUs"]) && isset($data["topMenu"])) {
    $footerContactUs = Model_Main::htmlDecodeValidation($data["contactUs"]);
    $footerMenuArray = Model_Main ::arrayExists($data["topMenu"]);
    if ($footerContactUs !== false && $footerMenuArray !== false) { ?>
    <div class="row pt-2">
        <div class="col-12 col-md-6">
            <ul class="navbar-nav default-color" id="main-menu-ul"><?php foreach ($footerMenuArray as $key => $value)
                {
                $key    = Model_Main::intExistsAndValidation($key, true);
                $name   = Model_Main::stringExistsAndValidation($value["menuName"]);
                $link   = Model_Main::stringExistsAndValidation($value["menuLink"]);
                if ($key === 0) {
                $link = filter_var($link, FILTER_VALIDATE_URL);
                }else{
                $link = "#".$link;
                }
                $icon   = Model_Main::htmlDecodeValidation($value["menuIcon"]);
                if ($key !== false && $name !== false && $link !== false) { ?><li class="nav-item font-weight-bold"> <?php echo $icon; ?> <a class="nav-link float-right default-base-color" href="<?php echo $link; ?>"><?php echo $name; ?></a></li><?php }
                } ?></ul>
        </div>
        <div class="col-12 col-md-6">
            <?php echo $footerContactUs; ?>
        </div>
        <div class="col-12 text-center font-weight-bold">
            <p class="footerP default-color border-top border-top-1 border-success pt-2">
                کلیه حقوق این سایت متعلق به فروشگاه ملورین پلنت می باشد.
            </p>
            <p class="footerP default-color">
                طراحی شده توسط شرکت برنامه نویسی نوین FBSCodes
            </p>
        </div>
    </div>
    <?php }
    }
    ?>
</div>
