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

//admin product leads
$route['admin/health-leads'] = "admin/controller_ProductLeads/index";
$route['admin/critical-illness-leads'] = "admin/controller_ProductLeads/critical_illness";
$route['admin/term-insurance-leads'] = "admin/controller_ProductLeads/term_plans";

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

//personal accident routes
$route['personal-accident'] = "personal_accident/controller_personal_accident/index";
$route['personal-accident/search-results'] = "personal_accident/controller_personal_accident/health_policy";
$route['personal-accident/compare-results'] = "personal_accident/controller_personal_accident/compare_policies";
$route['personal-accident/search-results/(:any)'] = "personal_accident/controller_personal_accident/health_policy/$1";
$route['personal-accident/(:any)'] = "personal_accident/controller_personal_accident/policyView/$1";

//term plan routes
$route['life-insurance/term-insurance'] = "life_insurance/controller_termPlan/index";
$route['life-insurance/term-insurance/search-results'] = "life_insurance/controller_termPlan/get_termPlan_results";
$route['life-insurance/term-insurance/search-results/(:any)'] = "life_insurance/controller_termPlan/get_termPlan_results/$1";
$route['life-insurance/term-insurance/compare-results'] = "life_insurance/controller_termPlan/compare_policies";

//ulip plan routes
$route['life-insurance/ulip'] = "life_insurance/controller_ulipPlan/index";

//endowment plan routes
$route['life-insurance/endowment-insurance'] = "life_insurance/controller_endowmentPlan/index";

//money-back-policy plan routes
$route['life-insurance/money-back-policy'] = "life_insurance/controller_money_back_policyPlan/index";

//child-plans  routes
$route['life-insurance/child-plans'] = "life_insurance/controller_childPlan/index";

//endowment plan routes
$route['life-insurance/pension-plan'] = "life_insurance/controller_pensionPlan/index";



//travel insurance
$route['travel-insurance'] = "travel/controller_travel/index";
$route['travel-insurance/search-results/(:any)'] = "travel/controller_travel/get_travel_insurance_search_results/$1";
$route['travel-insurance/search-results'] = "travel/controller_travel/get_travel_insurance_search_results";
$route['travel-insurance/compare-results'] = "travel/controller_travel/compare_policies";
$route['travel-insurance/increment-count'] = "travel/controller_travel/increment_count";
$route['travel-insurance/(:any)'] = "travel/controller_travel/policyView/$1";

//car insurance
$route['car-insurance'] = "car/controller_car/index";

//two_wheeler insurance
$route['two-wheeler-insurance'] = "two_wheeler/controller_two_wheeler/index";

//	company 
$route['life-insurance'] = "lifeInsurance/index/";
$route['life-insurance/companies'] = "lifeInsurance/companies/";
$route['life-insurance/companies/(:any)'] = "lifeInsurance/companies/$1";
$route['general-insurance-companies'] = "generalInsurance/companies/";
$route['general-insurance-companies/(:any)'] = "generalInsurance/companies/$1";

//news
$route['news'] = "news/index/";
$route['news/(:any)/(:any)'] = "news/newsByCategory/$1/$2";
$route['news/(:any)'] = "news/newsDetails/$1";

//articles
$route['articles'] = "articles/index/";
$route['articles/(:any)/(:any)'] = "articles/articlesByCategory/$1/$2";
$route['articles/(:any)'] = "articles/articlesDetails/$1";

//guides
$route['guides'] = "guides/index/";
$route['guides/(:any)/(:any)'] = "guides/guidesByCategory/$1/$2";
$route['guides/(:any)'] = "guides/guidesDetails/$1";


//Static Pages
$route['aboutus'] = "static_pages/controller_static_pages/index";
$route['team'] = "static_pages/controller_static_pages/team";
$route['contact'] = "static_pages/controller_static_pages/contact";
$route['ask-expert'] = "static_pages/controller_static_pages/ask_expert";
$route['terms-and-conditions'] = "static_pages/controller_static_pages/terms";
$route['feedback'] = "static_pages/controller_static_pages/feedback";




#########################	frontend routes ends	##############################

/* End of file routes.php */
/* Location: ./application/config/routes.php */