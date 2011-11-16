<?php
$config['evaluate_data'] = array(
	'is_vip' => FALSE,
	'has_score' => TRUE,
	'show_question_in_result' => FALSE,
	'description' => '这考试焦虑自评量表下面的测验旨在对学生的考试焦虑心理作客观的诊断。测验共有30道题，每题有4个备择答案，根据自己的实际情况，在题前填上相应字母，每题只能选择一个答案。总分焦虑水平:0-24镇定25-49轻度焦虑50-70中度焦虑70-90重度焦虑',
	'sumup' => '这考试焦虑自评量表下面的测验旨在对学生的考试焦虑心理作客观的诊断。总分焦虑水平:0-24镇定25-49轻度焦虑50-70中度焦虑70-90重度焦虑',
	'questions' => array(
		1 => array(
			'name' => '在重要的考试前几天，我就坐立不安了。',
			'type' => 'radio',
			'options' => array(
				1 => array('text' => '很符合自己的情况',
							'score' => 3,
						),
				2 => array('text' => '比较符合自己的情况',
							'score' => 2,
						),
				3 => array('text' => '较不符合自己的情况',
							'score' => 1,
						),
				4 => array('text' => '很不符合自己的情况',
							'score' => 0,
						),
			),
		
		),
		2 => array(
			'name' => '临近考试时，我就泻肚子了。',
			'type' => 'radio',
			'options' => array(
				1 => array('text' => '很符合自己的情况',
							'score' => 3,
						),
				2 => array('text' => '比较符合自己的情况',
							'score' => 2,
						),
				3 => array('text' => '较不符合自己的情况',
							'score' => 1,
						),
				4 => array('text' => '很不符合自己的情况',
							'score' => 0,
						),
			),
		
		),
		3 => array(
			'name' => '一想到考试即将来临，身体就会发僵。',
			'type' => 'radio',
			'options' => array(
				1 => array('text' => '很符合自己的情况',
							'score' => 3,
						),
				2 => array('text' => '比较符合自己的情况',
							'score' => 2,
						),
				3 => array('text' => '较不符合自己的情况',
							'score' => 1,
						),
				4 => array('text' => '很不符合自己的情况',
							'score' => 0,
						),
			),
		
		),
		4 => array(
			'name' => '考试前，我总感到苦恼。',
			'type' => 'radio',
			'options' => array(
				1 => array('text' => '很符合自己的情况',
							'score' => 3,
						),
				2 => array('text' => '比较符合自己的情况',
							'score' => 2,
						),
				3 => array('text' => '较不符合自己的情况',
							'score' => 1,
						),
				4 => array('text' => '很不符合自己的情况',
							'score' => 0,
						),
			),
		
		),
		5 => array(
			'name' => '考试前，我感到烦躁，脾气变坏。',
			'type' => 'radio',
			'options' => array(
				1 => array('text' => '很符合自己的情况',
							'score' => 3,
						),
				2 => array('text' => '比较符合自己的情况',
							'score' => 2,
						),
				3 => array('text' => '较不符合自己的情况',
							'score' => 1,
						),
				4 => array('text' => '很不符合自己的情况',
							'score' => 0,
						),
			),
		
		),
		6 => array(
			'name' => '紧张的温课期间，常会想到：“这次考试要是得到个坏分数怎么办？”',
			'type' => 'radio',
			'options' => array(
				1 => array('text' => '很符合自己的情况',
							'score' => 3,
						),
				2 => array('text' => '比较符合自己的情况',
							'score' => 2,
						),
				3 => array('text' => '较不符合自己的情况',
							'score' => 1,
						),
				4 => array('text' => '很不符合自己的情况',
							'score' => 0,
						),
			),
		
		),
		7 => array(
			'name' => '临近考试，我的注意力越难集中。',
			'type' => 'radio',
			'options' => array(
				1 => array('text' => '很符合自己的情况',
							'score' => 3,
						),
				2 => array('text' => '比较符合自己的情况',
							'score' => 2,
						),
				3 => array('text' => '较不符合自己的情况',
							'score' => 1,
						),
				4 => array('text' => '很不符合自己的情况',
							'score' => 0,
						),
			),
		
		),
		8 => array(
			'name' => '想到马上就要考试了，参加任何文娱活动都感到没劲。',
			'type' => 'radio',
			'options' => array(
				1 => array('text' => '很符合自己的情况',
							'score' => 3,
						),
				2 => array('text' => '比较符合自己的情况',
							'score' => 2,
						),
				3 => array('text' => '较不符合自己的情况',
							'score' => 1,
						),
				4 => array('text' => '很不符合自己的情况',
							'score' => 0,
						),
			),
		
		),
		9 => array(
			'name' => '在考试前，我总预感到这次考试将要考坏。',
			'type' => 'radio',
			'options' => array(
				1 => array('text' => '很符合自己的情况',
							'score' => 3,
						),
				2 => array('text' => '比较符合自己的情况',
							'score' => 2,
						),
				3 => array('text' => '较不符合自己的情况',
							'score' => 1,
						),
				4 => array('text' => '很不符合自己的情况',
							'score' => 0,
						),
			),
		
		),
		10 => array(
			'name' => '在考试前，我常做关于考试的梦。',
			'type' => 'radio',
			'options' => array(
				1 => array('text' => '很符合自己的情况',
							'score' => 3,
						),
				2 => array('text' => '比较符合自己的情况',
							'score' => 2,
						),
				3 => array('text' => '较不符合自己的情况',
							'score' => 1,
						),
				4 => array('text' => '很不符合自己的情况',
							'score' => 0,
						),
			),
		
		),
		11 => array(
			'name' => '到了考试那天，我就不安起来。',
			'type' => 'radio',
			'options' => array(
				1 => array('text' => '很符合自己的情况',
							'score' => 3,
						),
				2 => array('text' => '比较符合自己的情况',
							'score' => 2,
						),
				3 => array('text' => '较不符合自己的情况',
							'score' => 1,
						),
				4 => array('text' => '很不符合自己的情况',
							'score' => 0,
						),
			),
		
		),
		12 => array(
			'name' => '听到开始考试的铃声响了，我的心马上紧张地急跳起来。',
			'type' => 'radio',
			'options' => array(
				1 => array('text' => '很符合自己的情况',
							'score' => 3,
						),
				2 => array('text' => '比较符合自己的情况',
							'score' => 2,
						),
				3 => array('text' => '较不符合自己的情况',
							'score' => 1,
						),
				4 => array('text' => '很不符合自己的情况',
							'score' => 0,
						),
			),
		
		),
		13 => array(
			'name' => '一到重要的考试，我的脑子就变得比平时迟钝。',
			'type' => 'radio',
			'options' => array(
				1 => array('text' => '很符合自己的情况',
							'score' => 3,
						),
				2 => array('text' => '比较符合自己的情况',
							'score' => 2,
						),
				3 => array('text' => '较不符合自己的情况',
							'score' => 1,
						),
				4 => array('text' => '很不符合自己的情况',
							'score' => 0,
						),
			),
		
		),
		14 => array(
			'name' => '考试题目越多、越难，我越感到不安。',
			'type' => 'radio',
			'options' => array(
				1 => array('text' => '很符合自己的情况',
							'score' => 3,
						),
				2 => array('text' => '比较符合自己的情况',
							'score' => 2,
						),
				3 => array('text' => '较不符合自己的情况',
							'score' => 1,
						),
				4 => array('text' => '很不符合自己的情况',
							'score' => 0,
						),
			),
		
		),
		15 => array(
			'name' => '考试中，我的手会变得冰凉。',
			'type' => 'radio',
			'options' => array(
				1 => array('text' => '很符合自己的情况',
							'score' => 3,
						),
				2 => array('text' => '比较符合自己的情况',
							'score' => 2,
						),
				3 => array('text' => '较不符合自己的情况',
							'score' => 1,
						),
				4 => array('text' => '很不符合自己的情况',
							'score' => 0,
						),
			),
		
		),
		16 => array(
			'name' => '考试时，我感到十分紧张。',
			'type' => 'radio',
			'options' => array(
				1 => array('text' => '很符合自己的情况',
							'score' => 3,
						),
				2 => array('text' => '比较符合自己的情况',
							'score' => 2,
						),
				3 => array('text' => '较不符合自己的情况',
							'score' => 1,
						),
				4 => array('text' => '很不符合自己的情况',
							'score' => 0,
						),
			),
		
		),
		17 => array(
			'name' => '遇到很难的考试，我就担心自己会不及格。',
			'type' => 'radio',
			'options' => array(
				1 => array('text' => '很符合自己的情况',
							'score' => 3,
						),
				2 => array('text' => '比较符合自己的情况',
							'score' => 2,
						),
				3 => array('text' => '较不符合自己的情况',
							'score' => 1,
						),
				4 => array('text' => '很不符合自己的情况',
							'score' => 0,
						),
			),
		
		),
		18 => array(
			'name' => '紧张的考试中，我却会想些与考试无关的事情，注意力集中不起来。 ',
			'type' => 'radio',
			'options' => array(
				1 => array('text' => '很符合自己的情况',
							'score' => 3,
						),
				2 => array('text' => '比较符合自己的情况',
							'score' => 2,
						),
				3 => array('text' => '较不符合自己的情况',
							'score' => 1,
						),
				4 => array('text' => '很不符合自己的情况',
							'score' => 0,
						),
			),
		
		),
		19 => array(
			'name' => '考试时，我会紧张得连平时记得滚瓜烂熟的知识一点也回忆不起来。',
			'type' => 'radio',
			'options' => array(
				1 => array('text' => '很符合自己的情况',
							'score' => 3,
						),
				2 => array('text' => '比较符合自己的情况',
							'score' => 2,
						),
				3 => array('text' => '较不符合自己的情况',
							'score' => 1,
						),
				4 => array('text' => '很不符合自己的情况',
							'score' => 0,
						),
			),
		
		),
		20 => array(
			'name' => '在考试中，我会沉浸在空想之中，一时忘了自己是在考试。',
			'type' => 'radio',
			'options' => array(
				1 => array('text' => '很符合自己的情况',
							'score' => 3,
						),
				2 => array('text' => '比较符合自己的情况',
							'score' => 2,
						),
				3 => array('text' => '较不符合自己的情况',
							'score' => 1,
						),
				4 => array('text' => '很不符合自己的情况',
							'score' => 0,
						),
			),
		
		),
		21 => array(
			'name' => '考试中，我想上厕所的次数比平时多些。',
			'type' => 'radio',
			'options' => array(
				1 => array('text' => '很符合自己的情况',
							'score' => 3,
						),
				2 => array('text' => '比较符合自己的情况',
							'score' => 2,
						),
				3 => array('text' => '较不符合自己的情况',
							'score' => 1,
						),
				4 => array('text' => '很不符合自己的情况',
							'score' => 0,
						),
			),
		
		),
		22 => array(
			'name' => '考试时，即使不热，我也会浑身出汗。',
			'type' => 'radio',
			'options' => array(
				1 => array('text' => '很符合自己的情况',
							'score' => 3,
						),
				2 => array('text' => '比较符合自己的情况',
							'score' => 2,
						),
				3 => array('text' => '较不符合自己的情况',
							'score' => 1,
						),
				4 => array('text' => '很不符合自己的情况',
							'score' => 0,
						),
			),
		
		),
		23 => array(
			'name' => '在考试时，我紧张得手发僵，写字不流畅。',
			'type' => 'radio',
			'options' => array(
				1 => array('text' => '很符合自己的情况',
							'score' => 3,
						),
				2 => array('text' => '比较符合自己的情况',
							'score' => 2,
						),
				3 => array('text' => '较不符合自己的情况',
							'score' => 1,
						),
				4 => array('text' => '很不符合自己的情况',
							'score' => 0,
						),
			),
		
		),
		24 => array(
			'name' => '考试时，我经常会看错题目。',
			'type' => 'radio',
			'options' => array(
				1 => array('text' => '很符合自己的情况',
							'score' => 3,
						),
				2 => array('text' => '比较符合自己的情况',
							'score' => 2,
						),
				3 => array('text' => '较不符合自己的情况',
							'score' => 1,
						),
				4 => array('text' => '很不符合自己的情况',
							'score' => 0,
						),
			),
		
		),
		25 => array(
			'name' => '在进行重要的考试时，我的头就会痛起来。',
			'type' => 'radio',
			'options' => array(
				1 => array('text' => '很符合自己的情况',
							'score' => 3,
						),
				2 => array('text' => '比较符合自己的情况',
							'score' => 2,
						),
				3 => array('text' => '较不符合自己的情况',
							'score' => 1,
						),
				4 => array('text' => '很不符合自己的情况',
							'score' => 0,
						),
			),
		
		),
		26 => array(
			'name' => '发现剩下的时间来不及做完全部考题，我就急得手足无措、浑身大汗。',
			'type' => 'radio',
			'options' => array(
				1 => array('text' => '很符合自己的情况',
							'score' => 3,
						),
				2 => array('text' => '比较符合自己的情况',
							'score' => 2,
						),
				3 => array('text' => '较不符合自己的情况',
							'score' => 1,
						),
				4 => array('text' => '很不符合自己的情况',
							'score' => 0,
						),
			),
		
		),
		27 => array(
			'name' => '如果我考了个坏分数，家长或教师会严厉地指责我。',
			'type' => 'radio',
			'options' => array(
				1 => array('text' => '很符合自己的情况',
							'score' => 3,
						),
				2 => array('text' => '比较符合自己的情况',
							'score' => 2,
						),
				3 => array('text' => '较不符合自己的情况',
							'score' => 1,
						),
				4 => array('text' => '很不符合自己的情况',
							'score' => 0,
						),
			),
		
		),
		28 => array(
			'name' => '考试后，发现自己懂得的题没有答对时，就十分生自己的气。',
			'type' => 'radio',
			'options' => array(
				1 => array('text' => '很符合自己的情况',
							'score' => 3,
						),
				2 => array('text' => '比较符合自己的情况',
							'score' => 2,
						),
				3 => array('text' => '较不符合自己的情况',
							'score' => 1,
						),
				4 => array('text' => '很不符合自己的情况',
							'score' => 0,
						),
			),
		
		),
		29 => array(
			'name' => '有几次在重要的考试之后，我腹泻了。',
			'type' => 'radio',
			'options' => array(
				1 => array('text' => '很符合自己的情况',
							'score' => 3,
						),
				2 => array('text' => '比较符合自己的情况',
							'score' => 2,
						),
				3 => array('text' => '较不符合自己的情况',
							'score' => 1,
						),
				4 => array('text' => '很不符合自己的情况',
							'score' => 0,
						),
			),
		
		),
		30 => array(
			'name' => '我对考试十分厌烦。',
			'type' => 'radio',
			'options' => array(
				1 => array('text' => '很符合自己的情况',
							'score' => 3,
						),
				2 => array('text' => '比较符合自己的情况',
							'score' => 2,
						),
				3 => array('text' => '较不符合自己的情况',
							'score' => 1,
						),
				4 => array('text' => '很不符合自己的情况',
							'score' => 0,
						),
			),
		
		),
	),
);


?>