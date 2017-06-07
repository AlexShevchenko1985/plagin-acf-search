<div class="wrap">
    <form method="POST" id="settings_form">
        <div class="container">
            <h2><?php _e('Select custom fields to search by the site:', 'bd'); ?></h2>
            <label>
                <input id="checkAll" type="checkbox"
                       name="bd_acf_all" <?php echo ($option_all == 'on') ? 'checked' : ''; ?> >
                <strong><?php _e('All', 'bd'); ?></strong>
            </label>
            <br/>
            <?php
            $get_post_types = get_post_types();
            $skip = ['attachment', 'revision', 'nav_menu_item', 'custom_css', 'customize_changeset', 'wpcf7_contact_form', 'acf', 'acf-field', 'acf-field-group'];
            foreach ($get_post_types as $value) {
                if (in_array($value, $skip)) {
                    continue;
                }
                ?>
                <h3><?php echo $value; ?></h3>
                <?php
                $meta_key_result = $wpdb->get_col("SELECT DISTINCT(meta_key) FROM " . $wpdb->postmeta . " JOIN " . $wpdb->posts . " ON " . $wpdb->posts . ".id = " . $wpdb->postmeta . ".post_id WHERE  " . $wpdb->posts . ".post_type = '" . $value . "' AND meta_key NOT REGEXP '^_'");
                foreach ($meta_key_result as $value): ?>
                    <label>
                        <input type="checkbox" name="bd_acf_fields_array[]"
                               value="<?php echo trim($value); ?>" <?php if ($haystack) {
                            echo (in_array($value, $haystack)) ? 'checked' : '';
                        } ?>
                        <span><?php echo trim($value); ?></span>
                    </label>
                    <br/>
                <?php endforeach; ?>
            <?php } ?>
        </div>
        <div class="container-footer">
            <button class="button button-primary button-large" type="submit" name="save" value="save"><?php _e('Save change', 'bd'); ?></button>
        </div>
    </form>
</div>