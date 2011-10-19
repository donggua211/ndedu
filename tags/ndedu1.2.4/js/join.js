function changWarningText(id, text, type)
{
	var handle_warning = document.getElementById(id);
	
	handle_warning.style.display = '';
	handle_warning.style.padding = '5px';
	
	if(type=='warning')
	{
		handle_warning.style.background = '#FFFFFF';
		handle_warning.style.border = '1px solid #FF0000';
		handle_warning.style.color = '#FF0000';
		handle_warning.innerHTML = '<img src="images/icon/warning.gif" style="vertical-align:middle"> '+'<font>'+text+'</font>';
	}
	if(type=='warning2')
	{
		handle_warning.style.border = '1px solid #BE3145';
		handle_warning.style.color = '#BE3145';
		handle_warning.innerHTML = '<img src="images/icon/warning2.gif" style="vertical-align:middle"> '+'<font>'+text+'</font>';
	}
	else if(type=='loadding')
	{
		handle_warning.style.border = '';
		handle_warning.innerHTML = '<img src="images/icon/wait.gif" style="vertical-align:middle"> '+'<font>'+text+'</font>';
	}
	else if(type=='ok')
	{
		handle_warning.style.color = '#009933';
		handle_warning.style.border = '';
		handle_warning.innerHTML = '<img src="images/icon/ok.gif" style="vertical-align:middle"> '+'<font>'+text+'</font>';
	}
	else if(type=='hidden')
	{
		handle_warning.style.padding = '';
		handle_warning.style.display = 'none';
	}
	else if(type=='display')
	{
		handle_warning.style.display = '';
		handle_warning.style.padding = '';
	}
}

function submit_personal(form_obj)
{
	//姓名
	if( form_obj.name.value == '')
	{
		changWarningText('name_warning', '请填写您的姓名.', 'warning');
		form_obj.name.focus();
		return false;
	}
	else
	{
		changWarningText('name_warning', '', 'ok');
	}
	
	//性别
	var radios = document.getElementsByName("gender");
	var has_checked = false; //默认值
	for(i = 0; i < radios.length; i++)
	{
		if(radios[i].checked==true)
		{
			has_checked = true;
			break;
		}
	}
	if(!has_checked)
	{
		changWarningText('gender_warning', '请选择您的性别', 'warning');
		return false;
	}
	else
	{
		changWarningText('gender_warning', '', 'ok');
	}
	
	//出生日期
	if( form_obj.birthday.value == '')
	{
		changWarningText('birthday_warning', '请填写您的生日.', 'warning');
		form_obj.birthday.focus();
		return false;
	}
	else
	{
		changWarningText('birthday_warning', '', 'ok');
	}
		
	//居住地
	if( form_obj.province_id.value == 0 || form_obj.city_id.value == 0 )
	{
		changWarningText('province_warning', '请选择您的居住地.', 'warning');
		return false;
	}
	else
	{
		changWarningText('province_warning', '', 'ok');
	}
	
	//邮编
	if( form_obj.postcode.value == '')
	{
		changWarningText('postcode_warning', '请填写您的邮编.', 'warning');
		form_obj.postcode.focus();
		return false;
	}
	else if(!check_postcode(form_obj.postcode.value))
	{
		changWarningText('postcode_warning', '您填写的邮编格式不正确.', 'warning');
		form_obj.postcode.focus();
		return false;
	}
	else
	{
		changWarningText('postcode_warning', '', 'ok');
	}
	
	//居住地址
	if( form_obj.address.value == '')
	{
		changWarningText('address_warning', '请填写您的居住地址.', 'warning');
		form_obj.address.focus();
		return false;
	}
	else
	{
		changWarningText('address_warning', '', 'ok');
	}
	
	//居住时间
	if( form_obj.duration.value == '')
	{
		changWarningText('duration_warning', '请填写您的居住时间.', 'warning');
		form_obj.duration.focus();
		return false;
	}
	else
	{
		changWarningText('duration_warning', '', 'ok');
	}
	
	//家庭电话
	if( form_obj.family_phone.value == '')
	{
		changWarningText('family_phone_warning', '请填写您的家庭电话.', 'warning');
		form_obj.family_phone.focus();
		return false;
	}
	else if(!checkPhone(form_obj.family_phone.value))
	{
		changWarningText('family_phone_warning', '您填写的电话格式不正确.', 'warning');
		form_obj.family_phone.focus();
		return false;
	}
	else
	{
		changWarningText('family_phone_warning', '', 'ok');
	}
	
	//办公室电话
	if( form_obj.work_phone.value == '')
	{
		changWarningText('work_phone_warning', '请填写您的办公室电话.', 'warning');
		form_obj.work_phone.focus();
		return false;
	}
	else if(!checkPhone(form_obj.work_phone.value))
	{
		changWarningText('work_phone_warning', '您填写的电话格式不正确.', 'warning');
		form_obj.work_phone.focus();
		return false;
	}
	else
	{
		changWarningText('work_phone_warning', '', 'ok');
	}
	
	//手机
	if( form_obj.mobile.value == '')
	{
		changWarningText('mobile_warning', '请填写您的手机.', 'warning');
		form_obj.mobile.focus();
		return false;
	}
	else if(!checkPhone(form_obj.mobile.value))
	{
		changWarningText('mobile_warning', '您填写的手机格式不正确.', 'warning');
		form_obj.mobile.focus();
		return false;
	}
	else
	{
		changWarningText('mobile_warning', '', 'ok');
	}
	
	//email
	if( form_obj.email.value == '')
	{
		changWarningText('email_warning', '请填写您的email.', 'warning');
		form_obj.email.focus();
		return false;
	}
	else if(!check_email(form_obj.email.value))
	{
		changWarningText('email_warning', '您填写的email格式不正确.', 'warning');
		form_obj.email.focus();
		return false;
	}
	else
	{
		changWarningText('email_warning', '', 'ok');
	}
	
	//最佳联系时间
	if( form_obj.available_time.value == '')
	{
		changWarningText('available_time_warning', '请填写您的最佳联系时间.', 'warning');
		form_obj.available_time.focus();
		return false;
	}
	else
	{
		changWarningText('available_time_warning', '', 'ok');
	}
	
	//受您供养人数
	if( form_obj.provide_count.value == '')
	{
		changWarningText('provide_count_warning', '请填写您的受您供养人数.', 'warning');
		form_obj.provide_count.focus();
		return false;
	}
	else
	{
		changWarningText('provide_count_warning', '', 'ok');
	}
	
	//受供养人姓名及年龄
	if( form_obj.provide_peaple.value == '')
	{
		changWarningText('provide_peaple_warning', '请填写您的受供养人姓名及年龄.', 'warning');
		form_obj.provide_peaple.focus();
		return false;
	}
	else
	{
		changWarningText('provide_peaple_warning', '', 'ok');
	}
	
	//加盟省份
	if( form_obj.join_provice.value == 0 )
	{
		changWarningText('join_provice_warning', '请选择您的加盟省份.', 'warning');
		return false;
	}
	else
	{
		changWarningText('join_provice_warning', '', 'ok');
	}
	
	//加盟城市
	if( form_obj.join_city.value == 0 )
	{
		changWarningText('join_city_warning', '请选择您的加盟城市.', 'warning');
		return false;
	}
	else
	{
		changWarningText('join_city_warning', '', 'ok');
	}
	
	
	return true;
}


function submit_cv(form_obj)
{
	//姓名
	if( form_obj.cv_name.value == '')
	{
		alert('请填写您的姓名.');
		form_obj.cv_name.focus();
		return false;
	}
		
	//性别
	var radios = document.getElementsByName("cv_gendar");
	var has_checked = false; //默认值
	for(i = 0; i < radios.length; i++)
	{
		if(radios[i].checked==true)
		{
			has_checked = true;
			break;
		}
	}
	if(!has_checked)
	{
		alert('请选择您的性别.');
		return false;
	}
	
	//出生日期
	if( form_obj.cv_birthday.value == '' || form_obj.cv_birthday.value == '0000-00-00')
	{
		alert('请填写您的生日.');
		form_obj.cv_birthday.focus();
		return false;
	}
	
	//籍贯
	if( form_obj.home.value == '' )
	{
		alert('请填写您的籍贯.');
		form_obj.home.focus();
		return false;
	}
	
	//政治面貌
	if( form_obj.political.value == '' )
	{
		alert('请填写您的政治面貌.');
		form_obj.political.focus();
		return false;
	}
	
	//婚姻状况
	var radios = document.getElementsByName("marriage");
	var has_checked = false; //默认值
	for(i = 0; i < radios.length; i++)
	{
		if(radios[i].checked==true)
		{
			has_checked = true;
			break;
		}
	}
	if(!has_checked)
	{
		alert('请选择您的婚姻状况.');
		return false;
	}
	
	//毕业院校
	if( form_obj.graduated_school.value == '' )
	{
		alert('请填写您的毕业院校.');
		form_obj.graduated_school.focus();
		return false;
	}
	
	//专业
	if( form_obj.major.value == '' )
	{
		alert('请填写您的专业.');
		form_obj.major.focus();
		return false;
	}
	
	//手机号
	if( form_obj.cv_mobile.value == '' )
	{
		alert('请填写您的手机号.');
		form_obj.cv_mobile.focus();
		return false;
	}
	
	//email
	if( form_obj.cv_email.value == '' )
	{
		alert('请填写您的电子邮件.');
		form_obj.cv_email.focus();
		return false;
	}
	
	//现居住地址
	if( form_obj.cv_address.value == '' )
	{
		alert('请填写您的现居住地址.');
		form_obj.cv_address.focus();
		return false;
	}
	
	//现居住邮编
	if( form_obj.cv_postcode.value == '' )
	{
		alert('请填写您的现居住邮编.');
		form_obj.cv_postcode.focus();
		return false;
	}
	
	//教育经历
	if( form_obj.education_exp.value == '' )
	{
		alert('请填写您的教育经历.');
		form_obj.education_exp.focus();
		return false;
	}
	
	//工作经历
	if( form_obj.working_exp.value == '' )
	{
		alert('请填写您的工作经历.');
		form_obj.working_exp.focus();
		return false;
	}
	
	//家庭情况
	if( form_obj.family_infor.value == '' )
	{
		alert('请填写您的家庭情况.');
		form_obj.family_infor.focus();
		return false;
	}
	//个人评论
	if( form_obj.personal_intro.value == '' )
	{
		alert('请填写您的个人评论.');
		form_obj.personal_intro.focus();
		return false;
	}
	
	return true;
}