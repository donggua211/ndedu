<div id="nav">
	<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
	<span class="action-span"> » <a href="<?php echo site_url('admin/hr') ?>" target="main-frame">HR系统</a></span>
	 » 内部提案列表
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
		  <form action="<?php echo site_url('admin/hr')?>" method="POST" name="searchForm">
			<img src="images/admin/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
			面试时间: <input name="add_time_a" id="add_time_a" type="text" value="<?php echo $filter['add_time_b'] ?>" size='10'/>
			和<input name="add_time_b" id="add_time_b" type="text" value="<?php echo $filter['add_time_b'] ?>" size='10'/>之间
			<!-- 姓名 -->
			姓名 <input type="text" name="name" size="15" />
			<input type="submit" value=" 搜索 " class="button" />
		  </form>
		</div>
		
		<div id="listDiv" class="list-div">
			<table cellspacing='1' id="list-table">
				<tr>
					<th>姓名</th>
					<th>电话邮箱</th>
					<th>部门</th>
					<th>职位</th>
					<th>通知<br/>次数</th>
					<th>面试时间</th>
					<th>通知时间</th>
					<th>通知<br/>方式</th>
					<th>状态</th>
					<th>备注</th>
					<th>操作</th>
				</tr>
				<?php foreach($lists as $val): ?>
				<tr>
					<td><?php echo $val['name']; ?></td>
					<td><?php echo $val['mobile'].'<br/>'.$val['email'] ?></td>
					<td align="center"><?php echo mb_substr($val['group_name'], 0, mb_strpos($val['group_name'], '主管') )?>组</td>
					<td align="center"><?php echo $val['position_name'] ?></td>
					<td align="center"><?php echo $val['contact_num']; ?></td>
					
					<td align="center"><?php echo (isset($val['interview_time']['interviewer_time'])) ? $val['interview_time']['interviewer_time'].' (周'.date('N', strtotime($val['interview_time']['interviewer_time'])).')' : ''; ?></td>
					<td align="center"><?php echo (isset($val['interview_time']['add_time'])) ? $val['interview_time']['add_time'] : ''; ?></td>
					<td align="center"><?php echo (isset($val['interview_time']['notice_method'])) ? get_hr_interview_notice_mothed_text($val['interview_time']['notice_method']) : ''; ?></td>
					
					
					<td align="center"><?php echo get_hr_interview_status_text($val['status']); ?></td>
					<td><span title="<?php echo $val['remark'] ?>"><?php echo utf_substr($val['remark'], 45); ?></span></td>
					<td align="center">
					<?php
						$CI = & get_instance();
						if($CI->admin_ac_hr->hr_interviwe_time_ac()):
					?>
						<a href="javascript:void(0)" onclick="shw_add_interview_time(<?php echo $val['interviewer_id'] ?>)">添加面试时间</a>
						<a href="javascript:void(0)" onclick="shw_interview_time(<?php echo $val['interviewer_id'] ?>)">查看面试时间</a>
					<?php endif;?>
						<a href="<?php echo site_url('admin/hr/edit/'.$val['interviewer_id']) ?>">编辑</a>
						<a onclick="return confirm('确定要删除?');" href="<?php echo site_url('admin/hr/delete/'.$val['interviewer_id']) ?>">删除</a>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
		  </form>
		</div>
		<!-- 分页 -->
		<?php echo $page_nav; ?>
	</div>
</div>
<div id="dialog-modal" title="Basic modal dialog" style="display:none">
	<form action="<?php echo site_url('admin/hr/add_interview_time') ?>" method="post">
	<table width="90%">
		<tr>
			<td class="label" valign="top"><span class="notice-star"> * </span>面试时间: </td>
			<td>
				日期: <input name="interviewer_date" id="interviewer_date" type="text" value="" size='10'/> 小时: <?php echo show_hour_options('hour') ?>： <?php echo show_mins_options('mins') ?>
			</td>
		</tr>
		<tr>
			<td class="label" valign="top"><span class="notice-star"> * </span>通知方式: </td>
			<td>
				<select name="notice_method">
					<option value='<?php echo HR_NOTICE_METHOD_MOBILE ?>'><?php echo get_hr_interview_notice_mothed_text(HR_NOTICE_METHOD_MOBILE) ?></option>
					<option value='<?php echo HR_NOTICE_METHOD_SMS ?>'><?php echo get_hr_interview_notice_mothed_text(HR_NOTICE_METHOD_SMS) ?></option>
					<option value='<?php echo HR_NOTICE_METHOD_EMAIL ?>'><?php echo get_hr_interview_notice_mothed_text(HR_NOTICE_METHOD_EMAIL) ?></option>
					<option value='<?php echo HR_NOTICE_METHOD_SELF ?>'><?php echo get_hr_interview_notice_mothed_text(HR_NOTICE_METHOD_SELF) ?></option>
				</select>
			</td>
		</tr>
		
	</table>
	<div class="button-div">
		<input type="hidden" id="interviewer_id" name="interviewer_id" value="0">
		<input type="submit" class="button" value=" 确定 " name="submit">
		<input type="reset" class="button" value=" 重置 " name="reset">
	</div>
	</form>
</div>

<div id="dialog-modal2" title="Basic modal dialog" style="display:none">

<script type="text/javascript">
	$( "#interviewer_date" ).datepicker({
			changeMonth: true,
			changeYear: true,
			showOn: 'button',
			buttonText: '选择',
			dateFormat: 'yy-mm-dd'
	});
	
	$( "#add_time_a" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd'
	});
	
	$( "#add_time_b" ).datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd'
	});
	
	function shw_add_interview_time(interviewer_id)
	{
		$( "#dialog-modal" ).dialog({
			title: '添加面试时间',
			width: 500,
			modal: true,
			show: 'slide',
			hide: 'fade'
		});
		$( "#interviewer_id" ).val(interviewer_id);
	}
	
	function shw_interview_time(interviewer_id)
	{
		$( "#dialog-modal2" ).html('<img src="images/icon/wait.gif" alt="Loading..." />');
		$( "#dialog-modal2" ).dialog({
			title: '面试时间',
			width: 500,
			modal: true,
			show: 'slide',
			hide: 'fade'
		});
		
		$.post(site_url+"admin/ajax/get_interview_time", { interviewer_id: interviewer_id},
			function (data, textStatus){
				var html_content = '';
				if(data == '-1')
					html_content += '<img src="images/icon/warning2.gif" style="vertical-align:middle"> 无记录';
				else
				{
					html_content += '<table width="100%" cellspacing="1"><tr><th align="center">通知时间</th><th align="center">面试时间</th><th align="center">通知方式</th><th align="center">操作</th>';

					$.each(data, function(i, field){
						html_content += '<tr>';
						html_content += '<td align="center" style="padding:4px 0 4px 0">' + UrlDecode(field.interviewer_time) + '</td>';
						html_content += '<td align="center">' + UrlDecode(field.add_time) + '</td>';
						html_content += '<td align="center">' + get_hr_interview_notice_mothed_text(UrlDecode(field.notice_method)) + '</td>';
						html_content += '<td align="center"><a href="'+site_url+'admin/hr/edit_interview_time/'+field.interview_time_id+'">编辑</a> <a href="'+site_url+'admin/hr/delete_interview_time/'+field.interview_time_id+'">删除</a></td>';
						html_content += '</tr>';
					});
					
					html_content += '</table>';
				}
				$( "#dialog-modal2" ).html(html_content);
		}, "json");
	}
	
	function get_hr_interview_notice_mothed_text(status)
	{
		switch(status)
		{
			case '<?php echo HR_NOTICE_METHOD_MOBILE ?>':
				return '电话';
				break;
			case '<?php echo HR_NOTICE_METHOD_SMS ?>':
				return '短信';
				break;
			case '<?php echo HR_NOTICE_METHOD_EMAIL ?>':
				return '邮件';
				break;
			case '<?php echo HR_NOTICE_METHOD_SELF ?>':
				return '自来';
				break;
		
		}
	}
</script>