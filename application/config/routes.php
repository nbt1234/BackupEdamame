<?php

defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = false;

// -----------------------------ADMIN---------------------------------------

// LOGIN
$route['admin'] = 'admin/Login';
$route['admin/login-verify'] = 'admin/Login/admin_login_verify';
$route['admin/logout'] = 'admin/Login/logout';
$route['admin/forget-password'] = 'admin/Login/forget_password';
$route['admin/forget-password/verify'] = 'admin/Login/verify_forget_password';
$route['admin/forget-otp'] = 'admin/Login/forget_password_otp';
$route['admin/forget-otp/verify'] = 'admin/Login/password_forget_otp_verify';
$route['admin/recover-password'] = 'admin/Login/password_recover';
$route['admin/verify-reset-password'] = 'admin/Login/admin_password_reset_verify';
$route['admin/resend-otp'] = 'admin/Login/admin_resend_otp';

$route['admin/dashboard'] = 'admin/Admin_home';
$route['admin/access-denied'] = 'admin/Login/denied_access';

$route['admin/edit-profile'] = 'admin/Login/edit_profile';
$route['admin/update-profile'] = 'admin/Login/update_profile';


// USERS

$route['admin/all-users'] = 'admin/Users/index';
$route['admin/edit-user/(:num)'] = 'admin/Users/user_edit/$1';
$route['admin/delete-user/(:num)'] = 'admin/Users/user_delete/$1';

$route['admin/change-user-status'] = 'admin/Users/change_status_user';


// REPORTED USERS

$route['admin/reported-users'] = 'admin/Users/reported';

// BLOCKED USERS

$route['admin/blocked-users'] = 'admin/Users/blocked_users';


// VIEW USER'S PROFILE

$route['admin/viewprofile/(:num)'] = 'admin/Users/viewprofile';

// INBOX USERS

$route['admin/inbox-users'] = 'admin/Users/inbox';


// UNDER REVIEW USERS

$route['admin/notifications'] = 'admin/Users/notifications';
$route['admin/send-notifications'] = 'admin/Users/send_notification';


// SUB ADMIN

// $route['admin/subadmin'] = 'admin/Subadmin/index';
// $route['admin/subadmin-page'] = 'admin/Subadmin/subadmin_page';
// $route['admin/add-subadmin'] = 'admin/Subadmin/insert_subadmin';
// $route['admin/edit-subadmin/(:num)'] = 'admin/Subadmin/subadmin_edit/$1';
// $route['admin/update-subadmin/(:num)'] = 'admin/Subadmin/subadmin_update/$1';
// $route['admin/delete-subadmin/(:num)'] = 'admin/Subadmin/subadmin_delete/$1';
// $route['admin/change-subadmin-status'] = 'admin/Subadmin/change_status_subadmin';
// $route['admin/subadmin-access/(:num)'] = 'admin/Subadmin/subadmin_access_ctrl/$1';
// $route['admin/subadmin-insert-access/(:num)'] = 'admin/Subadmin/insert_subadmin_access/$1';

// PAGES
// BANNER
$route['admin/pages/home-page-banner'] = 'admin/Pages/banner_home_page';
$route['admin/pages/add-home-page-banner'] = 'admin/Pages/insert_banner_home_page';
// SERVICES
$route['admin/pages/home-page-services'] = 'admin/Pages/services_home_page';
$route['admin/pages/add-home-page-services'] = 'admin/Pages/insert_services_home_page';
// CONTACT
$route['admin/pages/home-page-contact'] = 'admin/Pages/contacts_home_page';
$route['admin/pages/add-home-page-contact'] = 'admin/Pages/insert_contact_home_page';
// NEWSLETTER
$route['admin/pages/add-home-page-newsletter'] = 'admin/Pages/insert_newsletter_home_page';
// LINKS
$route['admin/pages/add-home-page-links'] = 'admin/Pages/insert_links_home_page';

// CATEGORY
$route['admin/pages/home-page-category'] = 'admin/Pages/category_home_page';
$route['admin/pages/add-home-page-category'] = 'admin/Pages/insert_category_home_page';

// TERMS AND CONDITIONS
$route['admin/other-pages/terms-conditions'] = 'admin/Other_Pages/terms_and_condition_home_page';
$route['admin/other-pages/add-terms-and-condition'] = 'admin/Other_Pages/insert_terms_and_condition_home_page';

//PRIVACY POLICY
$route['admin/other-pages/privacy-policy'] = 'admin/Other_Pages/privacy_policy_home_page';
$route['admin/other-pages/add-privacy-policy'] = 'admin/Other_Pages/privacy_policy_home_pag';

// RECIPE

//FAQ

$route['admin/faq'] = 'admin/faq/index';
$route['admin/faq/change-faq-status'] = 'admin/faq/change_faq_status';
$route['admin/faq-page'] = 'admin/Faq/faq_page';
$route['admin/add-faq'] = 'admin/Faq/insert_faq';
$route['admin/edit-faq/(:num)'] = 'admin/Faq/faq_edit/$1';
$route['admin/update-faq/(:num)'] = 'admin/Faq/faq_update/$1';
$route['admin/delete-faq/(:num)'] = 'admin/Faq/faq_delete/$1';

//SETTINGS


$route['admin/settings/email-setting'] = 'admin/settings/email_setting';
$route['admin/settings/email-smtp'] = 'admin/settings/email_smtp_insert';
$route['admin/settings/email-server'] = 'admin/settings/email_server_insert';

$route['admin/settings/payments'] = 'admin/settings/payment_settings_page';
$route['admin/settings/payment-status'] = 'admin/settings/payment_status';
$route['admin/settings/paypal-payment-mode'] = 'admin/settings/paypal_payment_mode';

// -------------------------------------API---------------------------------
$route['api/user-signup'] = 'api/User/user_signup'; //Done
$route['api/user-login-check'] = 'api/User/user_login_check'; //Done
$route['api/update-user-profile'] = 'api/User/update_user_profile';
$route['api/delete-user-profile-images'] = 'api/User/delete_user_profile_images'; //done
$route['api/update-user-profile-images'] = 'api/User/update_user_profile_images'; //done
$route['api/userNearByMe'] = 'api/User/userNearByMe'; //done
$route['api/user-report'] = 'api/User/user_report';//Done 
$route['api/my-matched-profile'] = 'api/User/my_matched_profile';  //done        // set match_profile = true
$route['api/mylikes'] = 'api/User/mylikes'; //done   ///i likes whom
$route['api/myLikesAndMatch'] = 'api/User/myLikesAndMatch'; //done 
$route['api/get-user-profile'] = 'api/User/get_user_profile'; //Done
$route['api/user-show-or-hide'] = 'api/User/user_show_or_hide';
$route['api/feedback'] = 'api/User/feedback'; //done
//$route['api/feedbackReview'] = 'api/User/feedbackReview'; //done
//$route['api/feedbackRating'] = 'api/User/feedbackRating'; //done
$route['api/feedbackRatingReview'] = 'api/User/feedbackRatingReview'; //done
$route['api/firstchat'] = 'api/User/firstchat';



$route['api/mymatch'] = 'api/User/myMatch';  // likes ,data of users who likes me



$route['api/user-login'] = 'api/User/user_login';

$route['api/delete-user-profile'] = 'api/User/delete_user_profile';



$route['api/my-friend-match'] = 'api/User/my_friend_match';//match=true, data of all friends 

$route['api/my-match-time-update'] = 'api/User/my_match_time_update'; //update time in like unlike table
$route['api/unmatch'] = 'api/User/unmatch'; //delete(block) data of both  from like _unlike table


$route['api/get-user-info'] = 'api/User/get_user_profile'; //Done

$route['api/match-now'] = 'api/User/match_now'; //


$route['api/send-notifications-user'] = 'api/User/send_notifications'; //



$route['api/forget-password'] = 'api/User/password_forget';
$route['api/forget-otp/verify'] = 'api/User/user_password_forget_otp_verify';
$route['api/verify-reset-password'] = 'api/User/user_password_reset_verify';
$route['api/resend-otp'] = 'api/User/user_resend_otp';

// PAGES

$route['api/home-page'] = 'api/Pages/home_page_data';
$route['api/faqs'] = 'api/Pages/get_faqs';
// $route['api/recipe-details'] = 'api/Pages/recipe_details_page';


// USER PROFILE

$route['api/save-profile'] = 'api/User_profile/update_user_profile';
$route['api/show-user-profile'] = 'api/User_profile/get_user_profile';
$route['api/change-password'] = 'api/User_profile/change_user_password';
$route['api/update-user-address'] = 'api/User_profile/update_user_address';
