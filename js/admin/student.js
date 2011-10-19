var ajaxReq = new AjaxRequest();

function mark_star(student_id)
{
	var img_obj = document.getElementById('mark_star_img' + student_id);
	var input_val_obj = document.getElementById('val_' + student_id);
	var handleRequest = function()
	{
		if (ajaxReq.getReadyState() == 4 && ajaxReq.getStatus() == 200) 
		{
			if(input_val_obj.value == 1)
			{
				input_val_obj.value = 0;
				img_obj.src = 'images/icon/unsel_star.gif';
			}
			else
			{
				input_val_obj.value = 1;
				img_obj.src = 'images/icon/sel_star.gif';
			}
		}
	}
	
	var val;
	if(input_val_obj.value == 1)
		val = 0;
	else
		val = 1;
	
	var param = "student_id=" + student_id + "&val=" + val;
	ajaxReq.send("POST", site_url + "/admin/ajax/student_mark_star/", handleRequest, 'application/x-www-form-urlencoded', 'utf8', param);
}