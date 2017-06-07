<?php

class BDClassSetupSettings
{

    /**
     * init admin action
     *
     */
    public function __construct()
    {
        add_action('admin_enqueue_scripts', [$this, 'connectStyle']);
        add_action('admin_enqueue_scripts', [$this, 'connectScripts']);
    }

    /**
     * register style
     *
     */
    public function connectStyle()
    {
        wp_register_style('bd-plugin-style', DB_ACF_SEARCH_SIMPLE_URl . '/../inc/css/style.css');
        wp_enqueue_style('bd-plugin-style');
    }

    /**
     * register script
     *
     */
    public function connectScripts()
    {

        wp_register_script('bd-plugin-global-script', DB_ACF_SEARCH_SIMPLE_URl . '/../inc/js/global.js', array('jquery'), null, true);
        wp_enqueue_script('bd-plugin-global-script');

    }

}

new BDClassSetupSettings;