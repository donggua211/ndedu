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
	<a href="<?php echo site_url().'/admin/entry/info'?>">admin</a> &nbsp;»&nbsp; <a href="<?php echo site_url().'/admin/student/index'?>">学生管理</a> &nbsp;»&nbsp; 编辑学生
</div>
<div style="padding:10px">
	<?php if(isset($notification)): ?>
	<div style="backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
		<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
	</div>
	<?php endif;?>
	<form action="<?php echo site_url('/admin/student/edit/')?>" method="post">
		<span style="color:green; font-size:20px">学生基本信息</span><br/>
		学生姓名: <input name="student_name" type="text" value="<?php echo (isset($student['student_name'])) ? $student['student_name'] :''; ?>" />&nbsp;*<br/>
		学生电话: <input name="student_phone" type="text" value="<?php echo (isset($student['student_phone'])) ? $student['student_phone'] :''; ?>" />&nbsp;*<br/>
		学生年级: <input name="student_grade" type="text" value="<?php echo (isset($student['student_grade'])) ? $student['student_grade'] :''; ?>" />&nbsp;*<br/>
		学习情况: &nbsp;*<br/><textarea name="student_learning_status" cols="40" rows="4"><?php echo (isset($student['student_learning_status'])) ? $student['student_learning_status'] :''; ?></textarea><br/>
		<hr/>
		<span style="color:green; font-size:20px">学生家长的信息, 父亲或者母亲, 至少要填一位</span><br/>
		父亲姓名: <input name="father_name" type="text" value="<?php echo (isset($student['father_name'])) ? $student['father_name'] :''; ?>" />&nbsp;*<br/>
		父亲电话: <input name="father_phone" type="text" value="<?php echo (isset($student['father_phone'])) ? $student['father_phone'] :''; ?>" />&nbsp;*<br/>
		母亲姓名: <input name="mother_name" type="text" value="<?php echo (isset($student['mother_name'])) ? $student['mother_name'] :''; ?>" />&nbsp;*<br/>
		母亲电话: <input name="mother_phone" type="text" value="<?php echo (isset($student['mother_phone'])) ? $student['mother_phone'] :''; ?>" />&nbsp;*<br/>
		<hr/>
		备注: <br/>
		<textarea name="remark" cols="40" rows="4"><?php echo (isset($student['remark'])) ? $student['remark'] :''; ?></textarea><br/>
		<input type="hidden" name="action" value="do_edit">
		<input type="hidden" name="student_id" value="<?php echo $student_id ?>">
		<input type="submit" value="提交更新" name="submit"> <input type="reset" value="重写" name="reset"><br/>
	</form>
</div>

</body>
</html>