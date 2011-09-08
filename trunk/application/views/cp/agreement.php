<div id="ceping_main">
	<div class="ceping_content">
		<div><span class="font_30_red">许可协议</span> <span class="font_14_gray">请您仔细阅读以下相关说明，便于您顺利进行测评</span></div>	
		<div class="ceping_sub_content">	
			1、如果您是首次登录，请输入详细、准确的个人信息（我们将根据个人信息为您提供更多增值服务），确认后进入测评界面；<br/>
			2、本测评试共有<?php echo $total_title ?>个部分共<?php echo $total_question ?>道测评题，测评时长因人而异，约为40-60分钟；<br/>
			3、本测评必须一次性完成所有题目，如中途退出，已提交信息不予保存，下次再登录将重新开始，请谨慎；<br/>
			4、测试原则：严格按照指导语进行测评，请在安静的环境下真实答题；<br/>
			5、每个用户名和密码只能进行一种版本的一次测评；<br/>
		</div>
	</div>
	<div class="ceping_botton">
	<form action="<?php echo site_url("ceping/agreement"); ?>" method="post">
		<input type="image" name="submit" value="submit" src="images/cp/agreement_botton.jpg">
	</form>
	</div>
</div>