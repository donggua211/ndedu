<!-- main end -->
</div>
<div class="clearfix"></div>
<div class="footer">
	北京恒正尚康股份有限公司&copy;版权所有 <a href="http://www.miibeian.gov.cn/">京ICP备0245123号</a>
</div>
<SCRIPT src="js/ajax.js" type="text/javascript"></SCRIPT>
<SCRIPT src="js/common.js" type="text/javascript"></SCRIPT>
<?php if(isset($js_file) && !empty($js_file)):?>
	<?php 
	if(is_array($js_file)): 
		foreach($js_file as $js)
			echo '<script type="text/javascript" src="js/'.$js.'"></script>';
	else: ?>
	<script type="text/javascript" src="js/<?php echo $js_file ?>"></script>
	<?php endif; ?>
<?php endif;?>
</body>
</html>