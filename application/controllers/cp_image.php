<?php
require_once(APPPATH.'libraries/jpgraph/jpgraph.php');

class cp_image extends Controller {

	function cp_image()
	{
		parent::Controller();
	}
	
	function cat1cp5($data)
	{
		require_once(APPPATH.'libraries/jpgraph/jpgraph_bar.php');
	
		$datay=array($data);
		$datax=array("学习方法、学习习惯");

		// Setup the graph.
		$graph = new Graph(300,280);
		$graph->img->SetMargin(60,25,25,50);
		$graph->SetScale("textlin");
		$graph->SetFrame(true,'darkblue',1);
		$graph->SetShadow();

		// Set up the title for the graph
		$graph->title->Set("学习方法、学习习惯");
		$graph->title->SetMargin(8);
		$graph->title->SetFont(FF_SIMSUN,FS_BOLD,12);
		$graph->title->SetColor("darkred");

		// Setup font for axis
		$graph->xaxis->SetFont(FF_SIMSUN);
		$graph->yaxis->scale->SetGrace(48);
		
		// Setup X-axis labels
		$graph->xaxis->SetTickLabels($datax);
		$graph->xaxis->SetLabelAngle(0);

		// Create the bar pot
		$bplot = new BarPlot($datay);
		$bplot->SetWidth(0.3);

		// Setup color for gradient fill style
		$bplot->SetFillGradient("navy:0.9","navy:1.85",GRAD_MIDVER);

		// Set color for the frame of each bar
		$bplot->SetColor("navy");
		$graph->Add($bplot);

		// Finally send the graph to the browser
		$graph->Stroke();	
	}
	
	function cat5cp2($data1, $data2, $data3, $data4, $data5, $data6)
	{
		require_once(APPPATH.'libraries/jpgraph/jpgraph_radar.php');
		
		$titles=array('艺术型', '传统型', '管理型', '研究型', '现实型', '社会型');
		$data=array($data1, $data2, $data3, $data4, $data5, $data6);

		$graph = new RadarGraph (400,280);
		$graph->SetScale('lin',0,50);
		$graph->yscale->ticks->Set(25,5);
		$graph->ShowMinorTickMarks();
		
		$graph->SetTitles($titles);
		$graph->SetCenter(0.5,0.5);
		$graph->HideTickMarks();
		$graph->SetColor('lightgreen@0.9');
		$graph->axis->SetColor('darkgray');
		$graph->grid->SetColor('darkgray');
		$graph->grid->Show();

		$graph->axis->title->SetFont(FF_SIMSUN,FS_NORMAL,12);
		$graph->axis->title->SetMargin(10);
		$graph->SetGridDepth(DEPTH_BACK);
		$graph->SetSize(0.6);
		$graph->SetShadow();
		
		
		$plot = new RadarPlot($data);
		$plot->SetColor('red@0.2');
		$plot->SetLineWeight(1);
		$plot->SetFillColor('lightblue@0.5');

		$plot->mark->SetType(MARK_IMG_SBALL,'red');

		$graph->Add($plot);
		$graph->Stroke();
	
	}
	
	function cat2cp1($data1, $data2, $data3)
	{
		require_once(APPPATH.'libraries/jpgraph/jpgraph_pie.php');
		require_once(APPPATH.'libraries/jpgraph/jpgraph_pie3d.php');
		
		$data = array($data1, $data2, $data3);

		$graph = new PieGraph(400,330);
		$graph->SetShadow();
		$graph->SetColor('lightgreen@0.9');

		$p1 = new PiePlot3D($data);
		$p1->SetSize(0.5);
		$p1->SetCenter(0.54, 0.4);
		$p1->SetLegends(array('视觉学习类型', '听觉学习类型', '动作与触觉学习类型'));
		$p1->value->SetFont(FF_SIMSUN,FS_NORMAL,12);
		$p1->SetSliceColors(array('#FFFF33','#FF6600', '#336699'));
		
		$graph->Add($p1);
		$graph->Stroke();	
	}
	
	function cat5cp1($data1, $data2)
	{
		require_once(APPPATH.'libraries/jpgraph/jpgraph_pie.php');
		require_once(APPPATH.'libraries/jpgraph/jpgraph_pie3d.php');
				
		$data = array($data1, $data2);

		$graph = new PieGraph(400,280);
		$graph->SetShadow();
		$graph->SetColor('lightgreen@0.9');
		
		$p1 = new PiePlot3D($data);
		$p1->SetSize(0.5);
		$p1->SetCenter(0.45, 0.4);
		$p1->SetLegends(array('文科', '理科'));
		$p1->value->SetFont(FF_SIMSUN,FS_NORMAL,12);
		$p1->SetSliceColors(array('#FFFF33','#FF6600'));
		
		$graph->Add($p1);
		$graph->Stroke();	
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */