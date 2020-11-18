<link href="<?php echo APP_RESOURCES; ?>css/cms_style.css" media="screen" rel="stylesheet" type="text/css" />

<script src="https://code.jquery.com/jquery-3.5.1.min.js"integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="crossorigin="anonymous"></script>
<script>$.noConflict();</script>

<script src="<?php echo APP_RESOURCES;?>javascript/colorbox-master/jquery.colorbox.js"></script>
<link rel="stylesheet" href="<?php echo APP_RESOURCES; ?>javascript/colorbox-master/colorbox.css">

<script>

	jQuery(document).ready(function($) {
		
		$.colorbox({
			transition: 'fade',
			initialWidth: '50px',
			initialHeight: '50px',
			overlayClose: false,
			escKey: false,
			scrolling: false,
			opacity: .6,
			href: '<?php echo SITE_PATH; ?>app/login.php'
		});
		
	});

</script>

