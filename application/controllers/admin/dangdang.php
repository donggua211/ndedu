<?php
/* 
  当当网内容管理
  admin权限.
 */
class dangdang extends Controller {

	function dangdang()
	{
		parent::Controller();
		$this->load->library('session');
		$this->load->library('dd');
		$this->load->model('ArticleCat_model');
		$this->load->model('Dangdang_model');
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
		$data['header']['meta_title'] = '查看当当网内容 - 当当网内容管理';
		$data['main']['dangdangs'] = $this->Dangdang_model->get_all();
		_load_viewer($this->staff_info['group_id'], 'dangdang', $data);
	}
	
	function add()
	{
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			$new_dangdang['pid'] = intval($this->input->post('pid'));
			$new_dangdang['cat_id'] = $this->input->post('cat_id');

			if($new_dangdang['pid'] == FAlSE || $new_dangdang['cat_id'] == FAlSE)
			{
				$notify = '当当PID或者分类不能为空';
				$this->_load_dangdang_add_view($notify, $new_dangdang);
			}
			else
			{
				$product_info = $this->dd->getInfo($new_dangdang['pid']);
				
				if(empty($product_info))
				{
					$notify = '添加失败, 请重试!';
					$this->_load_dangdang_add_view($notify, $new_dangdang);
				}
				
				$new_dangdang = array_merge($product_info ,$new_dangdang);
				if($this->Dangdang_model->addDangdang($new_dangdang) !== FALSE)
				{
					//添加标签
					$tags = $this->input->post('tags');
					$this->Tags_model->addDangdangTag($new_dangdang['pid'], $tags);
					show_result_page('添加成功! ', 'admin/dangdang');
				}
				else
				{
					$notify = '添加失败, 请稍后再试';
					$this->_load_dangdang_add_view($notify, $new_dangdang);
				}
			}
		}
		else
		{
			$this->_load_dangdang_add_view();
		}
	}
	
	function _load_dangdang_add_view($notify = '', $dangdang = array())
	{
		$data['header']['meta_title'] = '添加 - 当当网内容管理';
		$data['main']['notify'] = $notify;
		$data['main']['tags'] = $this->Tags_model->getAllTags();
		$data['main']['dangdang'] = $dangdang;
		_load_viewer($this->staff_info['group_id'], 'dangdang_add', $data);
	}
	
	function delete($pid)
	{
		//判断pid是否合法.
		$pid = intval($pid);
		
		if($pid <= 0)
		{
			echo 'a';
			show_error_page('您输入的pid不合法, 请返回重试.', 'admin/dangdang');
			return false;
		}
		
		if($this->Dangdang_model->delete($pid))
		{
			show_result_page('该pid已经添加删除! ', 'admin/dangdang');
		}
		else
		{
			show_error_page('删除失败或者该PID不存在, 请重试.', 'admin/dangdang');
		}
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */