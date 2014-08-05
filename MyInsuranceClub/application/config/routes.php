<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "home";
$route['404_override'] = '';

/*
 * custom routes
 */		

#########################	Admin routes start	##############################
//auth/login
$route['admin'] = "admin/auth";
$route['admin/register'] = "admin/auth/register_account";
$route['admin/auth/register'] = "admin/auth/register_account";
$route['admin/forgotten_password'] = "admin/auth/forgotten_password";
$route['admin/resend_activation_token'] = "admin/auth/resend_activation_token";
$route['admin/logout'] = "admin/auth_public/logout";
$route['admin/dashboard'] = "admin/auth_public/dashboard";

//admin company
$route['admin/company'] = "admin/company/index";
$route['admin/company/(:any)'] = "admin/company/$1";

#########################	Admin routes ends	##############################



#########################	frontend routes start	##############################
//critical illness
$route['critical-illness'] = "health_insurance/controller_criticalIllness/index";
$route['critical-illness/search-results'] = "health_insurance/controller_criticalIllness/get_critical_illness_results";
$route['critical-illness/search-results/(:any)'] = "health_insurance/controller_criticalIllness/get_critical_illness_results/$1";
$route['critical-illness/compare-results'] = "health_insurance/controller_criticalIllness/compare_policies";

//mediclaim routes
$route['health-insurance'] = "health_insurance/controller_basicMediclaim/index";
$route['health-insurance/search-results'] = "health_insurance/controller_basicMediclaim/health_policy";
$route['health-insurance/compare-results'] = "health_insurance/controller_basicMediclaim/compare_policies";
$route['health-insurance/search-results/(:any)'] = "health_insurance/controller_basicMediclaim/health_policy/$1";
$route['health-insurance/(:any)'] = "health_insurance/controller_basicMediclaim/policyView/$1";

//term plan routes
$route['life-insurance/term-insurance'] = "life_insurance/controller_termPlan/index";
$route['life-insurance/term-insurance/search-results'] = "life_insurance/controller_termPlan/get_termPlan_results";
$route['life-insurance/term-insurance/search-results/(:any)'] = "life_insurance/controller_termPlan/get_termPlan_results/$1";
$route['life-insurance/term-insurance/compare-results'] = "life_insurance/controller_termPlan/compare_policies";

//	company 
$route['life-insurance'] = "lifeInsurance/index/";
$route['life-insurance/companies'] = "lifeInsurance/companies/";
$route['life-insurance/companies/(:any)'] = "lifeInsurance/companies/$1";
$route['general-insurance-companies'] = "generalInsurance/companies/";
$route['general-insurance-companies/(:any)'] = "generalInsurance/companies/$1";

//news
$route['news'] = "news/index/";

#########################	frontend routes ends	##############################

/* End of file routes.php */
/* Location: ./application/config/routes.php */