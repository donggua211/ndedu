<?php
//有提交的话 就处理
if( isset($_POST) && !empty($_POST))
{
	header("Content-Type: text/html;charset=GBK");

	define('PHONE_SEPERATOR', '/');
	if(empty($_FILES['file']['tmp_name']))
	{
		echo '请输入文件!<br/>';
		return;
	}

	//把核心reader类, 和方法文件包进来..
	require_once 'functions.php';
	require_once 'reader.php';
	$data = new Spreadsheet_Excel_Reader();
	$data->setOutputEncoding('utf-8');
	$data->read($_FILES['file']['tmp_name']);
	$result = $data->getExcelResult();
	
	//初始化结果数组
	$good_mobile = array();
	
	foreach($result as $row)
	{
		//初始化变量
		$mobile = '';
		$is_available_row = false;
		foreach($row as $cell)
		{
			$cell = trim($cell);
			if(empty($cell))
				continue;
			
			//检查本行是否是有效地
			if(checkRowAvailable($cell))
				$is_available_row = true;
			
			//检查本单元格是否是电话号码.
			if(is_cell_mobile($cell))
				$mobile = get_mobile($cell);
		}
		
		if($is_available_row && !empty($mobile))
			$good_mobile[] = $mobile;
	}

	if(empty($good_mobile))
		echo '结果为空..没有标记为可发短信的手机号';
	else
	{
		//处理结果数组
		$file_name = convert_encoding($_FILES['file']['name'], 'GBK');
		$file_name = substr($_FILES['file']['name'], 0, strrpos($file_name, '.'));
		header("Content-Type: application/force-download;charset=GBK");
		header("Content-Disposition: attachment; filename=".$file_name.'.txt');
		
		//输入文件内容
		echo implode("\r\n",$good_mobile);
	}
}
else
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="Content-type:text/html;charset=GBK" />
	<title>Excel => txt 转换工具</title>
</head>
<body>
	<div>
		<form action="index.php" target="_blank" method="post" enctype="multipart/form-data">
			<input type="file" name="file"><br/><br/>
			<input type="submit" name="submit" value="提交">
		</form>
	</div>
</body>
</html>
<?php
}
?>