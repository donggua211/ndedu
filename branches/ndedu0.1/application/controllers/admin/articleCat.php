<?php
/* 
  文章分类管理
  admin权限.
 */
class ArticleCat extends Controller {

	function ArticleCat()
	{
		parent::Controller();
		$this->load->library('session');
		$this->load->model('ArticleCat_model');
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
		$this->all();
	}
	
	function all()
	{
		$data['header']['meta_title'] = '所有分类 - 咨询系统管理';
		$data['main']['categories'] = $this->ArticleCat_model->get_all_category();
		_load_viewer($this->staff_info['group_id'], 'article_cat', $data);
	}
	
	function add()
	{
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			$new_category['cat_name'] = $this->input->post('name');
			$new_category['cat_desc'] = $this->input->post('description');
			$new_category['parent_id'] = intval($this->input->post('parent_id'));
			$new_category['add_time'] = time();
			
			if($new_category['cat_name'] == FAlSE || $new_category['cat_desc'] == FAlSE)
			{
				$notify = '分类名称或者分类描述不能为空.';
				$this->_load_category_add_view($notify, $new_category);
			}
			else
			{
				if($this->ArticleCat_model->addCategory($new_category))
				{
					show_result_page('分类已经添加成功! ', 'admin/ArticleCat');
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

	function unavailable($cat_id = 0)
	{
		//判断document_id是否合法.
		$cat_id = intval($cat_id);
		if($cat_id <= 0)
		{
			show_error_page('您输入的分类ID不合法, 请返回重试.', 'admin/articleCat');
			return false;
		}
		
		$data = array('is_deleted' => 1, 'modified_time'=> time());
		if($this->ArticleCat_model->updataCategory($cat_id, $data))
		{
			$notify = '分类已经成功被删除!';
			show_result_page($notify, 'admin/articleCat');
		}
		else
		{
			$notify = '删除失败, 请重试.';
			show_error_page($notify, 'admin/articleCat');
		}
	}
	
	function available($cat_id = 0)
	{
		//判断document_id是否合法.
		$cat_id = intval($cat_id);
		if($cat_id <= 0)
		{
			show_error_page('您输入的分类ID不合法, 请返回重试.', 'admin/articleCat');
			return false;
		}
		
		$data = array('is_deleted' => 0, 'modified_time'=> time());
		if($this->ArticleCat_model->updataCategory($cat_id, $data))
		{
			$notify = '分类已经成功被删除!';
			show_result_page($notify, 'admin/articleCat');
		}
		else
		{
			$notify = '删除失败, 请重试.';
			show_error_page($notify, 'admin/articleCat');
		}
	}
	
	function edit($cat_id = 0)
	{
		//判断cat_id是否合法.
		$cat_id = (empty($cat_id))? $this->input->post('cat_id') : intval($cat_id);
		if($cat_id <= 0)
		{
			show_error_page('您输入的文档ID不合法, 请返回重试.', 'admin/articleCat');
			return false;
		}
		
		//获取staff 信息.
		$catetory_info = $this->ArticleCat_model->getOneCategory($cat_id);
		
		//检查权限
		if(empty($catetory_info))
		{
			show_error_page('您所编辑的文类不存在!', 'admin/articleCat');
			return false;
		}
		
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			$edit_category['cat_name'] = $this->input->post('name');
			$edit_category['cat_desc'] = $this->input->post('description');
			$edit_category['parent_id'] = intval($this->input->post('parent_id'));
			
			//检查修改项
			$update_field = array();
			foreach($edit_category as $key => $val)
			{
				if(!empty($val) && ($val != $catetory_info[$key]))
					$update_field[$key] = $val;
			}
			
			if($this->ArticleCat_model->updataCategory($cat_id, $update_field))
			{
				show_result_page('分类已经更新成功! ', 'admin/articleCat');
			}
			else
			{
				$notify = '更新失败, 请重试.';
				$this->_load_category_edit_view($notify, $catetory_info);
			}	
		}
		else
		{
			$this->_load_category_edit_view('', $catetory_info);
		}
	}
	
	function _load_category_edit_view($notify = '', $category = array())
	{
		$data['header']['meta_title'] = $category['cat_name'].' - 修改分类 - 分类管理';
		$data['main']['notification'] = $notify;
		$data['main']['categories'] = $this->ArticleCat_model->get_all_category();
		$data['main']['category'] = $category;
		_load_viewer($this->staff_info['group_id'], 'article_cat_edit', $data);
	}
	
	function _load_category_add_view($notify = '', $category = array())
	{
		$data['header']['meta_title'] = '增加分类 - 分类管理';
		$data['main']['notification'] = $notify;
		$data['main']['categories'] = $this->ArticleCat_model->get_all_category();
		$data['main']['category'] = $category;
		_load_viewer($this->staff_info['group_id'], 'article_cat_add', $data);
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */