<table width="920" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30" background="images/hjxxgh_10.jpg" class="mianbao">您所在位置： <a href="<?php echo site_url()?>">首页</a> &gt; <a href="<?php echo site_url('school')?>">你的学堂</a> &gt; 教育文章</td>
  </tr>
</table>
<table width="920" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
	<td align="left" valign="top"><table height="650" width="145" border="0" cellpadding="0" cellspacing="0" style="background-color:#F2F2F2">
        <tr>
			<td align="left" valign="top">
				<table border="0" cellspacing="0" cellpadding="0">
					<tr height="35">
					  <td width="40" align="center" class=""><img src="images/icon/star.gif"></td>
					  <td align="left" colspan="2" class="font_143_orange">学堂分类</td>
					</tr>
					<?php foreach( $tags as $tag):
						if( !in_array($tag['tag_id'], $top_right_tags) ):
					?>
					<tr height="25">
					  <td width="40" align="center" class=""></td>
					  <td width="11" align="left" ><img src="images/icon/dot_yellow.gif"></td>
					  <td align="left" class="font_13">
						<a href="<?php echo site_url('school/article/'.$tag['tag_id'].'-'.$right_tag.'/1');?>"><?php echo ($tag['tag_id'] == $left_tag)? '<font style="color:#FF6600">'.$tag['tag_name'].'</font>' : $tag['tag_name'];?></a> <font class="font_13_gray">(<?php echo (isset($tag_article_num[$tag['tag_id']]) && !empty($tag_article_num[$tag['tag_id']])) ? $tag_article_num[$tag['tag_id']] : 0;?>)</font>
					  </td>
					</tr>
					<?php endif;
					endforeach;?>
					
				</table>
			</td>
        </tr>
	</table></td>	
    <td align="left" valign="top"><table width="519" border="0" cellpadding="0" cellspacing="0" style="border:1px solid #c8c8c8; padding-bottom:6px;">
        <tr>
          <td align="center" valign="top">
			<table align="left" border="0" cellspacing="13" cellpadding="0">
                <tr class="font_14_3">
                  <td class="font_14_4" width="90" height="27" align="center" style="background-color:#FFA044;color:#FFFFFF"><a href="<?php echo site_url('school');?>">教育文章</a></td>
                  <td width="90" height="27" align="center" style="background-color:#F2F2F2"><a href="<?php echo site_url('school/book');?>">精品图书</a></td>
                  <td width="90" height="27" align="center" style="background-color:#F2F2F2"><a href="<?php echo site_url('school/vedio');?>">教育影视</a></td>
                  <td width="90" height="27" align="center" style="background-color:#F2F2F2"><a href="<?php echo site_url('school/software');?>">教育软件</a></td>
                </tr>
            </table>
		</td>
		</tr>
		<tr height="600">
          <td align="center" valign="top">
			<table width="509" align="center" border="0" cellspacing="0" cellpadding="0" style="background-color:#EBEBEB;">
                <tr class="font_12_20">
					<?php 
						$star = ( $article_nav['star'] +1 );
						$end = ( $article_nav['current_page'] == $article_nav['totle_page'] ) ? $article_nav['totle_articles'] : $star+$article_nav['limit'];
						if($end == 0) $star= 0;
					?>
                  <td width="500" height="27" align="left" style="padding-left:10px">显示<?php echo $star.'-'.$end;?>条 共<?php echo $article_nav['totle_articles'] ?>条</td>
                  <td width="100" height="27" align="right">
				  <select class="font_12_20" onchange="window.location.href=this.options[this.selectedIndex].value">
					<option value="<?php echo site_url('school/article/'.$left_tag.'-0/'.$article_nav['current_page']);?>" <?php if($right_tag == 0) echo 'SELECTED';?>>班级</option>
					<?php foreach( $tags as $tag):
						if( in_array($tag['tag_id'], $top_right_tags) ):
					?>
					<option value="<?php echo site_url('school/article/'.$left_tag.'-'.$tag['tag_id'].'/'.$article_nav['current_page']);?>" <?php if($right_tag == $tag['tag_id']) echo 'SELECTED';?>><?php echo $tag['tag_name'];?></option>
					<?php endif;
					endforeach;?>
				  </select>
				  </td>
                </tr>
            </table>
		
		<?php
		if($article_nav['current_page'] == 1 &&!empty($recommand)):
			foreach($recommand as $article):
		?>
			<table width="490" border="0" cellspacing="0" cellpadding="0" style="border-bottom:1px dashed #c8c8c8">
			  <tr>
				<td width="394" height="32" align="left" class="font_14" style="background-image:url(images/icon/up.gif); background-repeat:no-repeat; background-position:5px center; padding-left:20px;"><a href="<?php echo site_url('article/'.$article['article_id']) ?>"><?php echo $article['title'] ?></a></td>
				<td width="80" align="right" class="font_gray"><?php echo $article['add_time'] ?></td>
			  </tr>
			</table>
		<?php
			endforeach;
		endif;
		
		if(!empty($articles)):
			foreach($articles as $article):
		?>
			<table width="490" border="0" cellspacing="0" cellpadding="0" style="border-bottom:1px dashed #c8c8c8">
			  <tr>
				<td width="394" height="32" align="left" class="font_14" style="background-image:url(images/dott_15.jpg); background-repeat:no-repeat; background-position:7px center; padding-left:20px;"><a href="<?php echo site_url('article/'.$article['article_id']) ?>"><?php echo $article['title'] ?></a></td>
				<td width="80" align="right" class="font_gray"><?php echo $article['add_time'] ?></td>
			  </tr>
			</table>
		<?php
			endforeach;
		else:
		?>
					所选分类暂无文章，敬请期待！
			<?php
				endif;
			?>
		    <table width="519" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px; background-color:#EEEEEE">
              <tr>
                <td height="24" align="center" valign="middle">
				<?php
				//首页 + 上一页
				if($article_nav['current_page'] == 1)
				{
					echo ' 首页 ';
					echo ' 上一页 &lt;&lt; ';
				}
				else
				{
					echo '<a href="'.site_url('school/article/'.$left_tag.'-'.$right_tag.'/1') .'">首页</a>';
					echo ' <a href="'.site_url('school/article/'.$left_tag.'-'.$right_tag.($article_nav['current_page']-1)).'">上一页 &lt;&lt; </a> ';
				}
				
				//循环数字
				$page_index = 1;
				if($article_nav['current_page'] > 5)
					$page_index = $article_nav['current_page'] - 4;
				
				if($article_nav['totle_page'] > 9 && ($article_nav['totle_page'] - $article_nav['current_page']) < 5)
					$page_index = $article_nav['current_page'] - 8 + ($article_nav['totle_page'] - $article_nav['current_page']);
				
				for($i = 0; $i < 9; $i++, $page_index++)
				{
					if($page_index > $article_nav['totle_page'])
						break;
					
					if($page_index == $article_nav['current_page'])
						echo ' [<font color="#ff0000"> '.$page_index.' </font>] ';
					else
						echo  ' <a href="'.site_url('school/article/'.$left_tag.'-'.$right_tag.'/'.$page_index).'">'.$page_index.'</a> ';
				
				}
				
				
				//末页 + 下一页
				if($article_nav['current_page'] == $article_nav['totle_page'])
				{
					echo ' 下一页 &gt;&gt; ';
					echo ' 末页 ';
				}
				else
				{
					echo ' <a href="'.site_url('school/article/'.$left_tag.'-'.$right_tag.'/'.($article_nav['current_page']+1)).'">下一页 &gt;&gt; </a> ';
					echo ' <a href="'.site_url('school/article/'.$left_tag.'-'.$right_tag.'/'.$article_nav['totle_page']).'">末页</a> ';
				}
				?>
				</td>
              </tr>
            </table></td>
        </tr>
    </table></td>
	
    <td width="247" valign="top"><table width="247" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="33"><img src="images/hjxxgh_07.jpg" width="247" height="72" /></td>
      </tr>
    </table>
	  <table width="247" border="0" cellspacing="0" cellpadding="0" height="30" style="margin-top:10px; background-image:url(images/hjxxgh_18.jpg);">
        <tr>
          <td class="font_14white" style="padding-left:35px;">你的学堂推荐</td>
        </tr>
      </table>
      <table width="247" border="0" cellpadding="0" cellspacing="0" class="gray_box">
        <tr>
          <td height="150" align="center" valign="top"><table width="220" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
            <tr>
              <td></td>
            </tr>
          </table>
		  
		<?php
		foreach($recommand as $article):
		?>
			<table width="220" border="0" cellspacing="0" cellpadding="0" >
              <tr>
                <td width="178" align="left" class="right_content_li"><a href="<?php echo site_url('article/'.$article['article_id']); ?>" title="<?php echo $article['title'] ?>"><?php echo utf_substr($article['title'], 27) ?></a></td>
              </tr>
            </table>
		<?php
		endforeach;
		?>
	      </td>
        </tr>
      </table>
	  <table width="247" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="images/hjxxgh_42.jpg" width="247" height="10" /></td>
        </tr>
      </table>
	  <table width="247" border="0" cellspacing="0" cellpadding="0" height="30" style="margin-top:10px; background-image:url(images/hjxxgh_18.jpg);">
        <tr>
          <td class="font_14white" style="padding-left:35px;">你的学堂热点</td>
        </tr>
      </table>
      <table width="247" border="0" cellpadding="0" cellspacing="0" class="gray_box">
        <tr>
          <td height="180" align="center" valign="top"><table width="220" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
            <tr>
              <td></td>
            </tr>
          </table>
		  
		<?php
		foreach($sidebar_articles as $article):
		?>
			<table width="220" border="0" cellspacing="0" cellpadding="0" >
              <tr>
                <td width="178" align="left" class="right_content_li"><a href="<?php echo site_url('article/'.$article['article_id']); ?>" title="<?php echo $article['title'] ?>"><?php echo utf_substr($article['title'], 27) ?></a></td>
                <td width="42" align="center" class="date" ><?php echo $article['count'] ?></td>
              </tr>
            </table>
		<?php
		endforeach;
		?>
	      </td>
        </tr>
      </table>
      <table width="247" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img src="images/hjxxgh_42.jpg" width="247" height="10" /></td>
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
      <table width="247" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="90" align="center" valign="bottom"><img src="images/index_94.jpg" width="237" height="93" /></td>
        </tr>
      </table></td>
  </tr>
</table>