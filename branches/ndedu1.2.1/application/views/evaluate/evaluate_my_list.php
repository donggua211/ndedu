<table width="920" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30" background="images/hjxxgh_10.jpg" class="mianbao">
	您所在位置：<a href="<?php echo site_url('') ?>">首页</a> &gt; <a href="<?php echo site_url('evaluate') ?>">尼德测评</a> &gt; 我的测评
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
	<table width="662" border="0" cellpadding="0" cellspacing="0" style="border:1px solid #c8c8c8; padding-bottom:6px;padding-left:20px;padding-top:10px">
        <tr>
          <td height="588"  width="600" align="left" valign="top">
			<?php if(!empty($evaluate_list)): ?>
				<?php foreach($evaluate_list as $evaluate): ?>
					<table width="600" border="0" cellspacing="0" cellpadding="0" style="border-bottom:1px dashed #c8c8c8;">
					  <tr>
						<td width="600" height="32" align="left" class="font_14" style="background-image:url(images/dott_15.jpg); background-repeat:no-repeat; background-position:5px center; padding-left:15px;"><a href="<?php echo site_url('evaluate/myEvaluate/'.$evaluate['result_id']) ?>"><?php echo $evaluate['name'] ?></a></td>
						<td width="250" align="right"><strong>测试时间: </strong><font style="padding:5px"><?php echo $evaluate['begin_time'] ?></font></td>
					  </tr>
					</table>
				<?php endforeach; ?>
			<?php else: ?>
				暂无测评分类信息. 敬请期待!
			<?php endif; ?>
          </td>
        </tr>
    </table>
	</td>
  </tr>
</table>