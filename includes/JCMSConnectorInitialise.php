<?php
/*
 * wordpress.stackexchange.com/questions/61437
 */
include "JCMSConnectorActions.php";
include "JCMSConnectorAdminSetup.php";    //functions to set up the settings page

class JCMSConnectorInitialise{

    
    function __construct(){
        add_shortcode('jcms_connector_content_id', [$this,'jcms_connector_get_content_by_id']);
//      Full version: Second shortcode to handle paths rather than IDs, and corresponding handler function
        add_shortcode('jcms_connector_content_path', [$this,'jcms_connector_get_content_by_path']);
        $admin = new JCMSConnectorAdminSetup();
    }
    
    /*
     * Get content by a content ID.
     * */
    public function jcms_connector_get_content_by_id($atts){    //shortcode params
        $_out = '';
        if(array_key_exists('id',$atts) && array_key_exists('service',$atts)){
            $_connector = new JCMSConnectorActions();
            $_out = $_connector->getContentById($atts);
            $_connector = null;
        }
        return $_out;
    }
    
    /*
     * Get content by a relative path. Will use a configured base path and will require appropriate source
     * CMS modifications to render isolated content, rather than a full HTML page.
     * */
    public function jcms_connector_get_content_by_path($atts){    //shortcode params
        $_out = '[Content rendering by path not available in Lite version.]';
        return $_out;
    }
    
}

