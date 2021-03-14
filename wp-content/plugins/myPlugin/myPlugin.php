<?php

/*
Plugin Name: My Plugin
Description: This will add program Count
*/

add_filter('the_content', 'contentEdit');

function contentEdit($content){
    $content = $content;
    return $content;
}

add_shortcode('programCount', 'programCounter');

function programCounter(){

    return wp_count_posts('program')->publish;
}