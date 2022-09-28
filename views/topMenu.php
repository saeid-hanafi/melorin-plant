<!-- Start Main Navbar -->
<nav class="main-navbar">
    <!-- Start Main Navbar Logo -->
    <div class="container-fluid bg-white p-0">
        <div class="row">
            <div class="col-3 col-sm-4 col-xl-5 p-0"></div>
            <div class="col-6 col-sm-4 col-xl-2 text-center p-0">
                <a class="navbar-brand w-75 h-auto m-auto" href="<?php echo DOMAIN; ?>">
                    <?php
                    $logoURL    = LOGO_DEF;
                    $logoAlt    = TITLE;
                    $logoTitle  = TITLE;
                    if (isset($data["logoInfo"])) {
                        $logoInfo = Model_Main::arrayExists($data["logoInfo"]);
                        if ($logoInfo !== false) {
                            $logoURL    = Model_Main::stringExistsAndValidation(filter_var($logoInfo["media_url"], FILTER_VALIDATE_URL));
                            $logoAlt    = Model_Main::stringExistsAndValidation($logoInfo["media_alt"]);
                            $logoTitle  = Model_Main::stringExistsAndValidation($logoInfo["media_title"]);
                        }
                    }
                    ?>
                    <img class="img-fluid w-50 h-auto" src="<?php echo $logoURL; ?>" alt="<?php echo $logoAlt; ?>" title="<?php echo $logoTitle; ?>">
                </a>
            </div>
            <div class="col-3 col-sm-4 col-xl-5 p-0"></div>
        </div>
    </div>
    <!-- End Main Navbar Logo -->
</nav>

<!-- Start Main Navbar Menu -->
<nav id="topMenuNav" class="navbar navbar-expand-lg navbar-light bg-light position-sticky sticky-top border-bottom border-bottom-1">
    <div class="container-fluid p-0">
        <div class="col-3 col-lg-2 p-0"></div>
        <div class="text-center col-6 col-lg-8 p-0">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon font-weight-bold"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav justify-content-center default-color" id="main-menu-ul"><?php
                    if (isset($data["topMenu"]) && !empty($data["topMenu"]) && $data["topMenu"] !== false) {
                        $topMenuArray = Model_Main ::arrayExists($data["topMenu"]);
                        if ($topMenuArray !== false) {
                            foreach ($topMenuArray as $key => $value)
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
                                if ($key !== false && $name !== false && $link !== false) { ?><li class="nav-item font-weight-bold"> <?php echo $icon; ?> <a class="nav-link float-right" href="<?php echo $link; ?>"><?php echo $name; ?></a></li><?php }
                            }
                        }
                    }
                    ?></ul>
            </div>
        </div>
        <div class="col-3 col-lg-2 p-0"></div>
    </div>
</nav>
<!-- End Main Navbar Menu -->

<!-- End Main Navbar -->