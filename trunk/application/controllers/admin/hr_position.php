<?php
/* 
  测评管理
  admin权限.
 */
class hr_position extends Controller {

	function hr_position()
	{
		parent::Controller();
		$this->load->library('session');
		$this->load->model('CRM_Group_model');
		$this->load->model('Hr_position_model');
		$this->load->helper('admin');
		
		//如果没有经登录, 就跳转到admin/login登陆页
		if (!has_login())
		{
			goto_login();
		}
		
		$this->staff_info = get_staff_info();
		
		$this->load->library('admin_ac/Admin_Ac_hr', array('group_id' => $this->staff_info['group_id'], 'staff_id' => $this->staff_info['staff_id']));
	}
	
	function index()
	{
		$positions = $this->Hr_position_model->get_all();
		
		$data['header']['meta_title'] = '职位列表';
		$data['main']['positions'] = $positions;
		_load_viewer($this->staff_info['group_id'], 'hr_position_all', $data);
	}
	
	function edit($position_id = 0)
	{
		//判断staff_id是否合法.
		$position_id = (empty($position_id))? $this->input->post('position_id') : intval($position_id);
		if($position_id <= 0)
		{
			show_error_page('您输入的参数不合法, 请返回重试.', 'admin/hr_position');
			return false;
		}
		
		//获取 position 信息.
		$position_info = $this->Hr_position_model->get_one($position_id);
		
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			//必填信息.
			$edit_position['position_name'] = $this->input->post('position_name');
			$edit_position['group_id'] = $this->input->post('group_id');
			
			//检查修改项
			$update_field = array();
			foreach($edit_position as $key => $val)
			{
				if(!empty($val) && ($val != $position_info[$key]))
					$update_field[$key] = $val;
			}
			
			if($this->Hr_position_model->update($position_id, $update_field))
			{
				show_result_page('职位已经更新成功! ', 'admin/hr_position');
			}
			else
			{
				$notify = '更新失败, 请重试.';
				$this->_load_position_edit_view($notify, $edit_position);
			}
		}
		else
		{
			$this->_load_position_edit_view('', $position_info);
		}
	}
		
	/* 
	 * 访问权限: 超级管理员, 校区管理员, 咨询师
	*/
	function add()
	{
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			//必填信息.
			$position['position_name'] = $this->input->post('position_name');
			$position['group_id'] = $this->input->post('group_id');
			
			if(empty($position['position_name']) || empty($position['group_id']))
			{
				$notify = '请填写完整的职位信息';
				$this->_load_hr_position_add_view($notify, $position);
			}
			else
			{
				//add into DB
				if($this->Hr_position_model->add($position))
				{
					show_result_page('新面试者已经添加成功! ', 'admin/hr_position');
				}
				else
				{
					$notify = '评论添加失败, 请重试.';
					$this->_load_hr_position_add_view($notify, $position);
				}
			}
		}
		else
		{
			$this->_load_hr_position_add_view();
		}
	}
	
	function delete($position_id)
	{
		//判断staff_id是否合法.
		$position_id = intval($position_id);
		if($position_id <= 0)
		{
			show_error_page('您输入的员工ID不合法, 请返回重试.', 'admin/hr_position');
			return false;
		}
		
		//获取 position 信息.
		$position_info = $this->Hr_position_model->get_one($position_id);
		
		if($this->Hr_position_model->delete($position_id))
		{
			show_result_page('评论已经删除! ', 'admin/hr_position');
		}
		else
		{
			show_error_page('删除失败, 请重试.', 'admin/hr_position');
		}
	}
	
	
	function _load_hr_position_add_view($notify = '', $position = array())
	{
		$data['header']['meta_title'] = '添加新职位 - HR系统';
		$data['main']['notification'] = $notify;
		$data['main']['groups'] = $this->_get_groups();
		_load_viewer($this->staff_info['group_id'], 'hr_position_add', $data);
	}
	
	function _load_position_edit_view($notify = '', $position = array())
	{
		$data['header']['meta_title'] = '编辑职位 - HR系统';
		$data['main']['notification'] = $notify;
		$data['main']['groups'] = $this->_get_groups();
		$data['main']['position'] = $position;
		_load_viewer($this->staff_info['group_id'], 'hr_position_edit', $data);
	}
	
	function _get_groups()
	{
		return $this->CRM_Group_model->get_all_department();
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */