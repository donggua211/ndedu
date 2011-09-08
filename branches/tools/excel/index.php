<?php
//���ύ�Ļ� �ʹ���
if( isset($_POST) && !empty($_POST))
{
	header("Content-Type: text/html;charset=GBK");

	define('PHONE_SEPERATOR', '/');
	if(empty($_FILES['file']['tmp_name']))
	{
		echo '�������ļ�!<br/>';
		return;
	}

	//�Ѻ���reader��, �ͷ����ļ�������..
	require_once 'functions.php';
	require_once 'reader.php';
	$data = new Spreadsheet_Excel_Reader();
	$data->setOutputEncoding('utf-8');
	$data->read($_FILES['file']['tmp_name']);
	$result = $data->getExcelResult();
	
	//��ʼ���������
	$good_mobile = array();
	
	foreach($result as $row)
	{
		//��ʼ������
		$mobile = '';
		$is_available_row = false;
		foreach($row as $cell)
		{
			$cell = trim($cell);
			if(empty($cell))
				continue;
			
			//��鱾���Ƿ�����Ч��
			if(checkRowAvailable($cell))
				$is_available_row = true;
			
			//��鱾��Ԫ���Ƿ��ǵ绰����.
			if(is_cell_mobile($cell))
				$mobile = get_mobile($cell);
		}
		
		if($is_available_row && !empty($mobile))
			$good_mobile[] = $mobile;
	}

	if(empty($good_mobile))
		echo '���Ϊ��..û�б��Ϊ�ɷ����ŵ��ֻ���';
	else
	{
		//����������
		$file_name = convert_encoding($_FILES['file']['name'], 'GBK');
		$file_name = substr($_FILES['file']['name'], 0, strrpos($file_name, '.'));
		header("Content-Type: application/force-download;charset=GBK");
		header("Content-Disposition: attachment; filename=".$file_name.'.txt');
		
		//�����ļ�����
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
	<title>Excel => txt ת������</title>
</head>
<body>
	<div>
		<form action="index.php" target="_blank" method="post" enctype="multipart/form-data">
			<input type="file" name="file"><br/><br/>
			<input type="submit" name="submit" value="�ύ">
		</form>
	</div>
</body>
</html>
<?php
}
?>