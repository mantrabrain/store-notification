<?php
/**
 * Admin View: Settings
 *
 * @package AgencyEcommerceAddons
 */

if (!defined('ABSPATH')) {
    exit;
}


$tab_exists = isset($tabs[$current_tab]) || has_action('store_notification_sections_' . $current_tab) || has_action('store_notification_settings_' . $current_tab) || has_action('store_notification_settings_tabs_' . $current_tab);
$current_tab_label = isset($tabs[$current_tab]) ? $tabs[$current_tab] : '';


if (!$tab_exists) {

    wp_safe_redirect(admin_url('admin.php?page=store-notification&tab=general&section=general'));
    exit;
}

?>
<div class="wrap store-notification">
    <form method="<?php echo esc_attr(apply_filters('store_notification_settings_form_method_tab_' . $current_tab, 'post')); ?>"
          id="mainform" action="" enctype="multipart/form-data">
        <nav class="nav-tab-wrapper store-notification-nav-tab-wrapper">
            <?php

            foreach ($tabs as $slug => $label) {
                echo '<a href="' . esc_html(admin_url('admin.php?page=store-notification&tab=' . esc_attr($slug))) . '" class="nav-tab ' . ($current_tab === $slug ? 'nav-tab-active' : '') . '">' . esc_html($label) . '</a>';
            }

            do_action('store_notification_settings_tabs');


            ?>
        </nav>
        <h1 class="screen-reader-text"><?php echo esc_html($current_tab_label); ?></h1>
        <?php
        do_action('store_notification_sections_' . $current_tab);

        self::show_messages();

        do_action('store_notification_settings_' . $current_tab);
        do_action('store_notification_settings_tabs_' . $current_tab); // @deprecated hook. @todo remove in 4.0.
        ?>
        <p class="submit">
            <?php if (empty($GLOBALS['hide_save_button'])) : ?>
                <button type="submit" class="button-primary store-notification-save-button" name="save"
                        value="<?php echo esc_attr('Save changes', 'store-notification'); ?>"><?php echo esc_attr('Save changes', 'store-notification'); ?></button>

            <?php endif; ?>

            <?php wp_nonce_field('store-notification'); ?>
        </p>
    </form>
</div>
