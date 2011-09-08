<div id="header-div">
  <div id="logo-div"><a href="<?php echo site_url('admin') ?>"  target="_top">尼德教育 -- 管理系统</a></div>
  <div id="submenu-div">
	<ul>
		<li><a href="<?php echo site_url('admin/admin/logout') ?>"  target="_top">退出</a></li>
		<?php if(is_admin()): //权限: 只有超级管理员可以随机生成密码?>
		<li><a href="<?php echo site_url('admin/staff/admin_gen_psw') ?>" target="main-frame">随机生成密码</a></li>
		<?php endif; ?>
		<li><a href="<?php echo site_url('admin/staff/change_psd') ?>" target="main-frame">修改密码</a></li>
		<li style="border-left:none;"><a href="<?php echo site_url('ics') ?>" target="main-frame">尼德内部咨询系统</a></li>
		<li style="border-left:none;"><font style="color:#FF7F24">欢迎回来, <?php echo $staff_info['username'] ?></font></li>
		<li style="border-left:none;"><img src="images/admin/welcome.gif"></li>
		<li id="supervisor_warn" style="border-left:none;display:none"></li>
	</ul>
    <div id="load-div" style="padding: 5px 10px 0 0; text-align: right; color: #FF9900; display: none;width:40%;float:right;"><img src="images/top_loader.gif" width="16" height="16" alt="正在处理您的请求..." style="vertical-align: middle" /> 正在处理您的请求...</div>
  </div>
</div>

<!-- ajax 控件 -->
<?php 
	if($staff_info['group_id'] == GROUP_SUPERVISOR):
?>
<script type="text/javascript">
	$.post(site_url+"admin/ajax/count_less_10_hours", { staff_id: "<?php echo $staff_info['staff_id'] ?>"},
		function (data, textStatus){
			if(data > 0)
			{
				$("#supervisor_warn").css("display","");
				$("#supervisor_warn").html("<a href='" + site_url + "admin/student'><font color='red'>（"+data+"）位学员剩余课时不足10</font></a>");
			}
		}, "text");
</script>
<?php 
	endif;
?>