var ajaxReq = new AjaxRequest();
var userExists = false;
var gpm = new GlobalProvincesModule;
gpm.def_province = ["省/市", ""];
gpm.def_city1 = ["市/地区", ""];
gpm.def_city2 = ["县/市", ""];
gpm.initProvince(document.getElementById('User_Shen'));
gpm.initCity1(document.getElementById('User_Town'), gpm.getSelValue(document.getElementById('User_Shen')));
document.getElementById('User_Town').value = "";
gpm.initCity2(document.getElementById('User_City'), gpm.getSelValue(document.getElementById('User_Shen')), gpm.getSelValue(document.getElementById('User_Town')));
document.getElementById('User_City').value = "";

function changeProvince() {
	gpm.initCity1(document.getElementById('User_Town'), gpm.getSelValue(document.getElementById('User_Shen')));
	gpm.initCity2(document.getElementById('User_City'), '', '');
} 
function changeTown() {
	gpm.initCity2(document.getElementById('User_City'), gpm.getSelValue(document.getElementById('User_Shen')), gpm.getSelValue(document.getElementById('User_Town')));
}


function focusInput(obj, id, text)
{
	if( obj.value == ''){
		changeBgColor(id, '#F4FCFE');
		changWarningText(id, text, 'tip');
	}
}

function changeBgColor(id, color)
{
	var handle_tr = document.getElementById('tr_'+id);
	handle_tr.style.background = color;
}

function changWarningText(id, text, type)
{
	var handle_warning = document.getElementById('warning_'+id);
	
	
	handle_warning.style.padding = '0 0 0 5px';
	
	if(type=='warning')
	{
		handle_warning.style.border = '1px solid #FF8080';
		handle_warning.innerHTML = '<img src="images/icon/warning.gif" style="vertical-align:middle"> '+'<span class="font_12_18">'+text+'</font>';
	}
	else if(type=='tip')
	{
		handle_warning.style.border = '1px solid #40B3FF';
		handle_warning.innerHTML = '<img src="images/icon/tip.gif" style="vertical-align:middle"> '+'<span class="font_12_18">'+text+'</font>';
	}
	else if(type=='ok')
	{
		handle_warning.innerHTML = '<img src="images/icon/ok.gif" style="vertical-align:middle"> '+'<span class="font_12_18">'+text+'</font>';
	}
}

function blurInput(id)
{
	var handle_tr = document.getElementById('tr_'+id);
	var handle_warning = document.getElementById('warning_'+id);
	handle_tr.style.background = '';
	handle_warning.innerHTML = '';
	handle_warning.style.border = '';
}

function showWarning(id, text, color)
{
	changeBgColor(id, color);
	changWarningText(id, text, 'warning');
}

function checkUser(obj, id)
{
	blurInput(id);
	var pattern=/^[a-zA-Z][a-zA-Z0-9_]{1,14}[a-zA-Z0-9]$/i;
	if( obj.value == '')
	{
		return false;
	}
	else if (obj.value.length < 3) 
	{
		showWarning(id, '帐号长度不能小于3位', '');
		return false;
	}
	else if (obj.value.length > 16)
	{
		showWarning(id, '帐号不能大于16位', '');
		return false;
	}
	else if (!pattern.test(obj.value))
	{
		showWarning(id, '只能由3-16位字母、数字或下划线(_)构成', '');
		return false;
	}
	else
	{
		checkUserExist(obj.value);
	}
}

function checkUserExist(username)
{
	var handleRequest = function()
	{
		if (ajaxReq.getReadyState() == 4 && ajaxReq.getStatus() == 200) 
		{
			textData = ajaxReq.getResponseText();
			
			if(textData == 'yes')
			{
				showWarning('username', '对不起, 您的用户名已存在.', '');
				userExists = true;
			}
			else if(textData == 'no')
			{
				changWarningText('username', '', 'ok');
				userExists = false;
			}
		}
	}
	
	var param = "username=" + username;
	
	ajaxReq.send("POST", site_url + "/ajax/checkUserExist/", handleRequest, 'application/x-www-form-urlencoded', 'utf8', param);

}

function checkRealname(obj, id)
{
	blurInput(id);
	if( obj.value == '')
	{
		return false;
	}
	else
	{
		changWarningText(id, '', 'ok');
		return true;
	}
}

function checkPassword(obj, id)
{
	blurInput(id);
	if( obj.value == '')
	{
		return false;
	}
	else if (obj.value.indexOf(" ", 0) != -1) 
	{
		changWarningText(id, '不能包含空格,', 'warning');
		return false;
	
	}
	else if (obj.value.length < 6) 
	{
		changWarningText(id, '至少要6位以上,', 'warning');
		return false;
	
	}
	else
	{
		changWarningText(id, '', 'ok');
		return true;
	}

}

function checkPasswordC(obj, id)
{
	var password = document.getElementById('password').value;
	blurInput(id);
	if( obj.value == '')
	{
		return false;
	}
	else if (obj.value.indexOf(" ", 0) != -1) 
	{
		changWarningText(id, '不能包含空格,', 'warning');
		return false;
	
	}
	else if (obj.value.length < 6) 
	{
		changWarningText(id, '至少要6位以上,', 'warning');
		return false;
	
	}
	else if (obj.value != password) 
	{
		changWarningText(id, '与上次输入的密码不一致,', 'warning');
		return false;
	
	}
	else
	{
		changWarningText(id, '', 'ok');
		return true;
	}

}

function checkPhoneRegister(obj, id)
{
	blurInput(id);
	if( obj.value == '')
	{
		return false;
	}
	else if(!checkPhone(obj.value))
	{
		changWarningText(id, '您输入的手机号或者座机号格式不对. 手机号应为11位数字, 座机号格式应为: 010-12345678', 'warning');
		return false;  
	}
	else 
	{
		changWarningText(id, '', 'ok');
		return true;  
	}
}

function checkEmail(obj, id)
{
	blurInput(id);
	if( obj.value == '')
	{
		return false;
	}
	else if(!isMail(obj.value))
	{
		changWarningText(id, '您的电子邮箱格式有误，请修改.', 'warning');
		return false;  
	}
	else 
	{
		changWarningText(id, '', 'ok');
		return true;  
	}
}

function isMail(mail) {
	return(new RegExp(/^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/).test(mail));
} 

function checkRegister(obj)
{
	var pattern=/^[a-zA-Z][a-zA-Z0-9_]{1,14}[a-zA-Z0-9]$/i;
	if( obj.username.value == '' )
	{
		obj.username.focus();
		changWarningText('username', '用户名不能为空.', 'warning');
		return false;
	}
	else if (obj.username.value.length < 3) 
	{
		showWarning('username', '帐号长度不能小于3位', '');
		return false;
	}
	else if (obj.username.value.length > 16)
	{
		showWarning('username', '帐号不能大于16位', '');
		return false;
	}
	else if (!pattern.test(obj.username.value))
	{
		showWarning('username', '只能由3-16位字母、数字或下划线(_)构成', '');
		return false;
	}
	else if( userExists )
	{
		showWarning('username', '对不起, 您的用户名已存在.', '');
		obj.username.focus();
		return false;
	}
	else if( obj.realname.value == '' )
	{
		obj.realname.focus();
		changWarningText('realname', '请填写您的姓名.', 'warning');
		return false;
	}
	else if( !checkRealname(obj.realname, 'realname') )
	{
		obj.realname.focus();
		return false;
	}
	else if( obj.password.value == '' )
	{
		obj.password.focus();
		changWarningText('password', '请填写您的密码.', 'warning');
		return false;
	}
	else if( !checkPassword(obj.password, 'password') )
	{
		obj.password.focus();
		return false;
	}
	else if( obj.password_c.value == '' )
	{
		obj.password_c.focus();
		changWarningText('password_c', '请再次填写您的密码.', 'warning');
		return false;
	}
	else if( !checkPasswordC(obj.password_c, 'password_c') )
	{
		obj.password_c.focus();
		return false;
	}
	else if( obj.phone.value == '' )
	{
		obj.phone.focus();
		changWarningText('phone', '请填写您的电话号码.', 'warning');
		return false;
	}
	else if( !checkPhoneRegister(obj.phone, 'phone') )
	{
		obj.phone.focus();
		return false;
	}
	else if( obj.email.value == '' )
	{
		obj.email.focus();
		changWarningText('email', '请填写您的电子邮箱.', 'warning');
		return false;
	}
	else if( !checkEmail(obj.email, 'email') )
	{
		obj.email.focus();
		return false;
	}
	else if( obj.User_City.value == '' )
	{
		changWarningText('province', '请选择您的居住地.', 'warning');
		var handle_warning = document.getElementById('warning_province');
		handle_warning.style.padding = '2px 0 3px 5px';
		return false;
	}
	else if( obj.captcha.value == '' )
	{
		obj.captcha.focus();
		changWarningText('captcha', '请输入验证码.', 'warning');
		return false;
	}

	return true;
	
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
