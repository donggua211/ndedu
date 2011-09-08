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

function copyUrl() {
	var a = this.location.href;
	var b = document.title;
	var c = b + " " + a;
	var userAgent = navigator.userAgent.toLowerCase();
	var is_opera = userAgent.indexOf('opera') != -1 && opera.version();
	var is_ie = (userAgent.indexOf('msie') != -1 && !is_opera) && userAgent.substr(userAgent.indexOf('msie') + 5, 3);

	if(is_ie) {
		clipboardData.setData('Text', c);
		alert("复制成功,请粘贴到你的QQ/MSN上推荐给你的好友！");
	} else if(prompt('你使用的是非IE核心浏览器，请按下 Ctrl+C 复制代码到剪贴板', c)) {
		alert('复制成功,请粘贴到你的QQ/MSN上推荐给你的好友！');
	} else {
		alert('目前只支持IE，请复制地址栏URL,推荐给你的QQ/MSN好友！');
	}
} 
function SetHome(obj,vrl){
	try{
		obj.style.behavior='url(#default#homepage)';obj.setHomePage(vrl);
	}
	
	catch(e){
		if(window.netscape) {
			try {
				netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
			}
			catch (e)
			{
		alert("抱歉！您的浏览器不支持直接设为首页。请在浏览器地址栏输入“about:config”并回车然后将 [signed.applets.codebase_principal_support]设置为“true”，点击“加入收藏”后忽略安全提示，即可设置成功。");
			}
			var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components.interfaces.nsIPrefBranch);
			prefs.setCharPref('browser.startup.homepage',vrl);
		}
	}
} 
/*第一种形式 第二种形式 更换显示样式*/
function setTab(name,cursel,n){
	for(i=1;i<=n;i++){
		var menu=document.getElementById(name+i);
		var con=document.getElementById("con_"+name+"_"+i);
		menu.className=i==cursel?"hover":"";
		con.style.display=i==cursel?"block":"none";
	}
}

function checkEvaluate(count){
	var finished = 0;
	for( var i=1; i <= count; i++){
		var option_1 = document.getElementById('option' + i + '1').checked;
		var option_2 = document.getElementById('option' + i + '2').checked;
		
		if(document.getElementById('option' + i + '3'))
			var option_3 = document.getElementById('option' + i + '3').checked;
		else
			var option_3 = false;
		
		if(document.getElementById('option' + i + '4'))
			var option_4 = document.getElementById('option' + i + '4').checked;
		else
			var option_4 = false;
		
		if(document.getElementById('option' + i + '5'))
			var option_5 = document.getElementById('option' + i + '5').checked;
		else
			var option_5 = false;
					
		if(document.getElementById('option' + i + '6'))
			var option_6 = document.getElementById('option' + i + '6').checked;
		else
			var option_6 = false;
		
		var warning = document.getElementById("warning" + i);
		warning.style.padding = '2px';
		warning.style.margin = '0 10px 0 0';
		if(option_1 == true || option_2 == true || option_3 == true || option_4 == true || option_5 == true || option_6 == true ){
			warning.innerHTML='<img src="images/icon/ok.gif" style="vertical-align:middle">已选';
			finished++;
		} else {
			warning.style.border = '1px solid #FF8080';
			warning.innerHTML='<img src="images/icon/warning.gif" style="vertical-align:middle">您忘记选这道题啦~';
		}
	}
	
	if( finished == count )
		return true;
	else
		return false;
}