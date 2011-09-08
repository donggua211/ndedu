<?php

class Stats extends Controller {

	function Stats()
	{
		parent::Controller();

		$this->load->library('session');
		
		if (!$this->session->userdata("adminuser"))
		{
			redirect("admin/admin/login");
		}
		
		$this->load->model('Stats_model');
		//$this->output->enable_profiler(TRUE);
	}
	
	function index()
	{
		$data1['year_stats_from'] = '2008';
		$this->load->view('admin/stats_time_selector.php', $data1);
	}
	
		
	function keywords()
	{
		$data['keyword_stats'] = $this->Stats_model->getKeywordStats();
		$this->load->view('admin/stats_keyword.php', $data);
	}
	
	function quickMenu()
	{
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{		
			$fields = $this->Stats_model->getAllFields();
			$quick_menu = $this->input->post('quick_menu');
			switch($quick_menu)
			{
				case 'year':
					break;
				case 'month':
					break;
				case 'day':
				default:
					$day = date('Y-m-d');
					foreach($fields as $key => $field)
					{
						$fields_stats[$key] = $this->Stats_model->getStatsByDay($key, $day);
					}
					
					ksort($fields);
					ksort($fields_stats);
					$this->load->view('admin/stats_by_day.php', array('fields' => $fields, 'fields_stats' => $fields_stats));
					break;
			}
		}
		else
		{
			$this->index();
		}
	}

	function byDate()
	{
		$data['year_stats_from'] = '2008';
	
	}
	
	function Bymonth()
	{
		$data['year_stats_from'] = '2008';
	
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */