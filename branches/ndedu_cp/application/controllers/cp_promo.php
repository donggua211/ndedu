<?php

class cp_promo extends Controller {

	function cp_promo()
	{
		parent::Controller();
		$this->load->library('session');
		
		$this->load->model('CP_Category_model');
		
		$this->load->helper('common');
		$this->load->helper('cp');
	}
	
	function index()
	{
		$data['header']['meta_title'] = '促销 - 尼德教育全方位测试系统';
		$data['main']['cat_list'] = $this->CP_Category_model->get_all_category(CP_CAT_TYPE_PROMO);
		
		_load_cp_viewer('cp_promo', $data, false, true, false, true);
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */