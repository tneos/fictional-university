<?php

require get_theme_file_path('/includes/search-route.php');
require get_theme_file_path('/includes/like-route.php');

function university_custom_rest() {
    register_rest_field('post', 'authorName', array(
        'get_callback' => function() {
            return get_the_author();
        }
    ));

    register_rest_field('note', 'userNoteCount', array(
        'get_callback' => function() {
            return count_user_posts(get_current_user_id(), 'note');
        }
    ));
}

add_action('rest_api_init', 'university_custom_rest');

// Arguments optional
function pageBanner($args = NULL) {
    if(!isset($args['title'])) {
        $args['title'] = get_the_title();
    }
    if(!isset($args['subtitle'])) {
        $args['subtitle'] = get_field('page_banner_subtitle');
    }
    if(!isset($args['photo'])) {
        if(get_field('page_banner_background_image') AND !is_archive() AND !is_home() ) {
            $args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
        } else {
            $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
        }
    }
?>
    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo'] ?>);">

    </div>
    <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"><?php echo $args['title'] ?></h1>
        <div class="page-banner__intro">
            <p><?php echo $args['subtitle'] ?></p>
        </div>
    </div>
    </div>
    <?php
}

function university_files() {
    wp_enqueue_script('googleMap', '//maps.googleapis.com/maps/api/js?key=AIzaSyC4ezRI0c1L26K6NqL7QNUxxF23IUy0hfI', NULL, '1.0', true);
    wp_enqueue_script('main-university-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('university_main_styles', get_theme_file_uri('/build/style-index.css'));
    wp_enqueue_style('university_extra_styles', get_theme_file_uri('/build/index.css'));

    wp_localize_script('main-university-js', 'universityData', array(
        'root_url' => get_site_url(),
        'nonce' => wp_create_nonce('wp_rest')
    ));
}

function university_features() {
    register_nav_menu('headerMenuLocation', 'Header Menu Location');
    register_nav_menu('footerLocationOne', 'Footer Location One');
    register_nav_menu('footerLocationTwo', 'Footer Location Two');
    add_theme_support('title-tag');
    // Add featured images
    add_theme_support('post-thumbnails');
    // Custom image sizes(crop image as last argument)
    add_image_size('professorLandscape', 400, 260, true);
    add_image_size('professorPortrait', 480, 650, true);
    add_image_size('pageBanner', 1500, 650, true);
}

// Load CSS
add_action('wp_enqueue_scripts', 'university_files');

// Manipulate URL based queries -- pass query object as parameter
function university_adjust_queries($query) {
    if(!is_admin() AND is_post_type_archive('campus') AND is_main_query()) {
        $query->set('posts_per_page', -1);
    }
    // Only of specific query type, not on admin database, and not custom queries
    if(!is_admin() AND is_post_type_archive('program') AND is_main_query()) {
        $query->set('orderby', 'title');
        $query->set('order', 'ASC');
        $query->set('posts_per_page', -1);
    }
    if(!is_admin() AND is_post_type_archive('event') AND is_main_query()) {
        $today = date('Ymd');
        $query->set('meta_key', 'event_date');
        $query->set('orderby', 'meta_value_num');
        $query->set('order', 'ASC');
        $query->set('meta_query', array(
            array(
              'key' => 'event_date',
              'compare' => '>=',
              'value' => $today,
              'type' => 'numeric'
            )
            ));
    }
    
}

function universityMapKey($api) {
    $api['key'] = GOOGLE_MAPS_API;
    return $api;
}

add_action('after_setup_theme', 'university_features');
add_action('pre_get_posts', 'university_adjust_queries');

add_filter('acf/fields/google_map/api', 'universityMapKey');

// Redirect subscriber accounts out of admin and onto home page
add_action('admin_init', 'redirectSubsToFrontend');

function redirectSubsToFrontend() {
    $ourCurrentUser = wp_get_current_user();

    if(count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0] == 'subscriber') {
       wp_redirect(site_url('/'));
       exit; 
    }
}

// Remove admin bar for subscribers
add_action('wp_loaded', 'noSubsAdminBar');

function noSubsAdminBar() {
    $ourCurrentUser = wp_get_current_user();

    if(count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0] == 'subscriber') {
       show_admin_bar(false);
    }
}

// Customize Login Screen
add_filter('login_headerurl', 'ourHeaderUrl');

function ourHeaderUrl(){
    return esc_url(site_url('/'));
}

// Load theme's CSS
add_action('login_enqueue_scripts', 'ourLoginCSS');

function ourLoginCSS() {
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('university_main_styles', get_theme_file_uri('/build/style-index.css'));
    wp_enqueue_style('university_extra_styles', get_theme_file_uri('/build/index.css'));
}

add_filter('login_headertext', 'ourLoginTitle');

function ourLoginTitle() {
    return get_bloginfo('name');
}

// Force note posts to be private -- second array of data passed with the hook(contains post id)
add_filter('wp_insert_post_data', 'makeNotePrivate', 10, 2);

function makeNotePrivate($data, $postarr) {
    if($data['post_type'] == 'note') {
        if(count_user_posts(get_current_user_id(), 'note') > 4 AND !$postarr['ID']) {
            die("You have reached your notes limit.");
        }
        // Remove any HTML
        $data['post_content'] = sanitize_textarea_field($data['post_content']);
        $data['post_title'] = sanitize_text_field($data['post_title']);
    }
    if($data['post_type'] == 'note' AND $data['post_status'] != 'trash'){
        $data['post_status'] = "private";
    }
   return $data;
}