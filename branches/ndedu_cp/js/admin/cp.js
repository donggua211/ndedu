var ajaxReq = new AjaxRequest();

function gen_batch()
{
	var batch = document.getElementById('batch');
	
	changWarningText('batch_notice', '', 'loadding');
	var handleRequest = function()
	{
		if (ajaxReq.getReadyState() == 4 && ajaxReq.getStatus() == 200) 
		{
			textData = ajaxReq.getResponseText();
			batch.value = textData;
			changWarningText('batch_notice', '', 'ok');
		}
	}
	ajaxReq.send("POST", site_url + "/admin/ajax/gen_batch/", handleRequest, 'application/x-www-form-urlencoded', 'utf8');
}

function last_batch()
{
	var batch = document.getElementById('batch');
	
	changWarningText('batch_notice', '', 'loadding');
	var handleRequest = function()
	{
		if (ajaxReq.getReadyState() == 4 && ajaxReq.getStatus() == 200) 
		{
			textData = ajaxReq.getResponseText();
			batch.value = textData;
			changWarningText('batch_notice', '', 'ok');
		}
	}
	ajaxReq.send("POST", site_url + "/admin/ajax/last_batch/", handleRequest, 'application/x-www-form-urlencoded', 'utf8');
}

function last_quan_batch()
{
	var batch = document.getElementById('batch');
	
	changWarningText('batch_notice', '', 'loadding');
	var handleRequest = function()
	{
		if (ajaxReq.getReadyState() == 4 && ajaxReq.getStatus() == 200) 
		{
			textData = ajaxReq.getResponseText();
			batch.value = textData;
			changWarningText('batch_notice', '', 'ok');
		}
	}
	ajaxReq.send("POST", site_url + "/admin/ajax/last_quan_batch/", handleRequest, 'application/x-www-form-urlencoded', 'utf8');
}

function changWarningText(id, text, type)
{
	var handle_warning = document.getElementById(id);
	
	
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