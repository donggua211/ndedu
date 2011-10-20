<?php

class cp_test extends Controller {

	function cp_test()
	{
		parent::Controller();		
		$this->load->model('CP_comment_model');
		$this->load->helper('cp');
		$this->load->helper('common');
	}
	
	function cp_comment($cat_id = 1, $from  = 1, $count = 1)
	{
		for($count; $count > 0; $count--, $from ++)
		{
			$comment = array();
			$comment['name'] = $from;
			$comment['comment'] = $from;
			$comment['cat_id'] = $cat_id;
			$this->CP_comment_model->add($comment);
		}
		echo 'done';
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */