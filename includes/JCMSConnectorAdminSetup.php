<?php
/*
 * Set up the admin page for the plugin.
 * */ 

class JCMSConnectorAdminSetup{
    function __construct(){
        add_action('admin_menu',[$this,'jcms_connector_setup_menu']);
        add_action('admin_init',[$this,'jcms_connector_admin_init']);
    }
    
    function jcms_connector_setup_menu(){      //CALLBACK
        add_options_page('JCMS Connector setup','JCMS Connector Lite','manage_options','jcms-connector',[$this,'jcms_connector_init']);
    }
    
    function jcms_connector_init(){     //CALLBACK
        ?>
    <div class="wrap">
    <h2>Configure JCMS Lite Connector</h2>
    <p>This lite version allows for one connector definition.</p>
    <form action="/wp-admin/options.php" method="post">
    <?php settings_fields('jcms_connector_opts'); ?>
    <?php do_settings_sections('jcms-connector'); ?>
    <table class="form-table"> 
      <tr valign="top">
        <td colspan="2">
            <input name="Submit" type="submit" class="button button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
        </td>
      </tr>
    </table>
    </form>
    </div>
    <?php
    }
    
    function jcms_connector_admin_init(){     //CALLBACK
        register_setting('jcms_connector_opts','jcms_connector_opts'); //no validate function yet
        add_settings_section('jcms_connector_s1', 'Connector', null, 'jcms-connector');
        add_settings_field('plugin_text_input1_1', 'Connection name', [$this,'plugin_input1_1'], 'jcms-connector', 'jcms_connector_s1');
        add_settings_field('plugin_text_input1_2', 'Server root', [$this,'plugin_input1_2'], 'jcms-connector', 'jcms_connector_s1');
        add_settings_field('plugin_text_input1_3', 'Script name', [$this,'plugin_input1_3'], 'jcms-connector', 'jcms_connector_s1');
        add_settings_field('plugin_text_input1_4', 'URL parameter name', [$this,'plugin_input1_4'], 'jcms-connector', 'jcms_connector_s1');
    }
    
    //callbacks for section 1:
    function plugin_input1_1() {
        $options = get_option('jcms_connector_opts');
        echo "<input id='plugin_input1_1' class='normal-text code' name='jcms_connector_opts[1][name]' size='50' type='text' value='{$options[1]['name']}' />";
    }
    function plugin_input1_2() {
        $options = get_option('jcms_connector_opts');
        echo "<input id='plugin_input1_2' class='normal-text code' name='jcms_connector_opts[1][server]' size='50' type='text' value='{$options[1]['server']}' />";
    }
    function plugin_input1_3() {
        $options = get_option('jcms_connector_opts');
        echo "<input id='plugin_input1_3' class='normal-text code' name='jcms_connector_opts[1][script]' size='50' type='text' value='{$options[1]['script']}' />";
    }
    function plugin_input1_4() {
        $options = get_option('jcms_connector_opts');
        echo "<input id='plugin_input1_4' class='normal-text code' name='jcms_connector_opts[1][urlparam]' size='50' type='text' value='{$options[1]['urlparam']}' />";
    }
    
    function plugin_options_validate($input) {
            $options = get_option('jcms_connector_opts');
            return $options;
    }
    
}
