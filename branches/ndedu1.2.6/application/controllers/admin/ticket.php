<?php
/* 
  班主任管理模块
  admin权限.
 */
class Ticket extends Controller {

	function Ticket()
	{
		parent::Controller();
		$this->load->library('session');
		
		$this->load->model('CRM_Ticket_model');
		
		$this->load->helper('admin');
			
		//如果没有经登录, 就跳转到admin/login登陆页
		if (!has_login())
		{
			goto_login();
		}
		
		$this->staff_info = get_staff_info();
		
		//加载权限控制类
		$this->load->library('admin_ac/Admin_Ac_Ticket', array('group_id' => $this->staff_info['group_id']));
		
		//access_control
		$this->admin_ac_ticket->view_ticket();
		
		//$this->output->enable_profiler(TRUE);
	}
	
	function index($filter_string = '')
	{
		//默认值
		$filter['page'] = 1;
		$filter = $this->_parse_filter($filter_string, $filter);
		
		//Page Nav
		$total = $this->CRM_Ticket_model->getAll_count($filter);
		$page_nav = page_nav($total, TICKET_PER_PAGE, $filter['page']);
		$page_nav['base_url'] = 'admin/ticket/index';
		$page_nav['filter'] = $filter;
		$data['main']['page_nav'] = $this->load->view('admin/common_page_nav', $page_nav, true);
		
		$ticket = $this->CRM_Ticket_model->getAll($filter, $page_nav['start'], TICKET_PER_PAGE, 'ticket.add_time', 'DESC');
		
		$data['header']['meta_title'] = '查看评论 - 内部评论';
		$data['main']['ticket'] = $ticket;
		$data['main']['this_staff_id'] = $this->staff_info['staff_id'];
		_load_viewer($this->staff_info['group_id'], 'ticket_all', $data);
	}
	
	function one($ticket_id)
	{
		//判断student_id是否合法.
		$ticket_id = intval($ticket_id);
		if($ticket_id <= 0)
		{
			show_error_page('您输入的员工ID不合法, 请返回重试.', 'admin/ticket');
			return false;
		}
		
		//获取 ticket 信息.
		$ticket_info = $this->CRM_Ticket_model->getOne($ticket_id);
		
		$data['header']['meta_title'] = $ticket_info['ticket_title'] . ' - 内部评论';
		$data['main']['this_staff_id'] = $this->staff_info['staff_id'];
		$data['main']['ticket_info'] = $ticket_info;
		
		_load_viewer($this->staff_info['group_id'], 'ticket_one', $data);
	}
	
	function edit($ticket_id = 0)
	{
		//判断staff_id是否合法.
		$ticket_id = (empty($ticket_id))? $this->input->post('ticket_id') : intval($ticket_id);
		if($ticket_id <= 0)
		{
			show_error_page('您输入的员工ID不合法, 请返回重试.', 'admin/ticket');
			return false;
		}
		
		//获取staff 信息.
		$ticket_info = $this->CRM_Ticket_model->getOne($ticket_id);
		
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			//必填信息.
			$edit_ticket['ticket_title'] = $this->input->post('ticket_title');
			$edit_ticket['ticket_content'] = $this->input->post('ticket_content');
			
			//检查修改项
			$update_field = array();
			foreach($edit_ticket as $key => $val)
			{
				if(!empty($val) && ($val != $ticket_info[$key]))
					$update_field[$key] = $val;
			}
			
			if($this->CRM_Ticket_model->update($ticket_id, $update_field))
			{
				show_result_page('评论已经更新成功! ', 'admin/ticket');
			}
			else
			{
				$notify = '更新失败, 请重试.';
				$this->_load_ticket_edit_view($notify, $ticket_info);
			}
		}
		else
		{
			$this->_load_ticket_edit_view('', $ticket_info);
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
			$new_ticket['ticket_title'] = $this->input->post('ticket_title');
			$new_ticket['ticket_content'] = $this->input->post('ticket_content');
			$new_ticket['staff_id'] = $this->staff_info['staff_id'];
			
			if(empty($new_ticket['ticket_title']) || empty($new_ticket['ticket_content']))
			{
				$notify = '请填写完整的评论信息';
				$this->_load_ticket_add_view($notify, $new_ticket);
			}
			else
			{
				//add into DB
				if($this->CRM_Ticket_model->add($new_ticket))
				{
					show_result_page('评论已经添加成功! ', 'admin/ticket');
				}
				else
				{
					$notify = '评论添加失败, 请重试.';
					$this->_load_ticket_add_view($notify, $new_ticket);
				}
			}
		}
		else
		{
			$this->_load_ticket_add_view();
		}
	}
	
	function delete($ticket_id, $is_delete = 1)
	{
		//判断staff_id是否合法.
		$ticket_id = intval($ticket_id);
		if($ticket_id <= 0)
		{
			show_error_page('您输入的员工ID不合法, 请返回重试.', 'admin/ticket');
			return false;
		}
		
		
		if($this->CRM_Ticket_model->delete($ticket_id))
		{
			show_result_page('评论已经删除! ', 'admin/ticket');
		}
		else
		{
			show_error_page('删除失败, 请重试.', 'admin/ticket/one/'.$ticket_id);
		}
	}
	
	
	function _load_ticket_add_view($notify = '', $ticket = array())
	{
		$data['header']['meta_title'] = '添加评论 - 内部评论';
		$data['main']['notification'] = $notify;
		$data['main']['ticket'] = $ticket;
		_load_viewer($this->staff_info['group_id'], 'ticket_add', $data);
	}
	
	function _load_ticket_edit_view($notify = '', $ticket_info = array())
	{
		$data['header']['meta_title'] = '编辑评论 - 内部评论';
		$data['main']['notification'] = $notify;
		$data['main']['ticket_info'] = $ticket_info;
		_load_viewer($this->staff_info['group_id'], 'ticket_edit', $data);
	}
	
	function _get_branch()
	{
		$result = array();
		if($this->staff_info['group_id'] == GROUP_ADMIN)
		{
			$result['show_branch_list'] = true;
			$result['branch'] = $this->CRM_Branch_model->get_branches();
		}
		else
		{
			$result['show_branch_list'] = false;
			$result['branch'] = $this->CRM_Branch_model->get_one_branch($this->staff_info['branch_id']);
		}
		return $result;		
	}
	
	function _get_groups()
	{
		switch($this->staff_info['group_id'])
		{
			case GROUP_ADMIN: //admin管理有权限
				$from_group = GROUP_ADMIN;
				break;
			case GROUP_SCHOOLADMIN: //shooladmin只有查看本校区员工的权限
				$from_group = GROUP_CONSULTANT;
				break;
			case GROUP_TEACHER_D: //shooladmin只有查看本校区员工的权限
				return array(
					array( 'group_id' => GROUP_TEACHER_PARTTIME,
							'group_name' => get_group_name(GROUP_TEACHER_PARTTIME)
						 ),
					array( 'group_id' => GROUP_TEACHER_FULL,
							'group_name' => get_group_name(GROUP_TEACHER_FULL)
						 ),
					);
				break;
			default:
				return array();
		}
		return $this->CRM_Group_model->get_groups($from_group);
	}
	
	function _get_grade()
	{
		return $this->CRM_Grade_model->get_grades(GRADE_PARENT);
	}
	
	function _parse_filter($filter_string, $filter)
	{
		$input_filter = parse_filter($filter_string);
		foreach($filter as $key => $value)
		{
			if(!isset($input_filter[$key]))
				continue;
			
			switch($key)
			{
				case 'page':
					$input_filter[$key] = intval($input_filter[$key]);
					break;
				default:
					break;
			}
			
			if(empty($input_filter[$key]) && $input_filter[$key] !== 0)
				continue;
			
			$filter[$key] = $input_filter[$key];
		}
		return $filter;
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */