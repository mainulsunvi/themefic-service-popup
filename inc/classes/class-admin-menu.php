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
    }

    function register_admin_menu(){
        add_menu_page( 
            __( "Themefic Popup" , "tfsp" ),
            __( "Themefic Popup" , "tfsp" ),
            'manage_options',
            'tfsp-popup',
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
            <form method="post" <?php echo admin_url( 'admin.php' ); ?> novalidate="novalidate">
            <table class="form-table">
                <tbody>
                    <tr>
                        <th scope="row">
                            <label for="blogname">Select a Sevice for Popup</label>
                        </th>
                        <td>
                            <?php
                            if($loop->have_posts()) {
                                $loop_posts = $loop->posts;
                                ?>
                                    <select name="cars" id="cars">
                                <?php
                                foreach($loop_posts as $data) {
                                    ?> <option value="<?php echo $data->post_title; ?>" ><?php echo $data->post_title; ?></option> <?php
                                }
                            }
                            ?>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
                <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p>
            </form>
        </div>
        <?php
    }
}