<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get('/', 'Home::index');

//$routes->get('/', 'Home::index');
$routes->post('/user_subscribe', 'Home::user_subscribe');


$routes->group('admin', static function ($routes) {

    $routes->get('/', 'Admin\Login::index');
    $routes->post('login_action', 'Admin\Login::login_action');
    $routes->get('logout', 'Admin\Login::logout');
    $routes->get('dashboard', 'Admin\Dashboard::index');

    //Album
    $routes->get('album', 'Admin\Album::index');
    $routes->get('album_create', 'Admin\Album::create');
    $routes->post('album_create_action', 'Admin\Album::create_action');
    $routes->post('album_update_action', 'Admin\Album::update_action');
    $routes->get('album_update/(:num)', 'Admin\Album::update/$1');
    $routes->get('album_delete/(:num)', 'Admin\Album::delete/$1');
    $routes->post('album_image_sort_action', 'Admin\Album::album_image_sort_action');
    $routes->post('album_image_delete', 'Admin\Album::image_delete');

    
    //User
    $routes->get('user', 'Admin\User::index');
    $routes->get('user_create', 'Admin\User::create');
    $routes->post('user_create_action', 'Admin\User::create_action');
    $routes->post('user_update_action', 'Admin\User::update_action');
    $routes->post('user_general_action', 'Admin\User::general_action');
    $routes->post('user_image_action', 'Admin\User::image_action');
    $routes->get('user_update/(:num)', 'Admin\User::update/$1');
    $routes->get('user_delete/(:num)', 'Admin\User::delete/$1');
    
    //Role
    $routes->get('role', 'Admin\Role::index');
    $routes->get('role_create', 'Admin\Role::create');
    $routes->post('role_create_action', 'Admin\Role::create_action');
    $routes->post('role_update_action', 'Admin\Role::update_action');
    $routes->get('role_update/(:num)', 'Admin\Role::update/$1');
    $routes->get('role_delete/(:num)', 'Admin\Role::delete/$1');
    

    
    //Settings
    $routes->get('settings', 'Admin\Settings::index');
    $routes->post('settings_update_action', 'Admin\Settings::update_action');
    


    //Ajax
    $routes->get('page_list', 'Admin\Page_settings::index');
    $routes->get('page_create', 'Admin\Page_settings::create');
    $routes->get('page_update/(:num)', 'Admin\Page_settings::update/$1');
    $routes->get('page_delete/(:num)', 'Admin\Page_settings::delete/$1');
    $routes->post('page_create_action', 'Admin\Page_settings::create_action');
    $routes->post('page_update_action', 'Admin\Page_settings::update_action');

    
    //Module
    $routes->get('module', 'Admin\Module::index');
    $routes->post('module_update_action', 'Admin\Module::update_action');
    $routes->post('module_update', 'Admin\Ajax::module_update');
    $routes->get('module_settings/(:num)', 'Admin\Module::module_settings/$1');
    $routes->post('module_settings_action', 'Admin\Module::module_settings_action');
    
    //newsletter
    $routes->get('newsletter', 'Admin\Newsletter::index');

    
    //Theme Settings
    $routes->get('theme_settings', 'Admin\Theme_settings::index');
    $routes->post('slider_update', 'Admin\Theme_settings::slider_update');
    $routes->post('logo_update', 'Admin\Theme_settings::logo_update');
    $routes->post('home_category', 'Admin\Theme_settings::home_category');
    $routes->post('home_category_banner', 'Admin\Theme_settings::home_category_banner');
    $routes->post('settings_update', 'Admin\Theme_settings::settings_update');
    $routes->post('home_special_banner', 'Admin\Theme_settings::home_special_banner');
    $routes->post('home_left_side_banner', 'Admin\Theme_settings::home_left_side_banner');
    $routes->post('favicon_update', 'Admin\Theme_settings::favicon_update');
    
    
    $routes->post('header_section_one_update', 'Admin\Theme_settings_3::header_section_one_update');
    $routes->post('header_section_two_update', 'Admin\Theme_settings_3::header_section_two_update');
    $routes->post('home_category_update', 'Admin\Theme_settings_3::home_category_update');
    $routes->post('banner_bottom_update', 'Admin\Theme_settings_3::banner_bottom_update');

    
    //Email_send
    $routes->get('email_send', 'Admin\Email_send::index');
    $routes->post('email_send_action', 'Admin\Email_send::email_send_action');
    //notice
    $routes->get('notice', 'Admin\Notice::index');
    $routes->get('notice_create', 'Admin\Notice::create');
    $routes->get('notice_update/(:num)', 'Admin\Notice::update/$1');
    $routes->get('notice_delete/(:num)', 'Admin\Notice::delete/$1');
    $routes->post('notice_create_action', 'Admin\Notice::create_action');
    $routes->post('notice_update_action', 'Admin\Notice::update_action');

    //Post
    $routes->get('post', 'Admin\Post::index');
    $routes->get('post_create', 'Admin\Post::create');
    $routes->post('post_create_action', 'Admin\Post::create_action');
    $routes->post('post_update_action', 'Admin\Post::update_action');
    $routes->get('post_update/(:num)', 'Admin\Post::update/$1');
    $routes->get('post_delete/(:num)', 'Admin\Post::delete/$1');


    //Product_category
    $routes->get('news_category', 'Admin\News_category::index');
    $routes->get('news_category_create', 'Admin\News_category::create');
    $routes->post('news_category_create_action', 'Admin\News_category::create_action');
    $routes->post('news_category_update_action', 'Admin\News_category::update_action');
    $routes->post('news_category_update_action_others', 'Admin\News_category::update_action_others');
    $routes->get('news_category_update/(:num)', 'Admin\News_category::update/$1');
    $routes->get('news_category_delete/(:num)', 'Admin\News_category::delete/$1');
    $routes->post('news_category_sort_update_action', 'Admin\News_category::sort_update_action');

    //Comments
    $routes->get('comments', 'Admin\Comments::index');



});



//login routes
$routes->get('/register', 'Login::register');
$routes->get('/login', 'Login::index');
$routes->post('/login_action', 'Login::login_action');
$routes->post('/register_action', 'Login::register_action');
$routes->get('/logout', 'Login::logout');
$routes->get('/forgotpassword', 'Login::forgotPassword');
$routes->post('/password_action', 'Login::password_action');
$routes->get('/otp_submit', 'Login::otp_submit');
$routes->post('/otp_action', 'Login::otp_action');
$routes->get('/password_reset', 'Login::password_reset');
$routes->post('/reset_action', 'Login::reset_action');



//pages routes
$routes->get('/about', 'Pages\Pages::about');
$routes->get('/contact', 'Pages\Pages::contact');
$routes->post('/contact_form_action', 'Pages\Pages::contact_action');
$routes->get('/page/(:any)', 'Pages\Pages::page/$1');

$routes->get('gallery_detail/(:num)', 'Gallery::detail/$1');

//ajax controller
$routes->post('get_state', 'Admin\Ajax::get_state');
$routes->post('get_zone_value', 'Admin\Ajax::get_zone_value');

$routes->get('/(:any)', 'Category::index/$1');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}