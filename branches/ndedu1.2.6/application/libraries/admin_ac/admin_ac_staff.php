<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('admin_ac_base.php');

/*
 * admin/entry controller 权限控制类
 */
class Admin_Ac_Staff extends Admin_Ac_Base 
{
	function Admin_Ac_Staff($params)
	{
		parent::Admin_Ac_Base($params);
		$this->branch_id = $params['branch_id'];
	}
	
	function staff_index_ac()
	{
		$filter = array();
		switch($this->group_id)
		{
			case GROUP_ADMIN: //admin管理有权限
				break;
			case GROUP_SCHOOLADMIN: //shooladmin只有查看本校区员工的权限
				$filter['branch_id'] = $this->branch_id;
				break;
			case GROUP_CS:
			case GROUP_CS_D:
			case GROUP_TEACHER_D:
				$filter['branch_id'] = $this->branch_id;
				$filter['group_id'] = array(GROUP_TEACHER_PARTTIME, GROUP_TEACHER_FULL);
				break;
			case GROUP_CONSULTANT_D:
				$filter['branch_id'] = $this->branch_id;
				$filter['group_id'] = array(GROUP_CONSULTANT);
				break;
			case GROUP_SUYANG_D:
				$filter['branch_id'] = $this->branch_id;
				$filter['group_id'] = array(GROUP_SUYANG);
				break;
			case GROUP_JIAOWU:
				$filter['branch_id'] = $this->branch_id;
				$filter['group_id'] = array(GROUP_TEACHER_PARTTIME, GROUP_TEACHER_FULL, GROUP_SUYANG_D, GROUP_SUYANG, GROUP_CONSULTANT_D, GROUP_CONSULTANT);
				break;
			case GROUP_JIAOWU_D:
				$filter['branch_id'] = $this->branch_id;
				$filter['group_id'] = array(GROUP_JIAOWU, GROUP_TEACHER_PARTTIME, GROUP_TEACHER_FULL, GROUP_SUYANG_D, GROUP_SUYANG, GROUP_CONSULTANT_D, GROUP_CONSULTANT);
				break;
			default:
				show_error_page('您没有权限查看员工列表: 请重新登录或者联系管理员!', 'admin');
				return false;
		}
		
		return $filter;
	}
	
	function staff_one_ac($staff_info)
	{
		switch($this->group_id)
		{
			case GROUP_ADMIN: //admin管理有权限
				return true;
				break;
			case GROUP_SCHOOLADMIN: //shooladmin只有查看本校区员工的权限
				if($staff_info['branch_id'] != $this->branch_id)
				{
					show_error_page('您没有权限查看该员工: 他/她不在您所在的校区!', 'admin/staff');
					return false;
				}
				else
					return true;
				break;
			case GROUP_CS:
			case GROUP_CS_D:
			case GROUP_TEACHER_D:
				$allow_group = array(GROUP_TEACHER_PARTTIME, GROUP_TEACHER_FULL);
				if(!in_array($staff_info['group_id'], $allow_group))
				{
					show_error_page('您没有权限查看该员工: 他/她不是学科老师!', 'admin/staff');
					return false;
				}
				else
					return true;
				break;
			case GROUP_CONSULTANT_D:
				$allow_group = array(GROUP_CONSULTANT);
				if(!in_array($staff_info['group_id'], $allow_group))
				{
					show_error_page('您没有权限查看该员工: 他/她不是咨询老师!', 'admin/staff');
					return false;
				}
				break;
			case GROUP_SUYANG_D:
				$allow_group = array(GROUP_SUYANG);
				if(!in_array($staff_info['group_id'], $allow_group))
				{
					show_error_page('您没有权限查看该员工: 他/她不是咨询老师!', 'admin/staff');
					return false;
				}
				break;
			case GROUP_JIAOWU:
				$allow_group = array(GROUP_TEACHER_PARTTIME, GROUP_TEACHER_FULL, GROUP_SUYANG_D, GROUP_SUYANG, GROUP_CONSULTANT_D, GROUP_CONSULTANT);
				if(!in_array($staff_info['group_id'], $allow_group))
				{
					show_error_page('您没有权限查看该员工: 他/她不是咨询老师!', 'admin/staff');
					return false;
				}
				break; 
			case GROUP_JIAOWU_D:
				$allow_group = array(GROUP_JIAOWU, GROUP_TEACHER_PARTTIME, GROUP_TEACHER_FULL, GROUP_SUYANG_D, GROUP_SUYANG, GROUP_CONSULTANT_D, GROUP_CONSULTANT);
				if(!in_array($staff_info['group_id'], $allow_group))
				{
					show_error_page('您没有权限查看该员工: 他/她不是咨询老师!', 'admin/staff');
					return false;
				}
				break; 
			default:
				show_error_page('您没有权限查看员工: 请重新登录或者联系管理员!', 'admin');
				return false;
		}
	}
	
	function staff_add_ac()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN, GROUP_TEACHER_D);
		
		return $this->_check_role($allowed_group_id);	
	}
	
	function admin_gen_psw_ac()
	{
		$allowed_group_id = array(GROUP_ADMIN);
		
		return $this->_check_role($allowed_group_id);	
	}
	
	function staff_become_full_ac($staff_info, $return_type = 'bool')
	{
		if(empty($staff_info))
		{
			if($return_type == 'warning')
				show_error_page('您所查询的员工不存在!', 'admin/staff');
			return false;
		}
		
		switch($this->group_id)
		{
			case GROUP_ADMIN: //admin管理有权限
				return true;
				break;
			case GROUP_SCHOOLADMIN: //shooladmin只有查看本校区员工的权限
				if($staff_info['branch_id'] != $this->branch_id)
				{
					if($return_type == 'warning')
						show_error_page('您没有权限查看该员工: 他/她不在您所在的校区!', 'admin/staff');
					return false;
				}
				else
					return true;
				break;
			case GROUP_TEACHER_D:
				$group = array(GROUP_TEACHER_FULL, GROUP_TEACHER_PARTTIME);
				break;
			case GROUP_CONSULTANT_D:
				$group = array(GROUP_CONSULTANT);
				break;
			case GROUP_SUYANG_D: //shooladmin只有查看本校区员工的权限
				$group = array(GROUP_SUYANG);
				break;
			default:
				if($return_type == 'warning')
					show_error_page('您没有权限查看该员工: 请重新登录或者联系管理员!', 'admin/staff');
				return false;
		}
		
		//GROUP_TEACHER_D, GROUP_CONSULTANT_D, GROUP_SUYANG_D 权限判断
		if($staff_info['branch_id'] != $this->branch_id)
		{
			if($return_type == 'warning')
				show_error_page('您没有权限查看该员工: 他/她不在您所在的校区!', 'admin/staff');
			return false;
		}
		elseif(!in_array($staff_info['group_id'], $group))
		{
			if($return_type == 'warning')
				show_error_page('您没有权限查看该员工: 他/她不是学科老师!', 'admin/staff');
			return false;
		}
		else
			return true;
	}
	
	/*
	 * return type： warning： 直接警告，停止执行脚本
	 * return type： bool：返回布尔值
	 */
	function staff_management_ac($staff_info, $return_type = 'bool')
	{
		if(empty($staff_info))
		{
			if($return_type == 'warning')
				show_error_page('您所查询的员工不存在!', 'admin/staff');
			return false;
		}
		
		switch($this->group_id)
		{
			case GROUP_ADMIN: //admin管理有权限
				return true;
				break;
			case GROUP_SCHOOLADMIN: //shooladmin只有查看本校区员工的权限
				if($staff_info['branch_id'] != $this->branch_id)
				{
					if($return_type == 'warning')
						show_error_page('您没有权限查看该员工: 他/她不在您所在的校区!', 'admin/staff');
					return false;
				}
				else
					return true;
				break;
			case GROUP_TEACHER_D: //shooladmin只有查看本校区员工的权限
				if($staff_info['branch_id'] != $this->branch_id)
				{
					if($return_type == 'warning')
						show_error_page('您没有权限查看该员工: 他/她不在您所在的校区!', 'admin/staff');
					return false;
				}
				elseif(!in_array($staff_info['group_id'], array(GROUP_TEACHER_PARTTIME, GROUP_TEACHER_FULL)))
				{
					if($return_type == 'warning')
						show_error_page('您没有权限查看该员工: 他/她不是学科老师!', 'admin/staff');
					return false;
				}
				else
					return true;
				break;
			default:
				if($return_type == 'warning')
					show_error_page('您没有权限查看该员工: 请重新登录或者联系管理员!', 'admin/staff');
				return false;
		}
	}
	
	function view_staff_one_sms()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN, GROUP_TEACHER_D);
		
		return $this->_check_role($allowed_group_id);	
	}
	
	function view_staff_one_see_all_sms()
	{
		$allowed_group_id = array(GROUP_ADMIN, GROUP_SCHOOLADMIN, GROUP_TEACHER_D);
		
		return $this->_check_role($allowed_group_id);	
	}
	
	
	
}