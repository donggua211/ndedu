<div id="nav">
	<div id="nav_left">
		<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
		<span class="action-span"> » <a href="<?php echo site_url('admin/staff') ?>" target="main-frame">员工管理</a></span>
		 » <?php echo $staff['name'] ?>
	</div>
	<div id="nav_right">
		所在校区: <span><?php echo $staff['branch_name'] ?></span>
	</div>
</div>
<div style="clear:both"></div>
<div id="main">
	<div id="main_navbar">
		<p>
			<span class="navbar-back"><a href="<?php echo site_url('admin/staff/one/'.$staff['staff_id']) ?>">基本信息</a></span>
			
			<span class="navbar-front"><a href="<?php echo site_url('admin/staff/one/'.$staff['staff_id'].'/timetable') ?>">时间表</a></span>
			
			<?php
			//access control
			$CI = & get_instance();
			if($CI->admin_ac_staff->view_staff_one_sms()):
			?>
			<span class="navbar-back"><a href="<?php echo site_url('admin/staff/one/'.$staff['staff_id'].'/sms') ?>">短信记录</a></span>
			<?php endif; ?>
		</p>
	</div>
	
	<div id="main_body">
		<?php if(isset($notification) && !empty($notification)): ?>
		<div style="backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
			<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
		</div>
		<?php endif;?>
		
		
	</div>
</div>