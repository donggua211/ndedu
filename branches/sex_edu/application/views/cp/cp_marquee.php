<style type="text/css">
<!--
#demo {
overflow:hidden;
height: 300px;
text-align: left;
font-size:12px;
color:#666666;
line-height:25px;
}
.font_12_red{
font-size:12px;
color:#FF0000;
line-height:20px;
}	
-->
</style>
<div id="demo">
	<div id="demo1">
		收货人：江苏苏州刘女士<br/>
		发货状态：<span class="font_12_red">已发货</span><br/>
		运单号码：20100000000<br/>
		快递公司：中通速递<br/><br/>
		
		收货人：湖北武汉赵女士<br/>
		发货状态：<span class="font_12_red">已发货</span><br/>
		运单号码：02700504863278<br/>
		快递公司：中通速递<br/><br/>
		
		收货人：陕西咸宁萍刘女士<br/>
		发货状态：<span class="font_12_red">已发货</span><br/>
		运单号码：680106540019<br/>
		快递公司：中通速递<br/><br/>
		
		收货人：北京朝阳张宗禹<br/>
		发货状态：<span class="font_12_red">已发货</span><br/>
		运单号码：02700504863279<br/>
		快递公司：中通速递<br/><br/>
		
		收货人：浙江宁波周家正<br/>
		发货状态：<span class="font_12_red">已发货</span><br/>
		运单号码：680106039049<br/>
		快递公司：中通速递<br/><br/>
		
		收货人：江苏徐州孔凡禹<br/>
		发货状态：<span class="font_12_red">已发货</span><br/>
		运单号码：680106039051<br/>
		快递公司：中通速递<br/><br/>
	</div>
	<div id="demo2">
	</div>
</div>
<script>
	<!--
	var speed=40; //数字越大速度越慢
	var tab=document.getElementById("demo");
	var tab1=document.getElementById("demo1");
	var tab2=document.getElementById("demo2");
	tab2.innerHTML=tab1.innerHTML;
	function Marquee(){
	if(tab2.offsetTop-tab.scrollTop<=0)
	tab.scrollTop-=tab1.offsetHeight
	else{
	tab.scrollTop++;
	}
	}
	var MyMar=setInterval(Marquee,speed);
	tab.onmouseover=function() {clearInterval(MyMar)};
	tab.onmouseout=function() {MyMar=setInterval(Marquee,speed)};
	-->
</script>
</div>