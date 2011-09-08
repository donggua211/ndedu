<?php
/* 
  班主任管理模块
  admin权限.
 */
class Student extends Controller {

	function Student()
	{
		parent::Controller();
		$this->load->library('session');
		$this->load->model('Student_model');
		$this->load->helper('admin_authority');
		
		$this->allowed_group = array(1, 2, 3);
		
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
		$group_id = get_group_id();
		$data['group_id'] = $group_id;
		//admin权限. 全部显示
		if(in_array($group_id, array(1))) 
		{
			$students = $this->Student_model->getAll(0);
		}
		else
		{
			$employee_id = get_employee_id();
			$students = $this->Student_model->getAll($employee_id);
		}
		$data['students'] = $students;
		$this->load->view('admin/student_index', $data);
	}
	
	function add()
	{
		//检查权限.
		if(!check_role(array(1, 3)))
		{
			show_access_deny_page();
		}
		
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			//必填信息.
			$new_student['student_name'] = $this->input->post('student_name');
			$new_student['student_phone'] = $this->input->post('student_phone');
			
			$new_student['father_name'] = $this->input->post('father_name');
			$new_student['father_phone'] = $this->input->post('father_phone');
			$new_student['mother_name'] = $this->input->post('mother_name');
			$new_student['mother_phone'] = $this->input->post('mother_phone');
			
			//选填信息.
			$new_student['student_grade'] = $this->input->post('student_grade');
			$new_student['student_learning_status'] = $this->input->post('student_learning_status');
			$new_student['remark'] = $this->input->post('remark');
			
			if($new_student['student_name'] == FAlSE || $new_student['student_phone'] == FAlSE || $new_student['student_grade'] == FAlSE || $new_student['student_learning_status'] == FAlSE)
			{
				$data['notification'] = '请填写完整的学生信息';
				$data['student'] = $new_student;
				$this->load->view('admin/student_add', $data);
			}
			elseif( !( ( !empty($new_student['father_name']) && !empty($new_student['father_phone']) ) || 
					( !empty($new_student['mother_name']) && !empty($new_student['mother_phone']) ) ) )
			{
				$data['notification'] = '请填写爸爸或者妈妈的信息';
				$data['student'] = $new_student;
				$this->load->view('admin/student_add', $data);
			}
			else
			{
				//add into DB
				$student_id = $this->Student_model->add($new_student);
				if( $student_id !== FALSE)
				{
					//建立student表和employee表的管理
					$employee_id = get_employee_id();
					$this->Student_model->creat_student_employee($student_id, $employee_id);
					$data['page'] = 'admin/student';
					$this->load->view('admin/result', $data);
				}
				else
				{
					$data['notification'] = '添加失败, 请重试.';
					$data['student'] = $new_student;
					$this->load->view('admin/student_add', $data);
				}
			}
		}
		else
		{
			$this->load->view('admin/student_add');	
		}
	}
	
	function edit()
	{
		$data['student_id'] = $this->input->post('student_id');
		if(!$data['student_id'])
		{
			$data['notification'] = '您访问的页面不合法.';
			$data['page'] = 'admin/student';
			$this->load->view('admin/error', $data);
			return;
		}
		
		if(isset($_POST['action']) && ($_POST['action'] == 'do_edit'))
		{
			//必填信息.
			$edit_student['student_name'] = $this->input->post('student_name');
			$edit_student['student_phone'] = $this->input->post('student_phone');
			
			$edit_student['father_name'] = $this->input->post('father_name');
			$edit_student['father_phone'] = $this->input->post('father_phone');
			$edit_student['mother_name'] = $this->input->post('mother_name');
			$edit_student['mother_phone'] = $this->input->post('mother_phone');
			
			//选填信息.
			$edit_student['student_grade'] = $this->input->post('student_grade');
			$edit_student['student_learning_status'] = $this->input->post('student_learning_status');
			$edit_student['remark'] = $this->input->post('remark');
			
			if($edit_student['student_name'] == FAlSE || $edit_student['student_phone'] == FAlSE || $edit_student['student_grade'] == FAlSE || $edit_student['student_learning_status'] == FAlSE)
			{
				$data['notification'] = '请填写完整的学生信息';
				$data['student'] = $edit_student;
				$this->load->view('admin/student_edit', $data);
			}
			elseif( !( ( !empty($edit_student['father_name']) && !empty($edit_student['father_phone']) ) || 
					( !empty($edit_student['mother_name']) && !empty($edit_student['mother_phone']) ) ) )
			{
				$data['notification'] = '请填写爸爸或者妈妈的信息';
				$data['student'] = $edit_student;
				$this->load->view('admin/student_edit', $data);
			}
			else
			{
				//add into DB
				if($this->Student_model->update($data['student_id'], $edit_student))
				{
					$data['notification'] = '更新成功!';
					$data['page'] = 'admin/student';
					$this->load->view('admin/result', $data);
				}
				else
				{
					$data['notification'] = '添加失败, 请重试.';
					$data['student'] = $edit_student;
					$this->load->view('admin/student_edit', $data);
				}
			}
		}
		else
		{
			$employee_id = get_employee_id();
			$student = $this->Student_model->getOne($data['student_id'], $employee_id);
			if(empty($student))
			{
				$data['notification'] = '您访问的学生不存在或者没有权限.';
				$data['page'] = 'admin/student';
				$this->load->view('admin/error', $data);
			}
			else
			{
				$data['student'] = $student;
				$this->load->view('admin/student_edit', $data);
			}
		}
	}
	
	function delete()
	{
		//检查权限.
		if(!check_role(array(1, 3)))
		{
			show_access_deny_page();
		}
		
		$data['student_id'] = $this->input->post('student_id');
		if(!$data['student_id'])
		{
			$data['notification'] = '您访问的页面不合法.';
			$data['page'] = 'admin/student';
			$this->load->view('admin/error', $data);
			return;
		}
		
		if( $this->Student_model->delect_student($data['student_id']) )
		{
			//删除学习历史
			$this->Student_model->delect_study_history($data['student_id']);
			//删除联系历史
			$this->Student_model->delect_contact_history($data['student_id']);
			
			$data['notification'] = '该学生已经成功删除!';
			$data['page'] = 'admin/student';
			$this->load->view('admin/result', $data);
		}
		else
		{
			$data['notification'] = '删除失败, 请重试.';
			$data['page'] = 'admin/student';
			$this->load->view('admin/result', $data);
		}
	}
	
	function contact_history()
	{
		//检查权限.
		if(!check_role(array(1, 3)))
		{
			show_access_deny_page();
		}
		
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
		//检查权限.
		if(!check_role(array(1, 2)))
		{
			show_access_deny_page();
		}
		
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
	
	function update_status()
	{
		//检查权限.
		if(!check_role(array(1, 3)))
		{
			show_access_deny_page();
		}
		$data['student_id'] = $this->input->post('student_id');
		$data['status'] = $this->input->post('status');
		if(!$data['student_id'] || !in_array($data['status'], array('0', '1', '2')))
		{
			$data['notification'] = '您访问的页面不合法.';
			$data['page'] = 'admin/student';
			$this->load->view('admin/error', $data);
			return;
		}
		
		if( $this->Student_model->update_status($data['student_id'], $data['status']) )
		{
			$data['notification'] = '该学生状态已经更改!';
			$data['page'] = 'admin/student';
			$this->load->view('admin/result', $data);
		}
		else
		{
			$data['notification'] = '学生状态更改失败, 请重试.';
			$data['page'] = 'admin/student';
			$this->load->view('admin/result', $data);
		}
		
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */