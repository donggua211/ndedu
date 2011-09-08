<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<base href="<?php echo base_url() ?>" />
	<link href="images/admin.css" rel="stylesheet" type="text/css" />
	<title>administrator's control panel</title>
	<script language="javascript">
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
	<a href="<?php echo site_url().'/admin/entry/info'?>">admin</a> &nbsp;»&nbsp; <a href="<?php echo site_url().'/admin/employee'?>">员工管理</a> &nbsp;»&nbsp; 员工列表
</div>
<div style="padding:10px">
	<?php if(isset($notification)): ?>
	<div style="backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
		<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
	</div>
	<?php endif;?>
	<table cellspacing="0" cellpadding="0" width="800" align="center" border="0" class="student_border">
		<tr align="center" class="bold_text" bgcolor="#FF6600">
			<td width="40">员工ID</td>
			<td width="60">员工姓名</td>
			<td width="50">状态</td>
			<td width="120">添加时间</td>
			<td width="80">员工组</td>
			<td width="80">操作</td>
		</tr>
		<tr align="center">
		<?php 
			foreach($employees as $employee)
			{
				echo '<tr>
						<td align="center">'.$employee['employee_id'].'</td>
						<td>'.$employee['name'].'</td>';
				echo	'<td>';
				switch($employee['is_active'])
				{
					case '0':
						echo '未激活';
						break;
					case '1':
						echo '激活';
						break;
				}
				echo	'</td>
						<td>'.$employee['add_time'].'</td>
						<td>'.$employee['description'].'</td>
						<td align="center">
							<form action="'.site_url('admin/employee/edit').'" method="post" style="float:left;padding-left:3px">
							<input type="hidden" name="employee_id" value="'.$employee['employee_id'].'">
							<input type="hidden" name="action" value="edit">
							<input type="submit" name="submit" value="编辑">
							</form>';
					echo'	<form name="delete_form" action="'.site_url('admin/employee/delete').'" method="post" style="float:right;padding-right:3px">
							<input type="hidden" name="employee_id" value="'.$employee['employee_id'].'">
							<input type="button" value="删除" onclick="confirm_delete()">
							</form>';
				echo'	</td>
					</tr>';
			}
		?>
	</table>
</div>

</body>
</html>