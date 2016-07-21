<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Artist extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(array('url','language'));

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->load->helper('form');
		$this->lang->load('auth');
		
	}

	// redirect if needed, otherwise display the user list
	function index()
	{
		$this->data['title'] = $this->lang->line('create_user_heading');

       /*  if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }
 */
        $tables = $this->config->item('tables','ion_auth');
        $identity_column = $this->config->item('identity','ion_auth');
        $this->data['identity_column'] = $identity_column;

        // validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required');
        $this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required');
        if($identity_column!=='email')
        {
            $this->form_validation->set_rules('identity',$this->lang->line('create_user_validation_identity_label'),'required|is_unique['.$tables['users'].'.'.$identity_column.']');
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');
        }
        else
        {
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
        }
      
        $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']');
      $this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|trim|matches[password]');

        if ($this->form_validation->run() == true)
        {
            $email    = strtolower($this->input->post('email'));
            $identity = ($identity_column==='email') ? $email : $this->input->post('identity');
            $password = $this->input->post('password');
			$username    = strtolower($this->input->post('email'));
            $additional_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name'  => $this->input->post('last_name'),
				'username'  => $email,
            );
			$group_id = $this->input->post('group_id'); 
			$group_ids = array($group_id);
        }
        if ($this->form_validation->run() == true && $artistID = $this->ion_auth->register($identity, $password, $email, $additional_data,$group_ids))
        {
				$this->load->library('email'); 
				$from_email = "sndtrack@sndtrack.com"; 
				$to_email = $this->input->post('email'); 
				 $this->email->from($from_email, 'sndtrack'); 
				 $this->email->to($to_email);
				 $this->email->subject('Sndtrack Registarion'); 
				 $this->email->message('Thanks for registration. Your login details are: username: '.$to_email.'  And Password: '.$password.''); 
					$this->email->send();
					$ID			=	$this->ion_auth->user()->row()->user_id; 
			$relationData = array('admin_id'	=>  $ID , 'artist_id'=> $artistID);
			$this-> db->insert('snd_admin_artist_group', $relationData);
            // check to see if we are creating the user
            // redirect them back to the admin page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("administrator/accounts", 'refresh');
        }
        else
        {
            // display the create user form
            // set the flash data error message if there is one
            $this->data['message'] = ($this->session->flashdata('message'));

            $this->data['first_name'] = array(
                'name'  => 'first_name',
                'id'    => 'first_name',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('first_name'),
            );
            $this->data['last_name'] = array(
                'name'  => 'last_name',
                'id'    => 'last_name',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('last_name'),
            );
            $this->data['identity'] = array(
                'name'  => 'identity',
                'id'    => 'identity',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('identity'),
            );
            $this->data['email'] = array(
                'name'  => 'email',
                'id'    => 'email',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('email'),
            );
           
           
            $this->data['password'] = array(
                'name'  => 'password',
                'id'    => 'password',
                'type'  => 'password',
                'value' => $this->form_validation->set_value('password'),
            );
           
				$adminID			=	$this->ion_auth->user()->row()->user_id; 
				$groupID 			= 	$this->ion_auth->get_users_groups($adminID)->row()->id;
					if($groupID==1){
						 $this->_render_page('administrator/superadmin/add_artist_view', $this->data);
					}if($groupID==2){
						$this->_render_page('administrator/admin/add_artist_view', $this->data);
					}
           
        }
		
	}

	

	function _render_page($view, $data=null, $returnhtml=false)//I think this makes more sense
	{

		$this->viewdata = (empty($data)) ? $this->data: $data;

		$view_html = $this->load->view($view, $this->viewdata, $returnhtml);

		if ($returnhtml) return $view_html;//This will return html on 3rd argument being true
	}

}
