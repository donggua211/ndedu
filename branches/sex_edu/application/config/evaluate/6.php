<?php
$config['evaluate_data'] = array(
	'is_vip' => FALSE,
	'has_score' => TRUE,
	'show_question_in_result' => FALSE,
	'description' => '在根据你自己的实际情况，对每个问题作出回答：是或否。总分10分，分值越高表示您越自信。',
	'sumup' => '总分10分，分值越高表示您越自信。',
	'questions' => array(
		1 => array(
			'name' => '你对自己的外表很不满意吗？',
			'type' => 'radio',
			'options' => array(
				1 => array('text' => '是',
							'score' => 0,
						),
				2 => array('text' => '否',
							'score' => 1,
						),
			),
		
		),
		2 => array(
			'name' => '参加晚宴时，即使很想上洗手间，你也会忍着直到宴会结束吗？',
			'type' => 'radio',
			'options' => array(
				1 => array('text' => '是',
							'score' => 0,
						),
				2 => array('text' => '否',
							'score' => 1,
						),
			),
		
		),
		3 => array(
			'name' => '如果想买性感内衣，你会尽量邮购，而不亲自到店里去吗？',
			'type' => 'radio',
			'options' => array(
				1 => array('text' => '是',
							'score' => 0,
						),
				2 => array('text' => '否',
							'score' => 1,
						),
			),
		
		),
		4 => array(
			'name' => '你认为你是个绝佳的情人吗？',
			'type' => 'radio',
			'options' => array(
				1 => array('text' => '是',
							'score' => 0,
						),
				2 => array('text' => '否',
							'score' => 1,
						),
			),
		
		),
		5 => array(
			'name' => '如果店员的服务态度不好，你会告诉他们经理吗？',
			'type' => 'radio',
			'options' => array(
				1 => array('text' => '是',
							'score' => 0,
						),
				2 => array('text' => '否',
							'score' => 1,
						),
			),
		
		),
		6 => array(
			'name' => '你不常欣赏自己的照片吗？',
			'type' => 'radio',
			'options' => array(
				1 => array('text' => '是',
							'score' => 0,
						),
				2 => array('text' => '否',
							'score' => 1,
						),
			),
		
		),
		7 => array(
			'name' => '别人批评你，你会觉得难过吗？',
			'type' => 'radio',
			'options' => array(
				1 => array('text' => '是',
							'score' => 0,
						),
				2 => array('text' => '否',
							'score' => 1,
						),
			),
		
		),
		8 => array(
			'name' => '你很少对人说出你真正的意见吗？',
			'type' => 'radio',
			'options' => array(
				1 => array('text' => '是',
							'score' => 0,
						),
				2 => array('text' => '否',
							'score' => 1,
						),
			),
		
		),
		9 => array(
			'name' => '对别人的赞美，你持怀疑的态度吗？',
			'type' => 'radio',
			'options' => array(
				1 => array('text' => '是',
							'score' => 0,
						),
				2 => array('text' => '否',
							'score' => 1,
						),
			),
		
		),
		10 => array(
			'name' => '你总是觉得自己比别人差吗？',
			'type' => 'radio',
			'options' => array(
				1 => array('text' => '是',
							'score' => 0,
						),
				2 => array('text' => '否',
							'score' => 1,
						),
			),
		),
	),
);


?>