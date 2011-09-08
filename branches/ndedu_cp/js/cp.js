var ajaxReq = new AjaxRequest();

function update_ship_value(index)
{
	var handleRequest = function()
	{
		if (ajaxReq.getReadyState() == 4 && ajaxReq.getStatus() == 200) 
		{
			var pingyou_obj = document.getElementById('pingyou_fee');
			var kuaidi_obj = document.getElementById('kuaidi_fee');
			var ems_obj = document.getElementById('ems_fee');
			var huodao_obj = document.getElementById('huodao_fee');
			
			textData = ajaxReq.getResponseText();
			
			pingyou_text = textData.substr(0, textData.indexOf(','));
			textData = textData.substr(textData.indexOf(',')+1);
			kuaidi_text = textData.substr(0, textData.indexOf(','));
			textData = textData.substr(textData.indexOf(',')+1);
			ems_text = textData.substr(0, textData.indexOf(','));
			textData = textData.substr(textData.indexOf(',')+1);
			huodao_text = textData;
			
			pingyou_obj.innerHTML = pingyou_text;
			kuaidi_obj.innerHTML = kuaidi_text;
			ems_obj.innerHTML = ems_text;
			huodao_obj.innerHTML = huodao_text;
		}
	}
	
	ajaxReq.send("GET", site_url + "/ajax/get_ship_value/"+index, handleRequest, 'application/x-www-form-urlencoded', 'utf8');
}

function update_ship_fee(obj)
{
	var province_id = obj.value;
	var province = obj.options[obj.selectedIndex].text;
	
	var ship_to_obj = document.getElementById('ship_to');
	ship_to_obj.innerHTML = province;
	update_ship_value(province_id);
}

function update_action_submit(form_id)
{
	var form_obj = document.getElementById(form_id);
	var action_obj = document.getElementById('action');
	action_obj.value = 'step1';
	form_obj.submit();
}

function check_password(form_obj)
{
	if( form_obj.value == '')
	{
		changWarningText('password_info', '', 'display');
		changWarningText('password_warning', '', 'hidden');
		return false;
	}
	
	var pattern =/^[0-9A-Z]{1,6}$/;
	if( !pattern.exec(form_obj.value))
	{
		changWarningText('password_info', '', 'hidden');
		changWarningText('password_warning', '密码共六位，由大写字母和数字组成.', 'warning');
		return false;
	}
	else
	{
		changWarningText('password_info', '', 'hidden');
		changWarningText('password_warning', '', 'ok');
	}
}

function check_card_id(form_obj)
{
	if( form_obj.value == '')
	{
		changWarningText('cat_id_info', '', 'display');
		changWarningText('cat_id_warning', '', 'hidden');
		return false;
	}
	
	var pattern =/^[0-9]{10}$/;
	if( !pattern.exec(form_obj.value))
	{
		changWarningText('cat_id_info', '', 'hidden');
		changWarningText('cat_id_warning', '帐号共十位，由数字组成.', 'warning');
		return false;
	}
	else
	{
		changWarningText('cat_id_info', '', 'hidden');
		changWarningText('cat_id_warning', '', 'ok');
	}
}

function check_captcha(form_obj)
{
	if( form_obj.value == '')
	{
		changWarningText('captcha_info', '', 'display');
		changWarningText('captcha_warning', '', 'hidden');
		return false;
	}
	
	
	var handleRequest = function()
	{
		if (ajaxReq.getReadyState() == 4 && ajaxReq.getStatus() == 200) 
		{
			textData = ajaxReq.getResponseText();
			
			if(textData == 'ok')
			{
				changWarningText('captcha_info', '', 'hidden');
				changWarningText('captcha_warning', '', 'ok');
				return false;
			}
			else
			{
				changWarningText('captcha_info', '', 'hidden');
				changWarningText('captcha_warning', '输入错误，请重新输入.', 'warning');
				return false;
			}
		}
	}
	ajaxReq.send("GET", site_url + "/ajax/checkCaptcha/"+form_obj.value, handleRequest, 'application/x-www-form-urlencoded', 'utf8');
}

function login_submit(form_obj)
{
	//账号
	var pattern =/^[0-9]{10}$/;
	if( form_obj.card_id.value == '')
	{
		changWarningText('cat_id_info', '', 'hidden');
		changWarningText('cat_id_warning', '请填写账号.', 'warning');
		form_obj.card_id.focus();
		return false;
	}
	else if( !pattern.exec(form_obj.card_id.value))
	{
		changWarningText('cat_id_info', '', 'hidden');
		changWarningText('cat_id_warning', '帐号共十位，由数字组成.', 'warning');
		form_obj.card_id.focus();
		return false;
	}
	else
	{
		changWarningText('cat_id_info', '', 'hidden');
		changWarningText('cat_id_warning', '', 'ok');
	}
	
	//密码
	var pattern =/^[0-9A-Z]{1,6}$/;
	if( form_obj.password.value == '')
	{
		changWarningText('password_info', '', 'hidden');
		changWarningText('password_warning', '请填写密码！', 'warning');
		form_obj.password.focus();
		return false;
	}
	else if( !pattern.exec(form_obj.password.value))
	{
		changWarningText('password_info', '', 'hidden');
		changWarningText('password_warning', '密码共六位，由大写字母和数字组成.', 'warning');
		return false;
	}
	else
	{
		changWarningText('password_info', '', 'hidden');
		changWarningText('password_warning', '', 'ok');
	}
	
	//验证码
	if ( form_obj.captcha.value == '')
	{
		changWarningText('captcha_info', '', 'hidden');
		changWarningText('captcha_warning', '请填写验证码', 'warning');
		form_obj.captcha.focus();
		return false;
	}
	else
	{
		changWarningText('captcha_info', '', 'hidden');
		changWarningText('captcha_warning', '', 'ok');
	}
		
	return true;
}

function submit_comment(form_obj)
{
	if( form_obj.comment.value == '')
	{
		changWarningText('warningText', '请填写评价！', 'warning');
		form_obj.comment.focus();	
	}
	else if( form_obj.name.value == '')
	{
		changWarningText('warningText', '请填写用户名！', 'warning');
		form_obj.name.focus();
	}
	else if ( form_obj.captcha.value == '')
	{
		changWarningText('warningText', '验证码错误！', 'warning');
		reloadcode();
		form_obj.captcha.focus();
	}
	else 
	{
		add_comment(form_obj);		
	}
	
	return false;
}

function add_comment(form_obj)
{
	changWarningText('warningText', '', 'loading');
	
	var handleRequest = function()
	{
		if (ajaxReq.getReadyState() == 4 && ajaxReq.getStatus() == 200) 
		{
			textData = ajaxReq.getResponseText();
			
			if(textData == 'ok')
			{
				form_obj.reset();
				reloadcode();
				changWarningText('warningText', '评论发表成功, 会在通过验证后显示！', 'ok');
			}
			else if(textData == 'captcha wrong')
			{
				reloadcode();
				changWarningText('warningText', '验证码错误！', 'warning');
			}
			else if(textData == 'field empty')
			{
				changWarningText('warningText', '请完全填写信息！', 'warning');
			}
			else
			{
				changWarningText('warningText', '评论失败，请重试', 'warning');
			}
		}
	}
	
	var param = "captcha=" + form_obj.captcha.value + "&name=" + form_obj.name.value + "&comment=" + encodeURIComponent(form_obj.comment.value) + "&cat_id=" + form_obj.cat_id.value;
	
	ajaxReq.send("POST", site_url + "/ajax/add_comment/", handleRequest, 'application/x-www-form-urlencoded', 'utf8', param);

}

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

function submit_order(form_obj)
{
	if( form_obj.name.value == '')
	{
		changWarningText('name_warning', '请填写收货人姓名.', 'warning');
		form_obj.name.focus();
		return false;
	}
	else
	{
		changWarningText('name_warning', '', 'ok');
	}
	
	if( form_obj.province_id.loader == 0 || form_obj.city_id.value == 0 || form_obj.district_id.value == 0)
	{
		changWarningText('loader', '请选择所在的地区.', 'warning');
		return false;
	}
	else
	{
		changWarningText('loader', '', 'ok');
	}
	
	if( form_obj.address.value == '')
	{
		changWarningText('address_warning', '请填写街道地址.', 'warning');
		form_obj.address.focus();
		return false;
	}
	else
	{
		changWarningText('address_warning', '', 'ok');
	}
	
	//邮编
	var pattern =/^[0-9]{6}$/;
	if( form_obj.postcode.value == '' || !pattern.exec(form_obj.postcode.value))
	{
		changWarningText('postcode_warning', '请填写正确的邮编.', 'warning');
		form_obj.postcode.focus();
		return false;
	}
	else
	{
		changWarningText('postcode_warning', '', 'ok');
	}
	
	//手机或座机.
	if( form_obj.phone.value == '' && form_obj.mobile.value == '' )
	{
		changWarningText('phone_warning', '手机或座机必须二填其一.', 'warning');
		form_obj.phone.focus();
		return false;
	}
	else
	{
		changWarningText('phone_warning', '', 'ok');
	}
	
	//座机格式.
	if( form_obj.phone.value != '' && !checkPhone(form_obj.phone.value) )
	{
		changWarningText('phone_warning', '请填写正确的座机格式.', 'warning');
		form_obj.phone.focus();
		return false;
	}
	else
	{
		changWarningText('phone_warning', '', 'ok');
	}
	
	//手机格式.
	if( form_obj.mobile.value != '' && !checkPhone(form_obj.mobile.value) )
	{
		changWarningText('mobile_warning', '请填写正确的手机格式.', 'warning');
		form_obj.mobile.focus();
		return false;
	}
	else
	{
		changWarningText('mobile_warning', '', 'ok');
	}
	
	//购买数量.
	if( form_obj.order_num.value == '' || form_obj.order_num.value <= 0 )
	{
		changWarningText('num_warning', '购买数量不能为空.', 'warning');
		form_obj.mobile.focus();
		return false;
	}
	else
	{
		changWarningText('num_warning', '', 'ok');
	}
	
	//运送方式.
	var delivery_type_checked = false;
	for(var i = 0; i < form_obj.delivery_type.length; i++)
	{
		if(form_obj.delivery_type[i].checked)
		{
			delivery_type_checked = true;
			break;
		}
	}
	if( !delivery_type_checked )
	{
		changWarningText('delivery_warning', '请选择运送方式.', 'warning');
		return false;
	}
	else
	{
		changWarningText('delivery_warning', '', 'ok');
	}
	
	return true;
}

function check_quan()
{
	var quan = document.getElementById("quan");
	var quan_value_obj = document.getElementById("quan_value");
	var total_count_obj = document.getElementById("total_count");
	var old_total_count = document.getElementById("old_total_count").innerHTML;
	
	if(quan.value == undefined || quan.value == '')
	{
		changWarningText('quan_warning', '您还没有填写优惠券!', 'warning');
		quan_value_obj.innerHTML = '0';
		total_count_obj.innerHTML = old_total_count;
		return false;
	}
	
	var handleRequest = function()
	{
		if (ajaxReq.getReadyState() == 4 && ajaxReq.getStatus() == 200) 
		{
			textData = ajaxReq.getResponseText();
			
			if(textData == 'ng')
			{
				changWarningText('quan_warning', '您所填写的优惠券不正确!', 'warning');
				quan_value_obj.innerHTML = '0';
				total_count_obj.innerHTML = old_total_count;
				quan.focus();
				
			}
			else
			{
				changWarningText('quan_warning', '', 'ok');
				quan_value_obj.innerHTML = textData+'.00';
				total_count = (parseInt(old_total_count) - parseInt(textData));
				//如果 total_count 小于零的话, 默认为0
				if(total_count < 0)
					total_count = 0;
				total_count_obj.innerHTML = total_count + '.00';
			}
		}
	}
	
	ajaxReq.send("GET", site_url + "/ajax/check_quan/"+quan.value, handleRequest, 'application/x-www-form-urlencoded', 'utf8');
}

function submit_order_step2(form_obj)
{
	var quan_area_obj = document.getElementById("quan_area");
	var quan = document.getElementById("quan");
	var quan_value_obj = document.getElementById("quan_value");
	var total_count_obj = document.getElementById("total_count");
	var old_total_count = document.getElementById("old_total_count").innerHTML;
	
	
	if( quan_area_obj.style.display == 'none' || quan.value == undefined || quan.value == '')
	{
		changWarningText('quan_warning', '', 'ok');
		quan_value_obj.innerHTML = '0';
		total_count_obj.innerHTML = old_total_count;
		return true;
	}
	
	var handleRequest = function()
	{
		if (ajaxReq.getReadyState() == 4 && ajaxReq.getStatus() == 200) 
		{
			textData = ajaxReq.getResponseText();
			
			if(textData == 'ng')
			{
				changWarningText('quan_warning', '您所填写的优惠券不正确!', 'warning');
				quan_value_obj.innerHTML = '0';
				total_count_obj.innerHTML = old_total_count;
				quan.focus();
				
			}
			else
			{
				changWarningText('quan_warning', '', 'ok');
				quan_value_obj.innerHTML = textData+'.00';
				total_count_obj.innerHTML = (parseInt(old_total_count) - parseInt(textData)) + '.00';
				form_obj.submit();
			}
		}
	}
	
	ajaxReq.send("GET", site_url + "/ajax/check_quan/"+quan.value, handleRequest, 'application/x-www-form-urlencoded', 'utf8');
	
	return false;
}

function submit_userinfo(form_obj)
{
	if( form_obj.name.value == '')
	{
		changWarningText('name_warning', '请填写真实姓名.', 'warning');
		form_obj.name.focus();
		return false;
	}
	else
	{
		changWarningText('name_warning', '', 'ok');
	}
		
	//手机格式.
	if( form_obj.phone.value == '' || !checkPhone(form_obj.phone.value) )
	{
		changWarningText('phone_warning', '请填写正确的手机格式.', 'warning');
		form_obj.phone.focus();
		return false;
	}
	else
	{
		changWarningText('phone_warning', '', 'ok');
	}
	
	//email.
	if( form_obj.email.value == '' || !check_email(form_obj.email.value) )
	{
		changWarningText('email_warning', '请填写正确的email格式.', 'warning');
		form_obj.email.focus();
		return false;
	}
	else
	{
		changWarningText('email_warning', '', 'ok');
	}
	
	//所在学校.
	if( form_obj.school.value == '' )
	{
		changWarningText('school_warning', '请填写所在学校.', 'warning');
		form_obj.school.focus();
		return false;
	}
	else
	{
		changWarningText('school_warning', '', 'ok');
	}
	
	if( form_obj.grade_id.value == 0 )
	{
		changWarningText('grade_warning', '请选择所在的年级.', 'warning');
		return false;
	}
	else
	{
		changWarningText('grade_warning', '', 'ok');
	}
	
	if( form_obj.province_id.value == 0 || form_obj.city_id.value == 0 || form_obj.district_id.value == 0)
	{
		changWarningText('loader', '请选择所在的地区.', 'warning');
		return false;
	}
	else
	{
		changWarningText('loader', '', 'ok');
	}
	
	return true;
}

function checkCP(count)
{
	var unfinished = 0;
	
	for( var i = 0; i < count; i++ )
	{
		//获取每一题的obj
		var radios = document.getElementsByName("answer[" + i + "]");
		var warning_id = "warning" + i;
		var has_checked = false; //默认值
		for(j = 0; j < radios.length; j++)
		{
			if(radios[j].checked==true)
			{
				changWarningText(warning_id, '', 'ok');
				has_checked = true;
				break;
			}
		}
		
		//如果本题无一选中的话.
		if(!has_checked)
		{		
			unfinished++;
			changWarningText(warning_id, '您忘记选这道题啦~', 'warning2');
			if(unfinished == 1)
				window.location.hash = i;
		}
	}
	
	if( unfinished == 0 )
		return true;
	else
		return false;
}

function detail_buy_mouse(div_obj, bg_color, border_color)
{
	div_obj.style.background = '#' + bg_color;
	div_obj.style.border = '1px solid #' + border_color;

}