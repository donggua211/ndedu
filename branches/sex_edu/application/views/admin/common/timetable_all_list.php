<div id="nav">
	<div id="nav_left">
		<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
		<span class="action-span"> » <a href="<?php echo site_url('admin/calendar') ?>" target="main-frame">日程管理</a></span>
		 » 课程表
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
		<div style="margin:10px 10px 20px 10px; text-align:right">
			<div style="float:left;padding-left:20px">
				<select name="show">
					<option value='all' <?php echo ($show == 'all') ? 'SELECTED' : ''?>>全部课程</option>
					<option value='active' <?php echo ($show == 'active') ? 'SELECTED' : ''?>>有效的课程</option>
					<option value='suspend' <?php echo ($show == 'suspend') ? 'SELECTED' : ''?>>暂停的课程</option>
				</select>
			</div>
			<a href="<?php echo site_url('admin/timetable/all/count/'.$show) ?>">切换至课时数模式</a>
		</div>
		<div id="listDiv" class="list-div">
			<table cellspacing='1' id="list-table">
				<tr>
					<th width="9%"></th>
					<th width="13%">星期一</th>
					<th width="13%">星期二</th>
					<th width="13%">星期三</th>
					<th width="13%">星期四</th>
					<th width="13%">星期五</th>
					<th width="13%">星期六</th>
					<th width="13%">星期日</th>
				</tr>
				
				<?php
				function cmp($a, $b)
				{
					if ($a['start_time'] == $b['start_time']) {
						return 0;
					}
					return ($a['start_time'] < $b['start_time']) ? -1 : 1;
				}
					
				ksort($all_time_table);
				foreach($all_time_table as $time_q => $time_table)
				{
					
					//计算出最长的day
					$max = 0;
					foreach($time_table as $key => $val)
					{
						usort($time_table[$key], "cmp");
						if(count($val) > $max)
							$max = count($val);
					}
					
					echo '<tr><th rowspan="'.($max+1).'">';
					switch($time_q)
					{
						case 1:
							echo '上午';
							break;
						case 2:
							echo '下午';
							break;
						case 3:
							echo '晚上';
							break;
					}
					echo '</th></tr>';
					
					
					for($i = 0; $i < $max; $i++)
					{
						echo '<tr>';
						for($j = 1; $j <= 8; $j++)
						{
							echo '<td>';
							if(isset($time_table[$j][$i]))
							{
								echo '<div class="' . (($time_table[$j][$i]['is_suspend'] == 0) ? 'timetable' : 'timetable_suspend') . '">';
								echo '<span class="subject">' . substr($time_table[$j][$i]['start_time'], 0, -3) . ' 至 ' . substr($time_table[$j][$i]['end_time'], 0, -3).'<br/>';
								echo '<span class="subject">' . $time_table[$j][$i]['subject_name'] . '</span><br/>';
								echo '<span class="name">' . $time_table[$j][$i]['name'] . '</span>';
								echo '</div>';
							}
							echo '</td>';
						}
						echo '</tr>';
					}
				}
				?>
			</table>
		</div>
	</div>
</div>

<script type="text/javascript">
	//ready function
	$(document).ready(function(){
		//发短信按钮
		$("select[name='show']").change(function(){
			window.location.href='<?php echo site_url('admin/timetable/all/list') ?>'+'/'+$("select[name='show'] option:selected").val();
		});
	});
</script>