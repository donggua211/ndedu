var ajaxReq = new AjaxRequest();

function check_message_submit(obj)
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
	else if( obj.email.value == '')
	{
		warningTable.style.display = '';
		warningText.innerHTML = '请完全填写信息！';
		obj.email.focus();	
	}
	else if( obj.type.value == '')
	{
		warningTable.style.display = '';
		warningText.innerHTML = '请完全填写信息！';
		obj.type.focus();	
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
		obj.captcha.focus();
	}
	else if( !checkPhone(obj.phone.value) )
	{
		warningTable.style.display = '';
		warningText.innerHTML = '您的电话格式不正确';
		obj.phone.focus();
	}
	else if( !check_email(obj.email.value) )
	{
		warningTable.style.display = '';
		warningText.innerHTML = '您的email格式不正确';
		obj.email.focus();
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
	
	var param = "captcha=" + obj.captcha.value + "&username=" + obj.username.value + "&phone=" + obj.phone.value + "&email=" + obj.email.value + "&type=" + obj.type.value+ "&message=" + obj.message.value;
	
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

function check_email(str)
{
	var check_email = /^([a-zA-Z0-9]+[_|\-|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\-|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
	return check_email.test(str); 
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

function switch_tag(ul_id, index)
{
	var lis_objs = document.getElementById(ul_id).getElementsByTagName("li");
	
	for(var i=0,l=lis_objs.length;i<l;i++){
		lis_objs[i].className = '';
	}
	lis_objs[index].className = 'cover';
}