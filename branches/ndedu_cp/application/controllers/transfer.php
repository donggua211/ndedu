<?php

class Transfer extends Controller {

	function Transfer()
	{
		parent::Controller();
		$this->load->model('Dangdang_model');
	}
	
	function dangdang($pid)
	{
		$dangdang_union_url = 'http://union.dangdang.com/transfer/transfer.aspx?from=P-282819&backurl=';
		$dangdang_backurl = 'http://product.dangdang.com/product.aspx?product_id=';
		if(empty($pid))
		{
			$dangdang_backurl = 'http://www.dangdang.com';
		}
		else
		{
			$dangdang_backurl .= $pid;
		}
		@$this->Dangdang_model->addCount($pid);
		header("Location: ".$dangdang_union_url.$dangdang_backurl);
	}
	
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */