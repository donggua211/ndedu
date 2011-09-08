var ajaxReq = new AjaxRequest();

function checkUser(id)
{
	var username = document.getElementById(id);
	
	if(username.value == '')
	{
		changWarningText('username', '对不起, 您的用户名不能为空.', 'warning');
		return false;
	}
	
	var pattern=/^[a-zA-Z][a-zA-Z0-9_.]{1,14}[a-zA-Z0-9]$/i;
	if (!pattern.test(username.value))
	{
		changWarningText('username', '只能由3-16位字母、数字、下划线(_)或者点(.)构成', 'warning');
		return false;
	}
	
	changWarningText('username', '', 'loadding');
	var handleRequest = function()
	{
		if (ajaxReq.getReadyState() == 4 && ajaxReq.getStatus() == 200) 
		{
			textData = ajaxReq.getResponseText();
			if(textData == 'yes')
			{
				changWarningText('username', '对不起, 您的用户名已存在.', 'warning');
			}
			else if(textData == 'no')
			{
				changWarningText('username', '', 'ok');
			}
		}
	}
	var param = "username=" + username.value;
	ajaxReq.send("POST", site_url + "/admin/ajax/check_staff_username/", handleRequest, 'application/x-www-form-urlencoded', 'utf8', param);
}

function changWarningText(id, text, type)
{
	var handle_warning = document.getElementById('warning_'+id);
	
	
	handle_warning.style.padding = '5px';
	
	if(type=='warning')
	{
		handle_warning.style.border = '1px solid #FF8080';
		handle_warning.innerHTML = '<img src="images/icon/warning.gif" style="vertical-align:middle"> '+'<font>'+text+'</font>';
	}
	else if(type=='loadding')
	{
		handle_warning.style.border = '';
		handle_warning.innerHTML = '<img src="images/icon/wait.gif" style="vertical-align:middle"> '+'<font>'+text+'</font>';
	}
	else if(type=='ok')
	{
		handle_warning.style.border = '';
		handle_warning.innerHTML = '<img src="images/icon/ok.gif" style="vertical-align:middle"> '+'<font>'+text+'</font>';
	}
}