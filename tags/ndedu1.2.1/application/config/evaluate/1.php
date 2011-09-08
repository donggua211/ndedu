<?php
$config['evaluate_data'] = array(
	'is_vip' => FALSE,
	'has_score' => FALSE,
	'show_question_in_result' => TRUE,
	'comment' => '80%以上选A：很遗憾，您的孩子马虎问题比较严重，马虎习惯的体现的非常明显。性格、环境、习惯都会造成马虎毛病的养成。建议您寻求专家辅导，及时有效的改正孩子马虎的问题。 60%以上选B：家长，孩子的马虎问题需要您重视，针对孩子具体的问题来找到相应的解决方法。 60%以上选C:家长，孩子目前的学习习惯及态度良好，请继续保持。 60%以上选D:恭喜您，您的孩子学习态度非常端正，学习习惯较好，请继续保持。',
	'questions' => array(
		1 => array(
			'name' => '您的孩子经常边看电视边写作业吗？',
			'type' => 'radio',
			'advice' => '<strong>指导与建议：</strong><br/>选A或B的：家长，孩子的马虎毛病与您从小的培养有关。孩子长期在嘈杂的环境里学习，或者边看电视边听音乐，边做作业。或者在课堂上对所学内容不感兴趣，使孩子逐渐养成了粗心马虎的毛病，所以建议您针对上述问题，及时纠正孩子的学习习惯。',
			'options' => array(
				1 => array('text' => '很符合',
							'discription' => '做题不认真，及时纠正孩子的学习习惯',
						),
				2 => array('text' => '比较符合',
							'discription' => '做题不认真，及时纠正孩子的学习习惯',
						),
				3 => array('text' => '较不符合',
							'discription' => '做题很认真',
						),
				4 => array('text' => '很不符合',
							'discription' => '做题很认真',
						),
			),
		
		),
		2 => array(
			'name' => '您的孩子经常在课堂上走神吗？',
			'type' => 'radio',
			'advice' => '<strong>指导与建议：</strong><br/>选A或B的：家长，孩子的马虎毛病与您从小的培养有关。孩子长期在嘈杂的环境里学习，或者边看电视边听音乐，边做作业。或者在课堂上对所学内容不感兴趣，使孩子逐渐养成了粗心马虎的毛病，所以建议您针对上述问题，及时纠正孩子的学习习惯。',
			'options' => array(
				1 => array('text' => '很符合',
							'discription' => '注意力不集中，上课不认真。',
						),
				2 => array('text' => '比较符合',
							'discription' => '注意力不集中，上课不认真。',
						),
				3 => array('text' => '较不符合',
							'discription' => '上课较认真',
						),
				4 => array('text' => '很不符合',
							'discription' => '上课较认真',
						),
			),
		
		),
		3 => array(
			'name' => '您的孩子经常在比较嘈杂的环境里学习吗？',
			'type' => 'radio',
			'advice' => '<strong>指导与建议：</strong><br/>选A或B的：家长，孩子的马虎毛病与您从小的培养有关。孩子长期在嘈杂的环境里学习，或者边看电视边听音乐，边做作业。或者在课堂上对所学内容不感兴趣，使孩子逐渐养成了粗心马虎的毛病，所以建议您针对上述问题，及时纠正孩子的学习习惯。',
			'options' => array(
				1 => array('text' => '很符合',
							'discription' => '长期在嘈杂的环境里学习，使孩子逐渐养成了粗心马虎的毛病，所以建议您针对上述问题，及时纠正孩子的学习习惯。',
						),
				2 => array('text' => '比较符合',
							'discription' => '长期在嘈杂的环境里学习，使孩子逐渐养成了粗心马虎的毛病，所以建议您针对上述问题，及时纠正孩子的学习习惯。',
						),
				3 => array('text' => '较不符合',
							'discription' => '不在嘈杂环境里学习，养成良好的学习习惯',
						),
				4 => array('text' => '很不符合',
							'discription' => '不在嘈杂环境里学习，养成良好的学习习惯',
						),
			),
		
		),
		4 => array(
			'name' => '您的孩子有平时作业完成较好，一到考试就马虎成绩不高的情况吗？',
			'type' => 'radio',
			'advice' => '<strong>指导与建议：</strong><br/>家长，您的孩子存在考试焦虑紧张的问题，由此导致的马虎情况的发生，建议家长不要给孩子太大的压力，对考试给予过度的期望。',
			'options' => array(
				1 => array('text' => '很符合',
							'discription' => '存在考试焦虑紧张的问题，由此导致的马虎情况的发生，建议家长不要给孩子太大的压力，对考试给予过度的期望。',
						),
				2 => array('text' => '比较符合',
							'discription' => '存在考试焦虑紧张的问题，由此导致的马虎情况的发生，建议家长不要给孩子太大的压力，对考试给予过度的期望。',
						),
				3 => array('text' => '较不符合',
							'discription' => '不存在考试焦虑紧张的问题，很认真。',
						),
				4 => array('text' => '很不符合',
							'discription' => '不存在考试焦虑紧张的问题，很认真。',
						),
			),
		
		),
		5 => array(
			'name' => '您的孩子在考试时容易紧张吗？',
			'type' => 'radio',
			'advice' => '<strong>指导与建议：</strong><br/>选A或B的：家长，您的孩子存在考试焦虑紧张的问题，由此导致的马虎情况的发生，建议家长不要给孩子太大的压力，对考试给予过度的期望。 ',
			'options' => array(
				1 => array('text' => '很符合',
							'discription' => '存在考试焦虑紧张的问题',
						),
				2 => array('text' => '比较符合',
							'discription' => '存在考试焦虑紧张的问题',
						),
				3 => array('text' => '较不符合',
							'discription' => '不存在考试焦虑紧张的问题',
						),
				4 => array('text' => '很不符合',
							'discription' => '不存在考试焦虑紧张的问题',
						),
			),
		
		),
		6 => array(
			'name' => '您的孩子是简单的题容易出错吗？',
			'type' => 'radio',
			'advice' => '<strong>指导与建议：</strong><br/>选A或B的：家长，您的孩子可能比较聪明，但因对问题的重视程度不同，遇到相对简单的问题或不是特别重要的考试，心理过度的放松，造成了马虎的情况。建议您教育孩子，认真对待每一次考试及每一道习题。',
			'options' => array(
				1 => array('text' => '很符合',
							'discription' => '做题马虎',
						),
				2 => array('text' => '比较符合',
							'discription' => '做题马虎',
						),
				3 => array('text' => '较不符合',
							'discription' => '做题很认真',
						),
				4 => array('text' => '很不符合',
							'discription' => '做题很认真',
						),
			),
		
		),
		7 => array(
			'name' => '您的孩子在平时的小考中容易马虎吗？',
			'type' => 'radio',
			'advice' => '<strong>指导与建议：</strong><br/>选A或B的：家长，您的孩子可能比较聪明，但因对问题的重视程度不同，遇到相对简单的问题或不是特别重要的考试，心理过度的放松，造成了马虎的情况。建议您教育孩子，认真对待每一次考试及每一道习题。',
			'options' => array(
				1 => array('text' => '很符合',
							'discription' => '孩子的马虎毛病与您从小的培养有关及时纠正孩子的学习习惯。',
						),
				2 => array('text' => '比较符合',
							'discription' => '孩子的马虎毛病与您从小的培养有关及时纠正孩子的学习习惯。',
						),
				3 => array('text' => '较不符合',
							'discription' => '孩子的学习很认真，要继续保持。',
						),
				4 => array('text' => '很不符合',
							'discription' => '孩子的学习很认真，要继续保持。',
						),
			),
		
		),
		8 => array(
			'name' => '您的孩子重视小测验吗？',
			'type' => 'radio',
			'advice' => '<strong>指导与建议：</strong><br/>选A或B的：家长，您的孩子可能比较聪明，但因对问题的重视程度不同，遇到相对简单的问题或不是特别重要的考试，心理过度的放松，造成了马虎的情况。建议您教育孩子，认真对待每一次考试及每一道习题。',
			'options' => array(
				1 => array('text' => '很符合',
							'discription' => '家长，您的孩子可能比较聪明，但因对问题的重视程度不同。',
						),
				2 => array('text' => '比较符合',
							'discription' => '家长，您的孩子可能比较聪明，但因对问题的重视程度不同。',
						),
				3 => array('text' => '较不符合',
							'discription' => '要多培养孩子的综合素质',
						),
				4 => array('text' => '很不符合',
							'discription' => '要多培养孩子的综合素质',
						),
			),
		
		),
		9 => array(
			'name' => '您的孩子写作业时很慢吗？（一个小时能写完的要摩擦三四个小时）',
			'type' => 'radio',
			'advice' => '<strong>指导与建议：</strong><br/>选A或B的：家长，孩子的马虎毛病与您从小的培养有关。孩子长期在嘈杂的环境里学习，或者边看电视边听音乐，边做作业。或者在课堂上对所学内容不感兴趣，使孩子逐渐养成了粗心马虎的毛病，所以建议您针对上述问题，及时纠正孩子的学习习惯。',
			'options' => array(
				1 => array('text' => '很符合',
							'discription' => '孩子的学习很不认真，马虎毛病与您从小的培养有关及时纠正孩子的学习习惯。',
						),
				2 => array('text' => '比较符合',
							'discription' => '孩子的学习很不认真，马虎毛病与您从小的培养有关及时纠正孩子的学习习惯。',
						),
				3 => array('text' => '较不符合',
							'discription' => '孩子的学习很认真，要继续保持。',
						),
				4 => array('text' => '很不符合',
							'discription' => '孩子的学习很认真，要继续保持。',
						),
			),
		
		),
		10 => array(
			'name' => '您的孩子经常在比较嘈杂的环境里学习吗？',
			'type' => 'radio',
			'advice' => '<strong>指导与建议：</strong><br/>孩子的性格因素也会导致马虎，性格急躁，东西经常丢三落四。<br/>
建议：您的孩子存在考试焦虑紧张的问题，由此导致的马虎情况的发生，建议家长不要给孩子太大的压力，对考试给予过度的期望',
			'options' => array(
				1 => array('text' => '很符合',
							'discription' => '学习上不认真',
						),
				2 => array('text' => '比较符合',
							'discription' => '学习上不认真',
						),
				3 => array('text' => '较不符合',
							'discription' => '学习上较认真',
						),
				4 => array('text' => '很不符合',
							'discription' => '学习上较认真',
						),
			),
		
		),
		11 => array(
			'name' => '您的孩子从不重视错题吗？',
			'type' => 'radio',
			'advice' => '<strong>指导与建议：</strong><br/>选A或B的：家长，孩子对错题的重视不够，没有及时总结问题的习惯。',
			'options' => array(
				1 => array('text' => '很符合',
							'discription' => '孩子对错题的重视不够，没有及时总结问题的习惯。',
						),
				2 => array('text' => '比较符合',
							'discription' => '孩子对错题的重视不够，没有及时总结问题的习惯。',
						),
				3 => array('text' => '较不符合',
							'discription' => '有及时总结问题的习惯',
						),
				4 => array('text' => '很不符合',
							'discription' => '有及时总结问题的习惯',
						),
			),
		
		),
	),
);


?>