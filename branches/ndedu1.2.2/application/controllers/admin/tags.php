<?php
/* 
  尼德学堂的标签管理
  admin权限.
 */
class Tags extends Controller {

	function Tags()
	{
		parent::Controller();
		$this->load->library('session');
		$this->load->model('Tags_model');
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
		$data['header']['meta_title'] = '查看tag - tag管理';
		$data['main']['tags'] = $this->Tags_model->getAllTags();
		_load_viewer($this->staff_info['group_id'], 'tag', $data);
	}
	
	function add()
	{
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			$new_tag['tag_name'] = $this->input->post('name');
					
			if($new_tag['tag_name'] == FAlSE)
			{
				$notify = 'tag不能为空';
				$this->_load_tag_add_view($notify);
			}
			else
			{
				$new_tag['add_time'] = time();
				
				if($this->Tags_model->addTag($new_tag))
				{
					show_result_page('tag添加成功! ', 'admin/tags');
				}
				else
				{
					$notify = 'tag添加失败, 请稍后再试';
					$this->_load_category_add_view($notify, $new_tag);
				}			
			}
		}
		else
		{
			$this->_load_tag_add_view();
		}
	}
	
	function edit($tag_id = 0)
	{
		//判断cat_id是否合法.
		$tag_id = (empty($tag_id))? $this->input->post('tag_id') : intval($tag_id);
		if($tag_id <= 0)
		{
			show_error_page('您输入的tag ID不合法, 请返回重试.', 'admin/tags');
			return false;
		}
		
		//获取tag 信息.
		$tag_info = $this->Tags_model->get_one($tag_id);
		
		//检查权限
		if(empty($tag_info))
		{
			show_error_page('您所编辑的tag不存在!', 'admin/tags');
			return false;
		}
		
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			$edit_tag['tag_name'] = $this->input->post('name');
			
			//检查修改项
			$update_field = array();
			foreach($edit_tag as $key => $val)
			{
				if(!empty($val) && ($val != $tag_info[$key]))
					$update_field[$key] = $val;
			}
			
			if($this->Tags_model->update($tag_id, $update_field))
			{
				show_result_page('tag已经更新成功! ', 'admin/tags');
			}
			else
			{
				$notify = '更新失败, 请重试.';
				$this->_load_tag_edit_view($notify, $tag_info);
			}	
		}
		else
		{
			$this->_load_tag_edit_view('', $tag_info);
		}
	}
	
	function delete($tag_id)
	{
		//判断staff_id是否合法.
		$tag_id = intval($tag_id);
		if($tag_id <= 0)
		{
			show_error_page('您输入的tag ID不合法, 请返回重试.', 'admin/tags');
			return false;
		}
		
		if($this->Tags_model->delete($tag_id))
		{
			show_result_page('tag已经添加删除! ', '');
		}
		else
		{
			show_error_page('删除失败, 请重试.', 'admin/tags');
		}
	}
	
	function _load_tag_add_view($notify = '', $tag = array())
	{
		$data['header']['meta_title'] = '增加tag - tag管理';
		$data['main']['notification'] = $notify;
		$data['main']['tag'] = $tag;
		_load_viewer($this->staff_info['group_id'], 'tag_add', $data);
	}
	
	function _load_tag_edit_view($notify = '', $tag = array())
	{
		$data['header']['meta_title'] = '编辑tag - tag管理';
		$data['main']['notification'] = $notify;
		$data['main']['tag'] = $tag;
		_load_viewer($this->staff_info['group_id'], 'tag_edit', $data);
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */