<?php
/*
 * Render and manage admin page
 */
class JCMSConnectorActions{
    const JCMS_CONNECTOR_OPTS = 'jcms_connector_opts';
    
    var $_current_jcms_settings = null;
    
    function __construct(){
        $this->_current_jcms_settings = get_option(JCMSConnectorActions::JCMS_CONNECTOR_OPTS);
    }
    
    public function getContentById($_attrs){
        $_current_config = $this->getAttributesByConnectionName($_attrs['service']);
        $_out = null;

        if($_current_config != null){
            $_url = $this->buildRequestUrl($_current_config, 'id', $_attrs['id']);
        
            //implement a cache as per here (see note on called function):
            $_out = $this->_urlCacheHandler($_url,$_current_config); 
        }
        
        return($_out);
    }
    
    public function getContentByPath($_attrs){
        $_current_config = $this->getAttributesByConnectionName($_attrs['service']);
        $_url = $this->buildRequestUrl($_current_config, 'path', $_attrs['path']);
        $_out = $this->_urlCacheHandler($_url,$_current_config);
        return($_out);
    }

    /*
     * Called by shortcode handler expecting to use an ID, a remote handler script and the name
     * */
    public function getAttributesByConnectionName($_service){
        $_out = null;
        //Full version: Will select correct configuration by passed parameter
        $_out = $this->_current_jcms_settings[1];//force the first one
        return ($_out);
    }
    

    public function buildRequestUrl($params,$type,$shortcode_flag){
        $url = null;
        //Full version: will select by path or ID
        $url = $params['server'] . '/' . $params['script'] . '?' . $params['urlparam'] . '=' .  $shortcode_flag;
        return($url);
    }
    

    private function _urlCacheHandler($_url,$_conf){
        //echo($_url);
        $_cachetime = 0;   //seconds, default
        //Full version: Implemets a configurable cache to assist performance and HTTP requests from the server
        $_out = strip_tags(file_get_contents($_url),'<br><ul><li><div>');
        return($_out);
    }
}

