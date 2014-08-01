<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DisqusLib {
	
	public $disConfig;
	public $disDBConfig;
	
	public function getConfig()
	{
		$CI =& get_instance();
		$this->disConfig = $CI->config->config['disqus'];
		$this->disConfig['disqus_url'] = current_url();
		return $this->disConfig;
	}
	
	public function getDBConfig()
	{
		$db =& get_instance();
		$this->disDBConfig['hostname'] = $this->db->hostname;
		$this->disDBConfig['username'] = $this->db->username;
		$this->disDBConfig['password'] = $this->db->password;
		$this->disDBConfig['database'] = $this->db->database;
		return $this->disDBConfig;
	}
	
	public function displayDisqus($arrParams = array())
	{
		$config = DisqusLib::getConfig();	
        // Validate config items
        if (!in_array($config['disqus_developer'], array(0,1)) || strlen($config['disqus_shortname']) == 0) {
            return "Disqus config items not setup correctly, please check library config settings";
        }
        $jsParams = '';   
        foreach ($config as $k1=>$v1)
        {
        	if (!in_array($k1, array('forum_id','forum_api_key','forum_secret_key','user_api_key','access_token')))
        	{
        		if (isset($arrParams[$k1]) && !empty($arrParams[$k1]))
        			$jsParams .= 'var '.$k1.' = "'.$arrParams[$k1].'";';
        		else if (!empty($v1))
        			$jsParams .= 'var '.$k1.' = "'.$v1.'";';
        	}
        }
//var_dump($config, $jsParams);die;     
        return  "<div id='disqus_thread'></div>
                <script type='text/javascript'>".$jsParams."

                    /* * * DON'T EDIT BELOW THIS LINE * * */
                    (function() {
                        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                        dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
                        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                    })();
                </script>
                <noscript>Please enable JavaScript to view the <a href='http://disqus.com/?ref_noscript'>comments powered by Disqus.</a></noscript>
                <a href='http://disqus.com' class='dsq-brlink'>Loading comments</a>";
	}
	
	
	public function listcomments($endpoint = null,$cursor = 0,$j=0) 
	{
		$config = DisqusLib::getConfig();	
		$apikey = $config['forum_api_key']; // get keys at http://disqus.com/api/ — can be public or secret for this endpoint
		$shortname = $config['forum_shortname']; // defined in the var disqus_shortname = '...';
		$thread = 'link:'.$config['disqus_url']; // IMPORTANT the URL that you're viewing isn't necessarily the one stored with the thread of comments
		//$thread = 'ident:<identifier of thread>'; Use this if 'link:' has no results. Defined in 'var disqus_identifier = '...';
		$limit = '100'; // max is 100 for this endpoint. 25 is default

		$endpoint = 'https://disqus.com/api/3.0/threads/listPosts.json?api_key='.$apikey.'&forum='.$shortname.'&limit='.$limit.'&cursor='.$cursor.'&thread='.$thread;
//var_dump($endpoint);
	//	$j=0;
	//	listcomments($endpoint,$cursor,$j);
		$url = "https://disqus.com/api/3.0/forums/listPosts.json?forum=mictest";
		// Standard CURL
	//	$session = curl_init($endpoint.$cursor);
		$session = curl_init($url);
		curl_setopt($session, CURLOPT_RETURNTRANSFER, 1); // instead of just returning true on success, return the result on success
		$data = curl_exec($session);
		curl_close($session);

		// Decode JSON data
		$results = json_decode($data);
//var_dump($results);die;		
		if ($results === NULL) die('Error parsing json');

		// Comment response
		$comments = $results->response;

		// Cursor for pagination
		$cursor = $results->cursor;

		$i=0;
		foreach ($comments as $comment) {
			$name = $comment->author->name;
			$comment = $comment->message;
			$created = $comment->createdAt;
			// Get more data...

			echo "<p>".$name." wrote:<br/>";
			echo $comment."<br/>";
			echo $created."</p>";
			$i++;
		}

		// cursor through until today
		if ($i == 100) {
			$cursor = $cursor->next;
			$i = 0;
			listcomments($endpoint,$cursor);
			/* uncomment to only run $j number of iterations
			 $j++;
			 if ($j < 10) {
			 listcomments($endpoint,$cursor,$j);
			 }*/
		}
	}
	
	
	
}

// END Util class

/* End of file Util.php */
/* Location: ./application/libraries/Util.php */