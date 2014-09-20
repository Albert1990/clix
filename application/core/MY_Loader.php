<?php

/**
 * /application/core/MY_Loader.php
 *
 */
class MY_Loader extends CI_Loader {
    public function template($template_name, $vars = array(), $return = FALSE)
    {
        $vars['viewName']=$template_name;
        $content  = $this->view('templates/start', $vars, $return);
//        $content  .= $this->view('templates/header', $vars, $return);
//        $content .= $this->view($template_name, $vars, $return);
//        $content .= $this->view('templates/footer', $vars, $return);

        if ($return)
        {
            return $content;
        }
    }
	
	
    public function generateThumbPhoto($picturePath)
    {
        $thumbPicturePath=substr($picturePath,0,strlen($picturePath)-4).'_thumb'. substr($picturePath, -4);
        return $thumbPicturePath;
    }
}
?>