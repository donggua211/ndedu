<?php
/* 
  文章管理
  admin权限.
 */
class Ics extends Controller {

	function Ics()
	{
		parent::Controller();
		$this->load->library('session');
		$this->load->model('ICS_Document_model');
		$this->load->model('ICS_Category_model');
		$this->load->model('ICS_Source_model');
		$this->load->model('ICS_Grade_model');
		$this->load->model('CRM_Staff_model');
		$this->load->helper('ics');
		$this->load->helper('admin');
		
		$this->allowed_group = array(1);
		
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
	
	function index($filter_string = '')
	{
		//默认参数
		$is_delete = 0;
		
		//get page 参数
		$input_filter = parse_filter($filter_string);
		if(!isset($input_filter['page']) || empty($input_filter['page']))
			$filter['page'] = 1;
		else
			$filter['page'] = intval($input_filter['page']);
		
		//Page Nav
		$total = $this->ICS_Document_model->getAll_count($is_delete);
		$page_nav = page_nav($total, DOCUMENT_PER_PAGE, $filter['page']);
		$page_nav['base_url'] = 'admin/ics/index';
		$page_nav['filter'] = $filter;
		$data['main']['page_nav'] = $this->load->view('admin/common_page_nav', $page_nav, true);
		
		$data['header']['meta_title'] = '所有文档 - 咨询系统管理';
		$data['main']['documents'] = $this->ICS_Document_model->getAll($is_delete, $page_nav['start'], DOCUMENT_PER_PAGE);
		_load_viewer($this->staff_info['group_id'], 'ics_document_all', $data);
	}
	
	function category_add()
	{
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			$new_category['name'] = trim($this->input->post('name'));
			$new_category['parent'] = intval($this->input->post('parent'));
			$new_category['order'] = intval($this->input->post('order'));
			
			if($new_category['name'] == FAlSE)
			{
				$notify = '请填写分类名称!';
				$this->_load_category_add_view($notify, $new_category);
			}
			else
			{
				//add into DB
				if($this->ICS_Category_model->add($new_category))
				{
					show_result_page('分类已经添加成功! ', 'admin/ics/category');
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
	
	function category()
	{
		$data['header']['meta_title'] = '所有分类 - 咨询系统管理';
		$data['main']['categories'] = $this->ICS_Category_model->get_all_category();
		_load_viewer($this->staff_info['group_id'], 'ics_category', $data);	
	}
	
	
	function category_edit($category_id = 0)
	{
		//判断document_id是否合法.
		$category_id = (empty($category_id))? intval($this->input->post('category_id')) : intval($category_id);
		if($category_id <= 0)
		{
			show_error_page('您输入的文档ID不合法, 请返回重试.', 'admin/ics');
			return false;
		}
		
		//获取staff 信息.
		$category_info = $this->ICS_Category_model->get_one($category_id);
		
		//检查权限
		if(empty($category_info))
		{
			show_error_page('您所查询的分类不存在!', 'admin/ics');
			return false;
		}
		
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			$edit_category['category_name'] = trim($this->input->post('name'));
			$edit_category['parent_id'] = intval($this->input->post('parent'));
			$edit_category['order'] = intval($this->input->post('order'));
			
			//检查修改项
			$update_field = array();
			foreach($edit_category as $key => $val)
			{	
				if($key == 'parent_id')
				{
					if(($val != $category_info[$key]) && ($val != $category_id))
						$update_field[$key] = $val;
					
					continue;
				}
				
				if(!empty($val) && ($val != $category_info[$key]))
				{
					$update_field[$key] = $val;
				}
			}
			
			if($this->ICS_Category_model->update($category_id, $update_field))
			{
				show_result_page('分类已经更新成功! ', 'admin/ics/category');
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
	
	function category_delete($category_id)
	{
		//判断document_id是否合法.
		$category_id = intval($category_id);
		if($category_id <= 0)
		{
			show_error_page('您输入的分类ID不合法, 请返回重试.', 'admin/ics/category');
			return false;
		}
		
		if($this->ICS_Category_model->delete($category_id))
		{
			$notify = '分类已经成功被删除!';
			show_result_page($notify, 'admin/ics/category');
		}
		else
		{
			$notify = '删除失败, 请重试.';
			show_error_page($notify, 'admin/ics/category');
		}	
	}
	
	function document_add()
	{
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			$new_document['document'] = $this->input->post('document');
			$new_document['category_id'] = $this->input->post('category_id');
			$new_document['grade_id'] = $this->input->post('grade_id');
			$new_document['staff_id'] = $this->input->post('staff_id');
			
			$new_document['source_id'] = $this->input->post('source_id');
			$new_document['source'] = trim($this->input->post('source'));
			
			$new_document['tags'] = trim($this->input->post('tags'));
						
			if(empty($new_document['document']) || empty($new_document['category_id']) || empty($new_document['grade_id']))
			{
				$notify = '请填写完整信息! ';
				$this->_load_document_add_view($notify, $new_document);
				return false;
			}
			if(empty($new_document['source_id']) && (empty($new_document['source'])))
			{
				$notify = '请填写来源! ';
				$this->_load_document_add_view($notify, $new_document);
				return false;
			}
			else
			{
				//处理 $new_document['tags'].
				if(!empty($new_document['tags']))
				{
					$tags = explode(' ,', $new_document['tags']);
					$new_document['tags'] = implode(',', $tags);
				}
				
				//处理 $new_document['source']. 是否要新加.
				$source_id = $this->ICS_Source_model->check_exists($new_document['source']);
				if($source_id > 0)
				{
					$new_document['source_id'] = $source_id;
				}
				
				if($this->ICS_Document_model->add($new_document))
				{
					show_result_page('文档已经添加成功! ', 'admin/ics');
				}
				else
				{
					$notify = '失败失败, 请重试.';
					$this->_load_document_add_view($notify, $new_document);
					return false;
				}
				
			}
		}
		else
		{
			$this->_load_document_add_view();
		}
	}
	
	
	function document_edit($document_id = 0)
	{
		//判断document_id是否合法.
		$document_id = (empty($document_id))? $this->input->post('document_id') : intval($document_id);
		if($document_id <= 0)
		{
			show_error_page('您输入的文档ID不合法, 请返回重试.', 'admin/ics');
			return false;
		}
		
		//获取staff 信息.
		$document_info = $this->ICS_Document_model->getOne($document_id);
		
		//检查权限
		if(empty($document_info))
		{
			show_error_page('您所查询的文档不存在!', 'admin/ics');
			return false;
		}
		
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			//必填信息.
			$edit_document['document'] = $this->input->post('document');
			$edit_document['category_id'] = $this->input->post('category_id');
			$edit_document['grade_id'] = $this->input->post('grade_id');
			$edit_document['provider_id'] = $this->input->post('staff_id');
			
			$edit_source['source_id'] = $this->input->post('source_id');
			$edit_source['source'] = trim($this->input->post('source'));
			
			$edit_document['tags'] = trim($this->input->post('tags'));
			
			//检查修改项
			$update_field = array();
			foreach($edit_document as $key => $val)
			{
				if($key == 'tags')
				{
					$tags = explode(' ,', $edit_document['tags']);
					$edit_document['tags'] = implode(',', $tags);
				}
				
				if(!empty($val) && ($val != $document_info[$key]))
					$update_field[$key] = $val;
			}
			
			if($this->ICS_Document_model->update($document_id, $update_field))
			{
				//如果需要更新source表:
				if(!empty($edit_source['source']))
				{
					//处理 $edit_source['source']. 是否要新加.
					$source_id = $this->ICS_Source_model->check_exists($edit_source['source']);
					if($source_id > 0)
					{
						$update_field['source_id'] = $source_id;
					}
					else
					{
						$update_field['source_id'] = $this->ICS_Source_model->add($edit_source['source']);
					}
					$this->ICS_Source_model->update($document_info['source_doc_id'], $update_field);
				}
				elseif(!empty($edit_source['source_id']) && ($edit_source['source_id'] != $document_info['source_id']))
				{
					$update_field['source_id'] = $edit_source['source_id'];
					$this->ICS_Source_model->update($document_info['source_doc_id'], $update_field);
				}
				
				show_result_page('员工已经更新成功! ', 'admin/ics');
			}
			else
			{
				$notify = '更新失败, 请重试.';
				$this->_load_document_edit_view($notify, $document_info);
			}
		}
		else
		{
			$this->_load_document_edit_view('', $document_info);
		}
	}
	
	function document_delete($document_id)
	{
		//判断document_id是否合法.
		$document_id = (empty($document_id))? $this->input->post('document_id') : intval($document_id);
		if($document_id <= 0)
		{
			show_error_page('您输入的文档ID不合法, 请返回重试.', 'admin/ics');
			return false;
		}
		
		$update_field['is_delete'] = 1;
		if($this->ICS_Document_model->update($document_id, $update_field))
		{
			$notify = '文档已经成功被删除!';
			show_result_page($notify, 'admin/ics');
		}
		else
		{
			$notify = '删除失败, 请重试.';
			show_error_page($notify, 'admin/ics');
		}	
	}
	
	function one($article_id)
	{
		$data['article'] = $this->Article_model->getOneArticle($article_id);
		$this->load->view('admin/admin/article', $data);			
	}
	
	function _load_document_add_view($notify = '', $document = array())
	{
		$data['header']['meta_title'] = '增加文档 - 咨询系统管理';
		$data['header']['js_file_header'] = '../ckeditor/ckeditor.js';
		$data['main']['notification'] = $notify;
		$data['main']['categories'] = $this->ICS_Category_model->get_all_category();
		$data['main']['sources'] = $this->ICS_Source_model->get_all_source();
		$data['main']['staffs'] = $this->CRM_Staff_model->get_all_by_group();
		$data['main']['grades'] = $this->ICS_Grade_model->get_all_grade();
		$data['main']['document'] = $document;
		_load_viewer($this->staff_info['group_id'], 'ics_document_add', $data);
	}
	
	function _load_document_edit_view($notify = '', $document = array())
	{
		$data['header']['meta_title'] = '编辑文档 - 咨询系统管理';
		$data['header']['js_file_header'] = '../ckeditor/ckeditor.js';
		$data['main']['notification'] = $notify;
		$data['main']['categories'] = $this->ICS_Category_model->get_all_category();
		$data['main']['sources'] = $this->ICS_Source_model->get_all_source();
		$data['main']['staffs'] = $this->CRM_Staff_model->get_all_by_group();
		$data['main']['grades'] = $this->ICS_Grade_model->get_all_grade();
		$data['main']['document'] = $document;
		_load_viewer($this->staff_info['group_id'], 'ics_document_edit', $data);
	}
	
	function _load_category_add_view($notify = '', $category = array())
	{
		$data['header']['meta_title'] = '增加分类 - 咨询系统管理';
		$data['main']['notification'] = $notify;
		$data['main']['categories'] = $this->ICS_Category_model->get_all_category();
		$data['main']['category'] = $category;
		_load_viewer($this->staff_info['group_id'], 'ics_category_add', $data);
	}
	
	function _load_category_edit_view($notify = '', $category = array())
	{
		$data['header']['meta_title'] = '编辑分类 - 咨询系统管理';
		$data['main']['notification'] = $notify;
		$data['main']['categories'] = $this->ICS_Category_model->get_all_category();
		$data['main']['category'] = $category;
		_load_viewer($this->staff_info['group_id'], 'ics_category_edit', $data);
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */