<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(array('url','language'));

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->load->helper('form');
		$this->lang->load('auth');
		if ($this->ion_auth->logged_in()){
				redirect('artist/artist_dashboard');
			}
	}		

	// redirect if needed, otherwise display the user list
	function index()
	{
		$this->data['title'] = $this->lang->line('login_heading');

		//validate form input
		$this->form_validation->set_rules('identity', str_replace(':', '', $this->lang->line('login_identity_label')), 'required');
		$this->form_validation->set_rules('password', str_replace(':', '', $this->lang->line('login_password_label')), 'required');

		if ($this->form_validation->run() == true)
		{
			// check to see if the user is logging in
			// check for "remember me"
			$remember = (bool) $this->input->post('remember');

			if ($getuserId 	=	$this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
			{
				 $adminID			=	$this->ion_auth->user()->row()->user_id; 
				 $groupID 			= 	$this->ion_auth->get_users_groups($adminID)->row()->id; 
				 //if the login is successful
				 if($groupID==1){
					 $this->session->set_flashdata('message', $this->ion_auth->messages());
						redirect('administrator/dashboard', 'refresh');
				}elseif($groupID==2){
					$this->session->set_flashdata('message', $this->ion_auth->messages());
					redirect('administrator/dashboard', 'refresh');
				}elseif($groupID==3){
					$this->session->set_flashdata('message', $this->ion_auth->messages());
					redirect('artist/dashboard', 'refresh');
				}elseif($groupID==4){
					$this->session->set_flashdata('message', $this->ion_auth->messages());
					redirect('artist/dashboard', 'refresh');
				}else{
					$logout = $this->ion_auth->logout();
					redirect('login', 'refresh');
				}
		
			}
			else
			{
				// if the login was un-successful
				// redirect them back to the login page
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('login', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
			}
		}
		else
		{
			// the user is not logging in so display the login page
			// set the flash data error message if there is one
			$this->data['message'] = $this->session->flashdata('message');

			$this->data['identity'] = array('name' => 'identity',
				'id'    => 'identity',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('identity'),
			);
			$this->data['password'] = array('name' => 'password',
				'id'   => 'password',
				'type' => 'password',
			);

			$this->_render_page('pages/login_view', $this->data);
		}
		
	}

	function logout()
	{
		$this->data['title'] = "Logout";

		// log the user out
		$logout = $this->ion_auth->logout();

		// redirect them to the login page
		$this->session->set_flashdata('message', $this->ion_auth->messages());
		redirect('login', 'refresh');
	}

	function _render_page($view, $data=null, $returnhtml=false)//I think this makes more sense
	{

		$this->viewdata = (empty($data)) ? $this->data: $data;

		$view_html = $this->load->view($view, $this->viewdata, $returnhtml);

		if ($returnhtml) return $view_html;//This will return html on 3rd argument being true
	}

}
	