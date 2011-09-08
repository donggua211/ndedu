<?php

class Article extends Controller {

	function Article()
	{
		parent::Controller();

		$this->load->library('session');
		
		if (!$this->session->userdata("adminuser"))
		{
			redirect("admin/admin/login");
		}
		
		$this->load->model('Article_model');

		$this->load->helper('language');
		
		//$this->output->enable_profiler(TRUE);
	}
	
	function index()
	{
		$articles = $this->Article_model->getArticle('public');
		$data["articles"] = $articles;				
		$this->load->view('admin/articles', $data);
	}
	
	function draft()
	{
		$articles = $this->Article_model->getArticle('draft');
		$data["articles"] = $articles;				
		$this->load->view('admin/articles', $data);
	}
	
	
	function unavailable($article_id = 0)
	{
		$set = array('is_deleted' => 1);
		$this->Article_model->updataMessage($article_id, $set);
		redirect('/admin/article/index', 'refresh');
	}
	
	function available($article_id = 0)
	{
		$set = array('is_deleted' => 0);
		$this->Article_model->updataMessage($article_id, $set);
		redirect('/admin/article/index', 'refresh');
	}
	
	function delete($article_id = 0)
	{
		$this->Article_model->deleteMessage($article_id);	
		redirect('/admin/article/index', 'refresh');
	}
	
	function add()
	{
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			$new_article['title'] = $this->input->post('title');
			$new_article['catagory'] = $this->input->post('catagory');
			$new_article['content'] = $this->input->post('content');
			$new_article['keywords'] = $this->input->post('keywords');
			$new_article['short_description'] = $this->input->post('short_description');
			$new_article['short_description_img'] = $this->input->post('short_description_img');
			$new_article['image_align'] = '';
			
			if($new_article['title'] == FAlSE || $new_article['catagory'] === FAlSE || $new_article['content'] == FAlSE)
			{
				$data['notification'] = 'article_field_empty,';
				$data['notification'] .= $new_article['title']? '' : 'title'. ',';
				$data['notification'] .= $new_article['catagory']? '' : 'catagory'. ',';
				$data['notification'] .= $new_article['content']? '' : 'content'. ',';
				$data['notification'] = trim($data['notification'], ' ,');
				
				$categories_list = $this->Article_model->getCategoriesList();
				$data['categories_list'] = $categories_list;
				$data["article"] = $new_article;				
				$this->load->view('admin/article_add', $data);
			}
			else
			{
				$new_article['add_time'] = time();
				$new_article['is_open'] = $this->input->post('draft')? '0' : '1';
				$new_article['image_url'] = '';
				$new_article['image_align'] = '';
				
				if (isset($_FILES['image']))
				{
					//Upload Image
					$config['upload_path'] = './images/uploads/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size'] = '500';
					$config['max_width']  = '1024';
					$config['max_height']  = '1024';
					$config['file_name']  = time();
					$this->load->library('upload', $config);
					if ( ! $this->upload->do_upload('image'))
					{
						$error = array('error' => $this->upload->display_errors());
						$data['notification'][] = 'upload_file_failed';
					}
					else
					{
						$image_info = $this->upload->data();
						$new_article['image_url'] = $image_info['file_name'];
						$new_article['image_align'] = $this->input->post('image_align');
					}
				}

				if($this->Article_model->addArticle($new_article))
				{
					$data['notification'] = 'category_successful';
				}
				else
				{
					$data['notification'] = 'category_failed';
				}

				$data['page'] = 'admin/article';
				$this->load->view('admin/result', $data);
				
			}
		}
		else
		{
			$categories_list = $this->Article_model->getCategoriesList();
			$data['categories_list'] = $categories_list;
			
			$this->load->view('admin/article_add', $data);		
		}
	}
	
	function edit($article_id)
	{
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			$edit_article['title'] = $this->input->post('title');
			$edit_article['catagory'] = $this->input->post('catagory');
			$edit_article['content'] = $this->input->post('content');
			$edit_article['keywords'] = $this->input->post('keywords');
			$edit_article['short_description'] = $this->input->post('short_description');
			$edit_article['short_description_img'] = $this->input->post('short_description_img');
					
			if($edit_article['title'] == FAlSE || $edit_article['catagory'] === FAlSE || $edit_article['content'] == FAlSE)
			{
				$data['notification'] = 'article_field_empty,';
				$data['notification'] .= $edit_article['title']? '' : 'title'. ',';
				$data['notification'] .= $edit_article['catagory']? '' : 'catagory'. ',';
				$data['notification'] .= $edit_article['content']? '' : 'content'. ',';
				$data['notification'] = trim($data['notification'], ' ,');
				
				$categories_list = $this->Article_model->getCategoriesList();
				$data['categories_list'] = $categories_list;
				$data["article"] = $edit_article;				
				$this->load->view('admin/article_add', $data);
			}
			else
			{
				$edit_article['modified_time'] = time();
				$edit_article['is_open'] = $this->input->post('draft')? '0' : '1';
				
				
				
				if (isset($_FILES['image']))
				{
					//Upload Image
					$config['upload_path'] = './images/uploads/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size'] = '500';
					$config['max_width']  = '1024';
					$config['max_height']  = '1024';
					$config['file_name']  = time();
					$this->load->library('upload', $config);
					if ( ! $this->upload->do_upload('image'))
					{
						$error = array('error' => $this->upload->display_errors());
						$data['notification'][] = 'upload_file_failed';
					}
					else
					{
						$old_article = $this->Article_model->getOneArticle($article_id);
						@unlink(base_url().'/images/uploads/'.$old_article['image_url']);
						$image_info = $this->upload->data();
						$edit_article['image_url'] = $image_info['file_name'];
						$edit_article['image_align'] = $this->input->post('image_align');
					}
				}
				
				
				if($this->Article_model->updateArticle($article_id, $edit_article))
				{
					$data['notification'] = 'category_successful';
				}
				else
				{
					$data['notification'] = 'category_failed';
				}

				$data['page'] = 'admin/article';
				$this->load->view('admin/result', $data);
				
			}
		}
		else
		{
			$categories_list = $this->Article_model->getCategoriesList();
			$data['categories_list'] = $categories_list;
			
			$artcle_info = $this->Article_model->getOneArticle($article_id);
			$data['artcle_info'] = $artcle_info;
			
			$this->load->view('admin/article_edit', $data);		
		}
	
	}
	
	function one($article_id)
	{
		$data['article'] = $this->Article_model->getOneArticle($article_id);
		$this->load->view('admin/article', $data);			
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */