<h2 class="default-color pt-5" id="products-menu"> محصولات ما </h2>
<?php
if (isset($data["productsList"])) {
    $productListVal = Model_Main::htmlDecodeValidation($data["productsList"]);
    if ($productListVal !== false) {
        echo $productListVal;
    }
}
if (isset($data["productSlider"])) {
    $productSliderInfo  = Model_Main::arrayExists($data["productSlider"]);
    if ($productSliderInfo !== false) { ?>
        <!-- Start Swiper Products Slider -->
        <h4 class="default-color"> نمونه هایی از محصولات ما </h4>
        <div class="swiper product-slider">
            <div class="swiper-wrapper">
                <?php
                foreach ($productSliderInfo as $item)
                {
                    $slideURL   = Model_Main::stringExistsAndValidation(filter_var($item["img_url"], FILTER_VALIDATE_URL));
                    $slideAlt   = Model_Main::stringExistsAndValidation($item["img_alt"]);
                    $slideTitle = Model_Main::stringExistsAndValidation($item["img_title"]);
                    $linkURL    = Model_Main::stringExistsAndValidation(filter_var($item["link_url"], FILTER_VALIDATE_URL));
                    if ($slideURL !== false && $linkURL !== false) { ?>
                        <div class="swiper-slide">
                            <a href="<?php echo $linkURL; ?>" target="_blank">
                                <img src="<?php echo $slideURL; ?>" alt="<?php echo $slideAlt; ?>" title="<?php echo $slideTitle; ?>">
                            </a>
                        </div>
                    <?php }
                }
                ?>

            </div>
            <div class="swiper-pagination"></div>
        </div>
        <!-- End Swiper Products Slider -->
    <?php }
} ?>
