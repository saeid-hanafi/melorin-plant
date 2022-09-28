<?php
$title              = TITLE;
$metaKeywords       = META_KEYWORDS;
$metaDescription    = META_DESCRIPTION;

if (isset($data["title"]) && !empty($data["title"]) && $data["title"] !== false) {
    $titleVal = Model_Main::stringExistsAndValidation($data["title"]);
    if ($titleVal !== false) {
        $title = $titleVal;
    }
}

if (isset($data["metaKeys"]) && !empty($data["metaKeys"]) && $data["metaKeys"] !== false) {
    $metaKeywordsVal = Model_Main::stringExistsAndValidation($data["metaKeys"]);
    if ($metaKeywordsVal !== false) {
        $metaKeywords = $metaKeywordsVal;
    }
}

if (isset($data["metaDes"]) && !empty($data["metaDes"]) && $data["metaDes"] !== false) {
    $metaDescriptionVal = Model_Main::stringExistsAndValidation($data["metaDes"]);
    if ($metaDescriptionVal !== false) {
        $metaDescription = $metaDescriptionVal;
    }
}
?>
<html>
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-056BGJVY0G"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-056BGJVY0G');
    </script>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="<?php echo $metaKeywords; ?>">
    <meta name="description" content="<?php echo $metaDescription; ?>">
    <meta name="google-site-verification" content="PxwcSqxeHpGoZzeqg_KWR_g5fBZmCoueIw2PLVrxv6M" />
    <link type="image/x-icon" rel="icon" href="<?php echo DOMAIN; ?>favicon.ico">	
    <link type="text/css" rel="stylesheet" href="<?php echo DOMAIN; ?>public/css/all.min.css">
    <link type="text/css" rel="stylesheet" href="<?php echo DOMAIN; ?>public/css/bootstrap-icons.css">
    <link type="text/css" rel="stylesheet" href="<?php echo DOMAIN; ?>public/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="<?php echo DOMAIN; ?>public/css/swiper-bundle.min.css">
    <link type="text/css" rel="stylesheet" href="<?php echo DOMAIN; ?>public/css/fonts-styles.css">
    <link type="text/css" rel="stylesheet" href="<?php echo DOMAIN; ?>public/css/styles.css">

    <title> <?php echo $title; ?> </title>
</head>
<body>
<h1 id="top-seo-h1"> <?php echo $title; ?> </h1>
<!-- Start Main Content -->
<div id="main-content">
