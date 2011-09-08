<table width="920" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="30" background="images/hjxxgh_10.jpg" class="mianbao">您所在位置： <a href="<?php echo site_url()?>">首页</a>&gt; 搜索 &gt; <?php echo $keyword ?>
  </tr>
</table>
<table width="920" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top"><table width="662" border="0" cellpadding="0" cellspacing="0" style="border:1px solid #c8c8c8; padding-bottom:6px;">
        <tr>
          <td height="588" align="center" valign="top"><table width="600" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px;">
                <tr>
                  <td width="442" height="36" align="left" class="font_143_orange">标题</td>
                  <td width="80" align="center" class="font_143_orange">发布日期</td>
                  <td width="78" align="center" class="font_143_orange">点击次数</td>
                </tr>
            </table>
			
		<?php
		if(!empty($articles)):
			foreach($articles as $article):
		?>
			<table width="600" border="0" cellspacing="0" cellpadding="0" style="border-bottom:1px dashed #c8c8c8;">
			  <tr>
				<td width="442" height="32" align="left" class="font_14" style="background-image:url(images/dott_15.jpg); background-repeat:no-repeat; background-position:5px center; padding-left:15px;"><a href="<?php echo site_url('article/'.$article['article_id']) ?>"><?php echo $article['title'] ?></a></td>
				<td width="80" align="center" class="font_gray"><?php echo $article['add_time'] ?></td>
				<td width="78" align="center" class="font_gray"><?php echo $article['count'] ?></td>
			  </tr>
			</table>
		<?php
				endforeach;
		?>
		    <table width="605" border="0" cellspacing="0" cellpadding="0" style="margin-top:10px; background-color:#EEEEEE">
              <tr>
                <td height="24" align="center" valign="middle">页面共<?php echo $article_nav['articles_per_page'] ?>条 
				<?php 
					if($article_nav['current_page'] == 1)
						echo '';
					else
						echo '<a href="'.site_url('articleCat/'.$cat['cat_id'].'/1').'">首页</a> ';
					
					for($i = 1; $i <= $article_nav['totle_page']; $i++)
					{
						if($article_nav['current_page'] == $i)
							echo $i;
						else
							echo '<a href="'.site_url('articleCat/'.$cat['cat_id'].'/'.$i).'">'.$i.' </a>';
					}
					
					
					if($article_nav['current_page'] == $article_nav['totle_page'])
						echo '';
					else
						echo '<a href="'.site_url('articleCat/'.$cat['cat_id'].'/'.$article_nav['totle_page']).'">尾页</a>';
				
				?>
				共<?php echo $article_nav['totle_page'] ?>页
				</td>
              </tr>
            </table>
			<?php
				else:
			?>
					所选分类暂无文章，敬请期待！
			<?php
				endif;
			?>
			
			</td>
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
          <td align="center" valign="bottom"><img src="images/hjxxgh_44.jpg" width="247" height="63" /></td>
        </tr>
      </table>
      <table width="247" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="90" align="center" valign="bottom"><img src="images/index_94.jpg" width="237" height="93" /></td>
        </tr>
      </table></td>
  </tr>
</table>