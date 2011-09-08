<?php
/* 
  测评管理
  admin权限.
 */
class cp extends Controller {

	function cp()
	{
		parent::Controller();
		$this->load->library('session');
		
		$this->load->model('CP_category_model');
		$this->load->model('CP_ceping_model');
		$this->load->model('CP_comment_model');
		
		$this->load->helper('admin');
		$this->load->helper('cp');
			
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
		
		//$this->output->enable_profiler(TRUE);
	}
	
	function index()
	{
		
	}
	
	function comments($filter_string = '')
	{
		//默认值
		$filter['page'] = 1;
		$filter['cat_id'] = $this->input->post('cat_id');
		$filter['status'] = $this->input->post('status');
		$filter['add_time_a'] = $this->input->post('add_time_a');
		$filter['add_time_b'] = $this->input->post('add_time_b');
			
		$filter = $this->_parse_filter($filter_string, $filter);
				
		//Page Nav
		$total = $this->CP_comment_model->all_comments_count($filter);
		$page_nav = page_nav($total, CP_COMMENTS_PER_PAGE, $filter['page']);
		$page_nav['base_url'] = 'admin/cp/comments';
		$page_nav['filter'] = $filter;
		$data['main']['page_nav'] = $this->load->view('admin/common_page_nav', $page_nav, true);
		
		$comments = $this->CP_comment_model->all_comments($filter, $page_nav['start'], CP_COMMENTS_PER_PAGE, 'comment.status, comment.cat_id');
		
		$data['header']['css_file'] = '../calendar.css';
		$data['header']['meta_title'] = '查看评论 - 测评系统管理';
		$data['footer']['js_file'][] = '../calendar.js';
		$data['main']['category'] = $this->CP_ceping_model->get_all();
		$data['main']['filter'] = $filter;
		$data['main']['comments'] = $comments;
		_load_viewer($this->staff_info['group_id'], 'cp_comments', $data);
	}
	
	function comment_review($comment_id)
	{
		//判断staff_id是否合法.
		$comment_id = intval($comment_id);
		if($comment_id <= 0)
		{
			show_error_page('您输入的评论ID不合法, 请返回重试.', 'admin/cp/comments');
			return false;
		}
		
		$comment_info = $this->CP_comment_model->get_one($comment_id);
		if(empty($comment_info))
		{
			show_error_page('您所查询的评论不存在!', 'admin/cp/comments');
			return false;
		}
		
		$update_field['status'] = CP_COMMENT_STATUS_REVIEWED;
		if($this->CP_comment_model->update($comment_id, $update_field))
		{
			show_result_page('评论已经通过审核! ', '');
		}
		else
		{
			show_error_page('操作失败, 请重试.', 'admin/cp/comments');
		}
	}
	
	function comment_delete($comment_id)
	{
		//判断staff_id是否合法.
		$comment_id = intval($comment_id);
		if($comment_id <= 0)
		{
			show_error_page('您输入的评论ID不合法, 请返回重试.', 'admin/cp/comments');
			return false;
		}
		
		$comment_info = $this->CP_comment_model->get_one($comment_id);
		if(empty($comment_info))
		{
			show_error_page('您所查询的评论不存在!', 'admin/cp/comments');
			return false;
		}
		
		if($this->CP_comment_model->delete($comment_id))
		{
			show_result_page('评论已经删除! ', '');
		}
		else
		{
			show_error_page('删除失败, 请重试.', 'admin/cp/comments');
		}
	}
	
	function ceping()
	{
		$data['header']['meta_title'] = '测评 - 测评系统管理';
		$data['main']['cepings'] = $this->CP_ceping_model->get_all();
		_load_viewer($this->staff_info['group_id'], 'cp_ceping', $data);
	}
	
	function ceping_add()
	{
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			$new_ceping['cp_name'] = trim($this->input->post('cp_name'));
			$new_ceping['cat_id'] = intval($this->input->post('cat_id'));
			$new_ceping['cp_des'] = trim($this->input->post('cp_des'));
			
			if($new_ceping['cp_name'] == FAlSE || $new_ceping['cat_id'] == FAlSE || $new_ceping['cp_des'] == FAlSE)
			{
				$notify = '请填写完整信息!';
				$this->_load_ceping_add_view($notify, $new_ceping);
			}
			else
			{
				//add into DB
				if($this->CP_ceping_model->add($new_ceping))
				{
					show_result_page('测评已经添加成功! ', 'admin/cp/ceping');
				}
				else
				{
					$notify = '测评添加失败, 请重试.';
					$this->_load_ceping_add_view($notify, $new_ceping);
				}
			}
		}
		else
		{
			$this->_load_ceping_add_view();
		}
	}
	
	function ceping_edit($cp_id = 0)
	{
		//判断 cp_id 是否合法.
		$cp_id = (empty($cp_id))? intval($this->input->post('cp_id')) : intval($cp_id);
		if($cp_id <= 0)
		{
			show_error_page('您输入的测评ID不合法, 请返回重试.', 'admin/cp/ceping');
			return false;
		}
		
		//获取 ceping 信息.
		$ceping_info = $this->CP_ceping_model->get_one($cp_id);
		
		//检查权限
		if(empty($ceping_info))
		{
			show_error_page('您所查询的测评不存在!', 'admin/cp/ceping');
			return false;
		}
		
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			$edit_ceping['cp_name'] = trim($this->input->post('cp_name'));
			$edit_ceping['cat_id'] = intval($this->input->post('cat_id'));
			$edit_ceping['cp_des'] = trim($this->input->post('cp_des'));
						
			//检查修改项
			$update_field = array();
			foreach($edit_ceping as $key => $val)
			{	
				if(!empty($val) && ($val != $ceping_info[$key]))
				{
					$update_field[$key] = $val;
				}
			}
			
			if($this->CP_ceping_model->update($cp_id, $update_field))
			{
				show_result_page('测评已经更新成功! ', 'admin/cp/ceping');
			}
			else
			{
				$notify = '更新失败, 请重试.';
				$this->_load_ceping_edit_view($notify, $ceping_info);
			}
		}
		else
		{
			$this->_load_ceping_edit_view('', $ceping_info);
		}
	}
	
	function category()
	{
		$data['header']['meta_title'] = '测评分类 - 测评系统管理';
		$data['main']['categories'] = $this->CP_category_model->get_all_category();
		_load_viewer($this->staff_info['group_id'], 'cp_category', $data);
	}
	
	function category_add()
	{
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			$new_category['cat_name'] = trim($this->input->post('cat_name'));
			$new_category['star'] = floatval($this->input->post('star'));
			$new_category['price_advanced'] = floatval($this->input->post('price_advanced'));
			$new_category['price_luxury'] = floatval($this->input->post('price_luxury'));
			$new_category['des_advanced'] = trim($this->input->post('des_advanced'));
			$new_category['des_luxury'] = trim($this->input->post('des_luxury'));
			
			if($new_category['cat_name'] == FAlSE || $new_category['star'] == FAlSE || $new_category['price_advanced'] == FAlSE || $new_category['price_luxury'] == FAlSE || $new_category['des_advanced'] == FAlSE || $new_category['des_luxury'] == FAlSE)
			{
				$notify = '请填写完整信息!';
				$this->_load_category_add_view($notify, $new_category);
			}
			else
			{
				//add into DB
				if($this->CP_category_model->add($new_category))
				{
					show_result_page('分类已经添加成功! ', 'admin/cp/category');
				}
				else
				{
					$notify = '分类添加失败, 请重试.';
					$this->_load_category_add_view($notify, $new_category);
				}
			}
		}
		else
		{
			$this->_load_category_add_view();
		}
	}
	
	
	function category_edit($category_id = 0)
	{
		//判断 category_id 是否合法.
		$category_id = (empty($category_id))? intval($this->input->post('category_id')) : intval($category_id);
		if($category_id <= 0)
		{
			show_error_page('您输入的测评分类ID不合法, 请返回重试.', 'admin/cp/category');
			return false;
		}
		
		//获取 category 信息.
		$category_info = $this->CP_category_model->get_one($category_id);
		
		//检查权限
		if(empty($category_info))
		{
			show_error_page('您所查询的分类不存在!', 'admin/cp/category');
			return false;
		}
		
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			$edit_category['cat_name'] = trim($this->input->post('cat_name'));
			$edit_category['star'] = floatval($this->input->post('star'));
			$edit_category['price_advanced'] = floatval($this->input->post('price_advanced'));
			$edit_category['price_luxury'] = floatval($this->input->post('price_luxury'));
			$edit_category['des_advanced'] = trim($this->input->post('des_advanced'));
			$edit_category['des_luxury'] = trim($this->input->post('des_luxury'));
						
			//检查修改项
			$update_field = array();
			foreach($edit_category as $key => $val)
			{	
				if(!empty($val) && ($val != $category_info[$key]))
				{
					$update_field[$key] = $val;
				}
			}
			
			if($this->CP_category_model->update($category_id, $update_field))
			{
				show_result_page('分类已经更新成功! ', 'admin/cp/category');
			}
			else
			{
				$notify = '更新失败, 请重试.';
				$this->_load_category_edit_view($notify, $category_info);
			}
		}
		else
		{
			$this->_load_category_edit_view('', $category_info);
		}
	}
	
	function _load_ceping_add_view($notify = '', $ceping = array())
	{
		$data['header']['meta_title'] = '增加测评 - 咨询系统管理';
		$data['main']['notification'] = $notify;
		$data['main']['category'] = $this->CP_category_model->get_all_category();
		$data['main']['ceping'] = $ceping;
		_load_viewer($this->staff_info['group_id'], 'cp_ceping_add', $data);
	}
	
	function _load_ceping_edit_view($notify = '', $ceping = array())
	{
		$data['header']['meta_title'] = '编辑测评分类 - 咨询系统管理';
		$data['main']['notification'] = $notify;
		$data['main']['category'] = $this->CP_category_model->get_all_category();
		$data['main']['ceping'] = $ceping;
		_load_viewer($this->staff_info['group_id'], 'cp_ceping_edit', $data);
	}
	
	function _load_category_add_view($notify = '', $category = array())
	{
		$data['header']['meta_title'] = '增加测评分类 - 咨询系统管理';
		$data['main']['notification'] = $notify;
		$data['main']['category'] = $category;
		_load_viewer($this->staff_info['group_id'], 'cp_category_add', $data);
	}
	
	function _load_category_edit_view($notify = '', $category = array())
	{
		$data['header']['meta_title'] = '编辑测评分类 - 咨询系统管理';
		$data['main']['notification'] = $notify;
		$data['main']['category'] = $category;
		_load_viewer($this->staff_info['group_id'], 'cp_category_edit', $data);
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
				case 'add_time_a':
				case 'add_time_b':
					if(!check_valid_date($input_filter[$key]))
						continue;
					$filter[$key] = $input_filter[$key];
					break;
				case 'page':
				case 'cat_id':
				case 'status':
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