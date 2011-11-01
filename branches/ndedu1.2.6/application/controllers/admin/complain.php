<?php
/* 
  合同模块. 查看单个合同.
  admin权限.
 */
class Complain extends Controller {

	function Complain()
	{
		parent::Controller();
		$this->load->library('session');
		
		$this->load->model('CRM_Staff_model');
		$this->load->model('CRM_Complain_model');
		
		$this->load->helper('admin');
			
		//如果没有经登录, 就跳转到admin/login登陆页
		if (!has_login())
		{
			goto_login();
		}
		//获取员工基本信息
		$this->staff_info = get_staff_info();
		
		//检查权限.
		$this->allowed_group = array(GROUP_ADMIN, GROUP_SCHOOLADMIN);
		if(!check_role($this->allowed_group, $this->staff_info['group_id']))
		{
			show_access_deny_page();
		}
		
		//$this->output->enable_profiler(TRUE);
	}
	
	function index($staff_id = 0)
	{
		//判断staff_id是否合法.
		$staff_id = intval($staff_id);
		if($staff_id <= 0)
		{
			show_error_page('您输入的员工ID不合法, 请返回重试.', 'admin/staff');
			return false;
		}
		
		//获取staff 信息.
		$staff_info = $this->CRM_Staff_model->getOne($staff_id);
		//检查权限
		if(empty($staff_info))
		{
			show_error_page('您所查看的员工不存在!', 'admin/staff');
			return false;
		}
		else
		{
			switch($this->staff_info['group_id'])
			{
				case GROUP_ADMIN: //admin管理有权限
					break;
				case GROUP_SCHOOLADMIN: //shooladmin只有查看本校区员工的权限
					if($staff_info['branch_id'] != $this->staff_info['branch_id'])
					{
						show_error_page('您没有权限查看该员工的投诉: 他/她不在您所在的校区!', 'admin/staff');
						return false;
					}
					break;
				default:
					show_error_page('您没有权限查看该员工的投诉: 请重新登录或者联系管理员!', 'admin');
					return false;
			}
		}
		
		$complains = $this->CRM_Complain_model->get_one_staff_complain($staff_id);
		$data['header']['meta_title'] = '查看投诉 - 管理员工';
		$data['main']['staff_info'] =$staff_info;
		$data['main']['complains'] =$complains;
		_load_viewer($this->staff_info['group_id'], 'complain_one_staff', $data);
	}
	
	function delete($complain_id = 0)
	{
		//判断staff_id是否合法.
		$complain_id = intval($complain_id);
		if($complain_id <= 0)
		{
			show_error_page('您输入的ID不合法, 请返回重试.', '');
			return false;
		}
		
		//投诉信息
		$complain_info =  $this->CRM_Complain_model->get_one_complain($complain_id);
		//检查权限
		if(empty($complain_info))
		{
			show_error_page('您所要删除的投诉不存在!', 'admin/staff');
			return false;
		}
		else
		{
			$staff_info = $this->CRM_Staff_model->getOne($complain_info['staff_id']);
			switch($this->staff_info['group_id'])
			{
				case GROUP_ADMIN: //admin管理有权限
					break;
				case GROUP_SCHOOLADMIN: //shooladmin只有查看本校区员工的权限
					if($staff_info['branch_id'] != $this->staff_info['branch_id'])
					{
						show_error_page('您没有权限查看该员工的投诉: 他/她不在您所在的校区!', 'admin/staff');
						return false;
					}
					break;
				default:
					show_error_page('您没有权限查看该员工的投诉: 请重新登录或者联系管理员!', 'admin');
					return false;
			}
		}
		
		$update_field['is_delete'] = 1;
		if($this->CRM_Complain_model->update($complain_id, $update_field))
		{
			show_result_page('投诉已经成功被删除! ', 'admin/complain/index/'.$complain_info['staff_id']);
		}
		else
		{
			show_error_page('删除失败, 请重试.', 'admin/complain/index/'.$complain_info['staff_id']);
		}
	}
	
	function edit($complain_id = 0)
	{
		//判断staff_id是否合法.
		$complain_id = (empty($complain_id))? $this->input->post('complain_id') : intval($complain_id);
		if($complain_id <= 0)
		{
			show_error_page('您输入的员工ID不合法, 请返回重试.', 'admin/staff');
			return false;
		}
		
		//投诉信息
		$complain_info =  $this->CRM_Complain_model->get_one_complain($complain_id);
		
		//检查权限
		if(empty($complain_info))
		{
			show_error_page('您所要修改的投诉不存在!', 'admin/staff');
			return false;
		}
		else
		{
			$staff_info = $this->CRM_Staff_model->getOne($complain_info['staff_id']);
			$complain_info['name'] = $staff_info['name'];
			switch($this->staff_info['group_id'])
			{
				case GROUP_ADMIN: //admin管理有权限
					break;
				case GROUP_SCHOOLADMIN: //shooladmin只有查看本校区员工的权限
					if($staff_info['branch_id'] != $this->staff_info['branch_id'])
					{
						show_error_page('您没有权限查看该员工: 他/她不在您所在的校区!', 'admin/staff');
						return false;
					}
					break;
				default:
					show_error_page('您没有权限查看该员工: 请重新登录或者联系管理员!', 'admin');
					return false;
			}
		}
		
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			//必填信息.
			$edit_complain['complain_id'] = $complain_id;
			$edit_complain['complain_reason'] = $this->input->post('complain_reason');
			
			//检查修改项
			$update_field = array();
			foreach($edit_complain as $key => $val)
			{
				if(!empty($val) && ($val != $complain_info[$key]))
					$update_field[$key] = $val;
			}
			
			if($this->CRM_Complain_model->update($complain_id, $update_field))
			{
				show_result_page('投诉已经更新成功! ', 'admin/complain/index/'.$complain_info['staff_id']);
			}
			else
			{
				$notify = '更新失败, 请重试.';
				$this->_load_complain_edit_view($notify, $complain_info);
			}
		}
		else
		{
			$this->_load_complain_edit_view('', $complain_info);
		}
	}
	
	function add($staff_id = 0)
	{
		//判断staff_id是否合法.
		$staff_id = (empty($staff_id))? $this->input->post('staff_id') : intval($staff_id);
		if($staff_id <= 0)
		{
			show_error_page('您输入的员工ID不合法, 请返回重试.', 'admin/staff');
			return false;
		}
		
		//获取staff 信息.
		$staff_info = $this->CRM_Staff_model->getOne($staff_id);
		//检查权限
		if(empty($staff_info))
		{
			show_error_page('您所投诉的员工不存在!', 'admin/staff');
			return false;
		}
		else
		{
			switch($this->staff_info['group_id'])
			{
				case GROUP_ADMIN: //admin管理有权限
					break;
				case GROUP_SCHOOLADMIN: //shooladmin只有查看本校区员工的权限
					if($staff_info['branch_id'] != $this->staff_info['branch_id'])
					{
						show_error_page('您没有权限投诉该员工: 他/她不在您所在的校区!', 'admin/staff');
						return false;
					}
					break;
				default:
					show_error_page('您没有权限投诉该员工: 请重新登录或者联系管理员!', 'admin');
					return false;
			}
		}
		
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			//必填信息.
			$complain['staff_id'] = $staff_id;
			$complain['complain_reason'] = $this->input->post('complain_reason');
			$complain['name'] = $staff_info['name'];
			
			if(empty($complain['complain_reason']))
			{
				$notify = '请填写投诉原因!';
				$this->_load_complain_add_view($notify, $complain);
			}
			else
			{
				//add into DB
				if($this->CRM_Complain_model->add($complain))
				{
					show_result_page('新投诉已经添加成功! ', 'admin/staff/');
				}
				else
				{
					$notify = '新投诉添加失败, 请重试.';
					$this->_load_complain_add_view($notify, $complain);
				}
			}
		}
		else
		{
			$complain['staff_id'] = $staff_id;
			$complain['name'] = $staff_info['name'];
			$this->_load_complain_add_view('', $complain);		
		}
	}
	
	function _load_complain_add_view($notify='', $complain)
	{
		$data['header']['meta_title'] = '投诉 - 管理员工';
		$data['main']['complain'] =$complain;
		$data['main']['notification'] = $notify;
		_load_viewer($this->staff_info['group_id'], 'complain_add', $data);
	}
	function _load_complain_edit_view($notify='', $complain)
	{
		$data['header']['meta_title'] = '投诉 - 管理员工';
		$data['main']['complain'] =$complain;
		$data['main']['notification'] = $notify;
		_load_viewer($this->staff_info['group_id'], 'complain_edit', $data);
	}
}
/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */