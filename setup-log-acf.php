<?php

/**
 * SETUP (Block Category)
 * Register Custom Block Category
 * 
 */
add_filter( 'block_categories', 'setup_log_block_categories', 10, 2 );
function setup_log_block_categories( $categories ) {
    return array_merge(
        array(
            array(
                'slug' => 'setup',
                'title' => __( 'Setup', 'mydomain' ),
                //'icon'  => 'wordpress',
            ),
        ),
        $categories
    );
}


/**
 * LOG (Custom Blocks)
 * Register Custom Blocks
 * 
 */
add_action( 'acf/init', 'setup_log_block_acf_init' );
function setup_log_block_acf_init() {

    $blocks = array(
        
        'logs' => array(
            'name'                  => 'log',
            'title'                 => __('Log'),
            'render_template'       => plugin_dir_path( __FILE__ ).'partials/blocks/setup-log-flex.php',
            'category'              => 'setup',
            'icon'                  => 'list-view',
            'mode'                  => 'edit',
            'keywords'              => array( 'update', 'log' ),
            'supports'              => [
                'align'             => false,
                'anchor'            => true,
                'customClassName'   => true,
                'jsx'               => true,
            ],
        ),

        'pull_field' => array(
            'name'                  => 'pull_field',
            'title'                 => __('Pull Field'),
            'render_template'       => plugin_dir_path( __FILE__ ).'partials/blocks/setup-pull-field.php',
            'category'              => 'setup',
            'icon'                  => 'admin-links',
            'mode'                  => 'edit',
            'keywords'              => array( 'pull', 'get' ),
        ),

    );

    // Bail out if function doesn’t exist or no blocks available to register.
    if ( !function_exists( 'acf_register_block_type' ) && !$blocks ) {
        return;
    }
    
    // this loop is broken, how do we register multiple blocks in one go?
    // Register all available blocks.
    $user = wp_get_current_user();

    $allowed_roles = array( 'administrator' ); // can also be array( 'editor', 'administrator', 'author' );

//    if( array_intersect( $allowed_roles, $user->roles ) ) {

        foreach( $blocks as $block ) {
            acf_register_block_type( $block );
        }

//    }
  
}


/**
 * Auto fill Select options
 *
 */
add_filter( 'acf/load_field/name=log_layout', 'acf_setup_load_template_choices' );
add_filter( 'acf/load_field/name=pull_layout', 'acf_setup_load_template_choices' );
function acf_setup_load_template_choices( $field ) {
    
    // get all files found in VIEWS folder
    $view_dir = plugin_dir_path( __FILE__ ).'partials/views/';
/*    $files = scandir($path);
    $choices = array_diff(scandir($path), array('.', '..'));
    var_dump($choices);
  */

    $data_from_database = setup_pull_view_files( $view_dir );

    //Change this to whatever data you are using.
    /*$data_from_database = array(
        'key1' => 'value1',
        'key2' => 'value2'
    );*/

    $field['choices'] = array();

    //Loop through whatever data you are using, and assign a key/value
    if( is_array( $data_from_database ) ) {

        foreach( $data_from_database as $field_key => $field_value ) {
            $field['choices'][$field_key] = $field_value;
        }

        return $field;

    }
    
}


/**
 * Get VIEW template | this function is called by SETUP-LOG-FLEX.PHP found in PARTIALS/BLOCKS folder
 */
function setup_acf_pull_view_template( $layout, $args = FALSE ) {

    $layout_file = plugin_dir_path( __FILE__ ).'partials/views/'.$layout;
    
    if( $args ) {

        if( array_key_exists( 'id', $args ) ) {

            global $pid;

            $pid = $args[ 'id' ];

        }
        
    }
    
    if( is_file( $layout_file ) ) {

        ob_start();

        include $layout_file;

        $new_output = ob_get_clean();
            
        if( !empty( $new_output ) )
            $output = $new_output;

    } else {

        $output = FALSE;

    }

    return $output;

}

/*add_action( 'genesis_before_content', 'textsss' );
function textsss() {
    $view_dir = plugin_dir_path( __FILE__ ).'partials/views/';
    var_dump( setup_pull_view_files( $view_dir ) );
}*/


// #####################################################################################################################
// get all files in the INC folder to be used for including the said files
// but get rid of the dots that scandir() picks up in Linux environments
if( !function_exists( 'setup_pull_view_files' ) ) {

    function setup_pull_view_files( $directory ) {

        $out = array();
        
        // get all files inside the directory but remove unnecessary directories
        $ss_plug_dir = array_diff( scandir( $directory ), array( '..', '.' ) );
        
        foreach ($ss_plug_dir as $value) {
            
            // combine directory and filename
            $file = basename( $directory.$value, ".php" );

            // get details of the file
            //$filepath = pathinfo( $file );
            //echo '<h1>'.basename( $file, ".php" ).'</h1>';
            // ------------------------------------------------------
            /*$source = file_get_contents( $file );
            var_dump($source);
            echo '<hr />';
            $tokens = token_get_all( $source );
            $comment = array(
                T_COMMENT,      // All comments since PHP5
//                T_ML_COMMENT,   // Multiline comments PHP4 only
//                T_DOC_COMMENT   // PHPDoc comments      
            );

            foreach( $tokens as $token ) {

                if( !in_array($token[0], $comment) )
                    continue;

                // Do something with the comment
                $txt = explode( 'TEMPLATE:', $token[1] );
                if( is_array( $txt ) ) {

                    if( is_array( $txt[ 1 ] ) ) {
                        if( count( $txt[ 1 ] ) >= 1 ) {

                            $select_value = explode( '* /', $txt[ 1 ] );
                            $use_sel_val = trim($select_value[ 0 ]);

                            // found what we need; exit the token loop
                            break;

                        }
                    }

                }

            }*/
            // ------------------------------------------------------

            // filter files to include
            if( $file ) {
                $out[ $value ] = $file;
            }

        }

        // Return an array of files (without the directory)
        return $out;

    }
    
}

// PULL TEMPLATE FILES
if( !function_exists( 'setup_starter_list_all_templates' ) ) {

    function setup_starter_list_all_templates() {
        
        // set directory
        $tar_dir = plugin_dir_path( __FILE__ )."templates";
        
        // get an array of files from $tar_dir
        $dir_file = setup_starter_pull_files( $tar_dir );
        foreach ($dir_file as $d_file) {
        
            // get the tokens
            $tokens = token_get_all( file_get_contents( $tar_dir.'/'.$d_file ) );

            foreach($tokens as $token) {
                
                //if($token[0] == T_COMMENT || $token[0] == T_DOC_COMMENT) {
                if( $token[0] == T_DOC_COMMENT ) {

                    // remove unnecessary characters
                    $t_name = trim( str_replace( '*', '', str_replace( '/', '', $token[1] ) ) );
                    
                }

            }

            // split the line to get the template name from "TEMPLATE NAME: Feature Display All"
            $et_name = explode( ':', $t_name );

            // trim( $et_name[0] ) contains "TEMPLATE NAME"
            // trim( $et_name[1] ) contains the actual template name
            // $d_file is the PHP file
            $out[] = array( $d_file => trim( $et_name[1] ) );

        }

        return $out;

    }

}