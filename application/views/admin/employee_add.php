<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<base href="<?php echo base_url() ?>" />
	<link href="images/admin.css" rel="stylesheet" type="text/css" />
	<title>administrator's control panel</title>
</head>
<body>
<div id="navigation" class="navigation">
	<a href="<?php echo site_url().'/admin/entry/info'?>">admin</a> &nbsp;»&nbsp; <a href="<?php echo site_url().'/admin/employee'?>">员工管理</a> &nbsp;»&nbsp; 添加员工
</div>
<div style="padding:10px">
	<?php if(isset($notification)): ?>
	<div style="backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
		<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
	</div>
	<?php endif;?>
	<form action="<?php echo site_url().'/admin/employee/add'?>" method="post">
		<span style="color:green; font-size:20px">员工基本信息</span><br/>
		员工账户: <input name="name" type="text" value="<?php echo (isset($employee['name'])) ? $employee['name'] :''; ?>" />&nbsp;*<br/>
		密码: <input name="password" type="text" value="<?php echo (isset($employee['password'])) ? $employee['password'] :''; ?>" />&nbsp;*<br/>
		再次输入密码: <input name="password2" type="text" value="<?php echo (isset($employee['password2'])) ? $employee['password2'] :''; ?>" />&nbsp;*<br/>
		分组: 
		<select name="group">
		<?php
			foreach($groups as $group)
			{
				echo '<option value="'.$group['group_id'].'" ';
				echo (isset($employee['group']) && ($employee['group'] == $group['group_id'])) ? 'SELECTED' :'';
				echo '>'.$group['description'].'</option>';
			}
		?>
		</select><br/>
		是否激活: <input type="radio" name="active" value="1" checked>是 
		<input type="radio" name="active" value="0">否  &nbsp;*<br/>
		<input type="submit" value="添加" name="submit"> <input type="reset" value="重写" name="reset"><br/>
	</form>
</div>

</body>
</html>