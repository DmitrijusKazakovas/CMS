<?php

/*CMS class for admins */

class Cms{
    private $content_types = array('wysiwyg', 'textarea', 'oneline');
    private $CMS;
    function __construct()
    {
        global $CMS;
        $this->CMS = &$CMS;
    }

    function clean_block_id($id){
        $id = str_replace(' ','_', $id);
        $id = str_replace('-', '_', $id);
        $id = preg_replace("/[^a-zA-Z0-9_]/" , '', $id);
        return strtolower($id);
    }

    function display_block($id, $type = 'wysiwyg'){
        //clean id
        $id = $this->clean_block_id($id);
        //check for valid type
        $type = strtolower(htmlentities($type, ENT_QUOTES));
        if (in_array($type, $this->content_types) == false){
            echo "<script>alert('Please enter a valid block type for\'"  . $id . "\''); <script>";
            return;
        }
        //get content
        $content = $this->load_block($id);
        if($content === FALSE){
            //create content
            $this->create_block($id);
            $content = '';
        }

        //check login status
        if ($this->CMS->Auth->checkLoginStatus()){
            if($type== 'wysiwyg') {$type2 = 'WYSIWYG';}
            if($type== 'textarea') {$type2 = 'Textarea';}
            if($type== 'oneline') {$type2 = 'One Line';}

            $edit_start = '<div class="cms_edit">';
            $edit_type = '<a class="cms_edit_type" href="' . SITE_PATH . 'app/cms/edit.php?id=' . $id . '&type=' . $type . '">' . $type2 . '</a>';
            $edit_link = '<a class="cms_edit_link" href="' . SITE_PATH . 'app/cms/edit.php?id=' . $id . '&type=' . $type . '"> Edit Block</a>';
            $edit_end = '</div>';

            echo $edit_start . $edit_type;
            echo $edit_link . $content . $edit_end;
        }else{
            echo $content;
        }
    }
    function generate_field($type, $content){
        if($type == 'wysiwyg'){
            return '<textarea name="field" id="field" class="wysiwyg">' . $content . '</textarea>';
        }
        else if($type == 'textarea'){
            return '<textarea name="field" id="field" class="textarea">' . $content . '</textarea>';
        }
        else if($type == "oneline"){
            return '<textarea name="field" id="field" class="oneline" value="' .$content.'">';
        }
        else{
            $error = "<p> Edit the block to use a valid content type:</p> <ul>";
            foreach( $this->content_types as $content_type){
                $error .= "<li>" . $content_type . "</li>";
            }
            $error .='</ul>';
            return $error;
        }
    }
    function load_block($id){
        //get content from db
        if($stmt = $this->CMS->Database->prepare("SELECT content FROM content WHERE id = ?")){
            $stmt->bind_param('s', $id);
            $stmt->execute();
            $stmt->store_result();

            if($stmt->num_rows != false){
                $stmt->bind_result($content);
                $stmt->fetch();
                $stmt->close();
                return $content;
            }
            else{
                $stmt->close();
                return false;
            }
        }
    }
    function create_block($id){
        if ($stmt = $this->CMS->Database->prepare("INSERT INTO content(id) VALUES (?)")){
            $stmt->bind_param("s", $id);
            $stmt->execute();
            $stmt->close();
        }
    }
    function update_block($id, $content){
        if($stmt = $this->CMS->Database->prepare("UPDATE content SET content = ? WHERE id = ?")){
            $stmt->bind_param("ss", $content, $id);
            $stmt->execute();
            $stmt->close();
        }
    }
}