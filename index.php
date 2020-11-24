<?php  include("app/init.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS</title>
    <link rel="stylesheet" href="resources/style.css">
    <?php  $CMS->head();?>
</head>
<body class="home"  <?php $CMS->body_class(); ?>>

<?php  $CMS->toolbar(); ?>

<div id="wrapper">
    <h1>CMS</h1>

    <div id="banner">
        <img src="app/resources/images/banner.jpg" alt="banner" width="900px" height="140px">
    </div>

    <ul id="nav">
        <li> <a href="#">Home</a> </li>
        <li> <a href="#">Link</a> </li>
        <li> <a href="#">Link2</a> </li>
        <li> <a href="#">Contacts</a> </li>
    </ul>

    <div id="content">
        <div class="left">
            <h2><?php $CMS->Cms->display_block('content-header', 'oneline'); ?></h2>
            <?php $CMS->Cms->display_block('content-maincontent'); ?>
        </div>
        <div class="right">
            <?php $CMS->Cms->display_block('content-quote'); ?>
            <?php $CMS->Cms->display_block('content-attribution'); ?>
        </div>
    </div>

    <div id="footer">
        &copy; 2020 CMS. | <?php $CMS->login_link();?>
    </div>
</div> 
</body>
</html>