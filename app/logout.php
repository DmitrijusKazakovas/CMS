<?php
include("init.php");

//Log out
$CMS->Auth->logout();

//Redirect
$CMS->Template->redirect(SITE_PATH);
