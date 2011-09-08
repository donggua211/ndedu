<?php
/* 
  班主任管理模块
  admin权限.
 */
class Employee extends Controller {

	function Employee()
	{
		parent::Controller();
		$this->load->library('session');
		$this->load->model('Employee_model');
		$this->load->helper('admin_authority');
		
		$this->allowed_group = array(1);
		
		//如果没有经登录, 就跳转到admin/login登陆页
		if (!has_login())
		{
			goto_login();
		}
		
		//检查权限.
		if(!check_role($this->allowed_group))
		{
			show_access_deny_page();
		}
		
		//$this->output->enable_profiler(TRUE);
	}
	
	function index()
	{
		$employees = $this->Employee_model->getAll();
		$data['employees'] = $employees;
		$this->load->view('admin/employee_index', $data);
	}
	
	function add()
	{
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			//必填信息.
			$employee['name'] = $this->input->post('name');
			$employee['password'] = $this->input->post('password');
			$employee['password2'] = $this->input->post('password2');
			$employee['group'] = $this->input->post('group');
			$employee['active'] = $this->input->post('active');
			
			if( $employee['name'] == FAlSE || $employee['password'] == FAlSE || $employee['password2'] == FAlSE || $employee['group'] == FAlSE || $employee['active'] == FAlSE)
			{
				$data['groups'] = $this->Employee_model->getGroups();
				$data['notification'] = '请填写完整的员工信息';
				$data['employee'] = $employee;
				$this->load->view('admin/employee_add', $data);
			}
			elseif( $employee['password'] != $employee['password2'] )
			{
				$data['groups'] = $this->Employee_model->getGroups();
				$data['notification'] = '两次密码输入不一致! 请重新输入';
				$data['employee'] = $employee;
				$this->load->view('admin/employee_add', $data);
			}
			else
			{
				//add into DB
				$employee_id = $this->Employee_model->add($employee);
				if( $employee_id !== FALSE)
				{
					$data['page'] = 'admin/employee';
					$this->load->view('admin/result', $data);
				}
				else
				{
					$data['groups'] = $this->Employee_model->getGroups();
					$data['notification'] = '添加失败, 请重试.';
					$data['student'] = $new_student;
					$this->load->view('admin/student_add', $data);
				}
			}
		}
		else
		{
			$data['groups'] = $this->Employee_model->getGroups();
			$this->load->view('admin/employee_add', $data);	
		}
	}
	
	function edit()
	{
		$data['employee_id'] = $this->input->post('employee_id');
		if(!$data['employee_id'])
		{
			$data['notification'] = '您访问的页面不合法.';
			$data['page'] = 'admin/student';
			$this->load->view('admin/error', $data);
			return;
		}
		
		if(isset($_POST['action']) && ($_POST['action'] == 'do_edit'))
		{
			//必填信息.
			$employee['name'] = $this->input->post('name');
			$employee['password'] = $this->input->post('password');
			$employee['password2'] = $this->input->post('password2');
			$employee['group'] = $this->input->post('group');
			$employee['active'] = $this->input->post('active');
			
			if( $employee['name'] == FAlSE || $employee['password'] == FAlSE || $employee['password2'] == FAlSE || $employee['group'] == FAlSE || $employee['active'] == FAlSE)
			{
				$data['groups'] = $this->Employee_model->getGroups();
				$data['notification'] = '请填写完整的员工信息';
				$data['employee'] = $employee;
				$this->load->view('admin/employee_add', $data);
			}
			elseif( $employee['password'] != $employee['password2'] )
			{
				$data['groups'] = $this->Employee_model->getGroups();
				$data['notification'] = '两次密码输入不一致! 请重新输入';
				$data['employee'] = $employee;
				$this->load->view('admin/employee_add', $data);
			}
			else
			{
				if($this->Employee_model->update($data['employee_id'], $employee))
				{
					$data['notification'] = '更新成功!';
					$data['page'] = 'admin/employee';
					$this->load->view('admin/result', $data);
				}
				else
				{
					$data['groups'] = $this->Employee_model->getGroups();
					$data['notification'] = '更新失败, 请重试.';
					$data['student'] = $new_student;
					$this->load->view('admin/employee_edit', $data);
				}
			}
		}
		else
		{
			$data['groups'] = $this->Employee_model->getGroups();
			$this->load->view('admin/employee_edit', $data);	
		}
	}
	
	function delete()
	{
		$data['employee_id'] = $this->input->post('employee_id');
		if(!$data['employee_id'])
		{
			$data['notification'] = '您访问的页面不合法.';
			$data['page'] = 'admin/employee';
			$this->load->view('admin/error', $data);
			return;
		}
		
		if( $this->Employee_model->delect_employee($data['employee_id']) )
		{
			$data['notification'] = '该员工已经成功删除!';
			$data['page'] = 'admin/employee';
			$this->load->view('admin/result', $data);
		}
		else
		{
			$data['notification'] = '删除失败, 请重试.';
			$data['page'] = 'admin/employee';
			$this->load->view('admin/result', $data);
		}
	}
	
	function contact_history()
	{
		if(!empty($_POST))
		{
			$contact_history['contact_history'] = $this->input->post('contact_history');
			$contact_history['student_id'] = $this->input->post('student_id');
			
			if( $this->Student_model->update_contact_history($contact_history) )
			{
				$data['page'] = 'admin/student';
				$this->load->view('admin/result', $data);
			}
			else
			{
				$data['notification'] = '更新失败, 请重试.';
				$this->load->view('admin/student', $data);
			}
		}
		else
		{
			echo 'not allowed here!';
		}
	}
	
	function study_history()
	{
		if(!empty($_POST))
		{
			$study_history['study_history'] = $this->input->post('study_history');
			$study_history['student_id'] = $this->input->post('student_id');
			
			if( $this->Student_model->update_study_history($study_history) )
			{
				$data['page'] = 'admin/student';
				$this->load->view('admin/result', $data);
			}
			else
			{
				$data['notification'] = '更新失败, 请重试.';
				$this->load->view('admin/student', $data);
			}
		}
		else
		{
			echo 'not allowed here!';
		}
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */