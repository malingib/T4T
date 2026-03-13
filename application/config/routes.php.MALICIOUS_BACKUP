<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| CLEAN VERSION - Obfuscated code removed
*/

$route['default_controller'] = 'welcome/index';
$route['404_override'] = 'welcome/show_404';
$route['translate_uri_dashes'] = FALSE;

// Frontend
$route['frontend'] = 'welcome';
$route['online_admission'] = 'welcome/admission';
$route['examresult'] = 'welcome/examresult';
$route['cbsexam'] = 'welcome/cbsexam';

// Admin
$route['admin/unauthorized'] = 'admin/admin/unauthorized';
$route['admin/resetpassword/(:any)'] = 'site/admin_resetpassword/$1';

// Student/User
$route['student/unauthorized'] = 'user/user/unauthorized';
$route['user/resetpassword/([a-z]+)/(:any)'] = 'site/resetpassword/$1/$2';

// Parent
$route['parent/unauthorized'] = 'parent/parents/unauthorized';

// Accountant
$route['accountant/unauthorized'] = 'accountant/accountant/unauthorized';

// Librarian
$route['librarian/unauthorized'] = 'librarian/librarian/unauthorized';

// Teacher
$route['teacher/unauthorized'] = 'teacher/teacher/unauthorized';

// Pages
$route['page/(:any)'] = 'welcome/page/$1';
$route['read/(:any)'] = 'welcome/read/$1';

// Cron
$route['cron/(:any)'] = 'cron/index/$1';
