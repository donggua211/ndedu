<?php

class ArticleCat extends Controller {

	function ArticleCat()
	{
		parent::Controller();

		$this->load->library('session');
		
		if (!$this->session->userdata("adminuser"))
		{
			redirect("admin/admin/login");
		}
		
		$this->load->model('ArticleCat_model');

		$this->load->helper('language');
		
		//$this->output->enable_profiler(TRUE);
	}

	function index()
	{
		$this->all();
	}
	
	function all()
	{
		//Get all messages
		$data["catetories"] = $this->ArticleCat_model->getAllCategories();
		
		$this->load->view('admin/article_cat', $data);
	}
	
	function add()
	{
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			$new_category['cat_name'] = $this->input->post('name');
			$new_category['cat_desc'] = $this->input->post('description');
					
			if($new_category['cat_name'] == FAlSE || $new_category['cat_desc'] == FAlSE)
			{
				$data['notification'] = 'category_field_empty,';
				$data['notification'] .= $new_category['cat_name']? '' : 'name'. ',';
				$data['notification'] .= $new_category['cat_desc']? '' : 'description'. ',';
				$data['notification'] = trim($data['notification'], ' ,');
				
				$categories = $this->ArticleCat_model->getAllCategories();
				if(!empty($categories))
					$data['parrent_cat'] = $categories['parrent_cat'];
				else
					$data['parrent_cat'] = array();
			
				$data["catetory"] = $new_category;
				$data["action"] = 'add';
				
				$this->load->view('admin/article_cat_edit', $data);
			}
			else
			{
				$new_category['add_time'] = time();
				$type = $this->input->post('type');
				
				if($type == 'sub')
				{
					$parent = $this->input->post('parent');
					if($parent == FALSE)
					{
						$new_category['parent_id'] = 0;
					}
					else
					{
						$new_category['parent_id'] = $parent;
					}
				}
				else
				{
					$new_category['parent_id'] = 0;
				}
				
				if($this->ArticleCat_model->addCategory($new_category))
				{
					$data['notification'] = 'category_successful';
				}
				else
				{
					$data['notification'] = 'category_failed';
				}

				$data['page'] = 'admin/articleCat';
				$this->load->view('admin/result', $data);
			
			}
		}
		else
		{
			$data["catetories"] = $this->ArticleCat_model->getAllCategories();
			$this->load->view('admin/article_cat_add', $data);
		}
		
	}

	function unavailable($cat_id = 0)
	{
		$data = array('is_deleted' => 1, 'modified_time'=> time());
		
		$category_info = $this->ArticleCat_model->getOneCategory($cat_id);
		
		$update_cat_ids = array();
		
		if($category_info['parent_id'] == 0)
			$update_cat_ids = $this->getSubCategory($cat_id);
		
		$update_cat_ids[] = $cat_id;

		$this->ArticleCat_model->updataCategory($update_cat_ids, $data);
		
		redirect('/admin/articleCat/all', 'refresh');
	}
	
	function available($cat_id = 0)
	{
		$data = array('is_deleted' => 0, 'modified_time'=> time());
		
		$category_info = $this->ArticleCat_model->getOneCategory($cat_id);
		
		$update_cat_ids = array();
		
		if($category_info['parent_id'] == 0)
			$update_cat_ids = $this->getSubCategory($cat_id);
		
		$update_cat_ids[] = $cat_id;
		
		$this->ArticleCat_model->updataCategory($update_cat_ids, $data);
		
		redirect('/admin/articleCat/all', 'refresh');
	}
	
	function delete($cat_id = 0)
	{
		$category_info = $this->ArticleCat_model->getOneCategory($cat_id);
		
		$delete_cat_ids = array();
		
		if($category_info['parent_id'] == 0)
			$delete_cat_ids = $this->getSubCategory($cat_id);
		
		$delete_cat_ids[] = $cat_id;
		
		$this->ArticleCat_model->deleteCategory($delete_cat_ids);	
		
		redirect('/admin/articleCat/all', 'refresh');
	}
	
	function edit($cat_id = 0)
	{
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			$edit_category['cat_name'] = $this->input->post('name');
			$edit_category['cat_desc'] = $this->input->post('description');
					
			if($edit_category['cat_name'] == FAlSE || $edit_category['cat_desc'] == FAlSE)
			{
				$data['notification'] = 'category_field_empty,';
				$data['notification'] .= $edit_category['cat_name']? '' : 'name'. ',';
				$data['notification'] .= $edit_category['cat_desc']? '' : 'description'. ',';
				$data['notification'] = trim($data['notification'], ' ,');
				
				$categories = $this->ArticleCat_model->getAllCategories();
				$data['parrent_cat'] = $categories['parrent_cat'];
			
				$data["catetory"] = $edit_category;
				$data["action"] = 'edit/'.$cat_id;
				
				$this->load->view('admin/article_cat_edit', $data);
			}
			else
			{
				$category_info = $this->ArticleCat_model->getOneCategory($cat_id);
				
				$edit_category['modified_time'] = time();
				$type = $this->input->post('type');
				
				if($type == 'sub')
				{
					$parent = $this->input->post('parent');
					if($parent == FALSE)
					{
						$edit_category['parent_id'] = 0;
					}
					else
					{
						$edit_category['parent_id'] = $parent;
					}
				}
				else
				{
					$edit_category['parent_id'] = 0;
				}
				
				
				$cat_ids = $this->getSubCategory($cat_id);
				
				if($this->ArticleCat_model->updataCategory($cat_id, $edit_category))
				{
				
					if($category_info['parent_id'] == 0 && $edit_category['parent_id'] != 0)
					{
						$edit_cat_ids = array();
						$edit_cat_ids = $this->getSubCategory($cat_id);
						if(!empty($edit_cat_ids))
						{
							$where = array('parent_id' => $edit_category['parent_id'], 'modified_time'=> time());

							$this->ArticleCat_model->updataCategory($edit_cat_ids, $where);	
						}
					}
					
					$data['notification'] = 'category_edit_successful';
				}
				else
				{
					$data['notification'] = 'category_edit_failed';

				}
				$data['page'] = 'admin/articleCat';
				$this->load->view('admin/result', $data);
			}	
		}
		else
		{
			$categories = $this->ArticleCat_model->getAllCategories();
			$data['parrent_cat'] = $categories['parrent_cat'];
		
			$data["catetory"] = $this->ArticleCat_model->getOneCategory($cat_id);
			
			$data["action"] = 'edit/'.$cat_id;
			
			$this->load->view('admin/article_cat_edit', $data);		
		}
	}
	
	function getSubCategory($cat_id)
	{
		return $this->ArticleCat_model->getSubCategoris($cat_id);
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */