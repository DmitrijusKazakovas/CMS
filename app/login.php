<?php

include("init.php");

if (isset($_POST['username']))
{
	// get data
	$CMS->Template->setData('input_user', $_POST['username']);
	$CMS->Template->setData('input_pass', $_POST['password']);
	
	// validate data
	if ($_POST['username'] == '' || $_POST['password'] == '')
	{
		// show error
		if ($_POST['username'] == '') { $CMS->Template->setData('error_user', 'required'); }
		if ($_POST['password'] == '') { $CMS->Template->setData('error_pass', 'required'); }
		$CMS->Template->setAlert('Please fill in all required fields', 'error');
		echo '<script type="text/javascript">jQuery.colorbox.resize();</script>';
		$CMS->Template->load(APP_PATH . "core/views/v_login.php");
	}
	else if ($CMS->Auth->validateLogin($CMS->Template->getData('input_user'), $CMS->Template->getData('input_pass')) == FALSE)
	{
		// invalid login
		$CMS->Template->setAlert('Invalid username or password!', 'error');
		echo '<script type="text/javascript">jQuery.colorbox.resize();</script>';
		$CMS->Template->load(APP_PATH . "core/views/v_login.php");
	}
	else
	{
		// successful log in	
		$_SESSION['username'] = $CMS->Template->getData('input_user');
		$_SESSION['loggedin'] = TRUE;
		$CMS->Template->load(APP_PATH . "core/views/v_loggingin.php");
	}
}
else
{
	$CMS->Template->load(APP_PATH . "core/views/v_login.php");
}