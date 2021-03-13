<?php 

require get_theme_file_path('/includes/search-route.php');
require get_theme_file_path('/includes/like-route.php');

function university_custom_rest(){
    // add new properties to the json data
    register_rest_field('post', 'authorName', array(
        'get_callback' => function() {return get_the_author();}
    ));
    register_rest_field('note', 'userNoteCount', array(
        'get_callback' => function() {return count_user_posts(get_current_user_id(), 'note');}
    ));
}
add_action('rest_api_init', 'university_custom_rest');

function pageBanner($args = NULL){
    // php logic will live here
    if (!$args['title']) {
        $args['title'] = get_the_title();
    }
    if (!$args['subtitle']){
        $args['subtitle'] = get_field('page_banner_subtitle');
    }
    if(!$args['photo']){
        if(get_field('page_banner_background_image')AND !is_archive() AND !is_home()){
            $args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
        } else {
            $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
        }
    }
    ?>
    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo']; ?>);">
        </div>
        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title"><?php echo $args['title']; ?></h1>
            <div class="page-banner__intro">
                <p><?php echo $args['subtitle']; ?></p>
            </div>
        </div>  
    </div>
<?php }

    function university_files(){
        wp_enqueue_style('custom-google-fonts', "https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i");
        wp_enqueue_style('font-awesome', "https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");
        wp_enqueue_script('googleMap', '//maps.googleapis.com/maps/api/js?key=AIzaSyBgCFaNt-7JRb6z6x-0zg019kxfIJ-S0L8', NULL, '1.0', true);

        if(strstr($_SERVER['SERVER_NAME'], 'localhost')) {
            wp_enqueue_script('main-university-js', 'http://localhost:3000/bundled.js', NULL, '1,0', true);
        } else {
            wp_enqueue_script('our-vendors-js', get_theme_file_uri('/bundled-assets/vendors~scripts.07cb7586e2052fd66bd1.js'), NULL, '1,0', true);
            wp_enqueue_script('main-university-js', get_theme_file_uri('/bundled-assets/scripts.7b4153e5cde98cf57c0a.js'), NULL, '1,0', true);
            wp_enqueue_style('our-main-styles', get_theme_file_uri('/bundled-assets/styles.7b4153e5cde98cf57c0a.css'));
        }
        wp_localize_script('main-university-js', 'universityData', array(
            'root_url' => get_site_url(),
            'nonce' => wp_create_nonce('wp_rest')
        ));
    }
    add_action('wp_enqueue_scripts', 'university_files');

    function university_features(){
        // register_nav_menu('headerMenuLocation', 'Header Menu Location');
        // register_nav_menu('footerExploreLocation', 'Footer Explore Menu Location');
        // register_nav_menu('footerLearnLocation', 'Footer Learn Menu Location');
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_image_size('professorLandscape', 400, 260, true);
        add_image_size('professorPortrait', 480, 650, true);
        add_image_size('pageBanner', 1500, 350, true);
    }
    add_action('after_setup_theme', 'university_features');

    function university_adjust_queries($query){
        if(!is_admin() AND is_post_type_archive('campus') AND is_main_query()){
            $query->set('posts_per_page', -1);
        }

        if(!is_admin() AND is_post_type_archive('program') AND is_main_query()){
            $query->set('orderby', 'title');
            $query->set('order', 'ASC');
            $query->set('posts_per_page', -1);
        }

        if (!is_admin() AND is_post_type_archive('event') AND is_main_query()){
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
    add_action('pre_get_posts', 'university_adjust_queries');

    function universityMapKey($api){
        $api['key'] = 'AIzaSyBgCFaNt-7JRb6z6x-0zg019kxfIJ-S0L8';
        return $api;
    }

    add_filter('acf/fields/google_map/api', 'universityMapKey');

    // redirect subscriber accounts on homepage

    function redirectSubsToFrontEnd(){
        $ourCurrentUser = wp_get_current_user();
        if( count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0] == 'subscriber'){
            wp_redirect(site_url('/'));
            exit();
        }
    }
    add_action('admin_init', 'redirectSubsToFrontEnd');

    // hide the admin bar

    function noSubsAdminBar(){
        $ourCurrentUser = wp_get_current_user();
        if( count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0] == 'subscriber'){
            show_admin_bar(false);
        }
    }
    add_action('wp_loaded', 'noSubsAdminBar');

    // customize login screen
    function ourHeaderUrl(){
        return esc_url(site_url('/'));
    }
    add_filter('login_headerurl', 'ourHeaderUrl');

    // redirect the CSS for login page
    function ourLoginCSS(){
        wp_enqueue_style('our-main-styles', get_theme_file_uri('/bundled-assets/styles.7b4153e5cde98cf57c0a.css'));
        wp_enqueue_style('custom-google-fonts', "https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i");

    }
    add_action('login_enqueue_scripts', 'ourLoginCSS');


    
    function ourLoginText(){
        return get_bloginfo('name');
    }
    add_filter('login_headertext', 'ourLoginText');

    // Force Note posts to be private

    function makeNotePrivate($data, $postarr){
        if($data['post_type'] == 'note'){
            if(count_user_posts(get_current_user_id(), 'note') > 4 AND !$postarr['ID']){
                die("You have reached your note limit");
            }

            $data['post_content'] = sanitize_textarea_field($data['post_content']);
            $data['post_title'] = sanitize_text_field($data['post_title']);
        }
        if($data['post_type'] == 'note' AND $data['post_status'] != 'trash'){
            $data['post_status'] = 'private';
        }
        return $data;
    }
// 10 is priority of functions 
    add_filter('wp_insert_post_data', 'makeNotePrivate', 10, 2);


    //  exclude files from deploying with the "All-in-One Wp Migration" plugin
    add_filter('ai1wm_exclude_content_from_export', 'ignoreCertainFiles');

    function ignoreCertainFiles($exlude_filters){
        $exlude_filters[] = 'themes/fictional-university-theme/node_modules';
        return $exlude_filters;
    }
?>