<link rel="stylesheet" href=" app/resources/css/cms_style.css" <?php echo APP_RESOURCES; ?>>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="crossorigin="anonymous"></script>
<script>$.noConflict();</script>

<script src=" javascript/tinymce/tinymce.min.js <?php echo APP_RESOURCES; ?>"></script>


<script src="<?php echo APP_RESOURCES;?>javascript/colorbox-master/jquery.colorbox.js"></script>
<link rel="stylesheet" href= "app/resources/javascript/colorbox-master/colorbox.css" <?php echo APP_RESOURCES; ?>>

<script>

	jQuery(document).ready(function($) {
		$('.cms_edit').each(function(){
			var height = $(this).outerHeight();
			if (heigh < 25) {height = 25;}
			var width = $(this).parent().width();

			$(this).height(height).widht(width);
			$(this).find('.cms_edit_link').height(height-2).width(width-2);
		});
		$('.cms_edit_type').mouseenter(function(){
			$(this).parent().find('.cms_edit_link').addClass('hover');
		}).mouseleave(function(){
			$(this).parent().find('.cms_edit_link').addClass('hover');
		});

		$('#edit_toggle').click(function(e){
			e.preventDefault();

			if($this().text() == 'Preview Page'){
				$(this).text('Edit Page');
			}
			else{
				$(this).text('Preview Page');
			}
			$('.cms_edit_type').toggle();
			$('.cms_edit_link').toggle();
		});
		$('.cms_edit_type, .cms_edit_link').click(function(e){
			$(this).colorbox({
			transition: 'fade',
			initialWidth: '50px',
			initialHeight: '50px',
			overlayClose: false,
			escKey: false,
			opacity: .6
			});
		});
		$('#cms_cancel').live('click', function(e){
            e.preventDefault();
            $.colorbox.close();
        });
	});

</script>