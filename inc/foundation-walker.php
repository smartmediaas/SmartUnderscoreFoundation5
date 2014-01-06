<?php 
/*
http://codex.wordpress.org/Function_Reference/wp_nav_menu
*/
 
// top bar
function foundation_top_bar() {
    wp_nav_menu(array( 
        'container' => false,                           // remove nav container
        'container_class' => '',                        // class of container                                       
        'menu_class' => 'top-bar-menu right',           // adding custom nav class
        'theme_location' => 'primary',                  // where it's located in the theme
        'before' => '',                                 // before each link <a> 
        'after' => '',                                  // after each link </a>
        'link_before' => '',                            // before each link text
        'link_after' => '',                             // after each link text
        'depth' => 5,                                   // limit the depth of the nav
        'fallback_cb' => false,                         // fallback function (see below)
        'walker' => new top_bar_walker()
        ));
} // end right top bar


/*
Customize the output of menus for Foundation top bar classes
*/
 
class top_bar_walker extends Walker_Nav_Menu {
 
    function display_element($element, &$children_elements, $max_depth, $depth=0, $args, &$output) {
        $element->has_children = !empty($children_elements[$element->ID]);
        $element->classes[] = ($element->current || $element->current_item_ancestor) ? 'active' : '';
        $element->classes[] = ($element->has_children) ? 'has-dropdown' : '';
                
        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
        
    function start_lvl(&$output, $depth = 0, $args = array()) {
        $output .= "\n<ul class=\"sub-menu dropdown\">\n";
    }
    
} // end top bar walker

?>