<?php
/* 
  文章管理
  admin权限.
 */
class Article extends Controller {

	function Article()
	{
		parent::Controller();
		$this->load->library('session');
		$this->load->model('Article_model');
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
		$articles = $this->Article_model->getArticle('public');
		
		$data['header']['meta_title'] = '所有分类 - 咨询系统管理';
		$data['main']['articles'] = $articles;
		$data['main']['page_name'] = '查看文章';
		_load_viewer($this->staff_info['group_id'], 'articles', $data);
	}
	
	function draft()
	{
		$articles = $this->Article_model->getArticle('draft');
		
		$data['header']['meta_title'] = '草稿箱 - 咨询系统管理';
		$data['main']['articles'] = $articles;
		$data['main']['page_name'] = '草稿箱';
		_load_viewer($this->staff_info['group_id'], 'articles', $data);
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
				$data['notification'] = '请填写：';
				$data['notification'] .= $new_article['title']? '' : '标题, '. '';
				$data['notification'] .= $new_article['catagory']? '' : '分类, '. ',';
				$data['notification'] .= $new_article['content']? '' : '内容, '. ',';
				$data['notification'] = trim($data['notification'], ' ,');
				
				$tags = $this->Tags_model->getAllTags();
				$data['tags'] = $tags;
				$categories_list = $this->Article_model->getCategoriesList();
				$data['categories_list'] = $categories_list;
				$data["article"] = $new_article;				
				$this->load->view('admin/admin/article_add', $data);
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
						$data['notification'] = '<font color="red">上传图片失败</font>';
					}
					else
					{
						$image_info = $this->upload->data();
						$new_article['image_url'] = $image_info['file_name'];
						$new_article['image_align'] = $this->input->post('image_align');
					}
				}
				
				$article_id = $this->Article_model->addArticle($new_article);
				if($article_id != FALSE)
				{
					$tags = $this->input->post('tags');
					$this->Tags_model->addArtileTag($article_id, $tags);
					$data['notification'] = '分类添加成功!';
				}
				else
				{
					$data['notification'] = '分类添加失败！请重试';
				}
				show_result_page($data['notification'], 'admin/article');
			}
		}
		else
		{
			$tags = $this->Tags_model->getAllTags();
			$data['tags'] = $tags;
			$categories_list = $this->Article_model->getCategoriesList();
			$data['categories_list'] = $categories_list;
			
			$this->load->view('admin/admin/article_add', $data);		
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
				$data['notification'] = '请填写：';
				$data['notification'] .= $edit_article['title']? '' : '标题, '. '';
				$data['notification'] .= $edit_article['catagory']? '' : '分类, '. ',';
				$data['notification'] .= $edit_article['content']? '' : '内容, '. ',';
				$data['notification'] = trim($data['notification'], ' ,');
				
				$categories_list = $this->Article_model->getCategoriesList();
				$data['categories_list'] = $categories_list;
				$data["article"] = $edit_article;				
				$this->load->view('admin/admin/article_add', $data);
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
						$data['notification'][] = '<font color="red">上传图片失败</font>';
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
				show_result_page($data['notification'], 'admin/article');
				
			}
		}
		else
		{
			$categories_list = $this->Article_model->getCategoriesList();
			$data['categories_list'] = $categories_list;
			
			$artcle_info = $this->Article_model->getOneArticle($article_id);
			$data['artcle_info'] = $artcle_info;
			
			$this->load->view('admin/admin/article_edit', $data);		
		}
	
	}
	
	function one($article_id)
	{
		$data['article'] = $this->Article_model->getOneArticle($article_id);
		$this->load->view('admin/admin/article', $data);			
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */