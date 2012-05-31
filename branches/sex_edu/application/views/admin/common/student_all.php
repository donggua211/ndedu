<div id="nav">
	<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
	<span class="action-span"> » <a href="<?php echo site_url('admin/student') ?>" target="main-frame">学员管理</a></span>
	 » 查看学员
	<div style="clear:both"></div>
</div>
<div id="main">
	<div id="main_body">
		<?php if(isset($notification) && !empty($notification)): ?>
		<div style="backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
			<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
		</div>
		<?php endif;?>
		
		<div class="form-div">
		  <form action="<?php echo site_url('admin/student')?>" method="POST" name="searchForm">
			<img src="images/admin/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
			<!-- 时间 -->
			状态时间: <input type="text" name="start_time" maxlength="60" size="10" value="" readonly="readonly" id="start_time_id" /> <input name="selbtn1" type="button" id="selbtn1" onclick="return showCalendar('start_time_id', '%Y-%m-%d', '24', false, 'selbtn1');" value="选择" class="button"/> 到 <input type="text" name="end_time" maxlength="60" size="10" value="" readonly="readonly" id="end_time_id" /> <input name="selbtn1" type="button" id="selbtn2" onclick="return showCalendar('end_time_id', '%Y-%m-%d', '24', false, 'selbtn2');" value="选择" class="button"/>
			<!-- 校区 -->
			<?php if(is_admin()): //权限: 只有超级管理员可以按校区搜索?>
			<select name="branch_id">
				<option value='0'>请选择...</option>
				<?php
					foreach($branches['branch'] as $branch)
						echo '<option value="'.$branch['branch_id'].'" '.((isset($filter['branch_id'])) ? ( ($branch['branch_id'] == $filter['branch_id']) ? 'SELECTED' : '' ) : '').'>'.$branch['branch_name'].'</option>';
				?>
			</select>
			<?php endif; ?>
			<!-- 学阶 -->
			<select name="grade_id">
				<option value='0'>全部学阶</option>
				<?php
					foreach($grades as $grade)
						echo '<option value="'.$grade['grade_id'].'" '.((isset($filter['grade_id'])) ? ( ($grade['grade_id'] == $filter['grade_id']) ? 'SELECTED' : '' ) : '').'>'.$grade['grade_name'].'</option>';
				?>
			</select>
			<!-- 校区 -->
			<select name="status">
				<option value='0'>所有状态</option>
				<?php
				//access control
				$CI = & get_instance();
				foreach($CI->admin_ac_student->get_group_status() as $val)
					echo "<option value='$val' ".( ($val == $filter['status']) ? 'SELECTED' : '' ). ">".get_student_status_text($val)."</option>";
				?>
			</select>
			<!-- 省市 -->
			<select name="province_id" id="selProvinces" onchange="region.changed(this, 2, 'selCities')">
				<option value='0' selected>所有省...</option>
				<?php 
					foreach($provinces as $province)
						echo '<option value="'.$province['region_id'].'" '.( ($province['region_id'] == $filter['province_id']) ? 'SELECTED' : '' ) .'>'.$province['region_name'].'</option>';
				?>
			</select>
			<select onchange="" id="selCities" name="city_id">
				<option value="0" selected>所有市...</option>
				<?php
					if(!empty($cities))
					foreach($cities as $city)
						echo '<option value="'.$city['region_id'].'" '.( ($city['region_id'] == $filter['city_id']) ? 'SELECTED' : '' ) .'>'.$city['region_name'].'</option>';
				?>
			</select>
			<!-- 姓名 -->
			学员姓名或电话 <input type="text" name="name" size="15" value="<?php echo isset($filter['name']) ? $filter['name'] : ''; ?>"/>
			<input type="submit" value=" 搜索 " class="button" />
		  </form>
		</div>
		
		<div id="listDiv" class="list-div">
		  <form action="<?php echo site_url('admin/student/sms_batch')?>" method="POST" id="sms_batch" target="_blank">
			<table cellspacing='1' id="list-table">
				<tr>
					<?php if($CI->admin_ac_student->view_student_all_student_detail()): ?>
					<th></th>
					<th>标记</th>
					<?php endif; ?>
					
					<th>姓名</th>
					<th>性别</th>
					<th>年级</th>
					
					<?php if($CI->admin_ac_student->view_student_all_student_detail()): ?>
					<th>父母电话</th>
					<th>住址</th>
					<th>状态</th>
					<th>最新联系时间</th>
					<?php endif; ?>
					
					<?php if($CI->admin_ac_student->view_student_all_finished_hour_dob()): ?>
					<th>生日</th>
					<th>剩余课时</th>
					<?php endif; ?>
					
					<?php if($CI->admin_ac_student->view_student_all_teaches()): ?>
					<th>对应老师</th>
					<?php endif; ?>
					
					<th>操作</th>
				</tr>
				<?php foreach($students as $student): ?>
				<tr>
					<?php 
						$mobile = '';
						if(!empty($student['mother_phone']))
							$mobile = $student['mother_phone'];
						elseif(!empty($student['father_phone']))
							$mobile = $student['father_phone'];
						
						//截取电话号码
						preg_match( "/[\d]{11}/", $mobile, $matches);
					?>
					<?php if($CI->admin_ac_student->view_student_all_student_detail()){ ?>
					<td><input type="checkbox" name="mobile[]" value="<?php echo isset($matches[0]) ? $matches[0] : ''; ?>"></td>
					<td align="center">
					<input type="hidden" id="val_<?php echo $student['student_id'] ?>" value="<?php echo $student['mark_star'];?>">
					<?php if($student['mark_star'] == 0): ?>
						<a href="javascript:void(0);" onClick="mark_star(<?php echo $student['student_id']; ?>);"><img src="images/icon/unsel_star.gif" border="0" id="mark_star_img<?php echo $student['student_id']; ?>"/></a>
					<?php else: ?>
						<a href="javascript:void(0);" onClick="mark_star(<?php echo $student['student_id']; ?>);"><img src="images/icon/sel_star.gif" border="0" id="mark_star_img<?php echo $student['student_id']; ?>"/></a>
					<?php endif; ?>
					</td>
					<?php } ?>
					
					<td align="center"><a href="<?php echo site_url('admin/student/one/'.$student['student_id']) ?>"><?php echo $student['name'] ?></a></td>
					<td align="center">
						<?php
							echo !(empty($student['gender'])) ? ( $student['gender'] == 'm' ? '男' : '女' ) : '无';
						?>
					</td>
					<td align="center"><?php echo $student['grade_name'] ?></td>
					
					<?php if($CI->admin_ac_student->view_student_all_student_detail()): ?>
					<td>
						<?php
							echo !(empty($student['father_phone'])) ? '<b>父亲电话:</b> '.$student['father_phone'].'<br/>' : '';
							echo !(empty($student['mother_phone'])) ? '<b>母亲电话:</b> '.$student['mother_phone'] : '';
						?>
					</td>
					<td><?php echo $student['address'] ?></td>
					<td align="center"><?php echo get_student_status_text($student['status']) ?></td>
					<td align="center"><?php echo ($student['last_contact_time'] ? $student['last_contact_time'] : $student['add_time'] )?></td>
					<?php endif; ?>
					
					<?php if($CI->admin_ac_student->view_student_all_finished_hour_dob()): ?>
					<td>
					<?php
						echo $student['dob'];
						//如果今天是生日的话，输入图标。
						list($dob_y, $dob_m, $dob_d) = explode( '-', $student['dob']);
						if($dob_m == date('m') && $dob_d == date('d'))
							echo ' <img src="images/icon/birthday.gif" border="0">';
						
					?>
					</td>
					<td align="center"><?php echo $student['total_hours'] - $student['finished_hours'] ?></td>
					<?php endif; ?>
					
					<?php if($CI->admin_ac_student->view_student_all_teaches()): ?>
					<td>
					<?php
						echo '课程顾问：'.( empty($student['cs_name']) ? '无' : $student['cs_name'] ).'<br/>';
						echo '咨询老师：'.( empty($student['consultant_name']) ? '无' : $student['consultant_name'] ).'<br/>';
						echo '素养老师：'.( empty($student['suyang_name']) ? '无' : $student['suyang_name'] ).'<br/>';
					?>
					</td>
					<?php endif; ?>
					
					<td align="center">
						<?php
						if($CI->admin_ac_student->view_student_all_contact_history($student['status']))
							echo '<a href="javascript:void(0)" onclick="show_history('.$student['student_id'].')">历史记录</a>';
						else
							echo '<a href="'.site_url('admin/student/one/'.$student['student_id']).'">查看</a>';
						?>
						
						<?php if($CI->admin_ac_student->view_student_all_student_detail()): ?>
						<a href="<?php echo site_url('admin/student/sms/'.$student['student_id']) ?>" target="_blank">发短信</a>
						<?php endif; ?>
						
						<?php
						if($CI->admin_ac_student->view_student_all_operation())
						{
							if($student['is_delete'] == 0)
								echo '<a onclick="return confirm(\'确定要删除?\');" href="'.site_url('admin/student/delete/'.$student['student_id']).'">删除</a>';
							else
								echo '<a onclick="return confirm(\'确定要取消删除?\');" href="'.site_url('admin/student/delete/'.$student['student_id'].'/1').'">取消删除</a>';
						}
						?>
					</td>
				</tr>
				<?php endforeach; ?>
				<tfoot>
				<?php if($CI->admin_ac_student->view_student_all_student_detail()): ?>
				<tr>
					<td colspan="3"><img src="images/admin/arrow_ltr.png"  border="0" alt="SEARCH" /> <a href="javascript:void(0);" onclick="markAll()">全选</a> / <a href="javascript:void(0);" onclick="unMarkAll()">全不选</a></td>
					<td colspan="9">操作：<input type="button" value="发短信" name="submit_sms"></td>
				</tr>
				<?php endif; ?>
				</tfoot>
			</table>
		  </form>
		</div>
		<!-- 分页 -->
		<?php echo $page_nav; ?>
	</div>
</div>
<div id="dialog-modal" title="Basic modal dialog" style="display:none"></div>

<script type="text/javascript">
	//ready function
	$(document).ready(function(){
		//发短信按钮
		$("input[name='submit_sms']").click(function(){
			if($(":checked[name^='mobile']").length == 0) {
				alert('请选择！')
			}
			else {
				$("#sms_batch").submit();
			}
		});
	});

	function show_history(student_id)
	{
		$( "#dialog-modal" ).html('<img src="images/icon/wait.gif" alt="Loading..." />');
		$( "#dialog-modal" ).dialog({
			title: '联系历史',
			width: 500,
			modal: true,
			show: 'slide',
			hide: 'fade'
		});
		
		$.post(site_url+"/admin/ajax/get_contact_history", { student_id: student_id},
			function (data, textStatus){
				var html_content = '';
				if(data == '-1')
					html_content += '<img src="images/icon/warning2.gif" style="vertical-align:middle"> 无记录';
				else
				{
					html_content += '<table width="100%" cellspacing="1"><tr><th width="300px" align="center">联系历史</th><th width="150px" align="center">联系时间</th>';

					$.each(data, function(i, field){
						html_content += '<tr>';
						html_content += '<td align="left" style="padding:4px 0 4px 0">' + UrlDecode(field.history_contact) + '</td>';
						html_content += '<td align="center">' + UrlDecode(field.add_time) + '</td>';
						html_content += '</tr>';
					});
					
					html_content += '</table>';
				}
				$( "#dialog-modal" ).html(html_content);
		}, "json");
	}
</script>