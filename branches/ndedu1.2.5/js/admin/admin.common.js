function markAll() {
	$("input:checkbox").attr("checked",true);
}

function unMarkAll () {
	$("input:checkbox").attr("checked",false);
}

function ContentChange(){
	var len=document.getElementById("content").value.length;
	var ts=parseInt(len/64);
	var ys=parseInt(len%64);
	
	if (ys>0){
		ts+=1;
	}
	
	var tsx=parseInt(len/63);
	var ysx=parseInt(len%63);
	
	if (ysx>0){
		tsx+=1;
	}
	if(ts>1){
		document.getElementById("content_Info").innerHTML="（"+len+"字/普通短信:"+ts+"条,长短信:"+tsx+"）";
	}else{
		document.getElementById("content_Info").innerHTML="（"+len+"字/短信:"+ts+"条）";
	}
}

function UrlDecode(str)
{
	var ret="";
	for(var i=0;i<str.length;i++){
		var chr = str.charAt(i);
		if(chr == "+"){
		  ret+=" ";
		}else if(chr=="%"){
		 var asc = str.substring(i+1,i+3);
		 if(parseInt("0x"+asc)>0x7f){
		  ret+=asc2str(parseInt("0x"+asc+str.substring(i+4,i+6)));
		  i+=5;
		 }else{
		  ret+=asc2str(parseInt("0x"+asc));
		  i+=2;
		 }
		}else{
		  ret+= chr;
		}
	}
	return ret;
}