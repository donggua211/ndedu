<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	//解析calendar的数据
	function _parse_calendar($results, $first_day, $last_day)
	{
		$from_stamp = strtotime($first_day.' 00:00:00');
		$to_stamp = strtotime($last_day.' 00:00:00');
		
		$days_calendar = array();
		foreach($results as $calendar) {
			list($date, $time) = explode(' ', $calendar['start_time']);
			list($startyear, $startmonth, $startday) = explode('-', $date);
			$start_stamp = mktime(0, 0, 0, $startmonth, $startday, $startyear);
			
			list($date, $time) = explode(' ', $calendar['end_time']);
			list($endyear, $endmonth, $endday) = explode('-', $date);
			$end_stamp = mktime(0, 0, 0, $endmonth, $endday, $endyear);
			
			$diff = $from_stamp - $start_stamp;
			if($diff > 0)
				$add_days = floor($diff / 86400);
			else
				$add_days = 0;

			// put the calendar in every day until the end
			for(; ; $add_days++) {
				$stamp = mktime(0, 0, 0, $startmonth, $startday + $add_days, $startyear);

				if($stamp > $end_stamp || $stamp > $to_stamp)
					break;

				$key = date('Y-m-d', $stamp);
				if(!isset($days_calendar[$key]))
					$days_calendar[$key] = array();
				$days_calendar[$key][] = $calendar;
			}
		}
		return $days_calendar;
	}
	
	function _parse_one_day_calendar($results, $first_day, $last_day)
	{
		return $results;
	}
	
	// returns the number of days in the week before the 
	//  taking into account whether we start on sunday or monday
	function day_of_week($month, $day, $year)
	{
		return day_of_week_ts(mktime(0, 0, 0, $month, $day, $year));
	}

	// returns the number of days in the week before the 
	//  taking into account whether we start on sunday or monday
	function day_of_week_ts($timestamp)
	{
		$days = date('w', $timestamp);

		return ($days + 7 - DAY_OF_WEEK_START) % 7;
	}

	// returns the number of days in $month
	function days_in_month($month, $year)
	{
		return date('t', mktime(0, 0, 0, $month, 1, $year));
	}

	//returns the number of weeks in $month
	function weeks_in_month($month, $year)
	{
		$days = days_in_month($month, $year);

		// days not in this month in the partial weeks
		$days_before_month = day_of_week($month, 1, $year);
		$days_after_month = 6 - day_of_week($month, $days, $year);

		// add up the days in the month and the outliers in the partial weeks
		// divide by 7 for the weeks in the month
		return ($days_before_month + $days + $days_after_month) / 7;
	}

	// return the week number corresponding to the $day.
	function week_of_year($month, $day, $year)
	{
		$timestamp = mktime(0, 0, 0, $month, $day, $year);

		// week_start = 1 uses ISO 8601 and contains the Jan 4th,
		//   Most other places the first week contains Jan 1st
		//   There are a few outliers that start weeks on Monday and use
		//   Jan 1st for the first week. We'll ignore them for now.
		if(DAY_OF_WEEK_START == 1) {
			$year_contains = 4;
			// if the week is in December and contains Jan 4th, it's a week
			// from next year
			if($month == 12 && $day - 24 >= $year_contains) {
				$year++;
				$month = 1;
				$day -= 31;
			}
		} else {
			$year_contains = 1;
		}
		
		// $day is the first day of the week relative to the current month,
		// so it can be negative. If it's in the previous year, we want to use
		// that negative value, unless the week is also in the previous year,
		// then we want to switch to using that year.
		if($day < 1 && $month == 1 && $day > $year_contains - 7) {
			$day_of_year = $day - 1;
		} else {
			$day_of_year = date('z', $timestamp);
			$year = date('Y', $timestamp);
		}

		/* Days in the week before Jan 1. */
		$days_before_year = day_of_week(1, $year_contains, $year);

		// Days left in the week
		$days_left = 8 - day_of_week_ts($timestamp) - $year_contains;

		/* find the number of weeks by adding the days in the week before
		 * the start of the year, days up to $day, and the days left in
		 * this week, then divide by 7 */
		return ($days_before_year + $day_of_year + $days_left) / 7;
	}
	
	function calendar_url($url, $staff_id, $is_owner = TRUE)
	{
		if($is_owner)
			return site_url($url);
		else
			return site_url($url.'/'.$staff_id);
	
	}
	
	function show_hour_options($name, $selected = '')
	{
		$str = '<select name="'.$name.'">';
		for($i = 0; $i < 24; $i++)
			$str .= '<option value="'.$i.'" '.($selected == $i ? 'SELECTED' : '').'>'.str_pad($i, 2, 0, STR_PAD_LEFT);
		
		$str .= '</select>';
		return $str;
	}
	
	function show_mins_options($name, $selected = '')
	{
		$str = '<select name="'.$name.'">';
		for($i = 0; $i < 60; $i += 10)
			$str .= '<option value="'.$i.'" '.($selected == $i ? 'SELECTED' : '').'>'.str_pad($i, 2, 0, STR_PAD_LEFT);
		
		$str .= '</select>';
		return $str;
	}