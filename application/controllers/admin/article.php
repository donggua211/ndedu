<?php
/* 
  文章管理
  admin权限.
 */
class Article extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('Article_model');
		$this->load->helper('admin');
		
		//如果没有经登录, 就跳转到admin/login登陆页
		if (!has_login())
		{
			goto_login();
		}
	}
	
	function index()
	{
		$articles = $this->Article_model->getArticle('public');
		
		$data['header']['meta_title'] = '所有分类 - 咨询系统管理';
		$data['main']['articles'] = $articles;
		$data['main']['page_name'] = '查看文章';
		_load_viewer('articles', $data);
	}
	
	function draft()
	{
		$articles = $this->Article_model->getArticle('draft');
		
		$data['header']['meta_title'] = '草稿箱 - 咨询系统管理';
		$data['main']['articles'] = $articles;
		$data['main']['page_name'] = '草稿箱';
		_load_viewer('articles', $data);
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
			
			if($new_article['title'] == FAlSE || $new_article['catagory'] === FAlSE || $new_article['content'] == FAlSE)
			{
				$notification = '请填写：';
				$notification .= $new_article['title']? '' : '标题, '. '';
				$notification .= $new_article['catagory']? '' : '分类, '. ',';
				$notification .= $new_article['content']? '' : '内容, '. ',';
				$notification = trim($data['notification'], ' ,');
				
				$this->_load_article_add_view($notification, $new_article);
			}
			else
			{
				$new_article['add_time'] = time();
				$new_article['is_open'] = $this->input->post('draft')? '0' : '1';
				
				$article_id = $this->Article_model->addArticle($new_article);
				if($article_id != FALSE)
				{
					$data['notification'] = '文章添加成功!';
				}
				else
				{
					$data['notification'] = '文章添加失败！请重试';
				}
				show_result_page($data['notification'], 'admin/article');
			}
		}
		else
		{
			$this->_load_article_add_view();
		}
	}
	
	function edit($article_id)
	{
		//判断 cp_id 是否合法.
		$article_id = (empty($article_id))? intval($this->input->post('article_id')) : intval($article_id);
		if($cp_id <= 0)
		{
			show_error_page('您输入的测评ID不合法, 请返回重试.', 'admin/cp/ceping');
			return false;
		}
		
		//获取 ceping 信息.
		$artcle_info = $this->Article_model->getOneArticle($article_id);
		
		//检查权限
		if(empty($artcle_info))
		{
			show_error_page('您所查询的 article 不存在!', 'admin/article');
			return false;
		}
		
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			$edit_article['title'] = $this->input->post('title');
			$edit_article['catagory'] = $this->input->post('catagory');
			$edit_article['content'] = $this->input->post('content');
			$edit_article['keywords'] = $this->input->post('keywords');
			$edit_article['is_open'] = $this->input->post('draft')? '0' : '1';
			
			//检查修改项
			$update_field = array();
			foreach($edit_article as $key => $val)
			{	
				if(!empty($val) && ($val != $artcle_info[$key]))
				{
					$update_field[$key] = $val;
				}
			}
			
			if($this->Article_model->updateArticle($article_id, $update_field))
			{
				show_result_page('文章已经更新成功', 'admin/article');
			}
			else
			{
				$notify = '更新失败, 请重试.';
				$this->_load_article_edit_view($notify, $article_id, $artcle_info);
			}
		}
		else
		{
			$this->_load_article_edit_view('', $article_id, $artcle_info);
		}
	}
	
	function one($article_id)
	{
		$data['article'] = $this->Article_model->getOneArticle($article_id);
		$this->load->view('admin/admin/article', $data);			
	}
	
	function _load_article_add_view($notify = '', $article = array())
	{
		$categories_list = $this->Article_model->getCategoriesList();
		$data['main']['categories_list'] = $categories_list;
		$data['main']['article'] = $article;
		
		//$this->load->view('admin/admin/article_add', $data);	
		_load_viewer('article_add', $data);
	}
	
	function _load_article_edit_view($notify = '', $article_id, $artcle_info = array())
	{
		$categories_list = $this->Article_model->getCategoriesList();
		$data['categories_list'] = $categories_list;
		
		$data['artcle_info'] = $artcle_info;
		$data['article_id'] = $article_id;
		
		$this->load->view('admin/admin/article_edit', $data);		
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */