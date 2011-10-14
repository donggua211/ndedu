<?php 
	function get_gender_text($index)
	{
		if($index == 'm')
			return '女';
		else
			return '男';
	}
	
	function get_marriage_text($index)
	{
		if($index == 'y')
			return '已婚';
		else
			return '未婚';
	}
	
	function get_situation_text($index)
	{
		switch($index)
		{
			case '1':
				return '目前正在找工作';
			case '2':
				return '自己出来创业';
			case '3':
				return '无业';
			case '4':
				return '在职';
			case '5':
				return '出来投资';
		}
	}
	
	function get_education_type_text($index)
	{
		switch($index)
		{
			case '1':
				return '无';
			case '2':
				return '初中';
			case '3':
				return '高中';
			case '4':
				return '中技';
			case '5':
				return '中专';
			case '6':
				return '大专';
			case '7':
				return '本科';
			case '8':
				return 'MBA';
			case '9':
				return '硕士';
			case '10':
				return '博士';
			case '11':
				return '其他';	
		}
	
	}
?>

<div id="nav">
	<span class="action-span"><a href="<?php echo site_url('admin') ?>"  target="_top">管理系统</a></span>
	<span class="action-span"> » <a href="<?php echo site_url('admin/join') ?>" target="main-frame">查看加入尼德列表</a></span>
	 » <?php echo $join_info['info']['name']; ?>
</div>
<div id="main">
	<div id="main_body">
		<?php if(isset($notification) && !empty($notification)): ?>
		<div style="backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
			<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
		</div>
		<?php endif;?>
		<div class="title"><span>个人资料</span></div>
		<table width="100%">
			<tr>
				<td class="label" valign="top">姓 名：</td>
				<td><?php echo $join_info['info']['name'] ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">加盟省市：</td>
				<td><?php echo $join_info['info']['join_province_name'].' -> '.$join_info['info']['join_city_name']; ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">性 别: </td>
				<td><?php echo get_gender_text($join_info['info']['gender']); ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">出生日期：</td>
				<td><?php echo $join_info['info']['birthday']; ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">居住地区：</td>
				<td><?php echo $join_info['info']['province_name'].' -> '.$join_info['info']['province_name']; ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">邮 编：</td>
				<td><?php echo $join_info['info']['postcode']; ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">居住地址：</td>
				<td><?php echo $join_info['info']['address']; ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">居住时间：</td>
				<td><?php echo $join_info['info']['duration']; ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">家庭电话：</td>
				<td><?php echo $join_info['info']['family_phone']; ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">办公室电话：</td>
				<td><?php echo $join_info['info']['work_phone']; ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">手机：</td>
				<td><?php echo $join_info['info']['mobile']; ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">电子邮件Email：</td>
				<td><?php echo $join_info['info']['email']; ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">最佳联系时间：</td>
				<td><?php echo $join_info['info']['available_time']; ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">受您供养人数：</td>
				<td><?php echo $join_info['info']['provide_count']; ?>人</td>
			</tr>
			<tr>
				<td class="label" valign="top">受供养人姓名及年龄：</td>
				<td><?php echo nl2br($join_info['info']['provide_peaple']); ?></td>
			</tr>
		</table>
		
		<div class="title"><span>商业问卷调查</span></div>
		<table width="70%" align="center">
		<?php foreach($survey_info as $key => $val): ?>
			<tr>
				<td><b>第<?php echo $key; ?>题:</b></td><td><b><?php echo !empty($val['question']) ? $val['question'].'</b><br/>' : '</b>'; ?></td>
			</tr>
			<tr>
				<td></td>
				<td>
					<?php 
						switch($val['type'])
						{
							case 'input':
								echo isset($join_info['survey'][$key]['survey_value']) ? $join_info['survey'][$key]['survey_value'] : '';
								break;
							case 'multi_input':
								if(!isset($join_info['survey'][$key]['survey_value']))
								{
									echo '';
									break;
								}
								
								$val_arr = explode(';', $join_info['survey'][$key]['survey_value']);
								$i = 0;
								foreach($val['option'] as $option)
								{
									echo $option.' '.$val_arr[$i].' <br/>';
									$i++;
								}
								break;
							case 'radio':
								if(!isset($val['option'][$join_info['survey'][$key]['survey_value']]))
								{
									echo '';
									break;
								}
								echo $val['option'][$join_info['survey'][$key]['survey_value']];
								if($join_info['survey'][$key]['survey_value'] == 99)
									echo ' : '.$join_info['survey'][$key]['survey_text'];
								break;
						}
					?>
				</td>
			</tr>
		<?php endforeach; ?>
		</table>
		
		<div class="title"><span>个人简历</span></div>
		<table width="100%">
			<tr>
				<td class="label" valign="top">姓 名：</td>
				<td><?php echo $join_info['cv']['cv_name'] ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">性 别: </td>
				<td><?php echo get_gender_text($join_info['cv']['cv_gendar']); ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">出生日期：</td>
				<td><?php echo $join_info['cv']['cv_birthday']; ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">籍贯：</td>
				<td><?php echo $join_info['cv']['home']; ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">政治面貌：</td>
				<td><?php echo $join_info['cv']['political']; ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">邮婚姻状况：</td>
				<td><?php echo get_marriage_text($join_info['cv']['marriage']); ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">学 历：</td>
				<td><?php echo get_education_type_text($join_info['cv']['education_type']); ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">现 状：</td>
				<td><?php echo get_situation_text($join_info['cv']['situation']); ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">毕业院校：</td>
				<td><?php echo $join_info['cv']['graduated_school']; ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">专 业：</td>
				<td><?php echo $join_info['cv']['major']; ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">手机号：</td>
				<td><?php echo $join_info['cv']['cv_mobile']; ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">电子邮件：</td>
				<td><?php echo $join_info['cv']['cv_email']; ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">现居住地址：</td>
				<td><?php echo $join_info['cv']['cv_address']; ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">现居住邮编：</td>
				<td><?php echo $join_info['cv']['cv_postcode']; ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">教育经历：</td>
				<td><?php echo nl2br($join_info['cv']['education_exp']); ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">工作经历：</td>
				<td><?php echo nl2br($join_info['cv']['working_exp']); ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">家庭情况：</td>
				<td><?php echo nl2br($join_info['cv']['family_infor']); ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">个人评论：</td>
				<td><?php echo nl2br($join_info['cv']['personal_intro']); ?></td>
			</tr>
			<tr>
				<td class="label" valign="top">查看简历</td>
				<td><?php echo ($join_info['cv']['has_attachment'] == '1') ?  '<a href="'.base_url().'upload/cv/'.$join_info['cv']['attachment_name'].'" target="_blank">点击查看</a>' : '无'; ?></td>
			</tr>
		</table>
		
		
		<div class="button-link-div">
			<a href="javascript:void(0);" onclick="history.back(-1)">返回</a>
		</div>
	</div>
</div>