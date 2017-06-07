<?php

class BDAcfSearch
{

    /**
     * Hook a function or method to a specific filter action.
     *
     */
    public function __construct()
    {

        add_filter('posts_join', [$this, 'bdSearchJoin']);
        add_filter('posts_where', [$this, 'bdSearchWhere']);
        add_filter('posts_distinct', [$this, 'bdSearchDistinct']);

    }

    /**
     * Join posts and postmeta tables
     * @return string $join
     *
     */
    public function bdSearchJoin($join)
    {
        global $wpdb;

        if (is_search()) {
            $join .= ' LEFT JOIN ' . $wpdb->postmeta . ' ON ' . $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
        }

        return $join;
    }


    /**
     * Modify the search query with posts_where
     * @return string $where
     *
     */
    public function bdSearchWhere($where)
    {
        global $wpdb;

        $request = get_search_query();

        $haystack_fields_array = get_option('bd_search_setting');
        $haystack_fields_string = "'" . implode("', '", $haystack_fields_array) . "'";

        if (is_search()) {
            $where = preg_replace(
                "/\(\s*" . $wpdb->posts . ".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
                "(" . $wpdb->posts . ".post_title LIKE $1 )", $where);
        }

        if (!is_admin() && !empty($haystack_fields_array) && is_search()) {
            $where .= " OR (" . $wpdb->postmeta . ".meta_key IN (" . $haystack_fields_string . ") AND " . $wpdb->postmeta . ".meta_value LIKE '%" . $request . "%'  AND (" . $wpdb->posts . ".post_status = 'publish' OR " . $wpdb->posts . ".post_status = 'acf-disabled' AND " . $wpdb->posts . ".post_status = 'private'))";
        }

        return $where;
    }


    /**
     * Prevent duplicates
     * @return string $where
     *
     */
    public function bdSearchDistinct($where)
    {
        global $wpdb;

        if (is_search()) {
            return "DISTINCT";
        }

        return $where;
    }


}

new BDAcfSearch();