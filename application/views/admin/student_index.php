<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<base href="<?php echo base_url() ?>" />
	<link href="images/admin.css" rel="stylesheet" type="text/css" />
	<title>administrator's control panel</title>
	<script language="javascript">
	function collapse_change(menucount) {
		contact = document.getElementById('contact_' + menucount);
		study = document.getElementById('study_' + menucount);
		if(contact.style.display == 'none') {
			contact.style.display = '';
			study.style.display = '';
		} else {
			contact.style.display = 'none';
			study.style.display = 'none';
		}
	}
	function confirm_delete() {
		if(confirm('确定删除？')) {
			document.delete_form.submit();
			return true;
		} else {
			return false;
		}
	}
	</script>
</head>
<body>
<div id="navigation" class="navigation">
	<a href="<?php echo site_url().'/admin/entry/info'?>">admin</a> &nbsp;»&nbsp; <a href="<?php echo site_url().'/admin/student/index'?>">学生管理</a> &nbsp;»&nbsp; 查看学生
</div>
<div style="padding:10px">
	<?php if(isset($notification)): ?>
	<div style="backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
		<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
	</div>
	<?php endif;?>
	<table cellspacing="0" cellpadding="0" width="1200" align="center" border="0" class="student_border">
		<tr align="center" class="bold_text" bgcolor="#FF6600">
			<td width="60"></td>
			<td width="40">学生ID</td>
			<td width="60">学生姓名</td>
			<td width="50">学生电话</td>
			<td width="60">学生年级</td>
			<td width="80">学生学习情况</td>
			<td width="80">学生父亲名字</td>
			<td width="80">学生父亲电话</td>
			<td width="80">学生母亲姓名</td>
			<td width="80">学生母亲电话</td>
			<td width="40">状态</td>
			<td width="50">添加时间</td>
			<td>备注</td>
			<td width="140">操作</td>
		</tr>
		<tr align="center">
		<?php 
			foreach($students as $student)
			{
				echo '<tr>
						<td align="center"><a onclick="collapse_change('.$student['student_id'].')" href="javascript:void(0)">展开详情</a></td>
						<td align="center">'.$student['student_id'].'</td>
						<td>'.$student['student_name'].'</td>
						<td>'.$student['student_phone'].'</td>
						<td>'.$student['student_grade'].'</td>
						<td>'.$student['student_learning_status'].'</td>
						<td>'.$student['father_name'].'</td>
						<td>'.$student['father_phone'].'</td>
						<td>'.$student['mother_name'].'</td>
						<td>'.$student['mother_phone'].'</td>';
						
				echo	'<td>';
				switch($student['status'])
				{
					case '0':
						echo '未报名';
						break;
					case '1':
						echo '正在学';
						break;
					case '2':
						echo '已学完';
						break;
				}
				echo	'</td>';
				
				echo	'<td>'.$student['add_time'].'</td>
						<td>'.$student['remark'].'</td>
						<td align="center">
							<form action="'.site_url('admin/student/update_status').'" method="post" style="clear:both;padding-left:3px">
							<input type="hidden" name="student_id" value="'.$student['student_id'].'">
							<select name="status">
							<option value="0"' . (($student['status'] == 0) ? 'SELECTED' : '' ) . '>未报名</option>
							<option value="1"' . (($student['status'] == 1) ? 'SELECTED' : '' ) . '>正在学</option>
							<option value="2"' . (($student['status'] == 2) ? 'SELECTED' : '' ) . '>已学完</option>
							<input type="submit" name="submit" value="更改状态">
							</select>
							</form>
							<form action="'.site_url('admin/student/edit').'" method="post" style="float:left;padding-left:3px">
							<input type="hidden" name="student_id" value="'.$student['student_id'].'">
							<input type="hidden" name="action" value="edit">
							<input type="submit" name="submit" value="编辑">
							</form>';
				if(in_array($group_id, array(1))) {
					echo'	<form name="delete_form" action="'.site_url('admin/student/delete').'" method="post" style="float:right;padding-right:3px">
							<input type="hidden" name="student_id" value="'.$student['student_id'].'">
							<input type="button" value="删除" onclick="confirm_delete()">
							</form>';
				}
				echo'	</td>
					</tr>';
				if(in_array($group_id, array(1, 3))) {
					echo'<tr style="display:none" id="contact_'.$student['student_id'].'"><td colspan="14">
						联系记录<br/>
						<form action="'.site_url('admin/student/contact_history').'" method="post">
						<textarea name="contact_history" cols="150" rows="5">'.(isset($student['contact_history'])?$student['contact_history']:'').'</textarea>
						<input type="hidden" name="student_id" value="'.$student['student_id'].'"><br/>
						<input type="submit" name="submit" value="提交更新">
						</form>
					</td></tr>';
				}
				if(in_array($group_id, array(1, 2))) {
				echo'<tr style="display:none" id="study_'.$student['student_id'].'"><td colspan="14">
						学习记录<br/>
						<form action="'.site_url('admin/student/study_history').'" method="post">
						<textarea name="study_history" cols="150" rows="5">'.(isset($student['study_history'])?$student['study_history']:'').'</textarea>
						<input type="hidden" name="student_id" value="'.$student['student_id'].'"><br/>
						<input type="submit" name="submit" value="提交更新">
						</form>
					</td></tr>';
				}
			}
		?>
	</table>
</div>

</body>
</html>