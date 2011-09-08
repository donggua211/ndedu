<?php
/* 
  留言本管理
  admin权限.
 */
class Guestbook extends Controller {

	function Guestbook()
	{
		parent::Controller();
		$this->load->library('session');
		$this->load->model('Guestbook_model');
		$this->load->helper('admin');
		$this->load->helper('language');
		
		$this->num_message_per_page = 20;
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
		$this->inbox();
	}
	
	function inbox($page = 1)
	{
		//Get all available messages
		$data["messages"] = $this->Guestbook_model->getMessages($page, $this->num_message_per_page, 'available');
		
		$data["current_page"] = $page;
		$data["count_message"] = $this->Guestbook_model->countMessage('available');
		$data["num_message_per_page"] = $this->num_message_per_page;
		
		$this->load->view('admin/admin/guestbook', $data);
	}
	
	function trash($page = 1)
	{
		//Get all unavailable messages
		$data["messages"] = $this->Guestbook_model->getMessages($page, $this->num_message_per_page, 'unavailable');
		
		$data["current_page"] = $page;
		$data["count_message"] = $this->Guestbook_model->countMessage('unavailable');
		$data["num_message_per_page"] = $this->num_message_per_page;
		
		$this->load->view('admin/admin/guestbook', $data);
	}
	
	function all($page = 1)
	{
		//Get all messages
		$data["messages"] = $this->Guestbook_model->getMessages($page, $this->num_message_per_page, 'all');
		
		$data["current_page"] = $page;
		$data["count_message"] = $this->Guestbook_model->countMessage('all');
		$data["num_message_per_page"] = $this->num_message_per_page;
		
		$this->load->view('admin/admin/guestbook', $data);
	}
	
	function one($message_id)
	{
		$data["message"] = $this->Guestbook_model->getOneMessage($message_id);
		
		if($data["message"]['is_new'] == 1)
		{
			//Update message to old
			$set = array('is_new' => 0);
			$this->Guestbook_model->updataMessage($message_id, $set);
		}
		
		$this->load->view('admin/admin/message_page', $data);
	
	}	
	
	function unavailable($message_id = 0)
	{
		$set = array('is_deleted' => 1);
		$this->Guestbook_model->updataMessage($message_id, $set);
		
		$page = $this->uri->segment(5);
		if ($page === FALSE)
		{
			$page = 'inbox';
		}
		
		 redirect('/admin/guestbook/'.$page, 'refresh');
	}
	
	function available($message_id = 0)
	{
		$set = array('is_deleted' => 0);
		$this->Guestbook_model->updataMessage($message_id, $set);
		
		$page = $this->uri->segment(5);
		if ($page === FALSE)
		{
			$page = 'inbox';
		}
		
		 redirect('/admin/guestbook/'.$page, 'refresh');
	}
	
	function delete($message_id = 0)
	{
		$this->Guestbook_model->deleteMessage($message_id);	
		
		$page = $this->uri->segment(5);
		if ($page === FALSE)
		{
			$page = 'inbox';
		}
		
		 redirect('/admin/guestbook/'.$page, 'refresh');
	}

	function batch()
	{
		if(isset($_POST['doAction']) && !empty($_POST['doAction']))
		{
			$msg_ids = $this->input->post('msg_ids');
			$action = $this->input->post('action');
			
			if(empty($msg_ids))
			{
				$data["notification"] ='<font color="red">所选留言不能为空</font>';
			}
			else
			{
				switch($action)
				{
					case 'read':
						$set = array('is_new' => 0);
						$this->Guestbook_model->updataMessage($msg_ids, $set);
						$data["notification"] ='所选留言已经设置为已读';
						break;
					case 'available':
						$set = array('is_deleted' => 0);
						$this->Guestbook_model->updataMessage($msg_ids, $set);
						$data["notification"] ='所选留言已经放回收件箱';
						break;
					case 'unavailable':
						$set = array('is_deleted' => 1);
						$this->Guestbook_model->updataMessage($msg_ids, $set);
						$data["notification"] ='所选留言已经删除，你可以在废件箱内查看';
						break;
					case 'delete':
						$this->Guestbook_model->deleteMessage($msg_ids);
						$data["notification"] ='所选留言已经彻底删除';
						break;
					default:
						break;
				}
			}
		}
		elseif(isset($_POST['readAll']) && !empty($_POST['readAll']))
		{
			$all_msg_ids = $pieces = explode(",", $this->input->post('all_msg_ids'));
			$set = array('is_new' => 0);
			$this->Guestbook_model->updataMessage($all_msg_ids, $set);
			
			$data["notification"] ='本页留言已经全部设置为已读';
		}
		elseif(isset($_POST['availableAll']) && !empty($_POST['availableAll']))
		{
			$all_msg_ids = $pieces = explode(",", $this->input->post('all_msg_ids'));
			$set = array('is_deleted' => 0);
			$this->Guestbook_model->updataMessage($all_msg_ids, $set);
			
			$data["notification"] ='本页留言已经全部放回收件箱';
		}
		elseif(isset($_POST['unavailableAll']) && !empty($_POST['unavailableAll']))
		{
			$all_msg_ids = $pieces = explode(",", $this->input->post('all_msg_ids'));
			$set = array('is_deleted' => 1);
			$this->Guestbook_model->updataMessage($all_msg_ids, $set);
			
			$data["notification"] ='本页留言已经全部删除，你可以在废件箱内查看';
		}
		elseif(isset($_POST['deleteAll']) && !empty($_POST['deleteAll']))
		{
			$all_msg_ids = $pieces = explode(",", $this->input->post('all_msg_ids'));
			$this->Guestbook_model->deleteMessage($all_msg_ids);
			
			$data["notification"] ='本页留言已经全部彻底删除';
		}
		
		$page = $this->input->post('page');		
		if ($page === FALSE)
		{
			$page = 'inbox';
		}
		
		$data['page'] = '/admin/guestbook/'.$page;
		$this->load->view('admin/admin/result', $data);
	}

	
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */