<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Base Site URL
|--------------------------------------------------------------------------
|
| URL to your CodeIgniter root. Typically this will be your base URL,
| WITH a trailing slash:
|
|	http://example.com/
|
| If this is not set then CodeIgniter will guess the protocol, domain and
| path to your installation.
|
*/
$config['base_url']	= (isset($_SERVER['HTTPS']) ? "https://" : "http://") . $_SERVER['HTTP_HOST'] .'/'. ROOT;

/*
|--------------------------------------------------------------------------
| Index File
|--------------------------------------------------------------------------
|
| Typically this will be your index.php file, unless you've renamed it to
| something else. If you are using mod_rewrite to remove the page set this
| variable so that it is blank.
|
*/
$config['index_page'] = '';

/*
|--------------------------------------------------------------------------
| URI PROTOCOL
|--------------------------------------------------------------------------
|
| This item determines which server global should be used to retrieve the
| URI string.  The default setting of 'AUTO' works for most servers.
| If your links do not seem to work, try one of the other delicious flavors:
|
| 'AUTO'			Default - auto detects
| 'PATH_INFO'		Uses the PATH_INFO
| 'QUERY_STRING'	Uses the QUERY_STRING
| 'REQUEST_URI'		Uses the REQUEST_URI
| 'ORIG_PATH_INFO'	Uses the ORIG_PATH_INFO
|
*/
$config['uri_protocol']	= 'AUTO';

/*
|--------------------------------------------------------------------------
| URL suffix
|--------------------------------------------------------------------------
|
| This option allows you to add a suffix to all URLs generated by CodeIgniter.
| For more information please see the user guide:
|
| http://codeigniter.com/user_guide/general/urls.html
*/

$config['url_suffix'] = '';

/*
|--------------------------------------------------------------------------
| Default Language
|--------------------------------------------------------------------------
|
| This determines which set of language files should be used. Make sure
| there is an available translation if you intend to use something other
| than english.
|
*/
$config['language']	= 'english';

/*
|--------------------------------------------------------------------------
| Default Character Set
|--------------------------------------------------------------------------
|
| This determines which character set is used by default in various methods
| that require a character set to be provided.
|
*/
$config['charset'] = 'UTF-8';

/*
|--------------------------------------------------------------------------
| Enable/Disable System Hooks
|--------------------------------------------------------------------------
|
| If you would like to use the 'hooks' feature you must enable it by
| setting this variable to TRUE (boolean).  See the user guide for details.
|
*/
$config['enable_hooks'] = TRUE;


/*
|--------------------------------------------------------------------------
| Class Extension Prefix
|--------------------------------------------------------------------------
|
| This item allows you to set the filename/classname prefix when extending
| native libraries.  For more information please see the user guide:
|
| http://codeigniter.com/user_guide/general/core_classes.html
| http://codeigniter.com/user_guide/general/creating_libraries.html
|
*/
$config['subclass_prefix'] = 'MIC_';


/*
|--------------------------------------------------------------------------
| Allowed URL Characters
|--------------------------------------------------------------------------
|
| This lets you specify with a regular expression which characters are permitted
| within your URLs.  When someone tries to submit a URL with disallowed
| characters they will get a warning message.
|
| As a security measure you are STRONGLY encouraged to restrict URLs to
| as few characters as possible.  By default only these are allowed: a-z 0-9~%.:_-
|
| Leave blank to allow all characters -- but only if you are insane.
|
| DO NOT CHANGE THIS UNLESS YOU FULLY UNDERSTAND THE REPERCUSSIONS!!
|
*/
$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-';


/*
|--------------------------------------------------------------------------
| Enable Query Strings
|--------------------------------------------------------------------------
|
| By default CodeIgniter uses search-engine friendly segment based URLs:
| example.com/who/what/where/
|
| By default CodeIgniter enables access to the $_GET array.  If for some
| reason you would like to disable it, set 'allow_get_array' to FALSE.
|
| You can optionally enable standard query string based URLs:
| example.com?who=me&what=something&where=here
|
| Options are: TRUE or FALSE (boolean)
|
| The other items let you set the query string 'words' that will
| invoke your controllers and its functions:
| example.com/index.php?c=controller&m=function
|
| Please note that some of the helpers won't work as expected when
| this feature is enabled, since CodeIgniter is designed primarily to
| use segment based URLs.
|
*/
$config['allow_get_array']		= TRUE;
$config['enable_query_strings'] = FALSE;
$config['controller_trigger']	= 'c';
$config['function_trigger']		= 'm';
$config['directory_trigger']	= 'd'; // experimental not currently in use

/*
|--------------------------------------------------------------------------
| Error Logging Threshold
|--------------------------------------------------------------------------
|
| If you have enabled error logging, you can set an error threshold to
| determine what gets logged. Threshold options are:
| You can enable error logging by setting a threshold over zero. The
| threshold determines what gets logged. Threshold options are:
|
|	0 = Disables logging, Error logging TURNED OFF
|	1 = Error Messages (including PHP errors)
|	2 = Debug Messages
|	3 = Informational Messages
|	4 = All Messages
|
| For a live site you'll usually only enable Errors (1) to be logged otherwise
| your log files will fill up very fast.
|
*/
$config['log_threshold'] = 0;

/*
|--------------------------------------------------------------------------
| Error Logging Directory Path
|--------------------------------------------------------------------------
|
| Leave this BLANK unless you would like to set something other than the default
| application/logs/ folder. Use a full server path with trailing slash.
|
*/
$config['log_path'] = '';

/*
|--------------------------------------------------------------------------
| Date Format for Logs
|--------------------------------------------------------------------------
|
| Each item that is logged has an associated date. You can use PHP date
| codes to set your own date formatting
|
*/
$config['log_date_format'] = 'Y-m-d H:i:s';

/*
|--------------------------------------------------------------------------
| Cache Directory Path
|--------------------------------------------------------------------------
|
| Leave this BLANK unless you would like to set something other than the default
| system/cache/ folder.  Use a full server path with trailing slash.
|
*/
$config['cache_path'] = '';

/*
|--------------------------------------------------------------------------
| Encryption Key
|--------------------------------------------------------------------------
|
| If you use the Encryption class or the Session class you
| MUST set an encryption key.  See the user guide for info.
|
*/
$config['encryption_key'] = 'dev';

/*
|--------------------------------------------------------------------------
| Session Variables
|--------------------------------------------------------------------------
|
| 'sess_cookie_name'		= the name you want for the cookie
| 'sess_expiration'			= the number of SECONDS you want the session to last.
|   by default sessions last 7200 seconds (two hours).  Set to zero for no expiration.
| 'sess_expire_on_close'	= Whether to cause the session to expire automatically
|   when the browser window is closed
| 'sess_encrypt_cookie'		= Whether to encrypt the cookie
| 'sess_use_database'		= Whether to save the session data to a database
| 'sess_table_name'			= The name of the session database table
| 'sess_match_ip'			= Whether to match the user's IP address when reading the session data
| 'sess_match_useragent'	= Whether to match the User Agent when reading the session data
| 'sess_time_to_update'		= how many seconds between CI refreshing Session Information
|
*/
$config['sess_cookie_name']		= 'ci_session';
$config['sess_expiration']		= 72000;
$config['sess_expire_on_close']	= TRUE;
$config['sess_encrypt_cookie']	= FALSE;
$config['sess_use_database']	= TRUE;
$config['sess_table_name']		= 'ci_sessions';
$config['sess_match_ip']		= FALSE;
$config['sess_match_useragent']	= TRUE;
$config['sess_time_to_update']	= 72000;

/*
|--------------------------------------------------------------------------
| Cookie Related Variables
|--------------------------------------------------------------------------
|
| 'cookie_prefix' = Set a prefix if you need to avoid collisions
| 'cookie_domain' = Set to .your-domain.com for site-wide cookies
| 'cookie_path'   =  Typically will be a forward slash
| 'cookie_secure' =  Cookies will only be set if a secure HTTPS connection exists.
|
*/
$config['cookie_prefix']	= "";
$config['cookie_domain']	= "";
$config['cookie_path']		= "/";
$config['cookie_secure']	= FALSE;

/*
|--------------------------------------------------------------------------
| Global XSS Filtering
|--------------------------------------------------------------------------
|
| Determines whether the XSS filter is always active when GET, POST or
| COOKIE data is encountered
|
*/
$config['global_xss_filtering'] = FALSE;

/*
|--------------------------------------------------------------------------
| Cross Site Request Forgery
|--------------------------------------------------------------------------
| Enables a CSRF cookie token to be set. When set to TRUE, token will be
| checked on a submitted form. If you are accepting user data, it is strongly
| recommended CSRF protection be enabled.
|
| 'csrf_token_name' = The token name
| 'csrf_cookie_name' = The cookie name
| 'csrf_expire' = The number in seconds the token should expire.
*/
$config['csrf_protection'] = FALSE;
$config['csrf_token_name'] = 'csrf_test_name';
$config['csrf_cookie_name'] = 'csrf_cookie_name';
$config['csrf_expire'] = 7200;

/*
|--------------------------------------------------------------------------
| Output Compression
|--------------------------------------------------------------------------
|
| Enables Gzip output compression for faster page loads.  When enabled,
| the output class will test whether your server supports Gzip.
| Even if it does, however, not all browsers support compression
| so enable only if you are reasonably sure your visitors can handle it.
|
| VERY IMPORTANT:  If you are getting a blank page when compression is enabled it
| means you are prematurely outputting something to your browser. It could
| even be a line of whitespace at the end of one of your scripts.  For
| compression to work, nothing can be sent before the output buffer is called
| by the output class.  Do not 'echo' any values with compression enabled.
|
*/
$config['compress_output'] = FALSE;

/*
|--------------------------------------------------------------------------
| Master Time Reference
|--------------------------------------------------------------------------
|
| Options are 'local' or 'gmt'.  This pref tells the system whether to use
| your server's local time as the master 'now' reference, or convert it to
| GMT.  See the 'date helper' page of the user guide for information
| regarding date handling.
|
*/
$config['time_reference'] = 'local';


/*
|--------------------------------------------------------------------------
| Rewrite PHP Short Tags
|--------------------------------------------------------------------------
|
| If your PHP installation does not have short tag support enabled CI
| can rewrite the tags on-the-fly, enabling you to utilize that syntax
| in your view files.  Options are TRUE or FALSE (boolean)
|
*/
$config['rewrite_short_tags'] = FALSE;


/*
|--------------------------------------------------------------------------
| Reverse Proxy IPs
|--------------------------------------------------------------------------
|
| If your server is behind a reverse proxy, you must whitelist the proxy IP
| addresses from which CodeIgniter should trust the HTTP_X_FORWARDED_FOR
| header in order to properly identify the visitor's IP address.
| Comma-delimited, e.g. '10.0.1.200,10.0.1.201'
|
*/
$config['proxy_ips'] = '';



/*
|--------------------------------------------------------------------------
| Custom global declaration
|--------------------------------------------------------------------------
|
*/
$config['css_path'] 	= 	$config['base_url'].'application/views/css/';
$config['js_path'] 		= 	$config['base_url'].'application/views/js/';

//	pagination setting
$config['pagination']['per_page'] 			=	10;
$config['pagination']['currentPage'] 		=	'';
$config['pagination']['num_links'] 			=	1;
$config['pagination']['first_link'] 		= 	'First';
$config['pagination']['last_link'] 			= 	'Last';
$config['pagination']['display_pages'] 		= 	TRUE;
$config['pagination']['page_query_string'] 	= 	TRUE;
$config['pagination']['base_url'] 			= 	$_SERVER['PHP_SELF'];
$config['pagination']['cur_tag_open'] 		= 	'<a href="javascript:void(0);" class="btn btn-primary">';
$config['pagination']['cur_tag_close'] 		= 	'</a>';
$config['pagination']['show_goto']			=	TRUE;
$config['pagination']['full_tag_open'] 		=	'<div class="btn-group">';
$config['pagination']['full_tag_close'] 	=	'</div>'; 



//	upload url path
$config['url_path']['temp']			 				= $config['base_url'].'uploads/temp/';
$config['url_path']['company']['all'] 				= $config['base_url'].'uploads/company/';
$config['url_path']['company']['companyLogoUrlLarge']= $config['base_url'].'uploads/company/company_logo_1000x399.jpg';
$config['url_path']['company']['companyPageLogo'] 	= $config['base_url'].'uploads/company/company_page_172x68/';
$config['url_path']['company']['partnerLogo'] 		= $config['base_url'].'uploads/company/partner_logo_147x107/';
$config['url_path']['company']['searchResultLogo'] 	= $config['base_url'].'uploads/company/search_result_80x50/';
$config['url_path']['company']['companyLeadership'] = $config['base_url'].'uploads/company/company_leadership_160x160/';

$config['url_path']['policy']['all'] 				= $config['base_url'].'uploads/policy/';
$config['url_path']['policy']['policy_logo'] 		= $config['base_url'].'uploads/policy/logo/';
$config['url_path']['policy']['brochure'] 				= $config['base_url'].'uploads/policy/brochure/';
$config['url_path']['policy']['brochure_images'] 		= $config['base_url'].'uploads/policy/brochure/images/';
$config['url_path']['policy']['brochure_thumbnails'] 	= $config['base_url'].'uploads/policy/brochure/thumbnails_133x146/';
$config['url_path']['policy']['policy_wordings'] 				= $config['base_url'].'uploads/policy/policy_wordings/';
$config['url_path']['policy']['policy_wordings_images'] 		= $config['base_url'].'uploads/policy/policy_wordings/images/';
$config['url_path']['policy']['policy_wordings_thumbnails'] 	= $config['base_url'].'uploads/policy/policy_wordings/thumbnails_133x146/';

//	news
$config['url_path']['news']['all']							= $config['base_url'].'uploads/news/';
$config['url_path']['news']['original_image']				= $config['base_url'].'uploads/news/original_image/';
$config['url_path']['news']['main_image']					= $config['base_url'].'uploads/news/main_image_680x309/';
$config['url_path']['news']['listing_image']				= $config['base_url'].'uploads/news/listing_image_300x220/';
$config['url_path']['news']['thumbnail']					= $config['base_url'].'uploads/news/thumbnail_75x75/';

//	articles
$config['url_path']['articles']['all']							= $config['base_url'].'uploads/articles/';
$config['url_path']['articles']['original_image']				= $config['base_url'].'uploads/articles/original_image/';
$config['url_path']['articles']['main_image']					= $config['base_url'].'uploads/articles/main_image_680x309/';
$config['url_path']['articles']['listing_image']				= $config['base_url'].'uploads/articles/listing_image_300x220/';
$config['url_path']['articles']['thumbnail']					= $config['base_url'].'uploads/articles/thumbnail_75x75/';

//	guides
$config['url_path']['guides']['all']							= $config['base_url'].'uploads/guides/';
$config['url_path']['guides']['original_image']				= $config['base_url'].'uploads/guides/original_image/';
$config['url_path']['guides']['main_image']					= $config['base_url'].'uploads/guides/main_image_680x309/';
$config['url_path']['guides']['listing_image']				= $config['base_url'].'uploads/guides/listing_image_300x220/';
$config['url_path']['guides']['thumbnail']					= $config['base_url'].'uploads/guides/thumbnail_75x75/';

//	user image
$config['url_path']['users']['user_image']				= $config['base_url'].'uploads/users/user_image/';
$config['url_path']['users']['original']				= $config['base_url'].'uploads/users/original/';
$config['url_path']['users']['32x32']					= $config['base_url'].'uploads/users/32x32/';
$config['url_path']['users']['75x75']					= $config['base_url'].'uploads/users/75x75/';

//	upload folder paths
$config['folder_path']['temp']			 				= realpath(APPPATH . '../uploads').'/temp/';
$config['folder_path']['company']['all'] 				= realpath(APPPATH . '../uploads').'/company/';
$config['folder_path']['company']['companyLogoUrlLarge']= realpath(APPPATH . '../uploads').'/company/company_logo_1000x399.png';
$config['folder_path']['company']['companyPageLogo'] 	= realpath(APPPATH . '../uploads').'/company/company_page_172x68/';
$config['folder_path']['company']['partnerLogo'] 		= realpath(APPPATH . '../uploads').'/company/partner_logo_147x107/';
$config['folder_path']['company']['searchResultLogo'] 	= realpath(APPPATH . '../uploads').'/company/search_result_80x50/';
$config['folder_path']['company']['companyLeadership'] 	= realpath(APPPATH . '../uploads').'/company/company_leadership_160x160/';

$config['folder_path']['policy']['all'] 						= realpath(APPPATH . '../uploads').'/policy/';
$config['folder_path']['policy']['policy_logo'] 				= realpath(APPPATH . '../uploads').'/policy/logo/';
$config['folder_path']['policy']['brochure'] 					= realpath(APPPATH . '../uploads').'/policy/brochure/';
$config['folder_path']['policy']['brochure_images'] 			= realpath(APPPATH . '../uploads').'/policy/brochure/images/';
$config['folder_path']['policy']['brochure_thumbnails'] 		= realpath(APPPATH . '../uploads').'/policy/brochure/thumbnails_133x146/';
$config['folder_path']['policy']['policy_wordings'] 			= realpath(APPPATH . '../uploads').'/policy/policy_wordings/';
$config['folder_path']['policy']['policy_wordings_images'] 		= realpath(APPPATH . '../uploads').'/policy/policy_wordings/images/';
$config['folder_path']['policy']['policy_wordings_thumbnails'] 	= realpath(APPPATH . '../uploads').'/policy/policy_wordings/thumbnails_133x146/';

//	news
$config['folder_path']['news']['all']						= realpath(APPPATH . '../uploads').'/news/';
$config['folder_path']['news']['original_image']			= realpath(APPPATH . '../uploads').'/news/original_image/';
$config['folder_path']['news']['main_image']				= realpath(APPPATH . '../uploads').'/news/main_image_680x309/';
$config['folder_path']['news']['listing_image']				= realpath(APPPATH . '../uploads').'/news/listing_image_300x220/';
$config['folder_path']['news']['thumbnail']					= realpath(APPPATH . '../uploads').'/news/thumbnail_75x75/';

//	articles
$config['folder_path']['articles']['all']						= realpath(APPPATH . '../uploads').'/articles/';
$config['folder_path']['articles']['original_image']			= realpath(APPPATH . '../uploads').'/articles/original_image/';
$config['folder_path']['articles']['main_image']				= realpath(APPPATH . '../uploads').'/articles/main_image_680x309/';
$config['folder_path']['articles']['listing_image']				= realpath(APPPATH . '../uploads').'/articles/listing_image_300x220/';
$config['folder_path']['articles']['thumbnail']					= realpath(APPPATH . '../uploads').'/articles/thumbnail_75x75/';

//	guides
$config['folder_path']['guides']['all']						= realpath(APPPATH . '../uploads').'/guides/';
$config['folder_path']['guides']['original_image']			= realpath(APPPATH . '../uploads').'/guides/original_image/';
$config['folder_path']['guides']['main_image']				= realpath(APPPATH . '../uploads').'/guides/main_image_680x309/';
$config['folder_path']['guides']['listing_image']				= realpath(APPPATH . '../uploads').'/guides/listing_image_300x220/';
$config['folder_path']['guides']['thumbnail']					= realpath(APPPATH . '../uploads').'/guides/thumbnail_75x75/';

//	user image
$config['folder_path']['users']['user_image']				= realpath(APPPATH . '../uploads').'/users/user_image/';
$config['folder_path']['users']['original']					= realpath(APPPATH . '../uploads').'/users/original/';
$config['folder_path']['users']['32x32']					= realpath(APPPATH . '../uploads').'/users/32x32/';
$config['folder_path']['users']['75x75']					= realpath(APPPATH . '../uploads').'/users/75x75/';


$config['policy']['descriptionCount'] = 1;
$config['policy']['keyFeatures'] = 4;


//	disquslib comments parameters
$config['disquslib']['disqus_shortname'] 		= 	'mictest';
$config['disquslib']['disqus_developer'] 		= 	1; //	make it 0 in live environment
$config['disquslib']['disqus_identifier'] 		= 	'';
$config['disquslib']['disqus_title'] 			= 	'';
$config['disquslib']['disqus_url'] 			= 	'';
$config['disquslib']['disqus_category_id'] 	= 	'';
$config['disquslib']['disqus_disable_mobile'] 	= 	"true";
$config['disquslib']['forum_id'] 				= 	'mictest';
$config['disquslib']['forum_api_key'] 			= 	'o1cY06myeoZqQiUoQnhpUiSWkkh0oFInLDRPgtjffNZ9T9sx0MH2wXSPBEphPYl2';
$config['disquslib']['forum_secret_key'] 		= 	'3WkS3xWCdjSU3XmE0CEnStD01NQClutdLdYM5IA3sh0ah14VZnyraoLFCr4HHtfr';
$config['disquslib']['user_api_key'] 			= 	'7ae528ff353c4c53a93f3b3217122c51';
$config['disquslib']['access_token'] 			= 	'7ae528ff353c4c53a93f3b3217122c51';


/*
 * Autoloads all the extended base controllers
| -------------------------------------------------------------------
|  Native Auto-load
| -------------------------------------------------------------------
| 
| Nothing to do with config/autoload.php, this allows PHP autoload to work
| for base controllers and some third-party libraries.
|
*/

function __autoload($class)
{
	if(strpos($class, 'CI_') !== 0)
	{
		@include_once( APPPATH . 'core/'. $class . EXT );
	}
}

/* End of file config.php */
/* Location: ./application/config/config.php */
