<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_public extends Admin_Controller {
 
    function __construct() 
    {
        parent::__construct();
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// flexi auth demo
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * Many of the functions within this controller load a custom model called 'demo_auth_model' that has been created for the purposes of this demo.
	 * The 'demo_auth_model' file is not part of the flexi auth library, it is included to demonstrate how some of the functions of flexi auth can be used.
	 *
	 * These demos show working examples of how to implement some (most) of the functions available from the flexi auth library.
	 * This particular controller 'auth_public', is used by users who have logged in and now wish to manage their account settings
	 * 
	 * All demos are to be used as exactly that, a demonstation of what the library can do.
	 * In a few cases, some of the examples may not be considered as 'Best practice' at implementing some features in a live environment.
	*/
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// Dashboard
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * index
	 * Forwards to the public dashboard.
	 */ 
	function index()
	{
		redirect('admin/auth_public/dashboard');
	}
 
 	/**
 	 * dashboard (Public)
 	 * The public account dashboard page that acts as the landing page for newly logged in public users.
 	 * The dashboard provides links to some examples of the features available from the flexi auth library.  
 	 */
	function dashboard()
	{
		// Get any status message that may have been set.
		$this->data['message'] = $this->session->flashdata('message');
		
		$this->template->write_view('content', 'admin/admin_profile/dashboard_view', $this->data, TRUE);
		$this->template->render();
		//$this->load->view('demo/public_examples/dashboard_view', $this->data);
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// Public Account Management
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

 	/**
 	 * update_account
 	 * Manage and update the account details of a logged in public user.
 	 */
	function update_account()
	{
		// If 'Update Account' form has been submitted, update the user account details.
		if ($this->input->post('update_account')) 
		{
			$this->load->model('demo_auth_model');
			$this->demo_auth_model->update_account();
		}
		
		// Get users current data.
		// This example does so via 'get_user_by_identity()', however, 'get_users()' using any other unqiue identifying column and value could also be used.
		$this->data['user'] = $this->flexi_auth->get_user_by_identity_row_array();

		// Set any returned status/error messages.
		$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];		

		$this->template->write_view('content', 'admin/admin_profile/account_update_view', $this->data, TRUE);
		$this->template->render();
		//$this->load->view('demo/public_examples/account_update_view', $this->data);
	}

 	/**
 	 * change_password
 	 * Manually update the logged in public users password, by submitting the current and new password.
 	 * This example requires that the length of the password must be between 8 and 20 characters, containing only alpha-numerics plus the following 
 	 * characters: periods (.), commas (,), hyphens (-), underscores (_) and spaces ( ). These customisable validation settings are defined via the auth config file.
 	 */
	function change_password()
	{
		// If 'Update Password' form has been submitted, validate and then update the users password.
		if ($this->input->post('change_password'))
		{
			$this->load->model('demo_auth_model');
			$this->demo_auth_model->change_password();
		}
				
		// Set any returned status/error messages.
		$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
		
		
		$this->template->write_view('content', 'admin/admin_profile/password_update_view', $this->data, TRUE);
		$this->template->render();
		//$this->load->view('demo/public_examples/password_update_view', $this->data);
	}

 	/**
 	 * update_email
 	 * Update the current logged in users email address via sending a verification email.
 	 * This example with send a verification email to the users newly entered email address, once they click a link within that email, their account will be
 	 * updated with the new email address. 
 	 * The purpose of verification via email ensures that a user enters their correct email address. If they were to unknowingly mispell the address, the next time
 	 * they tried to login to site, their email address would no longer be recognised, and they would then be completely locked out of their account.
 	 */
	function update_email($user_id = FALSE, $token = FALSE)
	{
		$this->load->model('demo_auth_model');

		// If 'Update Email' form has been submitted, send a verification email to the submitted email address.
		if ($this->input->post('update_email'))
		{
			$this->demo_auth_model->send_new_email_activation();
		}
		// Else if page has been accessed via a link set in the verification email, then validate the activation token and update the email address.
		else if (is_numeric($user_id) && strlen($token) == 40) // 40 characters = Email Activation Token length.
		{
			$this->demo_auth_model->verify_updated_email($user_id, $token);
		}

		// In this demo, the 'update_email' page is the only page in this controller that can be accessed without needing to be logged in.
		// This is because, some users may validate their change of email address at a later time, or from a different device that they are not logged in on.
		// Therefore, check that the user is logged in before granting them access to the 'update_email' page.
		if ($this->flexi_auth->is_logged_in())
		{
			// Set any returned status/error messages.
			$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
			
			
		$this->template->write_view('content', 'admin/admin_profile/email_update_view', $this->data, TRUE);
		$this->template->render();
		//$this->load->view('demo/public_examples/email_update_view', $this->data);
		}
		else
		{
			redirect('admin/admin/login');
		}
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// Manage Address Book
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

 	/**
 	 * manage_address_book
 	 * Manage and update the address book of the logged in public user.
 	 * This page is simply an example of using the auth library to save miscellaneous user details to the database and then linking them to the auth user profile.
 	 */
	function manage_address_book()
	{
		// If 'Address Book' form has been submitted, then delete any checkbox checked address details.
		if ($this->input->post('update_addresses')) 
		{
			$this->load->model('demo_auth_model');
			$this->demo_auth_model->manage_address_book();
		}

		// Get user id from session.
		$user_id = $this->flexi_auth->get_user_id();
		
		// Select address book data to be displayed, whilst filtering by addresses that match the user.
		$sql_select = array('uadd_id', 'uadd_alias', 'uadd_recipient', 'uadd_company', 'uadd_post_code');
		$sql_where = array('uadd_uacc_fk' => $user_id);
		// Note: The third argument is set as FALSE so that the query is not grouped by the user id - which would prevent multiple addresses being returned.
		$this->data['addresses'] = $this->flexi_auth->get_custom_user_data_array($sql_select, $sql_where, FALSE);
	
		// Set any returned status/error messages.
		$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
		
		$this->template->write_view('content', 'admin/admin_profile/address_view', $this->data, TRUE);
		$this->template->render();
		//$this->load->view('demo/public_examples/address_view', $this->data);		
	}
	
 	/**
 	 * insert_address
 	 * Insert a new address to the logged in public users address book.
 	 * This page is simply an example of using the auth library to save miscellaneous user details to the database and then linking them to the auth user profile.
 	 */
	function insert_address()
	{
		// If 'Add Address' form has been submitted, then insert the new address details to the logged in users address book.
		if ($this->input->post('insert_address')) 
		{		
			$this->load->model('demo_auth_model');
			$this->demo_auth_model->insert_address();
		}
				
		// Set any returned status/error messages.
		$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
		
		
		$this->template->write_view('content', 'admin/admin_profile/address_insert_view', $this->data, TRUE);
		$this->template->render();
		//$this->load->view('demo/public_examples/address_insert_view', $this->data);		
	}

 	/**
 	 * update_address
 	 * Update an existing address from the logged in public users address book.
 	 * This page is simply an example of using the auth library to save miscellaneous user details to the database and then linking them to the auth user profile.
 	 */
	function update_address($address_id = FALSE)
	{
		// Check the url parameter is a valid address id, else redirect to the dashboard.
		if (! is_numeric($address_id))
		{
			redirect('auth_public/dashboard');
		}
		// If 'Update Address' form has been submitted, then update the address details.
		else if ($this->input->post('update_address')) 
		{			
			$this->load->model('demo_auth_model');
			$this->demo_auth_model->update_address($address_id);
		}
		
		// Get user id from session to use in the update function as a primary key.
		$user_id = $this->flexi_auth->get_user_id();
		$sql_where = array('uadd_id' => $address_id, 'uadd_uacc_fk' => $user_id);
		$this->data['address'] = $this->flexi_auth->get_users_row_array(FALSE, $sql_where);
		
		// Set any returned status/error messages.
		$this->data['message'] = (! isset($this->data['message'])) ? $this->session->flashdata('message') : $this->data['message'];
		
		
		$this->template->write_view('content', 'admin/admin_profile/address_update_view', $this->data, TRUE);
		$this->template->render();
		//$this->load->view('demo/public_examples/address_update_view', $this->data);		
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// Logout
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * logout
	 * This example logs the user out of all sessions on all computers they may be logged into.
	 * In this demo, this page is accessed via a link on the demo header once a user is logged in.
	 */
	function logout() 
	{
		// By setting the logout functions argument as 'TRUE', all browser sessions are logged out.
		$this->flexi_auth->logout(TRUE);
		
		// Set a message to the CI flashdata so that it is available after the page redirect.
		$this->session->set_flashdata('message', $this->flexi_auth->get_messages());		
 
		redirect('admin/auth');
    }
	
	/**
	 * logout_session
	 * This example logs the user only out of their CURRENT browser session (e.g. Internet Cafe), but no other logged in sessions (e.g. Home and Work).
	 * In this demo, this controller method is actually not linked to. It is included here as an example of logging a user out of only their current session.
	 */
	function logout_session() 
	{
		// By setting the logout functions argument as 'FALSE', only the current browser session is logged out.
		$this->flexi_auth->logout(FALSE);

		// Set a message to the CI flashdata so that it is available after the page redirect.
		$this->session->set_flashdata('message', $this->flexi_auth->get_messages());		
        
		redirect('admin/auth');
    }	
}
	
/* End of file auth_public.php */
/* Location: ./application/controllers/auth_public.php */	
