<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<title><?php echo $meta_title ?></title>
	<base href="<?php echo base_url() ?>" />
	<link href="<?php echo base_url() ?>/css/cp_result.css" rel="stylesheet" type="text/css">
    <script language="javascript" type="text/javascript">
        function SetPrint(s,n) {
            document.all.factory.printing.header = n; //页眉
            document.all.factory.printing.footer = "尼德全方位测评系统"; //页脚
            //document.all.factory.printing.paperSize = "A4";
            if (s == "1") {
                document.all.factory.printing.Preview(); //打印预览
            }
            else {
                document.all.factory.printing.Print(true); //打印
            }
        }
    </script>
</head>
<body class="PrintBg">
<div>
    <div class="ExplainDiv border">
		<div class="cover_nav">
			<img src="images/logo.gif" />
			<span >www.ndedu.org</span>
		</div>
		<div class="cover">
			<p><?php echo $card_info['cat_name'];?></p>
			<p style="font-size:26px;">评估报告</p>
		</div>
		<table class="GeRenDiv" border="0" cellpadding="0" cellspacing="0"><tbody>
		<tr><td>
			<table width="100%" border="0" cellpadding="0" cellspacing="0"><tbody>
				<tr><td class="ULTd" width="50%">学员姓名：</td><td class="URTd" width="50%"><?php echo $card_info['user_info']['name'] ?></td></tr>
				<tr><td class="ULTd" width="50%">测评单位：</td><td class="URTd" width="50%">尼德教育</td></tr>
				<tr><td class="ULTd" width="50%">报告日期：</td><td class="URTd" width="50%"><?php echo date('Y-m-d')?></td></tr>
				<tr><td colspan="2" height="120">&nbsp;</td></tr>
				<tr><td colspan="2" class="TxTd">警告：个人报告未经许可不得传阅</td></tr>
				<tr><td colspan="2" class="TxTd">尼德全方位测评系统</td></tr>
				<tr><td colspan="2" class="TxTd">www.ndedu.org</td></tr>
			</tbody></table>
		</td></tr>
		</tbody></table>
	</div>
	<div class="PageNext"></div>
	
	<div class="ExplainDiv border">
		<h1>前言</h1>
		<div class="ExplainNeiDiv">
			<p>多年来，持续不断地专注于儿童教育行业，接触孩子、家长、教师成千上万，最最重要的一个问题就是“成人（家长和教师）不了解孩子，孩子不了解自己。”</p>
			<p>然而每个家长都以为自己最懂孩子，最爱孩子，但是孩子却与家长距离越来越远，焦虑、苦闷、厌学、逆反随之而来。</p>
			<p>多少父母不惜重金为孩子的身体提供一个物质天堂，却不愿为孩子的心理搭建一间温馨的精神小屋；</p>
			<p>多少父母托关系找门路为孩子争取重点小学初中学校，却从来不问孩子在重点学校学习生活是否快乐；</p>
			<p>多少父母总是拿自己的孩子与别人的比，从来都看不到自己孩子的优点，即使偶尔看到也不愿意对孩子说；</p><br/>

			<p>多少孩子年少时由于缺乏对自己正确的认识而没有很好的把握自己，以至于长大后当面对生存、面对社会时惊慌失措和无可奈何。</p>
			<p>多少孩子在（特别是小学高年级与初中年级）面对父母情感变动、自己生理变化、学业压力、考试压力时由于缺少相应的帮助而孤独的挣扎。</p>
			<p>多少孩子由于高考填报自愿和选择大学专业缺少专业的咨询和帮助而耽误了整个青春。</p>
			<p>多少孩子本来应该学业优秀，但就是因为缺乏自信而成绩平平。</p>
			<p>多少孩子天资聪颖，然而由于缺乏正确引导而误入歧途。</p><br/>
			
			<p>太多太多类似的现实案例，让我们警醒，让我们反思，让我们肩负起儿童教育的使命！</p><br/>

			<p>尼德教育全方位测评系统，覆盖小学、初中、高中三个学阶，特别是高中阶段分为应试测评、高考状态测评、高考专业选择测评。</p>
			<p>测评系统只是一个工具，可以帮助家长更加了解孩子的问题，可以帮助孩子更加了解自己的强弱项，同时给出专业的解决问题的方法和建议，但是不能代替家长和孩子自己的努力和勤奋！</p><br/>

			<p>不管人生的路多么漫长，童年都是一个意义重大的起点，隐藏着无法破译的心理秘密，一个阳光灿烂的童年储存了一声受用不尽的财富。在独生子女的时代，多数中国人做父母或者子女都只有一次机会，错了就无法再来，失去晨曦也将失去夕阳。我衷心祝愿尼德教育全方位测评系统为更多的家庭和孩子带去洒满阳光的童年。</p><br/>
			
			<b>尼德全方位测评系统统研发团队</b><br/><br/>
			<p>尼德全方位测评系统由北京师范大学、北京大学多位教育心理专家、特高级教师参与指导，由尼德教育IT事业部、咨询测评部、教学部骨干人员实际编写开发，根据严格的科学程序研发而成。</p><br/>
			<b>尼德全方位测评系统提供内容支持的名师团队（节选部分人员，按姓氏首字母顺序排列）</b><br/><br/>
			<table class="LaoTable" border="0" cellpadding="0" cellspacing="0"><tbody>
				<tr><td><strong>和震</strong> 北京师范大学教育学院 教授</td><td><strong>邵荃</strong> 北京师范大学教育学院 博士</td></tr>
				<tr><td><strong>李红菊</strong> 北京师范大学心理学院 博士</td><td><strong>付晓敬</strong> 《语文世界》 总策划</td></tr>
				<tr><td><strong>陈晓惠</strong> 《中学生数理化》 高中部的主任</td><td><strong>谭晓</strong> 北京西城实验中学 特级教师</td></tr>
				<tr><td colspan="2"><strong>王惠</strong> 国家二级心理咨询师</td></tr>
			</tbody></table>
		</div>
	</div>
	<div class="PageNext"></div>
	
	<?php 
	$CI =& get_instance();
	//获取得分.
	$total_score = array();
	foreach($answer_arr as $key => $val)
	{
		$this_answers = explode(',', $val);
		$total_score[] = $CI->cp_score->score($this_answers, $CI->config->config['answer_info']['score_info'][$key]);
	}
	
	foreach($total_score as $key => $score)
	{
		$this_answer_info = $CI->config->config['answer_info']['result_info'][$key];
		$this_image_info = isset($CI->config->config['answer_info']['image_info'][$key]) ? $CI->config->config['answer_info']['image_info'][$key] : array();
		$this_total_score = isset($CI->config->config['answer_info']['total_score'][$key]) ? $CI->config->config['answer_info']['total_score'][$key] : 0;
	
		echo '<div class="ExplainDiv">';
		
		//前言
		if(isset($this_answer_info['pre_title']))
		{
			echo '<div class="ExplainNeiDiv_pre_title">';
			//pre title 标题
			echo '<h1>'.$this_answer_info['pre_title'].'</h1>';
			
			//在 title text 前显示图片
			if(!empty($this_image_info) && (isset($this_image_info['position']) && $this_image_info['position'] == 'pre_title_text'))
				echo '<div class="pimg">'.$CI->cp_score->image($key, $this_image_info, $total_score, $cp_list).'</div>';
			
			echo nl2p($this_answer_info['pre_title_text']).'</div>';
			
		}
		
		//标题
		echo '<div class="ExplainNeiDiv">';
		echo '<h2>'.num2chinsesNum($key+1).'、';
		echo $cp_list[$key]['cp_name'].'</h2>';
		
		//得分
		if(isset($this_answer_info['show_score']))
		{
			$score_text = '';
			foreach($this_answer_info['show_score']['scores'] as $index => $text)
			{
				if($score <= $index)
				{
					$score_text = $text;
					break;
				}
			}
			
			echo nl2p(str_replace(array('NAME', 'SCORES'), array($card_info['user_info']['name'], $score_text), $this_answer_info['show_score']['text']));
		}
		elseif(!is_array($score))
		{
			echo nl2p($card_info['user_info']['name'].'同学，您的得分为: <b>'.$score.'</b>分。'.(!empty($this_total_score) ? '（满分为<b>'.$this_total_score.'</b>分）' : ''));
		}
		
		//图片 -- 在 common text前显示
		if(!empty($this_image_info) && (isset($this_image_info['position']) && $this_image_info['position'] == 'pre_common_text'))
			echo '<div class="pimg">'.$CI->cp_score->image($key, $this_image_info, $total_score, $cp_list).'</div>';
		
		//common text
		if(isset($this_answer_info['common_text']))
			echo nl2p($this_answer_info['common_text']);
		
		//图片 -- 在 common text 后显示图片 默认位置
		if(!empty($this_image_info) && !isset($this_image_info['position']))
			echo '<div class="pimg">'.$CI->cp_score->image($key, $this_image_info, $total_score, $cp_list).'</div>';
				
		//结果
		$result_text = $CI->cp_score->text($score, $this_answer_info);
		if(is_array($result_text))
		{
			foreach($result_text as $text)
				echo nl2p($text);
		}
		else
		{
			echo nl2p($result_text);
		}
		
		//显示common text end
		if(isset($this_answer_info['common_text_end']))
			echo nl2p($this_answer_info['common_text_end']);
		
		//豪华版文字
		if(isset($CI->config->config['luxury_text'][$key]))
			echo nl2p($CI->config->config['luxury_text'][$key]);
		
		echo '</div>';
		echo '<div class="PageNext"></div></div>';
	}
	?>	
		
</div>

<?php if($card_info['level'] == CP_LEVEL_ADVANCED): ?>
<div id="notice_box">
	<div class="head">
		<span style="float:right;padding:5px 0 5px 0;width:16px;line-height:auto;color:white;font-size:12px;font-weight:bold;text-align:center;cursor:pointer;overflow:hidden;" id="notice_box_close">
			<img border="0" src="images/cp/result/icon_close.gif" onclick="close_box();">
		</span>
	</div>
	
	<div id="notice_box_main">
		<div class="text1">
			<?php
				echo '请升级为<font style="color:#FF0000;font-size:13px;font-weight:bold;">豪华版</font>，';
				switch($card_info['cat_id'])
				{
					case 1:
						echo '享受专属于您孩子的个性化指导方案，为孩子从小建立良好的学习习惯。';
						break;
					case 2:
						echo '教育专家为你量身定做的个性化指导方案，让你的学习成绩不可思议的提高。';
						break;
					default:
						echo '教育专家为你量身定做的个性化指导方案，你的高中生活将充满色彩，从容面对高考，轻松迈入理想大学。';
						break;
				}
			?>
		</div>
		<div class="text2">
			立即升级为豪华版，只需
			<div class="discount">5折（￥<?php echo update_fee($card_info['price_luxury'], $card_info['price_advanced']) ?>）</div>
		</div>
		<div class="update">
			<form action="<?php echo site_url('cp_order/update')?>" method="post" target="_blank">
			<input type="image" name="submit" src="images/cp/result/update_botton.jpg">
			<input type="hidden" name="card_id" value="<?php echo $card_info['card_id'] ?>">
			<input type="hidden" name="cat_id" value="<?php echo $card_info['cat_id'] ?>">
			<input type="hidden" name="order_type" value="<?php echo CP_ORDER_TYPE_UPDATE ?>">
			</form>
		</div>
	</div>
	<img src="images/cp/result/notice_box_bottom.jpg">
</div>
<script type="text/javascript">
	var notice_box_obj = document.getElementById('notice_box');
	notice_box_obj.style.top = (document.body.scrollHeight - 268) + 'px';
	notice_box_obj.style.right = 0;
	
	function close_box()
	{
		notice_box_obj.style.display = 'none';
	}
</script>
<?php endif; ?>
</body>
</html>