<?php
/*
Plugin Name: Contactform
Description: use [contactform] shortcode in your template
Version: Номер версии плагина, например: 1.0
Author: Alexey Soloviov
*/
function contactFunction(){
    $notification = '';
    if (isset($_POST['contact_name']) && isset($_POST['email'])) {
        global $wpdb;
        $name = $_POST['contact_name'];
        $category = $_POST['category'];
        $email = $_POST['email'];
        $message = isset($_POST['message']) ? $_POST['message'] : '';
        $emailMessage = 'Category: '.$wpdb->get_var("SELECT category FROM ".$wpdb->prefix . "categories WHERE id = ".intval($category));
        if ($message) {
            $emailMessage .= ', Text:' .$message;
        }
        wp_mail($email, $name, $emailMessage);
        $notification = 'Message sent!';
    }

    include __DIR__ . '/view/index.php';
}
add_shortcode( 'contactform', 'contactFunction' );

function contactform_install() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'categories';

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `category` varchar(255) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

function contactform_install_data() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'categories';

    $wpdb->insert(
        $table_name,
        array(
            'category' => 'First category',
        )
    );
    $wpdb->insert(
        $table_name,
        array(
            'category' => 'Second category',
        )
    );
    $wpdb->insert(
        $table_name,
        array(
            'category' => 'Third category',
        )
    );
    $wpdb->insert(
        $table_name,
        array(
            'category' => 'Fourth category',
        )
    );
}

function contactform_uninstall() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'categories';

    $sql = "DROP TABLE IF EXISTS $table_name";

    $wpdb->query( $sql );
}

register_activation_hook( __FILE__, 'contactform_install' );
register_activation_hook( __FILE__, 'contactform_install_data' );

register_deactivation_hook(__FILE__, 'contactform_uninstall');
register_uninstall_hook(__FILE__, 'contactform_uninstall');