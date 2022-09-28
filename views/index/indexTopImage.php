<?php
$logoURL            = LOGO_DEF;
$logoAlt            = TITLE;
$logoTitle          = TITLE;
$rightImageURL      = false;
$rightImageAlt      = "";
$rightImageTitle    = "";
$leftImageURL       = false;
$leftImageAlt       = "";
$leftImageTitle     = "";
if (isset($data["logoInfo"])) {
    $logoInfo = Model_Main::arrayExists($data["logoInfo"]);
    if ($logoInfo !== false) {
        $logoURL    = Model_Main::stringExistsAndValidation(filter_var($logoInfo["media_url"], FILTER_VALIDATE_URL));
        $logoAlt    = Model_Main::stringExistsAndValidation($logoInfo["media_alt"]);
        $logoTitle  = Model_Main::stringExistsAndValidation($logoInfo["media_title"]);
    }
}

if (isset($data["rightImageInfo"]) && isset($data["leftImageInfo"])) {
    $rightImageInfo = Model_Main::arrayExists($data["rightImageInfo"]);
    $leftImageInfo  = Model_Main::arrayExists($data["leftImageInfo"]);
    if ($rightImageInfo !== false && $leftImageInfo !== false) {
        $rightImageURL      = Model_Main::stringExistsAndValidation(filter_var($rightImageInfo["media_url"], FILTER_VALIDATE_URL));
        $rightImageAlt      = Model_Main::stringExistsAndValidation($rightImageInfo["media_alt"]);
        $rightImageTitle    = Model_Main::stringExistsAndValidation($rightImageInfo["media_title"]);
        $leftImageURL       = Model_Main::stringExistsAndValidation(filter_var($leftImageInfo["media_url"], FILTER_VALIDATE_URL));
        $leftImageAlt       = Model_Main::stringExistsAndValidation($leftImageInfo["media_alt"]);
        $leftImageTitle     = Model_Main::stringExistsAndValidation($leftImageInfo["media_title"]);
    }
}
?>
<div class="container-fluid bg-white p-0">
    <div class="row">
        <div class="col-3 col-lg-4 p-0">
            <?php if ($rightImageURL !== false) { ?>
                <img src="<?php echo $rightImageURL; ?>" class="homePageImages" alt="<?php echo $rightImageAlt; ?>" title="<?php echo $rightImageTitle; ?>">
            <?php } ?>
        </div>
        <div class="col-6 col-lg-4 text-center p-0">
            <div id="topImageLogo">
                <img src="<?php echo $logoURL; ?>" alt="<?php echo $logoAlt; ?>" title="<?php echo $logoTitle; ?>">
                <h1 class="mt-2"> <?php echo $logoTitle; ?> </h1>
            </div>
        </div>
        <div class="col-3 col-lg-4 justify-content-around p-0">
            <?php if ($leftImageURL !== false) { ?>
                <img src="<?php echo $leftImageURL; ?>" class="homePageImages float-right" alt="<?php echo $leftImageAlt; ?>" title="<?php echo $leftImageTitle; ?>">
            <?php } ?>
        </div>
    </div>
</div>
