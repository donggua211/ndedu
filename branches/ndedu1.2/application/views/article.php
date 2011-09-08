<?php if( file_exists('images/cat_'.$article['cat_id'].'.jpg')): ?>
<table width="920" border="0" align="center" cellpadding="0" cellspacing="0" class="banner_border" style="margin-top:10px;">
  <tr>
    <td align="left"><img src="images/cat_<?php echo $article['cat_id']; ?>.jpg" width="916" height="203" /></td>
  </tr>
</table>
<?php endif; ?>
<table width="920" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30" background="images/hjxxgh_10.jpg" class="mianbao">
	您所在位置：<a href="<?php echo site_url('') ?>">首页</a> &gt; <a href="<?php echo site_url($cat_url) ?>"><?php echo $article['cat_name'] ?></a> &gt; <?php echo $article['title'] ?> 
	</td>
  </tr>
</table>
<table width="920" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top"><table width="662" border="0" cellpadding="0" cellspacing="0" style="border:1px solid #c8c8c8; padding-bottom:6px;padding-left:10px;">
        <tr>
          <td height="588"  width="600" align="center" valign="top"><table width="600" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
            <tr>
              <td align="center" class="con_title"><?php echo $article['title'] ?></td>
            </tr>
          </table>
            <table width="600" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td align="center" class="font_12_24" style="border-bottom:1px dashed #c8c8c8"><?php echo $article['add_time'] ?>　来源：尼德教育教研组<?php //echo $article['source'] ?>　 作者：<?php $rand=$article['article_id']%3; $author=array('王老师', '赵老师', '庞老师'); echo ( empty( $article['author'] ) ) ? $author[$rand] : $article['author'] ?> </td>
              </tr>
            </table>
            <table width="610" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="font_14">
					<?php echo $article['content'] ?>
				</td>
              </tr>
            </table>
            <table width="605" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px; background-color:#EEEEEE">
              <tr>
                <td height="24" align="left" valign="middle" style="padding-left:10px;">
					分享到:
					<a href="http://v.t.sina.com.cn/share/share.php?title=<?php echo urlencode(site_url('article/'.$article['article_id']).' '.$article['title'])?>" title="新浪微博" target="_blank"><img src="images/icon/sina_t.gif" alt="分享到新浪微博" style="padding-left:5px;"></a>
					<a href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=<?php echo urlencode(site_url('article/'.$article['article_id']))?>" title="QQ空间" target="_blank"><img src="images/icon/qqzone.gif"alt="分享到QQ空间" style="padding-left:5px;"></a>
					<a href="http://www.kaixin001.com/repaste/share.php?rtitle=<?php echo urlencode(site_url('article/'.$article['article_id']).' '.$article['title'])?>" title="开心网" target="_blank"><img src="images/icon/kaixin.gif" alt="分享开心网" style="padding-left:5px;"></a>
					<a href="http://apps.hi.baidu.com/share/?url=<?php echo urlencode(site_url('article/'.$article['article_id']))?>&title=<?php echo urlencode($article['title'])?>" target="_blank" title="百度空间"><img src="images/icon/baidu_kongjian.gif" alt="分享到百度空间" style="padding-left:5px;"></a>
					<a href="http://www.douban.com/recommend/?url=<?php echo urlencode(site_url('article/'.$article['article_id']))?>&title=<?php echo urlencode($article['title'])?>" title="豆瓣" target="_blank"><img src="images/icon/douban.gif" alt="分享到豆瓣" style="padding-left:5px;"></a>
					<a href="#" onclick="copyUrl();return false;" title="复制网址"><img src="images/icon/copy_url.gif" alt="复制网址" style="padding-left:5px;"></a>
					<a href="mailto:?subject=在尼德教育网站发现一篇文章很不错&body=<?php echo $article['title']." ".site_url('article/'.$article['article_id'])?>" title="发送邮件" target="_blank"><img src="images/icon/mailto.gif" alt="发送邮件" style="padding-left:5px;"></a>
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
          <td class="font_14white" style="padding-left:35px;">热点文章</td>
        </tr>
      </table>
      <table width="247" border="0" cellpadding="0" cellspacing="0" class="gray_box">
        <tr>
          <td height="200" align="center" valign="top"><table width="220" border="0" cellspacing="0" cellpadding="0" style="margin-top:8px;">
            <tr>
              <td align="left" class="font_12_orange" style="padding-left:8px;">标题</td>
              <td width="55" align="center" class="font_12_orange">点击次数</td>
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
                <td width="231" height="62" align="center" background="images/index2_35.jpg" class="font_12_red" style="padding-left:8px; padding-right:8px; padding-top:4px; font-size:12px; color:#333333; font-weight:bold">请放心，家长所留下的个人信息，尼德将恪守职业道德，为您保密。</td>
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