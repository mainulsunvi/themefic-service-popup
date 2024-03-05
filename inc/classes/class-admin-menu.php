<?php

namespace TFSP\Classes;

use WP_Query;

class Admin_Menu {
    // protected $menu_args = array(
    //     "title" => __( "Themefic Popup" , "tfsp" ),
    //     'capability' => 'manage_options',
    //     'slug' =>  'tfsp_service_popup',
    //     'icon' => 'dashicons-superhero',
    // );
    function init() {
        // add_menu_page(__( "Themefic Popup" , "tfsp" ), __( "Themefic Popup" , "tfsp" ),'manage_options', "tfsp_service_popup", null, 'dashicons-superhero', 28);
        add_action( 'admin_menu', array( $this, 'register_admin_menu') );
        add_action( 'admin_init', array( $this, 'register_mysettings') );
    }

    function register_mysettings() {
        //register our settings
        register_setting( 'tfsp_popup', 'tfsp_service_post_select' );
        register_setting( 'tfsp_popup', 'tfsp_service_popup_delay' );
    }

    function register_admin_menu(){
        add_menu_page( 
            __( "Themefic Popup" , "tfsp" ),
            __( "Themefic Popup" , "tfsp" ),
            'manage_options',
            'tfsp_popup',
            array($this, 'my_custom_menu_page'),
            'dashicons-superhero',
            25
        ); 
    }

    function my_custom_menu_page(){
        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => -1,
            'order' => 'ASC'
        );
        
        $loop = new WP_Query( $args );
        
        
        // die(); // added by - Sunvi
        ?>
        <div class="wrap">
            <h1>Themefic Service Popup Settings</h1>
            <form method="post" action="options.php">
            <?php settings_fields( 'tfsp_popup' ); ?>
            <?php do_settings_sections( 'tfsp_popup' ); ?>
            <input type="hidden" value="/wp-admin/options.php?page=tfsp_popup" name="_wp_http_referer">
            <table class="form-table">
                <tbody>
                    <tr>
                        <th scope="row">
                            <label for="tfsp_service_post_select">Select a Sevice for Popup:</label>
                        </th>
                        <td>
                            <?php
                            if($loop->have_posts()) {
                                $loop_posts = $loop->posts;
                                ?>
                                    <select name="tfsp_service_post_select" style="width: 15%;" id="products" value="<?php echo !empty(get_option('tfsp_service_post_select')) ? get_option('tfsp_service_post_select') : 0; ?>">
                                <?php 
                                foreach($loop_posts as $data) {
                                    ?> 
                                        <option <?php echo get_option('tfsp_service_post_select') ==  $data->ID ? "selected" : "" ?> value="<?php echo $data->ID; ?>" ><?php echo $data->post_title; ?></option> 
                                    <?php
                                }
                            }
                            ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">
                            <label for="blogname">Popup Delay Time (MS):</label>
                        </th>
                        <td>
                            <input type="number" name="tfsp_service_popup_delay" id="products" style="width: 15%;" value="<?php echo !empty(get_option('tfsp_service_popup_delay')) ? get_option('tfsp_service_popup_delay') : 0; ?>">
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php submit_button(); ?>
            </form>
        </div>
        <?php
    }
}