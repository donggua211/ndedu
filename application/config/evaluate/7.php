<?php
$config['evaluate_data'] = array(
	'is_vip' => FALSE,
	'has_score' => FALSE,
	'show_question_in_result' => TRUE,
	'description' => '复习环节测评，这套问卷用于学生对其复习行为进行自我检查，检测学生个体对待复习的态度和复习的方法存在的问题',
	'questions' => array(
		1 => array(
			'name' => '我在复习中？',
			'type' => 'radio',
			'advice' => '<strong>指导与建议：</strong><br/>选C说明你已经懂得如何制定计划<br/>
选A或B 你要学会如何制定依法划<br/>
建议：a.制定复习时间表，统筹时间b.跟上老师的复习计划c.老师的复习计划和自己的计划同步，合理安排时间',
			'options' => array(
				1 => array('text' => '自己无复习计划，全跟着老师走',
							'discription' => '你要学会如何制定计划 ',
						),
				2 => array('text' => '心中有一定的复习计划，但未书面写出',
							'discription' => '你要学会如何制定计划',
						),
				3 => array('text' => '根据自己的情况制定了一个总体的书面复习计划',
							'discription' => '说明你已经懂得如何制定计划',
						),
			),
		
		),
		2 => array(
			'name' => '制定复习计划后，我？',
			'type' => 'radio',
			'advice' => '<strong>指导与建议：</strong><br/>选A说明你能够自主的完成你的计划<br/>
选B、C说明你很茫然。你需要严格遵守并履行你的计划<br/>
建议：a.督促自己严格执行学习计划，告知家人自己的计划，增加压力b.加强自己自制力的培养c.相信自己能够成功 ',
			'options' => array(
				1 => array('text' => '能自觉执行计划',
							'discription' => '你能够自主的完成你的计划',
						),
				2 => array('text' => '不能完全执行计划',
							'discription' => '你很茫然。你需要严格遵守并履行你的计划',
						),
				3 => array('text' => '在执行计划的过程中，希望得到老师或家长的督促',
							'discription' => '你很茫然。你需要严格遵守并履行你的计划',
						),
			),
		
		),
		3 => array(
			'name' => '我现在的复习方法是?',
			'type' => 'radio',
			'advice' => '<strong>指导与建议：</strong><br/>选A恭喜你，你掌握了复习的流程，严格按照他去执行，形成习惯。<br/>
B、C、D选项，复习的过程均不完善，试着改善你的复习过程。<br/>
建议：a.通读教材，查漏补缺，彻底扫除知识结构中理解上的障碍b.对每一个知识结构及重点，深刻理解，把握知识结构内部之间的联系c.解题训练，提升实战能力',
			'options' => array(
				1 => array('text' => '听课、做题、考试',
							'discription' => '你掌握了复习的流程，严格按照他去执行，形成习惯',
						),
				2 => array('text' => '听课、做题、二度、偶尔看看书',
							'discription' => '复习的过程均不完善，试着改善你的复习过程',
						),
				3 => array('text' => '课前看教科书、听课、做题、考试',
							'discription' => '复习的过程均不完善，试着改善你的复习过程',
						),
				4 => array('text' => '课前看教科书并整理知识、听课、做题、考试、总结',
							'discription' => '复习的过程均不完善，试着改善你的复习过程',
						),
			),
		
		),
		4 => array(
			'name' => '在每一个单元复习前或每一节复课前',
			'type' => 'radio',
			'advice' => '<strong>指导与建议：</strong><br/>选C说明你具备主动复习的好习惯，能主动学习。<br/>
选AB要再接再厉<br/>
单元复习方法：阅读教材——整理归类——细究问题——考试自测',
			'options' => array(
				1 => array('text' => '老师未要求，我也未看书和整理',
							'discription' => '要再接再厉',
						),
				2 => array('text' => '老师要求我们认真看教科书并进行归类整理',
							'discription' => '要再接再厉',
						),
				3 => array('text' => '虽老师未要求，但我都要认真看教科书并进行归类整理',
							'discription' => '你具备主动复习的好习惯，能主动学习',
						),
			),
		
		),
		5 => array(
			'name' => '在复习的针对性和重难点的把握上',
			'type' => 'radio',
			'advice' => '<strong>指导与建议：</strong><br/>选A,恭喜你，你很会复习。能够科学的把握复习的方向和重点<br/>
选B、C、D需要加强对教材、课本知识点的理解。<br/>
建议：a.找二三张考试卷，合起来仔细分析一下，哪个知识点考分最多，就最重要b.老师上课时重点讲解的，一个也不要漏c.找考试的考纲，标有理解、掌握的知识点都为重点 ',
			'options' => array(
				1 => array('text' => '针对性强，重难点把握得当，难度和习题数量适中',
							'discription' => '你很会复习。能够科学的把握复习的方向和重点',
						),
				2 => array('text' => '重难点把握不准，重点内容一晃而过，非重点内容耗时过多',
							'discription' => '需要加强对教材、课本知识点的理解',
						),
				3 => array('text' => '例题难度较大，习题的数量过多，复习内空偏难',
							'discription' => '需要加强对教材、课本知识点的理解',
						),
				4 => array('text' => '针对性不强，有些考试不要求的内容也在复习',
							'discription' => '需要加强对教材、课本知识点的理解',
						),
			),
		
		),
		6 => array(
			'name' => '对复习资料的使用，我们是？',
			'type' => 'radio',
			'advice' => '<strong>指导与建议：</strong><br/>选C、D说明你能很好掌控复习的进度，知道复习的切入点。<br/>
选A、B你目前还比较盲从，找到自己的不足，选适合你的练习题，有针对性的训练。<br/>
建议：a.认清自己学习中的强弱科，选难度适合你该学科学习层次的练习册b.只选择一到两本，严格要求自己完成，善始善终c.对重难点题要分析清楚',
			'options' => array(
				1 => array('text' => '完全按复习资料进行，一点未变',
							'discription' => '你目前还比较盲从，找到自己的不足，选适合你的练习题，有针对性的训练',
						),
				2 => array('text' => '主要按复习资料进行，但作了部分调整',
							'discription' => '你目前还比较盲从，找到自己的不足，选适合你的练习题，有针对性的训练',
						),
				3 => array('text' => '根据我们的实际，作了删减和增加',
							'discription' => '说明你能很好掌控复习的进度，知道复习的切入点',
						),
				4 => array('text' => '选择一两本适合自己的资料，精准练习',
							'discription' => '说明你能很好掌控复习的进度，知道复习的切入点',
						),
			),
		
		),
	),
);


?>