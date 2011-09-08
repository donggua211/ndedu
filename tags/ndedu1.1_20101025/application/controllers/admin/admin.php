<?php

class Admin extends Controller {

	function Admin()
	{
		parent::Controller();
		$this->load->library('session');
		$this->load->model('Options_model');
		$this->load->helper('language');
	}
	
	function login()
	{
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			if ($this->session->userdata("adminuser")) 
			{
				redirect("admin/");
			}
			
			$admin_user_name = $this->input->post("username");
			$admin_password = $this->input->post("password");
			
			if($admin_user_name == FAlSE || $admin_password == FAlSE)
			{
				$data['notification'] = 'username_password_empty';
				$this->load->view('admin/login', $data);
			}
			else
			{
				$options = $this->Options_model->getOptions(array('admin_username', 'admin_password'));
				
				if ($admin_user_name == $options['admin_username'] && md5($admin_password) == $options['admin_password'])
				{
					//$query = $query->row_array();
					$session_data = array('adminuser'=>$admin_user_name);
					$this->session->set_userdata($session_data);
					redirect('admin/');
				}
				else
				{
					$data['notification'] = 'username_password_wrong';
					$this->load->view('admin/login', $data);
				}
			}
		}
		else
		{
			$this->load->view('admin/login');
		}
	}
	
	function logout()
	{
		$this->session->sess_destroy();
		redirect('admin/admin/login');
	}
	
	function editPwd()
	{
		if (!$this->session->userdata("adminuser"))
		{
			redirect("admin/admin/login");
		}
		
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			$admin_password = $this->input->post("old");
			$new_password = $this->input->post("password");
			$new_password2 = $this->input->post("password2");
			
			$options = $this->Options_model->getOptions(array('admin_username', 'admin_password'));
				
			if($admin_password == FAlSE || $new_password == FAlSE || $new_password == FAlSE)
			{
				$data['notification'] = 'password_empty';
				$this->load->view('admin/edit_password', $data);
			}
			elseif (md5($admin_password) != $options['admin_password'])
			{
				$data['notification'] = 'password_wrong';
				$this->load->view('admin/edit_password', $data);
				
			}
			elseif($new_password != $new_password2)
			{
				$data['notification'] = 'passwords_not_match';
				$this->load->view('admin/edit_password', $data);
			}
			else
			{
				$this->Options_model->updateOption('admin_password', md5($new_password));
				
				$data['notification'] = 'passwords_changed';
				$data['page'] = 'admin/entry/info';
				$this->load->view('admin/result', $data);
			}

		}
		else
		{
			$this->load->view('admin/edit_password');
		}
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */