<?php

class BDView
{
    /**
     * function renderer
     * Connect template
     */
    public function renderer($template)
    {
        // global
        global $wpdb;

        // options field
        $haystack = get_option('bd_search_setting');
        $option_all = get_option('bd_acf_all');

        include __DIR__. '/Views/'.$template.'.php';
    }

}

