<?php

/*
 * Create HTML list of nav menu items.
 * Replacement for the native Walker, using the description.
 *
 * @see    http://wordpress.stackexchange.com/q/14037/
 * @author toscho, http://toscho.de
 */

class Thumbnail_Walker extends Walker_Nav_Menu
{
    function start_el(&$output, $item, $depth, $args)
    {

        if (! get_post_meta( $item->ID, 'saltIsInMainNav', true )) {
            return;
        }

        $classes     = empty ( $item->classes ) ? array () : (array) $item->classes;

        $class_names = join(
            ' '
            ,   apply_filters(
                'nav_menu_css_class'
                ,   array_filter( $classes ), $item
            )
        );

        ! empty ( $class_names )
        and $class_names = ' class="'. esc_attr( $class_names ) . '"';

        $output .= "<li id='menu-item-$item->ID' $class_names>";

        $attributes  = '';

        ! empty( $item->post_title )
        and $attributes .= ' title="'  . esc_attr( $item->post_title ) .'"';
        ! empty( $item->guid )
        and $attributes .= ' href="' . esc_url( site_url('/?p='.$item->ID) ) .'"';

        // insert thumbnail
        // you may change this
        $thumbnail = '';
        if ( has_post_thumbnail( $item->ID ) ) {
            $thumbnail = get_the_post_thumbnail( $item->ID );
            $post_thumbnail_id = get_post_thumbnail_id( $item->ID );
            $thumbnailUrl = wp_get_attachment_thumb_url( $post_thumbnail_id );
        }

        $title = apply_filters( 'the_title', $item->post_title, $item->ID );

        $item_output = $args->before
            . "<a $attributes style='background-image:url(\"$thumbnailUrl\")'>"
            . $args->link_before
            . "<span>$title</span>"
            . $thumbnail
            . $args->link_after
            . '</a> '
            . $args->after;

        // Since $output is called by reference we don't need to return anything.
        $output .= apply_filters(
            'walker_nav_menu_start_el'
            ,   $item_output
            ,   $item
            ,   $depth
            ,   $args
        );
    }
}

class SecondaryNavWalker extends Walker_Nav_Menu
{
    function start_el(&$output, $item, $depth, $args)
    {
        if (get_post_meta( $item->ID, 'saltIsInMainNav', true )) {
            return;
        }

        $classes     = empty ( $item->classes ) ? array () : (array) $item->classes;

        $class_names = join(
            ' '
            ,   apply_filters(
                'nav_menu_css_class'
                ,   array_filter( $classes ), $item
            )
        );

        ! empty ( $class_names )
        and $class_names = ' class="'. esc_attr( $class_names ) . '"';

        $output .= "<li id='menu-item-$item->ID' $class_names>";

        $attributes  = '';

        ! empty( $item->post_title )
        and $attributes .= ' title="'  . esc_attr( $item->post_title ) .'"';
        ! empty( $item->guid )
        and $attributes .= ' href="' . esc_url( site_url('/?p='.$item->ID) ) .'"';

        $title = apply_filters( 'the_title', $item->post_title, $item->ID );

        $item_output = $args->before
            . "<a $attributes>"
            . $args->link_before
            . "$title"
            . $args->link_after
            . '</a> '
            . $args->after;

        // Since $output is called by reference we don't need to return anything.
        $output .= apply_filters(
            'walker_nav_menu_start_el'
            ,   $item_output
            ,   $item
            ,   $depth
            ,   $args
        );
    }
}


add_action( 'after_setup_theme', 'blankslate_setup' );
function blankslate_setup()
{
load_theme_textdomain( 'blankslate', get_template_directory() . '/languages' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
global $content_width;
if ( ! isset( $content_width ) ) $content_width = 640;
register_nav_menus(
array( 'main-menu' => 'Main Menu', 'secondary-nav' => 'Secondary Nav' )
);
}
add_action( 'wp_enqueue_scripts', 'blankslate_load_scripts' );
function blankslate_load_scripts()
{
wp_enqueue_script( 'jquery' );
}
add_action( 'comment_form_before', 'blankslate_enqueue_comment_reply_script' );
function blankslate_enqueue_comment_reply_script()
{
if ( get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}
add_filter( 'the_title', 'blankslate_title' );
function blankslate_title( $title ) {
if ( $title == '' ) {
return '&rarr;';
} else {
return $title;
}
}
add_filter( 'wp_title', 'blankslate_filter_wp_title' );
function blankslate_filter_wp_title( $title )
{
return $title . esc_attr( get_bloginfo( 'name' ) );
}
add_action( 'widgets_init', 'blankslate_widgets_init' );
function blankslate_widgets_init()
{
register_sidebar( array (
'name' => __( 'Sidebar Widget Area', 'blankslate' ),
'id' => 'primary-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => "</li>",
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );
}
function blankslate_custom_pings( $comment )
{
$GLOBALS['comment'] = $comment;
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
<?php 
}
add_filter( 'get_comments_number', 'blankslate_comments_number' );
function blankslate_comments_number( $count )
{
if ( !is_admin() ) {
global $id;
$comments_by_type = &separate_comments( get_comments( 'status=approve&post_id=' . $id ) );
return count( $comments_by_type['comment'] );
} else {
return $count;
}
}

// ===============================

function registerScripts() {
    wp_register_script('saltThemeJs', get_bloginfo('template_directory') . '/javascript.js', array('jquery'));
    wp_enqueue_script('saltThemeJs');
}

add_action( 'wp_enqueue_scripts', 'registerScripts' );

function navMetaBox($post) {

    wp_nonce_field( 'salt_save_meta_box_data', 'salt_meta_box_nonce' );

    $value = get_post_meta( $post->ID, 'saltIsInMainNav', true );

    if ($value) {
        echo '<input type="checkbox" id="saltNavPlacement" name="navPlacementField" value="mainNav" checked />';
    } else {
        echo '<input type="checkbox" id="saltNavPlacement" name="navPlacementField" value="mainNav" />';
    }

    echo '<label for="saltNavPlacement">Place in main navigation</label> ';
}

function registerMetaBox() {
    add_meta_box( 'saltNav', 'Navigation Placement', 'navMetaBox', 'page', 'side' );
}

add_action( 'add_meta_boxes', 'registerMetaBox' );

function saveNavPlacementMeta( $post_id ) {
    if ( ! isset( $_POST['salt_meta_box_nonce'] ) ) {
        return;
    }

    if ( ! wp_verify_nonce( $_POST['salt_meta_box_nonce'], 'salt_save_meta_box_data' ) ) {
        return;
    }

    if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
        if ( ! current_user_can( 'edit_page', $post_id ) ) {
            return;
        }
    } else {
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }

    $my_data = sanitize_text_field( $_POST['navPlacementField'] );

    update_post_meta( $post_id, 'saltIsInMainNav', $my_data );
}
add_action( 'save_post', 'saveNavPlacementMeta' );

function my_page_menu_args( $args ) {
    if($args['theme_location'] === 'secondary-menu')
        $args['show_home'] = true;
    return $args;
}
add_filter( 'wp_page_menu_args', 'my_page_menu_args' );