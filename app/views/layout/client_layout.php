<!DOCTYPE html>
<html lang="en" data-web-root="<?php echo _WEB_ROOT; ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo-Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/css/base.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/css/main.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/css/product_detail.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/css/product_page_responsive.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/css/responsive.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/fonts/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?php echo _WEB_ROOT ?>/public/assets/icons/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="<?php _WEB_ROOT ?>/public/assets/icons/favicon.png" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<?php
    $this->render('blocks/header.php');
?>

<body>
    <div class="shop">
        <?php
        $this->render('pages/main.php');
        
        ?>
        <div class="shop-footer">
           
        </div>
        <script src="<?php echo _WEB_ROOT ?>/public/assets/js/search.js"></script>
        <script src="<?php echo _WEB_ROOT ?>/public/js/home/home.js"></script>
</body>

</html>