<div class="ceping_shining_head">
	<div class="ceping_title"><?php echo $cat_name ?></div>
</div>
<div id="ceping_main">
	<div class="login_content">
		<div class="login_content_img"><img src="images/cp/login_content_top.jpg"></div>
		<div class="login_content_text">
		<div class="ceping_sub_title"><?php echo num2chinsesNum($current_cp_index+1).'、'.$current_cp_info['cp_name'] ?></div>
			<div class="ceping_des"><?php echo nl2br($current_cp_info['cp_des']) ?></div>
			<form action="<?php echo site_url("ceping/cp"); ?>" method="post" onSubmit="return checkCP(<?php echo count($cp_info['questions']) ?> );">
			<div class="ceping_area">
				<?php
				//判断, 需要不需要换行.
				$need_br = false;
				foreach($cp_info['questions'] as $index => $question)
				{
					$temp_str = '';
					if($cp_info['same_answer'])
						$answer_array = $cp_info['answers'];
					else
						$answer_array = $question['answers'];
					
					foreach ($answer_array as $key => $answer)
						$temp_str .= $answer;
					
					if(mb_strlen($temp_str, 'utf-8') > 35)
					{
						$need_br = true;
						break;
					}
				}
				
				foreach($cp_info['questions'] as $index => $question)
				{
					//题目
					echo '<a name="'.$index.'"></a><div class="ceping_area_title">'.($index + 1).'. ';
					
					if($cp_info['same_answer'])
					{
						echo $question;
						$answer_array = $cp_info['answers'];
					}
					else
					{
						echo $question['name'];
						$answer_array = $question['answers'];
					}
					echo '<span id="warning'.$index.'" class="ceping_area_warning" ></span></div>';
					
					//选项 - 显示
					if($need_br)
						echo '<div class="ceping_area_answer_br">';
					else
						echo '<div class="ceping_area_answer">';
					foreach ($answer_array as $key => $answer)
					{
						echo '<label for="option'.$index.$key.'"><input id="option'.$index.$key.'" type="radio" name="answer['.$index.']" value="'.$key.'" style="margin:0 5px 0 0">'.get_option_pre_char($key).'. '.$answer.'</label>';
						
						if($need_br)
							echo '<br/>';						
					}
					echo '</div>';
				}
				?>
			<div class="clear"></div>
			</div>
			<div class="order_submit_botton">
				<input type="image" name="submit" value="submit" src="images/cp/<?php echo (($current_cp_index+1) < $count_cp) ? 'ceping_botton' : 'ceping_last_botton'; ?>.jpg">
			</div>
			<div class="order_foot_nav">第<font class="font_red_12"><?php echo ($current_cp_index+1);?></font>套 / 共<?php echo $count_cp;?>套</div>
			<input type="hidden" name="cp_index" value="<?php echo $current_cp_index ?>">
			<input type="hidden" name="answer_arr" value="<?php echo $answer_arr ?>">
			</form>
		</div>
		<div class="login_content_img"><img src="images/cp/login_content_bottom.jpg"></div>
	</div>
</div>