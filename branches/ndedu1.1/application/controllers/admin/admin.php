<?php
/* 
  用户登录, 退出等功能.
  公共权限
 */
class Admin extends Controller {

	function Admin()
	{
		parent::Controller();
		$this->load->library('session');
		$this->load->model('Employee_model');
		$this->load->helper('admin_authority');
		$this->load->helper('language');
	}
	
	function login()
	{
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			// 如果已经登录, 就跳转到admin首页
			if (has_login())
			{
				redirect("admin/");
			}
			
			$user = $this->input->post("username");
			$password = $this->input->post("password");
			
			if($user == FAlSE || $password == FAlSE)
			{
				$data['notification'] = '用户名或者密码不能为空';
				$this->load->view('admin/login', $data);
			}
			else
			{
				$employee_info = $this->Employee_model->login(array('username'=>$user, 'password'=>$password));
				/* 
					登录成功, 设置session: name, group_id. 然后跳转至admin首页
				*/
				if (!empty($employee_info))
				{
					$session_data = array('employee_id' => $employee_info['employee_id'], 'name'=>$employee_info['name'], 'group_id'=>$employee_info['group_id']);
					$this->session->set_userdata($session_data);
					redirect('admin/');
				}
				else
				{
					$data['notification'] = '用户名或者密码错误';
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
	
	/*
	TODO: 把该方法单拎出来. >> profile.class
	function editPwd()
	{
		if (!$this->session->userdata("adminuser"))
		{
			goto_login();
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
	*/
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */