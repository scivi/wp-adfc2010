<?php

add_action( 'init', 'create_radtouren_post_type' );

function create_radtouren_post_type() {
    register_post_type('radtouren', 
        array(
            'label' => 'Radtouren',
            'description' => 'Radtouren des ADFC Sachsen-Anhalt e.V. - Auch in Ihrer Nähe!',
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => false,
            'capability_type' => 'post',
            'hierarchical' => false,
            'rewrite' => array('slug' => 'radtour'),
            'has_archive' => 'radtouren',
            'query_var' => 'radtouren',
            'supports' => array('title','editor','custom-fields','comments','revisions','thumbnail','author','page-attributes'),
            'taxonomies' => array('schwierigkeitsgrad','veranstalter','besonderheiten'),
            'labels' => array (
                'name' => 'Radtouren',
                'singular_name' => 'Radtour',
                'menu_name' => 'Radtouren',
                'add_new' => 'Neue Tour',
                'add_new_item' => 'Neue Radtour',
                'edit' => 'Bearbeiten',
                'edit_item' => 'Tour bearbeiten',
                'new_item' => 'Neue Tour',
                'view' => 'Zeigen',
                'view_item' => 'Tour anzeigen',
                'search_items' => 'Touren suchen',
                'not_found' => 'Keine Touren gefunden',
                'not_found_in_trash' => 'Keine Touren im Papierkorb'
            )
        )
    );
    
    register_taxonomy( 'schwierigkeitsgrad', 'radtouren',
        array(
            'hierarchical' => false,
            'label' => 'Schwierigkeitsgrad',
            'query_var' => true,
            'rewrite' => true,
            'singular_label' => 'Schwierigkeitsgrad'
        )
    );
    
    register_taxonomy('besonderheiten', 'radtouren',
        array(
            'hierarchical' => true,
            'label' => 'Besonderheiten',
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => true,
            'singular_label' => 'Besonderheit'
        )
    );
    
    register_taxonomy('veranstalter', 'radtouren',
        array(
            'hierarchical' => true,
            'label' => 'Veranstalter',
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => true,
            'singular_label' => 'Veranstalter'
        )
    );
}

?>