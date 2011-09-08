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
		$this->load->helper('admin_authority');
		
		$this->allowed_group = array(1);
		
		//如果没有经登录, 就跳转到admin/login登陆页
		if (!has_login())
		{
			goto_login();
		}
		
		//检查权限.
		if(!check_role($this->allowed_group))
		{
			show_access_deny_page();
		}
	}

	function index()
	{
		$data["tags"] = $this->Tags_model->getAllTags();
		$this->load->view('admin/tag', $data);
	}
	
	function add()
	{
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			$new_tag['tag_name'] = $this->input->post('name');
					
			if($new_tag['tag_name'] == FAlSE)
			{
				$data['notification'] = 'tag不能为空';
				$this->load->view('admin/tag_add', $data);
			}
			else
			{
				$new_tag['add_time'] = time();
								
				if($this->Tags_model->addTag($new_tag))
				{
					$data['notification'] = 'tag添加成功';
				}
				else
				{
					$data['notification'] = 'tag添加失败, 请稍后再试';
				}

				$data['page'] = 'admin/tags';
				$this->load->view('admin/result', $data);
			
			}
		}
		else
		{
			$this->load->view('admin/tag_add');
		}
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */