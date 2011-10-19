<div id="nav">
	<div id="nav_left">
		<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
		<span class="action-span"> » <a href="<?php echo site_url('admin/student') ?>" target="main-frame">学员管理</a></span>
		<span class="action-span"> » <a href="<?php echo site_url('admin/student') ?>" target="main-frame">查看学员</a></span>
		<span class="action-span"> » <a href="<?php echo site_url('admin/student/one/'.$student['student_id'].'/contract') ?>" target="main-frame"><?php echo $student['name'] ?></a></span>
		 » 修改合同
	</div>
	<div id="nav_right">
		所在校区: <span><?php echo $student['branch_name'] ?></span>
	</div>
</div>
<div style="clear:both"></div>
<div id="main">
	<div id="main_body">
		<?php if(isset($notification) && !empty($notification)): ?>
		<div style="backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
			<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
		</div>
		<?php endif;?>
		<div class="title">
			<span>编辑合同</span>
		</div>
		<form action="<?php echo site_url('admin/contract/edit')?>" method="post">
		<table width="90%">
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>合同时间: </td>
				<td>
					从 <input type="text" name="start_time" maxlength="60" size="20" value="<?php echo (isset($contract_info['start_time'])) ? $contract_info['start_time'] :''; ?>" readonly="readonly" id="start_time_id" /> 
					<input name="selbtn1" type="button" id="selbtn1" onclick="return showCalendar('start_time_id', '%Y-%m-%d', '24', false, 'selbtn1');" value="选择" class="button"/> 到 <input type="text" name="end_time" maxlength="60" size="20" value="<?php echo (isset($contract_info['end_time'])) ? $contract_info['end_time'] :''; ?>" readonly="readonly" id="end_time_id" /> <input name="selbtn1" type="button" id="selbtn2" onclick="return showCalendar('end_time_id', '%Y-%m-%d', '24', false, 'selbtn2');" value="选择" class="button"/> 

				</td>
			</tr>
			<tr>
				<td class="label" valign="top"><span class="notice-star"> * </span>详细信息: </td>
				<td>
					总时间为: <input name="total_hours" type="text" value="<?php echo (isset($contract_info['total_hours'])) ? $contract_info['total_hours'] :''; ?>" size="20" /> 小时<br/>
					总金额为: <input name="contact_value" type="text" value="<?php echo (isset($contract_info['contact_value'])) ? $contract_info['contact_value'] :''; ?>" size="20" /> 元. 其中押金: <input name="deposit" type="text" value="<?php echo (isset($contract_info['deposit'])) ? $contract_info['deposit'] :''; ?>" size="20" /> 元<br/>
					
				</td>
			</tr>	
		</table>
		<div class="button-div">
			<input type="hidden" value="<?php echo $contract_info['contract_id']; ?>" name="contract_id">
			<input type="submit" class="button" value=" 更新 " name="submit">
			<input type="reset" class="button" value=" 重置 " name="reset">
		</div>
		</form>
	</div>
</div>