var ajaxReq = new AjaxRequest();

function change_status(radio_val, message_id)
{
	var label1_obj = document.getElementById('st1_' +message_id);
	var label2_obj = document.getElementById('st2_' +message_id);
	var label3_obj = document.getElementById('st3_' +message_id);
	var label_curr_obj = document.getElementById('st' + radio_val + '_' +message_id);
	
	var handleRequest = function()
	{
		if (ajaxReq.getReadyState() == 4 && ajaxReq.getStatus() == 200) 
		{
			label1_obj.style.color="#CCCCCC";
			label2_obj.style.color="#CCCCCC";
			label3_obj.style.color="#CCCCCC";
			label_curr_obj.style.color="#000000";
		}
	}
	
	var param = "status=" + radio_val + "&message_id=" + message_id;
	ajaxReq.send("POST", site_url + "/admin/ajax/update_guestboot_status", handleRequest, 'application/x-www-form-urlencoded', 'utf8', param);
}