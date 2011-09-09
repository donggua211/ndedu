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
		$this->load->model('CRM_Staff_model');
		$this->load->helper('admin');
		
		//加载权限控制类
		$this->load->library('admin_ac/Admin_Ac_Admin', array('group_id' => $this->staff_info['group_id']));
	}
	
	/* 用户登录 */
	function login()
	{
		// 如果已经登录, 就跳转到admin首页
		if (has_login())
		{
			redirect("admin");
		}
		
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			$username = $this->input->post("username");
			$password = $this->input->post("password");
			
			if($username == FAlSE || $password == FAlSE)
			{
				$data_header['meta_title'] = '用户登录';
				$data['notification'] = '用户名或者密码不能为空';
				
				$this->load->view('admin/header', $data_header);
				$this->load->view('admin/login', $data);
				$this->load->view('admin/footer');
			}
			else
			{
				$staff_info = $this->CRM_Staff_model->login(array('username'=>$username, 'password'=>$password));
				
				/* 
					登录成功, 设置session: staff_id, group_id. 然后跳转至admin首页
				*/
				if (!empty($staff_info))
				{
					$session_data = array('staff_id' => $staff_info['staff_id'], 'group_id'=>$staff_info['group_id'], 'branch_id'=>$staff_info['branch_id'], 'username'=>$staff_info['username']);
					$this->session->set_userdata($session_data);
					redirect('admin');
				}
				else
				{
					$data_header['meta_title'] = '用户登录';
					$data['notification'] = '用户名或者密码错误';
					
					$this->load->view('admin/header', $data_header);
					$this->load->view('admin/login', $data);
					$this->load->view('admin/footer');
				}
			}
		}
		else
		{
			$data['meta_title'] = '用户登录';
			$this->load->view('admin/header', $data);
			$this->load->view('admin/login');
			$this->load->view('admin/footer');
		}
	}
	
	function logout()
	{
		$this->session->sess_destroy();
		redirect('admin/admin/login');
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */