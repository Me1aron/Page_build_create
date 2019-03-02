<?php 
function my_plugin_block_categories( $categories, $post ) {
    return array_merge(
        $categories,
        array(
            array(
                'slug' => 'Name category',
                'title' => __( 'Name category', 'Name category' ),
            ),
        )
    );
}
add_filter( 'block_categories', 'my_plugin_block_categories', 10, 2 );

add_action('acf/init', 'my_acf_init');
function my_acf_init() {
    
    // check function exists
    if( function_exists('acf_register_block') ) {
        
        // register a testimonial block
        acf_register_block(array(
            'name'              => 'Name',
            'title'             => __('Name'),
            'description'       => __('A custom Name block.'),
            'render_callback'   => 'my_acf_block_render_callback',
            'category'          => 'Store',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'Name', 'quote' ),
        ));
    }
}

function my_acf_block_render_callback( $block ) {
    
    $slug = str_replace('acf/', '', $block['name']);
    
    if( file_exists( get_theme_file_path("/blocks/content-{$slug}.php") ) ) {
        include( get_theme_file_path("/blocks/content-{$slug}.php") );
    }
}

?>