<?php

/**
 * Class DropDown_Nav_Menu
 * This class defines the logic for the menu rendering.
 */

class DropDown_Nav_Menu extends Walker_Nav_Menu {

    public function display_element ($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
        // check, whether there are children for the given ID and append it to the element with a (new) ID
        $element->hasChildren = isset($children_elements[$element->ID]) && !empty($children_elements[$element->ID]);

        return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }

    public function start_el(&$output, $item, $depth = 0, $args =  array(), $current_object_id = 0) {

//&$output, $object, $depth = 0, $args = Array, $current_object_id = 0


        if($item->hasChildren) {
            $output .= sprintf("\n<li class=\"has-sub%s\"><a href=\"%s\"><span>%s</span></a>",
                ($item->object_id == get_the_ID()) ? ' active' : '',
                $item->url,
                $item->title
            );
        } else {
            $output .= sprintf("\n<li%s><a href=\"%s\"><span>%s</span></a>",
                ($item->object_id == get_the_ID()) ? ' style="active"' : '',
                $item->url,
                $item->title
            );
        }

    }

    public function end_el(&$output, $item, $depth =0, $args = array(),$current_object_id = 0 ) {

        $output .= '</li>';

    }

}