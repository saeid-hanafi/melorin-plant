<?php
class Index extends Main_Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $pageTitle      = TITLE;
        $metaKeys       = META_KEYWORDS;
        $metaDes        = META_DESCRIPTION;
        $getLogoInfo    = [];
        $rightImage     = [];
        $leftImage      = [];
        $getMainLogo    = Model_Main::arrayExists($this->models->getAdminSettingInfo("logo", "Main Web Site Logo"));
        if ($getMainLogo !== false) {
            $logoID         = Model_Main::intExistsAndValidation($getMainLogo["setting_used_id"]);
            $getLogoInfo    = Model_Main::arrayExists($this->models->getMediaInfoByID($logoID));
        }
        $getTopMenu     = Model_Main::arrayExists($this->models->getTopMenu());
        $getPageInfo    = Model_Main::arrayExists($this->models->getPagesInfo("home"));
        if ($getPageInfo !== false) {
            if (isset($getPageInfo["pageTitle"]) && isset($getPageInfo["pageMetaKeys"]) && isset($getPageInfo["pageMetaDes"]))
            {
                $pageTitle  = Model_Main::stringExistsAndValidation($getPageInfo["pageTitle"]);
                $metaKeys   = Model_Main::stringExistsAndValidation($getPageInfo["pageMetaKeys"]);
                $metaDes    = Model_Main::stringExistsAndValidation($getPageInfo["pageMetaDes"]);
            }
        }
        $getRightImage  = Model_Main::arrayExists($this->models->getAdminSettingInfo("home_image_right", "home_image_right"));
        $getLeftImage   = Model_Main::arrayExists($this->models->getAdminSettingInfo("home_image_left", "home_image_left"));
        if ($getRightImage !== false && $getLeftImage !== false) {
            $getRightImageID    = Model_Main::intExistsAndValidation($getRightImage["setting_used_id"]);
            $getLeftImageID     = Model_Main::intExistsAndValidation($getLeftImage["setting_used_id"]);
            $rightImage         = Model_Main::arrayExists($this->models->getMediaInfoByID($getRightImageID));
            $leftImage          = Model_Main::arrayExists($this->models->getMediaInfoByID($getLeftImageID));
        }

        $productsList       = "";
        $getProductListInfo = Model_Main::arrayExists(Model_Main::getPagesInfo("product-list"));
        if ($getProductListInfo !== false) {
            $productListVal = Model_Main::stringExistsAndValidation($getProductListInfo["pageContent"]);
            if ($productListVal !== false) {
                $productsList = $productListVal;
            }
        }

        $productSlidesInfo  = [];
        $getProductSlider   = Model_Main::arrayExists($this->models->getProductsSliderSlidesID());
        if ($getProductSlider !== false) {
            foreach ($getProductSlider as $key => $value)
            {
                $key        = Model_Main::intExistsAndValidation($key, true);
                $img_id     = Model_Main::intExistsAndValidation($value["img_id"]);
                $link_url   = Model_Main::stringExistsAndValidation(filter_var($value["link_url"], FILTER_VALIDATE_URL));
                if ($key !== false && $img_id !== false && $link_url !== false) {
                    $sliderInfo = Model_Main::arrayExists(Model_Main::getMediaInfoByID($img_id));
                    if ($sliderInfo !== false) {
                        $imgURL     = Model_Main::stringExistsAndValidation(filter_var($sliderInfo["media_url"], FILTER_VALIDATE_URL));
                        $imgAlt     = Model_Main::stringExistsAndValidation($sliderInfo["media_alt"]);
                        $imgTitle   = Model_Main::stringExistsAndValidation($sliderInfo["media_title"]);
                        if ($imgURL !== false) {
                            $productSlidesInfo[$key]["img_url"]     = $imgURL;
                            $productSlidesInfo[$key]["img_alt"]     = $imgAlt;
                            $productSlidesInfo[$key]["img_title"]   = $imgTitle;
                            $productSlidesInfo[$key]["link_url"]    = $link_url;
                        }
                    }
                }
            }
        }

        $aboutUs = "";
        $getAboutUsInfo = Model_Main::arrayExists(Model_Main::getPagesInfo("about-us"));
        if ($getAboutUsInfo !== false) {
            $aboutUsVal = Model_Main::stringExistsAndValidation($getAboutUsInfo["pageContent"]);
            if ($aboutUsVal !== false) {
                $aboutUs = $aboutUsVal;
            }
        }

        $contactUs = "";
        $getContactUsInfo = Model_Main::arrayExists(Model_Main::getPagesInfo("contact-us"));
        if ($getContactUsInfo !== false) {
            $contactUsVal = Model_Main::stringExistsAndValidation($getContactUsInfo["pageContent"]);
            if ($contactUsVal !== false) {
                $contactUs = $contactUsVal;
            }
        }
        $data = [
            "title"             => $pageTitle,
            "metaKeys"          => $metaKeys,
            "metaDes"           => $metaDes,
            "logoInfo"          => $getLogoInfo,
            "topMenu"           => $getTopMenu,
            "rightImageInfo"    => $rightImage,
            "leftImageInfo"     => $leftImage,
            "productsList"      => $productsList,
            "productSlider"     => $productSlidesInfo,
            "aboutUs"           => $aboutUs,
            "contactUs"         => $contactUs,
        ];
        $this->views("index/index", $data);
    }
}
