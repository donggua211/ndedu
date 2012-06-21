<?php
	if(!empty($article['image_url'])):
?>
	<table width="920" border="0" align="center" cellpadding="0" cellspacing="0" class="banner_border" style="margin-top:10px;">
	  <tr>
		<td align="left"><img src="<?php echo base_url().'/images/uploads/'.$article['image_url'] ?>" alt=""></td>
	  </tr>
	</table>
<?php
	endif;
?>

	<table width="920" border="0" align="center" cellpadding="0" cellspacing="0">
	  <tr>
		<td height="30" background="images/hjxxgh_10.jpg" class="mianbao">您所在位置： <a href="<?php echo site_url('') ?>">首页</a> &gt; <a href="<?php echo site_url($cat_url) ?>"><?php echo $article['cat_name'] ?></a> &gt; <?php echo $article['title'] ?> </td>
	  </tr>
	</table>

<table width="920" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top">
	<?php
		if(!empty($article['short_description'])):
	?>
		<table width="662" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFCF5" class="box">
			<tr>
			<td align="left" valign="top" background="images/hjxxgh_14.jpg" style="background-repeat:no-repeat; background-position:right top">
				<table width="610" border="0" cellpadding="0" cellspacing="0" class="font_14" style="margin-left:15px; margin-top:15px; margin-bottom:8px;">
				  <tr>
					<td>
						<?php echo str_replace("\n", '<br/>',$article['short_description']) ?>	
					</td>
				  </tr>
				</table>
			</td>
			</tr>
		</table>
	<?php
		endif;
	?>

	<?php
		if(!empty($article['short_description_img'])):
	?>
		<table width="662" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
			<tr>
			  <td><img src="images/<?php echo $article['short_description_img'] ?>" alt=""/></td>
			</tr>
		</table>
	<?php
		endif;
	?>
		
		<?php echo $article['content'] ?>			  

	</td>
	
    <td width="247" valign="top"><table width="247" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="33"><img src="images/hjxxgh_07.jpg" width="247" height="72" /></td>
      </tr>
    </table>
	
	
    <table width="247" border="0" cellspacing="0" cellpadding="0" height="30" style="margin-top:10px; background-image:url(images/hjxxgh_18.jpg);">
      <tr>
        <td class="font_14white" style="padding-left:35px;"><?php echo ($article['article_id'] >= 7 && $article['article_id'] <= 10) ? '私人教育顾问' : $article['cat_name']; ?></td>
      </tr>
    </table>
	
	<?php 
		require_once('side_bar.php');
		echo $side_bar[$article['article_id']] 
	?>
	
	
	<table width="247" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="images/hjxxgh_42.jpg" width="247" height="10" /></td>
        </tr>
    </table>
	
	<table width="247" border="0" cellspacing="0" cellpadding="0" style="margin-top:9px;">
		<tr>
		  <td align="center" valign="bottom"><a href="<?php echo site_url('topGrowth') ?>" target="_blank"><img src="images/jyczjh.gif" width="247" height="70" border="0" /></a></td>
		</tr>
	</table>
	
    <table width="247" border="0" cellspacing="0" cellpadding="0" style="margin-top:9px;">
        <tr>
          <td align="center" valign="bottom"><a href="javascript:viod(0);" onclick="collapse_switch('guestbook_table')"><img src="images/hjxxgh_44.jpg" width="247" height="63" border="0" /></a></td>
        </tr>
    </table>
	
	<table id="guestbook_table" width="247" border="0" cellspacing="0" cellpadding="0" style="display:none">
	  <form name="guestbook_right" action="<?php echo site_url().'/guestbook/submit/'?>" method="post" onSubmit="return checkTable_contactus_right(this);">
        <tr>
          <td height="384" align="center" valign="top" background="images/right_80.jpg"><table width="220" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
            <tr>
              <td width="70" align="left">姓&nbsp;&nbsp;&nbsp;&nbsp;名：</td>
              <td align="left"><label>
                <input type="text" name="username" style="width:106px; height:18px; background-color:#FFFFFF; border:1px solid #CCCCCC"/>
              </label><span id="username_alert" style="display:none"> * </span></td>
            </tr>
          </table>
            <table width="220" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
              <tr>
                <td width="70" align="left">电&nbsp;&nbsp;&nbsp;&nbsp;话：</td>
                <td align="left"><label>
                  <input type="text" name="phone" style="width:106px; height:18px; background-color:#FFFFFF; border:1px solid #CCCCCC"/>
                </label><span id="phone_alert" style="display:none"> * </span></td>
              </tr>
            </table>
            <table width="220" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
              <tr>
                <td width="70" align="left">年&nbsp;&nbsp;&nbsp;&nbsp;级：</td>
                <td align="left">
				  <select name="grade">
					<option value="preschool">学前班</option>
					<option value="primary_school">小学</option>
					<option value="junior_middle_school">初中</option>
					<option value="high_school">高中</option>
				  </select>
                  <span id="grade_alert" style="display:none"> * </span></td>
              </tr>
            </table>
            <table width="220" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
              <tr>
                <td width="70" valign="top">学习情况：</td>
                <td  align="left"><label>
                  <textarea name="message" style="width:148px; height:115px; background-color:#FFFFFF; border:1px solid #CCCCCC; overflow:auto"></textarea>
                </label></td>
              </tr>
            </table>
            <table width="220" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
              <tr>
                <td width="70" align="left">验证码：</td>
                <td width="70" align="left"><label>
                  <input type="text" name="captcha" style="width:60px; height:18px; background-color:#FFFFFF; border:1px solid #CCCCCC"/>
                </label></td>
                <td width="80" align="left"><img src="<?php echo site_url().'/ajax/captcha/'?>" id="safecode_right" border="0" onclick="reloadcode_right()" style="cursor:hand;padding:2px 8px 0pt 3px;"  /></td>
                
              </tr>
            </table>
            <table id="warningTable_right" width="220" border="0" cellspacing="0" cellpadding="0" style="display:none">
              <tr>
                <td height="24" align="center" class="font_12_red"><div id="warningText_right"></div></td>
              </tr>
            </table>
            <table width="220" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
              <tr>
                <td align="center"><label><input type="image" name="submit" align="bottom" src="images/right_19.jpg"></label></td>
              </tr>
            </table>
            <table width="231" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
              <tr>
                <td width="231" height="62" align="center" background="images/index2_35.jpg" class="font_12_red" style="padding-left:8px; padding-right:8px; padding-top:4px; font-size:12px; color:#333333; font-weight:bold">请放心，家长所留下的个人信息，你的将恪守职业道德，为您保密。</td>
              </tr>
            </table></td>
        </tr>
	  </form>	
      </table>
	
	  <table width="247" border="0" cellspacing="0" cellpadding="0" style="margin-top:9px;">
        <tr>
          <td align="center" valign="bottom"><a href="<?php echo site_url('cp/detail/1') ?>" target="_blank"><img src="images/banner_evaluate.gif" width="247" height="72" border="0" /></a></td>
        </tr>
      </table>
	
    <table width="247" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="90" align="center" valign="bottom"><a href="<?php echo site_url('contactUs') ?>"><img src="images/index_94.jpg" width="237" height="93" border="0" /></a></td>
        </tr>
    </table>
	<table width="247" border="0" cellspacing="0" cellpadding="0" style="margin-top:9px;">
		<tr>
			<td align="center" valign="bottom"><a href="<?php echo site_url('entry/oo1') ?>" target="_blank"><img src="images/9d.gif" width="247" height="70" border="0" /></a></td>
		</tr>
	</table>
	</td>
  </tr>
</table>