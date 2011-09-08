<?php if(isset($notification) && !empty($notification)): ?>
<div style="margin-top:20px;backgroud:#fff;padding:5px;border:1px solid #FF8080;text-align:center">
	<img style="vertical-align: middle;" src="images/icon/warning.gif"> <span style="color:red;font-size:20px;line-height:22px"><?php echo $notification;?></span>
</div>
<?php endif; ?>

<div class="join_survey">
	<form action="<?php echo site_url('join/cv'); ?>" method="post" onsubmit="return submit_personal(this);">
	
	<?php foreach($survey_info as $key => $val): ?>
	<div class="input">
		<label>第<?php echo num2chinsesNum($key); ?>：</label>
		<div>
			<!-- 题目 -->
			<?php echo !empty($val['question']) ? $val['question'].'<br/>' : ''; ?>
			<?php 
				switch($val['type'])
				{
					case 'input':
						echo '<input type="text" name="q'.$key.'" value="" class="line">';
						break;
					case 'multi_input':
						foreach($val['option'] as $option)
						{
							echo $option.' <input type="text" name="q'.$key.(count($val['option']) > 1 ? '[]' : '').'" value="" class="short_line"><br/>';
						}
						break;
					case 'radio':
						foreach($val['option'] as $index => $option)
						{
							echo '<input type="radio" name="q'.$key.'" value="'.$index.'"> '.$option;
							if($index == 99)
								echo ' <input type="text" name="q'.$key.'_othor" value="" class="short_line">';
							if((isset($val['one_line']) && $val['one_line'] == 1))
								echo '<span style="margin-left:10px"> </span>';
							else
								echo '<br/>';
						}
						break;
				}
			?>
			
		</div>
	</div>
	<div class="clearfix"></div>
	<?php endforeach; ?>

	<div class="button">
		<input type="submit" name="submit" value="完成并下一步" class="input_button">
	</div>
	<input type="hidden" name="join_id" value="<?php echo $join_id; ?>">
	<input type="hidden" name="next_action" value="cv">
	</form>
</div>