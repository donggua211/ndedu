<div id="nav">
	<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
	<span class="action-span"> » <a href="<?php echo site_url('admin/staff') ?>" target="main-frame">员工管理</a></span>
	 » 查看员工
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
		  <form action="<?php echo site_url('admin/staff')?>" method="POST" name="searchForm">
			<img src="images/admin/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
			<!-- 校区 -->
			<?php if(is_admin()): //权限: 只有超级管理员可以按校区搜索?>
			<select name="branch_id">
				<option value='0'>尼德教育所有校区</option>
				<?php
					foreach($branches['branch'] as $branch)
						echo '<option value="'.$branch['branch_id'].'" ' . ( ($branch['branch_id'] == $filter['branch_id']) ? 'SELECTED' : '' ) . '>'.$branch['branch_name'].'</option>';
				?>
			</select>
			<?php endif; ?>
			<!-- 学阶 -->
			<select name="grade_id">
				<option value='0'>全部学阶</option>
				<?php
					foreach($grades as $grade)
						echo '<option value="'.$grade['grade_id'].'" ' . ( ($grade['grade_id'] == $filter['grade_id']) ? 'SELECTED' : '' ) . '>'.$grade['grade_name'].'</option>';
				?>
			</select>
			<!-- 角色 -->
			<?php if(is_admin() || is_school_admin()): //权限: 只有超级管理员可以按校区搜索?>
			<select name="group_id">
				<option value='0'>所有员工角色</option>
				<?php
					foreach($groups as $group)
						echo '<option value="'.$group['group_id'].'" '. (($group['group_id'] == $filter['group_id']) ? 'SELECTED' : '' ) .'>'.$group['group_name'].'</option>';
				?>
			</select>
			<?php endif; ?>
			<!-- 姓名 -->
			员工姓名 <input type="text" name="name" size="15" />
			<input type="submit" value=" 搜索 " class="button" />
		  </form>
		</div>
		
		<div id="listDiv" class="list-div">
		  <form action="<?php echo site_url('admin/student/sms_batch')?>" method="POST" id="sms_batch" target="_blank">
			<table cellspacing='1' id="list-table">
				<tr>
					<th></th>
					<th>姓名</th>
					<th>电话</th>
					<th>籍贯/住址</th>
					<th>备注</th>
					<th>操作</th>
				</tr>
				<?php foreach($staffs as $staff): ?>
				<tr>
					<?php 
						$mobile = $staff['phone'];
						
						//截取电话号码
						preg_match( "/[\d]{11}/", $mobile, $matches);
					?>
					<td><input type="checkbox" name="mobile[]" value="<?php echo isset($matches[0]) ? $matches[0] : ''; ?>"></td>
					<td class="first-cell" align="center"><a href="<?php echo site_url('admin/staff/one/'.$staff['staff_id']) ?>"><?php echo $staff['name'] ?></a></td>
					<td><?php echo $staff['phone'] ?></td>
					<td><?php echo $staff['address'] ?></td>
					<td><span title="<?php echo $staff['remark'] ?>"><?php echo utf_substr($staff['remark'], 45); ?></span></td>
					<td align="center"  id="option_<?php echo $staff['staff_id']; ?>">
					<?php if(is_admin() || is_school_admin()): ?>
						<a href="<?php echo site_url('admin/complain/add/'.$staff['staff_id']) ?>">投诉</a>
						<a href="<?php echo site_url('admin/staff/edit/'.$staff['staff_id']) ?>">编辑</a>
						<?php 
						if($staff['is_active'] == 1) 
							echo '<a onclick="return confirm(\'确定要注销?\');" href="'.site_url('admin/staff/inactive/'.$staff['staff_id']).'">注销</a> ';
						else
							echo '<a onclick="return confirm(\'确定要取消注销?\');" href="'.site_url('admin/staff/inactive/'.$staff['staff_id'].'/1').'">取消注销</a> ';
						
						if($staff['is_delete'] == 0) 
							echo '<a onclick="return confirm(\'确定要删除?\');" href="'.site_url('admin/staff/delete/'.$staff['staff_id']).'">删除</a>';
						else
							echo '<a onclick="return confirm(\'确定要取消删除?\');" href="'.site_url('admin/staff/delete/'.$staff['staff_id'].'/1').'">取消删除</a>';
						?>
					<?php endif; ?>
					</td>
				</tr>
				<?php endforeach; ?>
				<tfoot>
				<tr>
					<td colspan="3"><img src="images/admin/arrow_ltr.png"  border="0" alt="SEARCH" /> <a href="javascript:void(0);" onclick="markAll()">全选</a> / <a href="javascript:void(0);" onclick="unMarkAll()">全不选</a></td>
					<td colspan="3">操作：<input type="button" value="发短信" name="submit_sms"></td>
				</tr>
				</tfoot>
			</table>
		  </form>
		</div>
		<!-- 分页 -->
		<?php echo $page_nav; ?>
	</div>
</div>

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
		
		$.each(trial_staffs, function(i, field){
			load_finished_hours(field);
		});
	});
	
	
	function load_finished_hours(staff_id) {
		$("#option_"+staff_id).ajaxSend(function(e,xhr,opt){
			$("#h_"+staff_id).html('<img src="images/icon/wait.gif" style="vertical-align:middle">');
		});
		
		$.post(site_url+"admin/ajax/count_staff_finished_hours", { staff_id: staff_id},
		function (data, textStatus){
			if(data > <?php echo STAFF_BECOME_FULL_HOURS ?>)
			{
				//载入"转正"按钮
				var temp = '';
				temp = $("#option_"+staff_id).html();
				$("#option_"+staff_id).html('<a href="'+site_url+'admin/staff/become_full/'+staff_id+'">转正</a>' + temp);
				
				//载入课时数
				$("#h_"+staff_id).html('<font style="color:red">'+data+'</font>');
			
			}
			else
			{
				$("#h_"+staff_id).html(data);			
			}
			
		}, "text");
	}
</script>