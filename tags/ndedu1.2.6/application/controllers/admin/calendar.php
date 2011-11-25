<?php
/* 
  班主任管理模块
  admin权限.
 */
class Calendar extends Controller {

	function Calendar()
	{
		parent::Controller();
		$this->load->library('session');
		$this->load->model('CRM_Staff_model');
		$this->load->model('CRM_Calendar_model');
		
		$this->load->helper('admin');
		$this->load->helper('calendar');
			
		//如果没有经登录, 就跳转到admin/login登陆页
		if (!has_login())
		{
			goto_login();
		}
				
		$this->staff_info = get_staff_info();
	}
	
	function index()
	{
		$this->month(date('Y'), date('m'));
	}
	
	function today()
	{
		$this->day(date('Y'), date('m'), date('d'));
	}
	
	function month($year, $month, $staff_id = '')
	{
		//staff id
		$staff_id = ((is_admin() || is_school_admin()) && !empty($staff_id)) ? $staff_id : $this->staff_info['staff_id'];
		
		//这个月的星期数
		$wim = weeks_in_month($month, $year);
		
		//这个月开始的日期
		$first_offset = 1 - day_of_week($month, 1, $year);
		$first_day = date('Y-m-d', mktime(0, 0, 0, $month, $first_offset, $year));
		
		//这个月结束的日期
		$last_offset = $wim * 7 - day_of_week($month, 1, $year);
		$last_day = date('Y-m-d', mktime(0, 0, 0, $month, $last_offset, $year));
		
		//获取日程数据
		$calendar_data = $this->CRM_Calendar_model->get_calendar($staff_id, $first_day, $last_day);
		$days_calendar = _parse_calendar($calendar_data, $first_day, $last_day);
		
		//显示数据
		$prev_month = $month - 1;
		$prev_year = $year;
		if($prev_month < 1) {
			$prev_month += 12;
			$prev_year--;
		}
		$next_month = $month + 1;
		$next_year = $year;
		if($next_month > 12) {
			$next_month -= 12;
			$next_year++;
		}
		
		$data['header']['meta_title'] = $year.'-'.$month.' - 日程管理';
		$data['header']['css_file'] = 'calendar.css';
		$data['main']['days_calendar'] = $days_calendar;
		$data['main']['month'] = $month;
		$data['main']['year'] = $year;
		$data['main']['prev_month'] = $prev_month;
		$data['main']['prev_year'] = $prev_year;
		$data['main']['next_month'] = $next_month;
		$data['main']['next_year'] = $next_year;
		$data['main']['wim'] = $wim;
		$data['main']['staffs'] = $this->_get_all_staffs();
		$data['main']['staff_id'] = $staff_id;
		$data['main']['is_owner'] = $this->_is_owner($staff_id);
		_load_viewer($this->staff_info['group_id'], 'calendar_month', $data);
	}
	
	function day($year, $month, $day, $staff_id = '')
	{
		
		$staff_id = ((is_admin() || is_school_admin()) && !empty($staff_id)) ? $staff_id : $this->staff_info['staff_id'];
		
		$first_day = "$year-$month-$day";
		$last_day = "$year-$month-$day";
		
		//获取日程数据
		$calendar_data = $this->CRM_Calendar_model->get_calendar($staff_id, $first_day, $last_day);
		$one_day_calendar = _parse_one_day_calendar($calendar_data, $first_day, $last_day);
		
		//显示数据
		$prev_day = date('Y/m/d', mktime(0, 0, 0, $month, ($day-1), $year));
		$next_day = date('Y/m/d', mktime(0, 0, 0, $month, ($day+1), $year));
		
		$data['header']['meta_title'] = $year.'-'.$month.' - 日程管理';
		$data['header']['css_file'] = 'calendar.css';
		$data['main']['one_day_calendar'] = $one_day_calendar;
		$data['main']['day'] = $day;
		$data['main']['month'] = $month;
		$data['main']['year'] = $year;
		$data['main']['prev_day'] = $prev_day;
		$data['main']['next_day'] = $next_day;
		$data['main']['staffs'] = $this->_get_all_staffs();
		$data['main']['staff_id'] = $staff_id;
		$data['main']['is_owner'] = $this->_is_owner($staff_id);
		_load_viewer($this->staff_info['group_id'], 'calendar_day', $data);
	}
	
	function edit($calendar_id = 0)
	{
		//判断staff_id是否合法.
		$calendar_id = (empty($calendar_id))? $this->input->post('calendar_id') : intval($calendar_id);
		if($calendar_id <= 0)
		{
			show_error_page('您输入的日程ID不合法, 请返回重试.', 'admin/calendar');
			return false;
		}
		
		$calendar_info = $this->CRM_Calendar_model->get_one_calendar($calendar_id);
		if(empty($calendar_info))
		{
			show_error_page('您所查询的日程不存在!', 'admin/calendar');
			return false;
		}
		
		//检查权限.
		switch($this->staff_info['group_id'])
		{
			case GROUP_ADMIN: //admin管理有权限
				break;
			default:
				if($calendar_info['staff_id'] != $this->staff_info['staff_id'])
				{
					show_error_page('您没有权限删除其他员工的日程!', 'admin/calendar');
					return false;
				}
				break;
		}
		
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			//必填信息.
			//开始时间.
			$start_date = $this->input->post('start_date');
			$start_hour = $this->input->post('start_hour');
			$start_mins = $this->input->post('start_mins');
			$edit_calendar['start_time'] = $start_date.' '.$start_hour.':'.$start_mins.':00';
			
			//结束时间.
			$end_date = $this->input->post('end_date');
			$end_hour = $this->input->post('end_hour');
			$end_mins = $this->input->post('end_mins');
			$edit_calendar['end_time'] = $end_date.' '.$end_hour.':'.$end_mins.':00';
			
			$edit_calendar['calendar_content'] = $this->input->post('calendar_content');
			
			if($edit_calendar['end_time'] < $edit_calendar['start_time'])
			{
				$notify = '!? 结束时间必须在开始时间以后!';
				$this->_load_calendar_edit_view($notify, $calendar_info);
				return false;
			}
			
			//检查修改项
			$update_field = array();
			foreach($edit_calendar as $key => $val)
			{
				if($key == 'start_time' || $key == 'end_time')
				{
					if(!empty($val) && (strtotime($val) != strtotime($calendar_info[$key])))
						$update_field[$key] = $val;
				
				}
				else
				{
					if(!empty($val) && ($val != $calendar_info[$key]))
						$update_field[$key] = $val;
				}
			}
			
			if($this->CRM_Calendar_model->update($calendar_id, $update_field))
			{
				$start_ts = strtotime($edit_calendar['start_time']);
				show_result_page('日程已经更新成功! ', 'admin/calendar/day/'.date('Y/m/d', $start_ts));
			}
			else
			{
				$notify = '更新失败, 请重试.';
				$this->_load_calendar_edit_view($notify, $calendar_info);
			}
		}
		else
		{
			$this->_load_calendar_edit_view('', $calendar_info);
		}
	}
	
	function add($year = '', $month = '', $day = '')
	{
		if(isset($_POST['submit']) && !empty($_POST['submit']))
		{
			//开始时间.
			$new_calendar['start_date'] = $this->input->post('start_date');
			$new_calendar['start_hour'] = $this->input->post('start_hour');
			$new_calendar['start_mins'] = $this->input->post('start_mins');
			$new_calendar['start_time'] = $new_calendar['start_date'].' '.$new_calendar['start_hour'].':'.$new_calendar['start_mins'].':00';
			
			//结束时间.
			$new_calendar['end_date'] = $this->input->post('end_date');
			$new_calendar['end_hour'] = $this->input->post('end_hour');
			$new_calendar['end_mins'] = $this->input->post('end_mins');
			$new_calendar['end_time'] = $new_calendar['end_date'].' '.$new_calendar['end_hour'].':'.$new_calendar['end_mins'].':00';
			
			$new_calendar['calendar_content'] = $this->input->post('calendar_content');
			
			if(empty($new_calendar['start_date']) || empty($new_calendar['end_date']) || empty($new_calendar['calendar_content']))
			{
				$notify = '请填写完整的日程信息';
				$this->_load_calendar_add_view($notify, $new_calendar);
			}
			elseif($new_calendar['end_time'] < $new_calendar['start_time'])
			{
				$notify = '!? 结束时间必须在开始时间以后!';
				$this->_load_calendar_add_view($notify, $new_calendar);
			}
			else
			{
				if($this->CRM_Calendar_model->add($new_calendar, $this->staff_info['staff_id']))
				{
					$start_ts = strtotime($new_calendar['start_time']);
					show_result_page('日程已经添加成功! ', 'admin/calendar/day/'.date('Y/m/d', $start_ts));
				}
				else
				{
					$notify = '日程添加失败, 请重试.';
					$this->_load_calendar_add_view($notify, $new_student);
				}
			}
		}
		else
		{
			/*添加日历的默认时间. */
			//开始时间
			$time_stamp = mktime(date('H'), date('i'), 0, (!empty($month)?$month:date('m')), (!empty($day)?$day:date('d')), (!empty($year)?$year:date('y')));
			$new_calendar['start_date'] = date('Y-m-d', $time_stamp);
			$new_calendar['start_hour'] = date('H');
			$new_calendar['start_mins'] = floor(date('i')/10) * 10;
			//结束时间.
			$time_stamp = $time_stamp + 60 * 60; //一小时后
			$new_calendar['end_date'] = date('Y-m-d', $time_stamp);
			$new_calendar['end_hour'] = date('H', $time_stamp);
			$new_calendar['end_mins'] = floor(date('i')/10) * 10;
			$this->_load_calendar_add_view('', $new_calendar);
		}
	}
	
	function delete($calendar_id)
	{
		//判断staff_id是否合法.
		$calendar_id = intval($calendar_id);
		if($calendar_id <= 0)
		{
			show_error_page('您输入的员工ID不合法, 请返回重试.', 'admin/calendar');
			return false;
		}
		
		$calendar_info = $this->CRM_Calendar_model->get_one_calendar($calendar_id);
		if(empty($calendar_info))
		{
			show_error_page('您所查询的日程不存在!', 'admin/calendar');
			return false;
		}
		
		//检查权限.
		switch($this->staff_info['group_id'])
		{
			case GROUP_ADMIN: //admin管理有权限
				break;
			default:
				if($calendar_info['staff_id'] != $this->staff_info['staff_id'])
				{
					show_error_page('您没有权限删除其他员工的日程!', 'admin/calendar');
					return false;
				}
				break;
		}
		
		$update_field['is_delete'] = 1;
		if($this->CRM_Calendar_model->update($calendar_id, $update_field))
		{
			show_result_page('日程已经添加删除! ', '');
		}
		else
		{
			show_error_page('删除失败, 请重试.', 'admin/calendar');
		}
	
	}
	
	function _load_calendar_add_view($notify = '', $calendar = array())
	{
		$data['header']['meta_title'] = '添加日程 - 日程管理';
		$data['main']['notification'] = $notify;
		$data['header']['css_file'] = '../calendar.css';
		$data['footer']['js_file'] = '../calendar.js';
		$data['main']['calendar'] = $calendar;
		_load_viewer($this->staff_info['group_id'], 'calendar_add', $data);
	}
	
	function _load_calendar_edit_view($notify = '', $calendar = array())
	{
		$data['header']['meta_title'] = '编辑日程 - 日程管理';
		$data['main']['notification'] = $notify;
		$data['header']['css_file'] = '../calendar.css';
		$data['footer']['js_file'] = '../calendar.js';
		$data['main']['calendar'] = $calendar;
		
		//开始时间
		$time_stamp = strtotime($calendar['start_time']);
		$data['main']['calendar']['start_date'] = date('Y-m-d', $time_stamp);
		$data['main']['calendar']['start_hour'] = date('H', $time_stamp);
		$data['main']['calendar']['start_mins'] = floor(date('i', $time_stamp)/10) * 10;
		//结束时间.
		$time_stamp = strtotime($calendar['end_time']);
		$data['main']['calendar']['end_date'] = date('Y-m-d', $time_stamp);
		$data['main']['calendar']['end_hour'] = date('H', $time_stamp);
		$data['main']['calendar']['end_mins'] = floor(date('i', $time_stamp)/10) * 10;
		
		_load_viewer($this->staff_info['group_id'], 'calendar_edit', $data);
	}
	
	function _get_all_staffs()
	{
		$filter['is_active'] = 1;
		$filter['is_delete'] = 0;
		$filter['group_id'] = array(GROUP_ADMIN, GROUP_SCHOOLADMIN, GROUP_CONSULTANT, GROUP_SUPERVISOR, GROUP_TEACHER_FULL, GROUP_CS, GROUP_CS_D, GROUP_SUYANG, GROUP_TEACHER_D, GROUP_CONSULTANT_D, GROUP_SUYANG_D, GROUP_JIAOWU, GROUP_JIAOWU_D);
		
		switch($this->staff_info['group_id'])
		{
			case GROUP_ADMIN: //admin管理有权限
				break;
			case GROUP_SCHOOLADMIN:
				$filter['branch_id'] = $this->staff_info['branch_id'];
				break;
			default:
				return array();
		}
		
		return $this->CRM_Staff_model->getAll($filter);
	}
	
	function _is_owner($staff_id)
	{
		switch($this->staff_info['group_id'])
		{
			case GROUP_ADMIN:
			case GROUP_SCHOOLADMIN:
				return ($staff_id == $this->staff_info['staff_id']) ? TRUE : FALSE;
				break;
			case GROUP_CONSULTANT:
			case GROUP_SUPERVISOR:
			default:
				return TRUE;
		}
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */