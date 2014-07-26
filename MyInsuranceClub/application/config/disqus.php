<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* Disqus configuration file.
*/

/*
|--------------------------------------------------------------------------
| Forum ID
|--------------------------------------------------------------------------
|
| ID of the forum
|
*/

$config['forum_id'] = 'mictest';


/*
|--------------------------------------------------------------------------
| Forum API Key
|--------------------------------------------------------------------------
|
| API Key for the forum
|
*/

$config['forum_api_key'] = 'sNBISJjGv2Z89HegloEf53Hxm36B7hVcPYGD3rud4KQfKb8wp2Oz7cpdpVwHD8cq';

/*
|--------------------------------------------------------------------------
| Forum Shortname
|--------------------------------------------------------------------------
|
| Shortname for the forum
|
*/

$config['forum_shortname'] = 'mictest';

/*
|--------------------------------------------------------------------------
| User API Key
|--------------------------------------------------------------------------
|
| API Key for the user (usually, a moderator for the forum)
|
*/

$config['user_api_key'] = 'aa8d1d13e8a043579a08373ad004e825';


/*
|--------------------------------------------------------------------------
| JS Params
|--------------------------------------------------------------------------
|
| These are the parameters set by the display method.  See: http://wiki.disqus.net/JSEmbed/
|
*/

$config['js_params'] = array(
		'disqus_developer' => '1',
		//'disqus_url' => current_url(),
		//'disqus_identifier' => 'disqus_thread',
		//'disqus_title' => '',
		//'disqus_message' => '',
		//'disqus_iframe_css' => '',
		//'disqus_container_id' => 'disqus_thread',
		//'disqus_def_email' => '',
		//'disqus_def_name' => ''
	);
