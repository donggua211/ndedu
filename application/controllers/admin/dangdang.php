<?php
/* 
  当当网内容管理
  admin权限.
 */
class Dangdang extends Controller {

	function Dangdang()
	{
		parent::Controller();
		$this->load->library('session');
		$this->load->model('Dangdang_model');
		$this->load->model('Tags_model');
		$this->load->library('my_dangdang');
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

	function index()
	{
		$tags = $this->Tags_model->getAllTags();
		$data['tags'] = $tags;
		$this->load->view('admin/admin/dangdang_add', $data);
	}
	
	function add()
	{
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			$new_dangdang['pid'] = $this->input->post('pid');
			$new_dangdang['cat'] = $this->input->post('cat');

			if($new_dangdang['pid'] == FAlSE)
			{
				$data['notification'] = 'pid不能为空';
				$tags = $this->Tags_model->getAllTags();
				$data['tags'] = $tags;
				$this->load->view('admin/admin/dangdang_add', $data);
			}
			elseif($new_dangdang['cat'] == FAlSE)
			{
				$data['notification'] = '分类不能为空';
				$tags = $this->Tags_model->getAllTags();
				$data['tags'] = $tags;
				$this->load->view('admin/admin/dangdang_add', $data);
			}
			else
			{
				$product_info = $this->my_dangdang->getInfo($new_dangdang['pid']);
				
				if(empty($product_info))
				{
					$data['notification'] = '添加失败, 请重试!';
					$tags = $this->Tags_model->getAllTags();
					$data['tags'] = $tags;
					$this->load->view('admin/admin/dangdang_add', $data);
				}
				
				$product_info['cat'] = $new_dangdang['cat'];
				if($this->Dangdang_model->addDangdang($product_info) !== FALSE)
				{
					$tags = $this->input->post('tags');
					$this->Tags_model->addDangdangTag($new_dangdang['pid'], $tags);
					$data['notification'] = 'tag添加成功';
				}
				else
				{
					$data['notification'] = 'tag添加失败, 请稍后再试';
				}

				$data['page'] = 'admin/dangdang';
				$this->load->view('admin/admin/result', $data);
			}
		}
		else
		{
			$tags = $this->Tags_model->getAllTags();
			$data['tags'] = $tags;
			$this->load->view('admin/admin/dangdang_add', $data);
		}
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */