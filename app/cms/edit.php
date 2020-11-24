<?php

include("../init.php");

$CMS->Auth->checkAuthorization();

if (isset($_POST['field']) && (isset($_POST['id']) == false || isset($_POST['type']) == false)){
    $CMS->Template->error('','Do not open edit windows in a separate tab');
    exit;
}else if (isset($_POST['field'])){
    //get data
    $id = $CMS->Cms->clean_block_id($_POST['id']);
    $CMS->Template->setData('block_id', $id);

    $type = htmlentities($_POST['type'], ENT_QUOTES);
    $content = $_POST['field'];

    $CMS->Cms->update_block($id, $content);

    //close colorbox + refresh
    $CMS->Template->load(APP_PATH . "cms/views/v_saving.php");
}else{
    if(isset($_GET['id']) == false || isset($_GET['type']) == false){
        $CMS->Template->error();
        exit;
    }
    $id = $CMS->Cms->clean_block_id($_GET['id']);
    $type = htmlentities($_GET['type'], ENT_QUOTES);

    $content = $CMS->Cms->load_block($id);

    $CMS->Template->setData('block_id', $id);
    $CMS->Template->setData('block_type', $type);
    $CMS->Template->setData('cms_field', $CMS->Cms->generate_field($type, $content), false);

    //load view
    $CMS->Template->load(APP_PATH . 'cms/views/v_edit.php');

}
