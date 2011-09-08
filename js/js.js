var ajaxReq = new AjaxRequest();

function checkTable_falk(obj)
{
	var warningTable = document.getElementById('warningTable');
	var warningText = document.getElementById('warningText');
	
	if( obj.username.value == '')
	{
		warningTable.style.display = '';
		warningText.innerHTML = '请完全填写信息！';
		obj.username.focus();	
	}
	else if( obj.password.value == '')
	{
		warningTable.style.display = '';
		warningText.innerHTML = '请完全填写信息！';
		obj.password.focus();
	}
	else if ( obj.captcha.value == '')
	{
		warningTable.style.display = '';
		warningText.innerHTML = '验证码错误！';
		reloadcode();
		obj.captcha.focus();
	}
	else
	{
		warningTable.style.display = '';
		warningText.innerHTML = '您输入信息有误！';
	}
	
	return false;
	
}

function checkTable_contactus_right(obj)
{
	var warningTable = document.getElementById('warningTable_right');
	var warningText = document.getElementById('warningText_right');
	
	if( obj.username.value == '')
	{
		warningTable.style.display = '';
		warningText.innerHTML = '请完全填写信息！';
		obj.username.focus();	
	}
	else if( obj.phone.value == '')
	{
		warningTable.style.display = '';
		warningText.innerHTML = '请完全填写信息！';
		obj.phone.focus();
	}
	else if( obj.message.value == '')
	{
		warningTable.style.display = '';
		warningText.innerHTML = '请完全填写信息！';
		obj.message.focus();	
	}
	else if ( obj.captcha.value == '')
	{
		warningTable.style.display = '';
		warningText.innerHTML = '验证码错误！';
		reloadcode_right();
		obj.captcha.focus();
	}
	else if( !checkPhone(obj.phone.value) )
	{
		warningTable.style.display = '';
		warningText.innerHTML = '您的电话格式不正确';
		obj.phone.focus();
	}
	else 
	{
		submitGuestbook_contactus_right(obj);		
	}
	
	return false;
}


function submitGuestbook_contactus_right(obj)
{
	var warningTable = document.getElementById('warningTable_right');
	var warningText = document.getElementById('warningText_right');
	
	warningTable.style.display = '';
	warningText.innerHTML = '正在提交.....<img src="' + base_url + 'images/wait.gif" alt="Loading..." />';
	
	var handleRequest = function()
	{
		if (ajaxReq.getReadyState() == 4 && ajaxReq.getStatus() == 200) 
		{
			textData = ajaxReq.getResponseText();
			
			if(textData == 'ok')
			{
				obj.reset();
				reloadcode_right();
				warningText.innerHTML = '<span style="color:green">谢谢您的留言，我们会尽快和您联系！<span>';
			}
			else if(textData == 'captcha wrong')
			{
				reloadcode_right();
				warningText.innerHTML = '验证码错误！';
			}
			else if(textData == 'field empty')
			{
				warningText.innerHTML = '请完全填写信息！';
			}
			else
			{
				warningText.innerHTML = '对不起，留言失败，请重试';
			}
		}
	}
	
	var param = "captcha=" + obj.captcha.value + "&username=" + obj.username.value + "&phone=" + obj.phone.value + "&grade=" + obj.grade.value + "&message=" + obj.message.value + "&from_page=" + thisURL;
	
	ajaxReq.send("POST", site_url + "/ajax/submitGuestBook/", handleRequest, 'application/x-www-form-urlencoded', 'utf8', param);

}

function checkTable(obj)
{
	var warningTable = document.getElementById('warningTable');
	var warningText = document.getElementById('warningText');
	
	if( obj.username.value == '')
	{
		warningTable.style.display = '';
		warningText.innerHTML = '请完全填写信息！';
		obj.username.focus();	
	}
	else if( obj.phone.value == '')
	{
		warningTable.style.display = '';
		warningText.innerHTML = '请完全填写信息！';
		obj.phone.focus();
	}
	else if( obj.message.value == '')
	{
		warningTable.style.display = '';
		warningText.innerHTML = '请完全填写信息！';
		obj.message.focus();	
	}
	else if ( obj.captcha.value == '')
	{
		warningTable.style.display = '';
		warningText.innerHTML = '验证码错误！';
		reloadcode();
		obj.captcha.focus();
	}
	else if( !checkPhone(obj.phone.value) )
	{
		warningTable.style.display = '';
		warningText.innerHTML = '您的电话格式不正确';
		obj.phone.focus();
	}
	else 
	{
		submitGuestbook(obj);		
	}
	
	return false;
}

function submitGuestbook(obj)
{
	var warningTable = document.getElementById('warningTable');
	var warningText = document.getElementById('warningText');
	
	warningTable.style.display = '';
	warningText.innerHTML = '正在提交.....<img src="' + base_url + 'images/wait.gif" alt="Loading..." />';
	
	var handleRequest = function()
	{
		if (ajaxReq.getReadyState() == 4 && ajaxReq.getStatus() == 200) 
		{
			textData = ajaxReq.getResponseText();
			
			if(textData == 'ok')
			{
				obj.reset();
				reloadcode();
				warningText.innerHTML = '<span style="color:green">谢谢您的留言，我们会尽快和您联系！<span>';
			}
			else if(textData == 'captcha wrong')
			{
				reloadcode();
				warningText.innerHTML = '验证码错误！';
			}
			else if(textData == 'field empty')
			{
				warningText.innerHTML = '请完全填写信息！';
			}
			else
			{
				warningText.innerHTML = '对不起，留言失败，请重试';
			}
		}
	}
	
	var param = "captcha=" + obj.captcha.value + "&username=" + obj.username.value + "&phone=" + obj.phone.value + "&grade=" + obj.grade.value + "&message=" + obj.message.value + "&from_page=" + thisURL;
	
	ajaxReq.send("POST", site_url + "/ajax/submitGuestBook/", handleRequest, 'application/x-www-form-urlencoded', 'utf8', param);

}

function checkPhone(str)
{
	var checkMobile = (/^(?:1[358]\d)-?\d{5}(\d{3}|\*{3})/.test(str));
	var checkTel = (/^(([0\+]\d{2,3})?(-)?(0\d{2,3}))(-)?(\d{7,8})(-(\d{3,}))?/.test(str));
	
	if (checkMobile||checkTel)
	{  
		return true;  
	}
	else 
	{  
		return false;  
	}
}

function reloadcode()
{
	var verify=document.getElementById('safecode');
	verify.setAttribute('src',site_url + '/ajax/captcha/' + Math.random());
}
		
function reloadcode_right()
{
	var verify=document.getElementById('safecode_right');
	verify.setAttribute('src',site_url + '/ajax/captcha/' + Math.random());
}
		
function collapse_switch( id )
{
	var student = document.getElementById( id );
	if(student.style.display == 'none') {
		student.style.display = '';
	} else {
		student.style.display = 'none';
	}
}