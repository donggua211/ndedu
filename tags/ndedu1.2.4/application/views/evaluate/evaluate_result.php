<?php
function showOption($options, $question_id, $correct)
{
	foreach($options as $key => $option)
	{
		if($key % 2 == 1)
			echo '<tr height="25">';
		
		echo '<td>';						
		showOptionPre($key, $correct);
		echo $option['text'];
		
		if(isset($option['discription']) && !empty($option['discription']))
			echo '<br/><strong>选项评价：</strong>'.$option['discription'];
		
		echo '</td>';
		if($key % 2 == 0)
			echo '</tr>';
	}
}
function showOptionPre($key, $correct){
	switch($key)
	{
		case '1':
			$pre = 'A.';
			break;
		case '2':
			$pre = 'B.';
			break;
		case '3':
			$pre = 'C.';
			break;
		case '4':
			$pre = 'D.';
			break;
		case '5':
			$pre = 'E.';
			break;
	}
	if(in_array($key, $correct))
		echo '<font class="select_answer">'.$pre.'</font>';
	else
		echo '<font class="">'.$pre.'</font>';
}
function showSelectOption($answer){
	$result = implode($answer, ', ');
	$result = str_replace(array('1', '2', '3', '4', '5'), array('A', 'B', 'C', 'D', 'E'), $result);
	echo $result;
}

function showCorrectOption($correct){
	$correct = implode($correct, ', ');
	$correct = str_replace(array('1', '2', '3', '4', '5'), array('A', 'B', 'C', 'D', 'E'), $correct);
	echo $correct;
}

function isAnwerCorrect($answers, $correct)
{
	if(empty($correct))
		return true;
	
	foreach($answers as $answer)
	{
		if(!in_array($answer, $correct))
			return false;
	}
	return true;
}
?>

<table width="920" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30" background="images/hjxxgh_10.jpg" class="mianbao">
	您所在位置：<a href="<?php echo site_url('') ?>">首页</a> &gt; <a href="<?php echo site_url('evaluate') ?>">尼德测评</a> &gt; <?php echo (isset($my_evaluate) && $my_evaluate) ? '<a href="'.site_url('evaluate/my').'">我的测评</a>' : '<a href="'.site_url('evaluate/'.$evaluate['evaluate_id']).'">'.$evaluate['name'].'</a>'?> &gt; <?php echo (isset($my_evaluate) && $my_evaluate) ? $evaluate['name'] : '测评结果'?>
	</td>
  </tr>
</table>
<table width="920" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
  <td width="247" valign="top">
	<table width="247" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td><img src="images/evaluate/userinfo_banner_top.gif" width="247" height="14" /></td>
		</tr>
	</table>
	<table width="247" border="0" cellspacing="0" cellpadding="0" class="font_12_20" style="padding:5px;border-left:1px solid #FFA901;border-right:1px solid #FFA901;background-color:#FFFBE6;">
		<tr><td colspan="2"><?php echo $user_info['user_name']?>，欢迎您回来</td></tr>
		<tr><td colspan="2">考生姓名：<?php echo $user_info['real_name']?></td></tr>
		<tr><td colspan="2">考生等级：<?php echo ($user_info['is_vip']) ? 'VIP会员' : '普通会员'?></td></tr>
	</table>
	<table width="247" border="0" cellspacing="0" cellpadding="0" class="font_12_20" style="padding:5px;border-left:1px solid #FFA901;border-right:1px solid #FFA901;background-color:#FFFBE6;border-top:1px solid #FFA901">
		<tr  style=''>
			<td><a href="<?php echo site_url('evaluate/my') ?>">我的测评历史</td>
			<td><a href="<?php echo site_url('user/logout') ?>">安全退出</a></td>
		</tr>
	</table>
	<table width="247" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td><img src="images/evaluate/userinfo_banner_bottom.gif" width="247" height="14" /></td>
		</tr>
	</table>
	<table width="247" border="0" cellspacing="0" cellpadding="0" style="margin-top:9px;">
		<tr>
			<td height="33"><a href="<?php echo site_url('growthPlan') ?>"><img src="images/evaluate/banner_growthPlan.gif" width="247" height="72" /></a></td>
		</tr>
	</table>
	<table width="247" border="0" cellspacing="0" cellpadding="0" style="margin-top:9px;">
		<tr>
			<td height="33"><a href="<?php echo site_url('userGrowth') ?>"><img src="images/evaluate/banner_userGrowth.gif" width="247" height="72" /></a></td>
		</tr>
	</table>
	<table width="247" border="0" cellspacing="0" cellpadding="0" style="margin-top:9px;">
		<tr>
		  <td align="center" valign="bottom"><a href="javascript:viod(0);" onclick="collapse_switch('guestbook_table')"><img src="images/hjxxgh_44.jpg" width="247" height="63" border="0" /></a></td>
		</tr>
	</table>
	
	<table id="guestbook_table" width="247" border="0" cellspacing="0" cellpadding="0" style="display:none">
	  <form name="guestbook_right" action="<?php echo site_url().'/guestbook/submit/'?>" method="post" onSubmit="return checkTable_contactus_right(this);">
		<tr>
		  <td height="384" align="center" valign="top" background="images/right_80.jpg"><table width="220" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
			<tr>
			  <td width="70" align="left">姓&nbsp;&nbsp;&nbsp;&nbsp;名：</td>
			  <td align="left"><label>
				<input type="text" name="username" style="width:106px; height:18px; background-color:#FFFFFF; border:1px solid #CCCCCC"/>
			  </label><span id="username_alert" style="display:none"> * </span></td>
			</tr>
		  </table>
			<table width="220" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
			  <tr>
				<td width="70" align="left">电&nbsp;&nbsp;&nbsp;&nbsp;话：</td>
				<td align="left"><label>
				  <input type="text" name="phone" style="width:106px; height:18px; background-color:#FFFFFF; border:1px solid #CCCCCC"/>
				</label><span id="phone_alert" style="display:none"> * </span></td>
			  </tr>
			</table>
			<table width="220" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
			  <tr>
				<td width="70" align="left">年&nbsp;&nbsp;&nbsp;&nbsp;级：</td>
				<td align="left">
				  <select name="grade">
					<option value="preschool">学前班</option>
					<option value="primary_school">小学</option>
					<option value="junior_middle_school">初中</option>
					<option value="high_school">高中</option>
				  </select>
				  <span id="grade_alert" style="display:none"> * </span></td>
			  </tr>
			</table>
			<table width="220" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
			  <tr>
				<td width="70" valign="top">学习情况：</td>
				<td  align="left"><label>
				  <textarea name="message" style="width:148px; height:115px; background-color:#FFFFFF; border:1px solid #CCCCCC; overflow:auto"></textarea>
				</label></td>
			  </tr>
			</table>
			<table width="220" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
			  <tr>
				<td width="70" align="left">验证码：</td>
				<td width="70" align="left"><label>
				  <input type="text" name="captcha" style="width:60px; height:18px; background-color:#FFFFFF; border:1px solid #CCCCCC"/>
				</label></td>
				<td width="80" align="left"><img src="<?php echo site_url().'/ajax/captcha/'?>" id="safecode_right" border="0" onclick="reloadcode_right()" style="cursor:hand;padding:2px 8px 0pt 3px;"  /></td>
				
			  </tr>
			</table>
			<table id="warningTable_right" width="220" border="0" cellspacing="0" cellpadding="0" style="display:none">
			  <tr>
				<td height="24" align="center" class="font_12_red"><div id="warningText_right"></div></td>
			  </tr>
			</table>
			<table width="220" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
			  <tr>
				<td align="center"><label><input type="image" name="submit" align="bottom" src="images/right_19.jpg"></label></td>
			  </tr>
			</table>
			<table width="231" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
			  <tr>
				<td width="231" height="62" align="center" background="images/index2_35.jpg" class="font_12_red" style="padding-left:8px; padding-right:8px; padding-top:4px; font-size:12px; color:#333333; font-weight:bold">请放心，家长所留下的个人信息，尼德将恪守职业道德，为您保密。</td>
			  </tr>
			</table></td>
		</tr>
	  </form>	
	</table>
  </td>
  <td align="right" valign="top">
	<table width="662" border="0" cellpadding="0" cellspacing="0" style="border:1px solid #c8c8c8; padding-bottom:6px;padding-left:20px;padding-right:20px;padding-top:10px">
        <tr>
			<?php if(isset($error)): ?>
				<td height="300"  width="600" align="center" valign="center">
					<span class="font_red_14" style="text-align:center"><?php echo $error ?></span>
				</td>
			<?php else: ?>
				<td height="588"  width="600" align="left" valign="top">
					<table width="550" border="0" cellspacing="0" cellpadding="0" style="background-color:#EBEBEB">
						<tr class="font_12_20">
						  <td height="27" align="left" style="padding:10px">
							<strong>您好，系统根据您的答题结果，得出以下报告，请仔细阅读</strong><br/>
							<strong>答卷名称：<?php echo $evaluate['name']?></strong><br/>						
							开始时间：<?php echo $begin_time?><br/>
							结束时间：<?php echo $end_time?>
						  </td>
						</tr>
					</table>
					<?php if(isset($fanal_score)): ?>
					<table width="550" border="0" cellspacing="0" cellpadding="0" style="background-color:#EBEBEB">
						<tr>
						  <td align="left" style="padding:0 10px 10px 10px">
							<strong>您的得分为：</strong><span style="color:#FF0000;font-size:30px;font-weight:bold"><?php echo $fanal_score ?></span> 分
						  </td>
						</tr>
					</table>
					<?php endif; ?>	
					
					<?php if( !isset($evaluate_data['show_question_in_result']) || $evaluate_data['show_question_in_result']): ?>
					<?php foreach($evaluate_data['questions'] as $question_id => $question): ?>
						<?php
							//处理正确答案
							if(isset($question['correct']) && !empty($question['correct']))
								$question['correct'] = explode(',', $question['correct']);
							else
								$question['correct'] = array();
							
							$isAnwerCorrect = isAnwerCorrect($answer[$question_id], $question['correct']); 
						?>
						<div style="margin-top:5px;padding:5px;background:<?php echo ($isAnwerCorrect) ? '#99FF99' : '#FF8080';?>">
							<img src="images/icon/<?php echo ($isAnwerCorrect) ? 'ok' : 'warning';?>.gif" style="vertical-align:middle;padding:5px">
							<strong><?php echo $question_id.'、'.$question['name'] ?></strong>
							<font style="padding-left:15px">您的答案:（<?php echo showSelectOption($answer[$question_id]); ?>）</font>
						</div>
						<table border="0" cellspacing="0" cellpadding="5" style="margin-top:5px" class="font_12_20">
							<?php
							switch($question['type'])
							{
								case 'textarea':
									echo '<tr><td><input type="textarea" name="question[]'.$question_id.'"></td></tr>';
									break;
								case 'radio':
								case 'checkbox':
									showOption($question['options'], $question_id, $question['correct']);
									break;
							}
							?>
						</table>
						<?php if(!empty($question['correct'])): ?>
						<table border="0" cellspacing="0" cellpadding="5" style="margin-top:5px" class="font_12_18">
							<tr>
								<td><strong>正确答案：</strong><?php echo showCorrectOption($question['correct']); ?></td>
						</table>
						<?php endif; ?>
						<?php if(isset($question['advice']) && !empty($question['advice'])): ?>
						<table border="0" cellspacing="0" cellpadding="5" style="margin-top:5px" class="font_12_18">
							<tr>
								<td><?php echo $question['advice']; ?></td>
						</table>
						<?php endif; ?>
					<?php endforeach; ?>
					<?php endif; ?>	
					
					<?php if(isset($evaluate_data['comment']) && !empty($evaluate_data['comment'])): ?>
					<div style="margin-top:5px;padding:5px;background-color:#EBEBEB">
						<strong>老师评语：</strong><br/><?php echo $evaluate_data['comment'] ?>
					</div>
					<?php endif; ?>
					<?php if(isset($evaluate_data['sumup']) && !empty($evaluate_data['sumup'])): ?>
					<div style="margin-top:10px;padding:5px;background-color:#EBEBEB">
						<strong>综述：</strong><br/><?php echo $evaluate_data['sumup'] ?>
					</div>
					<?php endif; ?>
					<div style="text-align:center; margin-top:10px">
						<form action="<?php echo site_url('evaluate/'.$evaluate['evaluate_id']) ?>" method="post">
						<input type="image" name="submit" align="bottom" src="images/evaluate/reanswer.gif" value="submit">
						</form>
					</div>
				</td>
			<?php endif; ?>
			
			
        </tr>
    </table>
	</td>
  </tr>
</table>