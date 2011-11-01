<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	function show_category_options($category, $selected_id = 0)
	{
		foreach($category as $value)
		{
			echo '<option value="'.$value['category_id'].'" '.(($value['category_id'] == $selected_id) ? 'SELECTED' : '').'>';
			
			for($i = 0; $i < $value['level']; $i++)
				echo '&nbsp;&nbsp;';
			
			if($value['level'] > 0)
				echo '└─';
			
			echo $value['category_name'].'</option>';
			
			if(isset($value['sub_cat']) && !empty($value['sub_cat']))
				show_category_options($value['sub_cat'], $selected_id);
		}
	}
	
	function show_category_list($category)
	{
		foreach($category as $value)
		{
			echo '<tr><td align="left">';
			
			for($i = 0; $i < $value['level']; $i++)
				echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
			
			if($value['level'] > 0)
				echo '└──';
			
			echo '<img src="images/admin/menu_arrow.gif" width="9" height="9" border="0" style="margin-left:2px;margin-right:2px" />'.$value['category_name'].'</td>
					<td align="center">'.$value['order'].'</td>
					<td align="center">
						<a href="'.site_url('admin/ics/category_edit/'.$value['category_id']).'">编辑</a>
						<a onclick="return confirm(\'确定要删除? 删除后将无法恢复!\');" href="'.site_url('admin/ics/category_delete/'.$value['category_id']).'">删除</a>
					</td>
				<tr>';
			
			if(isset($value['sub_cat']) && !empty($value['sub_cat']))
				show_category_list($value['sub_cat']);
		}
	}
	
	function show_category_mune($category, $staff_info = array())
	{
		echo '<ul>';
		foreach($category as $value)
		{
			//为 staff id = 5 , 定制. @tobe
			if($staff_info['staff_id'] == 6 && in_array($value['category_id'], array(594, 271, 272, 372, 479)))
				echo '<li style="display:none">';
			else
				echo '<li class="'.((isset($value['sub_cat']) && !empty($value['sub_cat']))?'explode':'menu-item').'" name="menu">';
			
			if(isset($value['sub_cat']) && !empty($value['sub_cat']))
				echo $value['category_name'];
			else
				echo '<a onclick="return markurl(this);" href="'.site_url('ics/ics/category/'.$value['category_id']).'" target="main-ics">'.$value['category_name'].'</a>';
			
			if(isset($value['sub_cat']) && !empty($value['sub_cat']))
				show_category_mune($value['sub_cat'], $staff_info);
			
			echo '</li>';
		}
		echo '</ul>';
	}