<?php if(isset($notification) && !empty($notification)): ?>
<div style="margin-top:20px;backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
	<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
</div>
<?php endif; ?>

<div class="join_cv">
	<form method="post" action="<?php echo site_url('join/finish'); ?>" enctype="multipart/form-data" onsubmit="return submit_cv(this);">
	<table width="640" cellspacing="1" cellpadding="2" border="0" align="center">
		<tbody>
			<tr>
				<td height="72" align="center" colspan="4"><b>个人简历</b></td>
			</tr>
			<tr>
				<td height="28" align="left" class="item" colspan="4">个人资料</td>
			</tr>
			<tr>
				<td width="91" height="29" align="right">姓 名：</td>
				<td width="199" align="left"><input type="text" value="" name="cv_name"></td>
				<td width="82" align="right">性 别：</td>
				<td width="247" align="left">
					<input type="radio" name="cv_gendar" value="m">男
					<input type="radio" name="cv_gendar" value="f">女
				</td>
			</tr>
			<tr>
				<td height="29" align="right">出生日期：</td>
				<td align="left"><input type="text" name="cv_birthday" readonly="readonly" id="birthday" size="12" value="0000-00-00" onclick="SelectDate(this,'yyyy-MM-dd',80,0);" /></td>
				<td align="right">籍 贯：</td>
				<td align="left"><input type="text" name="home"></td>
			</tr>
			<tr>
				<td height="29" align="right">政治面貌：</td>
				<td align="left"><input type="text" name="political"></td>
				<td align="right">婚姻状况：</td>
				<td align="left">
					<input type="radio" name="marriage" value="y">是
					<input type="radio" name="marriage" value="n">否
				</td>
			</tr>
			<tr>
				<td height="29" align="right">学 历：</td>
				<td align="left">
					<select name="education_type">
						<option value="1">无</option>
						<option value="2">初中</option>
						<option value="3">高中</option>
						<option value="4">中技</option>
						<option value="5">中专</option>
						<option value="6">大专</option>
						<option selected="selected" value="7">本科</option>
						<option value="8">MBA</option>
						<option value="9">硕士</option>
						<option value="10">博士</option>
						<option value="11">其他</option>
					</select>
				</td>
				<td align="right">现 状：</td>
				<td align="left">
					<select name="situation">
						<option value="1">目前正在找工作</option>
						<option selected="selected" value="2">自己出来创业</option>
						<option value="3">无业</option>
						<option value="4">在职</option>
						<option value="5">出来投资</option>
					</select>
				</td>
			</tr>
			<tr>
				<td height="29" align="right">毕业院校：</td>
				<td align="left"><input type="text" name="graduated_school"></td>
				<td align="right">专 业：</td>
				<td align="left"><input type="text" name="major"></td>
			</tr>
			<tr>
				<td height="29" align="right">手机号：</td>
				<td align="left"><input type="text" name="cv_mobile"></td>
				<td align="right">电子邮件：</td>
				<td align="left"><input type="text" name="cv_email"></td>
			</tr>
			<tr>
				<td height="29" align="right">现居住地址：</td>
				<td align="left" colspan="3"><input type="text" size="60" name="cv_address"></td>
			</tr>
			<tr>
				<td height="40" align="right">现居住邮编：</td>
				<td align="left" colspan="3"><input type="text" size="6" name="cv_postcode"></td>
			</tr>
			<tr>
				<td height="23" class="item" colspan="4">教育经历</td>
			</tr>
			<tr>
				<td height="94" align="center">&nbsp;</td>
				<td align="left" colspan="3"><textarea rows="5" cols="70" name="education_exp"></textarea></td>
			</tr>
			<tr>
				<td height="22" class="item" colspan="4">工作经历 </td>
			</tr>
			<tr>
				<td height="91" align="center">&nbsp;</td>
				<td height="91" colspan="3"><textarea rows="5" cols="70" name="working_exp"></textarea></td>
			</tr>
			<tr>
				<td height="23" align="left" class="item" colspan="4">家庭情况</td>
			</tr>
			<tr>
				<td height="89" align="center">&nbsp;</td>
				<td colspan="3"><textarea rows="5" cols="70" name="family_infor"></textarea></td>
			</tr>

			<tr>
				<td height="23" align="left" class="item" colspan="4">个人评论</td>
			</tr>
			<tr>
				<td height="81" align="center">&nbsp;</td>
				<td height="81" colspan="3"><textarea rows="5" cols="70" name="personal_intro"></textarea></td>
			</tr>
			<tr>
				<td height="24" class="item" colspan="4">上传附件</td>
			</tr>
			<tr>
				<td height="51" align="right">&nbsp;</td>
				<td height="51" colspan="3">
				<input type="file" name="upfile">
				(附件：个人详细信息、项目计划等&nbsp; word格式：*.doc)</td>
			</tr>
			<tr>
				<td valign="middle" height="51" align="center" colspan="4"><label>
				<input type="submit" name="submit" value="完成并下一步" class="input_button">
				<input type="hidden" name="join_id" value="<?php echo $join_id; ?>">
				<input type="hidden" name="next_action" value="finish">
				</label></td>
			</tr>
		</tbody>
	</table>
	</form>
</div>