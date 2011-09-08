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
		$this->load->model('ICS_Category_model');
		$this->load->model('ICS_Document_model');
		$this->load->model('ICS_Grade_model');
		$this->load->helper('ics');
		$this->load->helper('admin');
		
		$this->allowed_group = array(1);
		
		//如果没有经登录, 就跳转到admin/login登陆页
		if (!has_login())
		{
			goto_login();
		}
		
		$this->staff_info = get_staff_info();
		/*
		//检查权限.
		if(!check_role(array(GROUP_ADMIN), $this->staff_info['group_id']))
		{
			show_access_deny_page();
		}
		*/
	}
	
	function menu()
	{
		$data_header['css_file'] = 'common_menu.css';
		$data['categories'] = $this->ICS_Category_model->get_all_category();
		$data['staff_info'] = $this->staff_info;
		
		$this->load->view('admin/header', $data_header);
		$this->load->view('ics/common_menu', $data);
		$this->load->view('admin/footer');
	}
	
	function index()
	{
		$this->category(621);
	}
	
	function search()
	{
		$category_id = intval($this->input->post('category_id'));
		$grade_id = intval($this->input->post('grade_id'));
		$keyword = trim($this->input->post('keyword'));
		
		//获取 category_id 及, 其下的子分类
		$category = array();
		if (!empty($category_id))
        {
            $category = $this->ICS_Category_model->get_sub_cat($category_id);
        }
		$documents = $this->ICS_Document_model->search($keyword, $grade_id, $category);
		if(empty($documents))
		{
			$data['main']['notification'] = '您选的分类下没有文章!';
		}
		
		
		
		
		$data['header']['meta_title'] = $keyword.' - 搜索 - 咨询系统管理';
		$data['main']['keyword'] = $keyword;
		$data['main']['grade_id'] = $grade_id;
		$data['main']['category_id'] = $category_id;
		$data['main']['documents'] = $documents;
		$data['main']['grades'] = $this->ICS_Grade_model->get_all_grade();
		$data['main']['categories'] = $this->ICS_Category_model->get_all_category();
		$this->_load_viewer('search', $data);
	}
	
	function category($category_id)
	{
		$category_id = intval($category_id);
		if($category_id <= 0)
		{
			show_error_page('您输入的分类ID不合法, 请返回重试.', 'admin/ics/category');
			return false;
		}
		
		$category_info = $this->ICS_Category_model->get_one($category_id);
		$path_info = $this->ICS_Category_model->get_path_info($category_id);
		
		if(empty($category_info))
		{
			show_error_page('无法找到您选的分类, 请返回重试.', 'ics/ics');
			return false;
		}
		
		$documents = $this->ICS_Document_model->getAllByCat($category_id);
		if(empty($category_info))
		{
			show_error_page('您选的分类下没有文章, 请返回重试.', 'ics/ics');
			return false;
		}
		
		$data['header']['meta_title'] = $category_info['category_name'].' - 咨询系统管理';
		$data['main']['documents'] = $documents;
		$data['main']['category_info'] = $category_info;
		$data['main']['path_info'] = $path_info;
		$data['main']['grades'] = $this->ICS_Grade_model->get_all_grade();
		$data['main']['categories'] = $this->ICS_Category_model->get_all_category();
		$this->_load_viewer('category_all', $data);	
	}
	
	function _load_viewer($template, $data = array())
	{
		//处理 template EXT后缀.
		if(!strpos($template, '.php'))
			$template .= EXT;
		
		$template = 'ics/'.$template;
		
		if( !isset($data['header']) )
			$data['header'] = array();
		$this->load->view('admin/header', $data['header']);
		
		//加载主页面
		if( !isset($data['main']) )
			$data['main'] = array();
		
		//如果在views/admin/common存在的话, 就载入, 否则在权限的文件夹下超找.
		if(!file_exists(APPPATH.'views/'.$template))
		{
			show_error_page('您没有权限访问该页面!');
		}
		
		$this->load->view($template, $data['main']);
		
		//加载footer
		if( !isset($data['footer']) )
			$data['footer'] = array();
		$this->load->view('admin/footer', $data['footer']);
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */