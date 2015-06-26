<?php
/**
* Plugin Name: RRSB
* Plugin URI: https://aklosismedia.com/quotes/dev/downloads/rrssb
* Description: RRSSB stands for ridiculously responsive social share buttons and is an adaptation of Kurt Noble's library for web. Install the plugin and use the exposed function or shortcode to display social sharing buttons on your site.
* Version: 1.0.0
* Author: Marty Boggs
* Author URI: https://aklosismedia.com
* Text Domain: Optional. Plugin's text domain for localization. Example: mytextdomain
* Domain Path: Optional. Plugin's relative directory path to .mo files. Example: /locale/
* License: GPLv2 or later
*/

function rrssb($options) {
    $types = array(
        'email',
        'facebook',
        'twitter',
        'googleplus',
        'tumblr',
        'linkedin',
        'hackernews',
        'reddit',
        'youtube',
        'pinterest',
        'pocket',
        'github',
        'outside_loop'
    );

    // convert to an array if string
    if (is_string($options)) {
        if (strpos($options, ',') !== false) {
            $options = explode(',', $options);
            foreach ($options as $o) {
                $o = trim($o);
            }
        } else {
            $options = array(trim($options));
        }
    }

    remove_filter( 'the_content', 'wpautop' );
    remove_filter( 'the_content', 'wptexturize' );

    $blog_name = get_bloginfo('name');
    $image = wp_get_attachment_url(get_post_thumbnail_id());

    if (isset($types['outside_loop']) && $types['outside_loop']) {
        global $wp;
        $url = trailingslashit(add_query_arg( $wp->query_string, '', home_url( $wp->request ) ));
        if (is_archive() && is_tax()) { // category archive page
            $cat = single_cat_title('', false);
            $title = ucfirst($cat) . ' - ' . $blog_name;
        } else if (is_archive()) { // post archive and cpt archive
            $type = get_post_type();
            $title = ucfirst($type) . ' - ' . $blog_name;
        } else { // includes is_front_page() is_home() and anything else
            $title = $blog_name;
        }
        $description = get_bloginfo('description');
    } else {
        $title = wp_strip_all_tags(get_the_title()) . ' - ' . $blog_name;
        $url = trailingslashit(get_permalink());
        $description = get_the_excerpt();
    }

    add_filter( 'the_content', 'wpautop' );
    add_filter( 'the_content', 'wptexturize' );

    echo '<div class="rrssb-container"><ul class="rrssb-buttons">';
    foreach ($options as $o) {
        if ($o !== 'outside_loop' && in_array($o, $types)) {
            $button = 'rrssb_' . $o;
            $button($title, $url, $description);
        }
    }
    echo '</ul></div>';
}


function rrssb_scripts () {
    wp_enqueue_style('rrssb-css', plugin_dir_url( __FILE__ ) . '/rrssb.css', array(), null);
    wp_enqueue_script('rrssb-js', plugin_dir_url( __FILE__ ) . '/rrssb.min.js', array('jquery'), null, false);
    // wp_enqueue_script('rrssb-js', plugin_dir_url( __FILE__ ) . '/rrssb.js', array('jquery'), null, false);
}
add_action('wp_enqueue_scripts', 'rrssb_scripts', 12); // priority 12

require 'rrssb_template.php';

// Add Shortcode
function rrssb_shortcode( $atts ) {
    $types = array(
        'email',
        'facebook',
        'twitter',
        'googleplus',
        'tumblr',
        'linkedin',
        'hackernews',
        'reddit',
        'youtube',
        'pinterest',
        'pocket',
        'github',
        'outside_loop'
    );

    // Attributes
    extract( shortcode_atts(
        array(
            'options' => ''
        ), $atts )
    );

    $options = explode(',', $options);
    foreach ($options as $o) {
        $o = trim($o);
    }

    remove_filter( 'the_content', 'wpautop' );
    remove_filter( 'the_content', 'wptexturize' );

    $blog_name = get_bloginfo('name');
    $image = wp_get_attachment_url(get_post_thumbnail_id());

    if ($types['outside_loop']) {
        global $wp;
        $url = trailingslashit(add_query_arg( $wp->query_string, '', home_url( $wp->request ) ));
        if (is_archive() && is_tax()) { // category archive page
            $cat = single_cat_title('', false);
            $title = ucfirst($cat) . ' - ' . $blog_name;
        } else if (is_archive()) { // post archive and cpt archive
            $type = get_post_type();
            $title = ucfirst($type) . ' - ' . $blog_name;
        } else { // includes is_front_page() is_home() and anything else
            $title = $blog_name;
        }
        $description = get_bloginfo('description');
    } else {
        $title = wp_strip_all_tags(get_the_title()) . ' - ' . $blog_name;
        $url = trailingslashit(get_permalink());
        $description = get_the_excerpt();
    }

    add_filter( 'the_content', 'wpautop' );
    add_filter( 'the_content', 'wptexturize' );

    // Code
    ob_start();

    echo '<ul class="rrssb-buttons">';
    foreach($options as $o) {
        if ($o !== 'outside_loop' && in_array($o, $types)) {
            $button = 'rrssb_' . $o;
            $button($title, $url, $description);
        }
    }
    echo '</ul>';
    return ob_get_clean();
}
add_shortcode( 'rrssb', 'rrssb_shortcode' );
