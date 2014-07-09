<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron extends CI_Controller {
 
    function __construct() 
    {
        parent::__construct();
		// Load required CI libraries and helpers.
		$this->load->database();
		$this->load->library('session');
        $this->load->library('curl');
        $this->load->library('util');
        $this->load->library('DisqusLib');
        $this->load->model('disqus_comments_model');
 		
		// Note: This is only included to create base urls for purposes of this demo only and are not necessarily considered as 'Best practice'.
		$this->load->vars('base_url', base_url());
		$this->load->vars('includes_dir', base_url().'/includes/');
		$this->load->vars('current_url', $this->uri->uri_to_assoc(1));
		
		// Define a global variable to store data that is then used by the end view page.
		$this->data = null;
	}

	
	
	
	/*
	 * Copy Disqus comments to a local database via their API. It does not go back and update
	 * comments that have already been copied locally.
	 *
	 * Will fetch all new comments and threads since it was last run.
	 *
	 * You must use our forked version of the Disqus API (https://github.com/dbmedialab/disqus-php)
	 * for this script to work (provides cursor access which is missing from disqus/disqus-php).
	 *
	 * Schedule script to run daily via your local scheduling program.
	 *
	 * Read the README file for more information.
	 *
	 *
	 * @copyright Aller Internett AS (dev@aller.no)
	 * @author    JustAdam
	 * @package   disqus-comment-sync
	 * @version   0.1.1
	 * @license   GPL v3
	 *
	 */
	public function getCommentsFromDisqus()
	{
		$config = DisqusLib::getConfig();
		$dbConfig = DisqusLib::getDBConfig();		
		// Max. of 100
		$fetch_limit = 100;
		// asc or desc
		$fetch_order = 'asc';
		// API key to use when quering the API
		$disqus_api_key = $config['forum_secret_key'];
		// List of forum short names as listed at Disqus
		$forum_shortnames = array($config['disqus_shortname']);

		$db_connect = 'mysql:host='.$dbConfig['hostname'].';port=3306;dbname='.$dbConfig['database'];
		$db_user = $dbConfig['username'];
		$db_pass = $dbConfig['password'];

		// Local location to our Disqus API fork .. (https://github.com/dbmedialab/disqus-php)
		require_once('disqusapi/disqusapi.php');


		$dbh = new PDO($db_connect, $db_user, $db_pass);
		// We run two queries; one to fetch Disqus forum threads, and one to fetch the comments.
		// We need to be able to link each comment to an article (or thread), and this information is
		// not available in the API's comment response (when using you own identifiers).  These processes
		// are not tied together (or dependant upon each other), so it is in theory possible to have
		// comments backed up without any parent thread.
		$threads = $dbh->prepare("insert into disqus_threads (id, identifiers, forum, created,feed,category,clean_title,slug,isClosed,posts,userSubscription,link,likes,title,isDeleted,sublink,controller,module,action,link_slug,link_params) values (:id, :identifiers, :forum, :created,:feed,:category,:clean_title,:slug,:isClosed,:posts,:userSubscription,:link,:likes,:title,:isDeleted,:sublink,:controller,:module,:action,:link_slug,:link_params)");
		$comments = $dbh->prepare("insert into disqus_comments (forum, isApproved,author_name,author_url,avatar_url,author_email,author_id,author_our_id,isAnonymous,raw_message,message,thread_id,comment_id,parent_comment_id, created,isSpam,isDeleted, isEdited, likes,username, profileUrl,joinedAt,media,isFlagged,dislikes,isHighlighted,points,numReports, lat, lng,ipAddress)
  									values (:forum,:isApproved,:author_name,:author_url,:avatar_url,:author_email,:author_id,:author_our_id,:isAnonymous,:raw_message,:message,:thread_id,:comment_id,:parent_comment_id,:created,:isSpam,:isDeleted,:isEdited,:likes,:username,:profileUrl,:joinedAt,:media,:isFlagged,:dislikes,:isHighlighted,:points,:numReports,:lat,:lng,:ipAddress)");
		
		


		try {
			$disqus = new DisqusAPI($disqus_api_key, 'json', '3.0');

			foreach ($forum_shortnames as $forum) {
				//
				// Back up forum threads ... these are needed to reference back each comment to an article ID
				//
				// Arguments to send to Disqus > http://disqus.com/api/docs/threads/list/, http://disqus.com/api/docs/posts/list/
				// We will also send since and cursor, but these are added later as needed.
				$params = array('forum' => $forum, 'order' =>  $fetch_order, 'limit' => $fetch_limit);

				// Get the latest comment date downloaded so we request only comments made since then
				$res = $dbh->query("select max(created) as max from disqus_threads where forum = '$forum'")->fetch();
				
				if (!empty($res['max'])) {
					$params['since'] = $res['max'];
				}

				do {
					$posts = $disqus->threads->list($params);

					// Create cursor to paginate through resultset
					$cursor = $posts['cursor'];

					// Update our arguments with the cursor and the next position
					$params['cursor'] = $cursor->next;
					
					foreach ($posts['response'] as $post) {
						$link = array_filter(explode('/', $post->link));
						$base_url = array_filter(explode('/', base_url()));
						$diff = array_values(array_diff($link, $base_url));
						$sublink = implode('/', $diff);
						$threads->bindValue(':id', $post->id);
						$threads->bindValue(':identifiers', @$post->identifiers[0]);
						$threads->bindValue(':forum', $forum);
						$threads->bindValue(':created', Util::getDate($post->createdAt, 3));
						$threads->bindValue(':feed', $post->feed);
						$threads->bindValue(':category', $post->category);
						$threads->bindValue(':clean_title', $post->clean_title);
						$threads->bindValue(':slug', $post->slug);
						$threads->bindValue(':isClosed', $post->isClosed);
						$threads->bindValue(':posts', $post->posts);
						$threads->bindValue(':userSubscription', $post->userSubscription);
						$threads->bindValue(':link', $post->link);
						$threads->bindValue(':likes', $post->likes);
						$threads->bindValue(':title', $post->title);
						$threads->bindValue(':isDeleted', $post->isDeleted);	
						$threads->bindValue(':sublink', $sublink);					
						$threads->bindValue(':module', isset($diff[0]) ? $diff[0] : '');
						$threads->bindValue(':controller', isset($diff[1]) ? $diff[1] : '');
						$threads->bindValue(':action', isset($diff[2]) ? $diff[2] : '');
						$threads->bindValue(':link_slug', isset($diff[3]) ? $diff[3] : '');
						$threads->bindValue(':link_params', isset($diff[4]) ? $diff[4] : '');						
						$threads->execute();
					}
				} while ($cursor->more);
				// End forum threads

				//
				// Now fetch the actual comments ..
				//
				// Reset the "changeable" paramaters being sent to Disqus.
				unset($params['since']);
				unset($params['cursor']);
				unset($res);			
				$res = $dbh->query("select max(created) as max from disqus_comments where forum = '$forum'")->fetch();
				if (!empty($res['max'])) {
					$params['since'] = $res['max'];
				}
			//	$arrInsertCols = array('forum','isApproved', 'raw_message','ip_address','thread', 'id','parent','isSpam','isDeleted','isEdited','likes', 'createdAt','isFlagged','dislikes','isHighlighted','points', 'numReports','message');
			//	$arrInsertAuthorCols = array('name', 'url', 'email', 'id', 'isAnonymous', 'username','profileUrl','joinedAt');
				do {
					$posts = $disqus->posts->list($params);
					$cursor = $posts['cursor'];
					$params['cursor'] = $cursor->next;
					foreach ($posts['response'] as $post) {
						$media = '';
						if (!empty($post->media))
						{
							foreach ($post->media as $k1=>$v1)
							{
								$media[] = $v1->url;
							}
							$media = serialize($media);
						}
						$comments->bindValue(':forum', $forum);
						$comments->bindValue(':isApproved', $post->isApproved);
						$comments->bindValue(':author_name', $post->author->name);
						$comments->bindValue(':author_url', $post->author->url);
						$comments->bindValue(':avatar_url', @$post->author->avatar->permalink);
						$comments->bindValue(':author_email', isset($post->author->email) ? $post->author->email : '');
						$comments->bindValue(':author_id', isset($post->author->id) ? $post->author->id : '');
						$comments->bindValue(':author_our_id', isset($post->author->remote->identifier) ? $post->author->remote->identifier : ''); //@$post->author->remote->identifier);
						
						$comments->bindValue(':isAnonymous', $post->author->isAnonymous);
						$comments->bindValue(':raw_message', $post->raw_message);
						$comments->bindValue(':message', $post->message);	
						$comments->bindValue(':thread_id', $post->thread);
						$comments->bindValue(':comment_id', $post->id);
						$comments->bindValue(':parent_comment_id', $post->parent);
						$comments->bindValue(':created', Util::getDate($post->createdAt, 3));
						
						$comments->bindValue(':isSpam', $post->isSpam);
						$comments->bindValue(':isDeleted', $post->isDeleted);
						$comments->bindValue(':isEdited', $post->isEdited);
						$comments->bindValue(':likes', $post->likes);
						$comments->bindValue(':username', $post->author->username);
						$comments->bindValue(':profileUrl', $post->author->profileUrl);
						$comments->bindValue(':joinedAt', Util::getDate($post->author->joinedAt, 3));
						$comments->bindValue(':media', $media);
						
						$comments->bindValue(':isFlagged', $post->isFlagged);
						$comments->bindValue(':dislikes', $post->dislikes);
						$comments->bindValue(':isHighlighted', $post->isHighlighted);
						$comments->bindValue(':points', $post->points);
						$comments->bindValue(':numReports', $post->numReports);	
						
						$comments->bindValue(':ipAddress', $post->ipAddress);
						$comments->bindValue(':lat', $post->approxLoc->lat);
						$comments->bindValue(':lng', $post->approxLoc->lng);	
						
						$comments->execute();
					}
				} while ($cursor->more);
			}
			return true;
		} catch (DisqusAPIError $e) {
			echo $e->getMessage();
			echo PHP_EOL;
			return false;
			exit();
		}
	}
	
}

/* End of file auth_lite.php */
/* Location: ./application/controllers/auth_lite.php */