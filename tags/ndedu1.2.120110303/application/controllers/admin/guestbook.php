<?php
/* 
  留言本管理
  admin权限.
 */
class Guestbook extends Controller {

	function Guestbook()
	{
		parent::Controller();
		$this->load->library('session');
		$this->load->model('Guestbook_model');
		$this->load->helper('admin');
		
		//如果没有经登录, 就跳转到admin/login登陆页
		if (!has_login())
		{
			goto_login();
		}
		
		$this->staff_info = get_staff_info();
		//检查权限.
		if(!check_role(array(GROUP_ADMIN), $this->staff_info['group_id']))
		{
			show_access_deny_page();
		}
	}
	
	function index()
	{
		$this->inbox("page=1&is_deleted=0");
	}
	
	function inbox($filter_string = "page=1&is_deleted=0")
	{
		$this->_get_messages($filter_string, 'inbox');
	}
	
	function trash($filter_string = "page=1&is_deleted=1")
	{
		$this->_get_messages($filter_string, 'trash');
	}
	
	function all($filter_string = "page=1")
	{
		$this->_get_messages($filter_string, 'all');
	}
		
	function one($message_id)
	{
		$message_id = intval($message_id);
		if($message_id <= 0)
		{
			show_error_page('您输入的留言ID不合法, 请返回重试.', 'admin/guestbook');
			return false;
		}
		
		$message_info = $this->Guestbook_model->getOneMessage($message_id);
		
		if(empty($message_info))
		{
			show_error_page('您所查询的留言簿存在, 请返回重试.', 'admin/guestbook');
			return false;
		}
		
		//更新信息状态
		if($message_info['is_new'] == 1)
		{
			//Update message to old
			$set = array('is_new' => 0);
			$this->Guestbook_model->updataMessage($message_id, $set);
		}
		
		$data['header']['meta_title'] = '留言管理 - 留言详情';
		$data['main']['message_info'] = $message_info;
		_load_viewer($this->staff_info['group_id'], 'guestbook_one', $data);
	}	
	
	function unavailable($message_id = 0)
	{
		$this->_update_available($message_id, 1);
	}
	
	function available($message_id = 0)
	{
		$this->_update_available($message_id, 0);
	}
	
	function _update_available($message_id, $to_available)
	{
		$message_id = intval($message_id);
		if($message_id <= 0)
		{
			show_error_page('您输入的留言ID不合法, 请返回重试.', 'admin/guestbook');
			return false;
		}
		
		$set = array('is_deleted' => $to_available);
		if($this->Guestbook_model->updataMessage($message_id, $set))
		{
			$notify = '操作已成功!';
			show_result_page($notify, '');
		}
		else
		{
			$notify = '操作失败, 请重试.';
			show_error_page($notify, '');
		}
	}
	
	function _get_messages($filter_string = '', $base_url_method = 'inbox')
	{
		//默认值
		$filter['page'] = 1;
		$filter['is_new'] = 2;
		$filter['is_deleted'] = 2;
		
		$filter = $this->_parse_filter($filter_string, $filter);
		
		//Page Nav
		$total = $this->Guestbook_model->getAll_count($filter);
		$page_nav = page_nav($total, GUESTBOOK_MESSAGE_PER_PAGE, $filter['page']);
		$page_nav['base_url'] = 'admin/guestbook/'.$base_url_method;
		$page_nav['filter'] = $filter;
		$data['main']['page_nav'] = $this->load->view('admin/common_page_nav', $page_nav, true);
		
		//Get all available messages
		$messages = $this->Guestbook_model->getAll($filter, $page_nav['start'], GUESTBOOK_MESSAGE_PER_PAGE);
		
		switch($base_url_method)
		{
			case 'inbox':
				$page_name = '查看留言';
				break;
			case 'trash':
				$page_name= '废件箱';
				break;
			case 'all':
				$page_name= '查看全部留言';
				break;
			default:
				$page_name = '';
				break;
		}
		$data['header']['meta_title'] = '留言管理 - '.$page_name;
		$data['main']['page_name'] = $page_name;
		$data['main']['messages'] = $messages;
		_load_viewer($this->staff_info['group_id'], 'guestbook', $data);
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
				case 'is_new':
				case 'is_deleted':
					$input_filter[$key] = intval($input_filter[$key]);
					break;
				case 'name':
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