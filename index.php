<?php
/*
Plugin Name: ACF Search Simple
Plugin URI: https://github.com/AlexShevchenko1985/plagin-acf-search
Description: Add custom fields to WordPress website search results.
Author: Alex Shevchenko
Text Domain: bd
Version: 1.0
License: GPLv2 or later
*/

/*  Copyright 2017 Alex Shevchenko  (email: alexdoc1985@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
define('DB_ACF_SEARCH_SIMPLE_DIR', __DIR__ );
define('DB_ACF_SEARCH_SIMPLE_URl', plugin_dir_url(__FILE__));

function bd_acf_search_simple_loads(){

    // admin only includes
    if(is_admin()){
        require_once(DB_ACF_SEARCH_SIMPLE_DIR. '/App/BDAdminMenuPage.php');
        require_once(DB_ACF_SEARCH_SIMPLE_DIR. '/App/BDClassSetupSettings.php');
        require_once(DB_ACF_SEARCH_SIMPLE_DIR. '/App/BDView.php');
    }

    // includes
    if (!is_admin()) {
        require_once(DB_ACF_SEARCH_SIMPLE_DIR . '/App/BDAcfSearch.php');
    }

}
bd_acf_search_simple_loads();


