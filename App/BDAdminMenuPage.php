<?php

class BDAdminMenuPage
{

    /**
     * @vars string option name
     */
    private $option_name = 'bd_search_setting';
    private $option_all = 'bd_acf_all';

    /**
     * @var string icon name
     */
    private $icon = 'dashicons-search';


    /**
     * @var object singleton
     */
    private static $instance;

    /**
     * constructor
     * Hooks a function on to a specific action register menu.
     *
     */
    protected function __construct()
    {
        add_action('admin_menu', [$this, 'registerAdminMenuPage']);

    }

    /**
     * instance
     * @return object
     */
    public static function instance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;

    }

    /**
     * function register menu
     * @return string
     */
    public function registerAdminMenuPage()
    {

        add_menu_page(__('Custom Fields Search setting:', 'bd'), __('ACF Search settings', 'bd'), 'manage_options', 'bd-admin-search', [$this, 'viewAdminMenuPage'], $this->icon, 98);

    }

    /**
     * function viewAdminMenuPage
     *
     */
    public function viewAdminMenuPage()
    {

        $this->saveField();

        $view = new BDView();
        echo $view->renderer('admin');

    }

    /**
     * function saveField(saves custom fields for searching)
     *
     */
    public function saveField()
    {

        if ($_GET == $_SERVER['REQUEST_METHOD']) {
            return false;
        }

        if ('POST' == $_SERVER['REQUEST_METHOD'] && isset($_POST['bd_acf_fields_array'])) {

            update_option($this->option_name, $_POST['bd_acf_fields_array']);

        } elseif ('POST' == $_SERVER['REQUEST_METHOD']) {

            update_option($this->option_name, '');
        }

        if (!empty($_POST['bd_acf_all']) && 'POST' == $_SERVER['REQUEST_METHOD']) {

            update_option($this->option_all, $_POST['bd_acf_all']);

        } elseif ('POST' == $_SERVER['REQUEST_METHOD']) {

            update_option($this->option_all, '');

        }

    }

}

BDAdminMenuPage::instance();
