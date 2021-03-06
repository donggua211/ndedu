<?php
$config['evaluate_data'] = array(
	'is_vip' => FALSE,
	'score' => 60,
	'time' => '15 分钟',
	'has_score' => TRUE,
	'show_question_in_result' => TRUE,
	'questions' => array(
		1 => array(
			'name' => '下列字形中没有错误的一项是：（     ）',
			'type' => 'radio',
			'correct' => '4',
			'score' => 6,
			'advice' => '<strong>知识点分析：</strong><br/>
这是一道字形辨别题，考察学生对形近字的掌握能力。<br/>
<strong>指导与建议：</strong><br/>
做题时需注意形近字的区别，尤其是要注意平时的习惯用法和正确用法的区别，这道题主要考察学生平日积累和基础素质。 <br/>
<strong>答题错误语：</strong><br/>
最根本的原因是平时学习的过程中粗心，没有注意到形近字的辨析，建议做错的同学给自己准备一个错字本，把尚未掌握的形近字列成表格加以区分。 ',
			'options' => array(
				1 => array('text' => '融会贯通      变换莫测     凋敝      眷恋',
							'discription' => '选此项的同学同音异形字区分不清；对常用词语不熟悉；基础知识把握不到位； 把“幻”误认为“换”',
						),
				2 => array('text' => '山清水秀      嘻笑怒骂     弓弩      掂量',
							'discription' => '选此项的同学形近字辨析不清，词义理解有误；把“嬉笑怒骂”误认为“嘻笑怒骂”',
						),
				3 => array('text' => '笑容可掬       一张一弛    通谍      冷漠',
							'discription' => '选此项的同学形近字区分不清；不理解词语意思；把“通牒”误认为“通谍”',
						),
				4 => array('text' => '川流不息       心宽体胖    债务      辍学',
							'discription' => '选项正确',
						),
			),
		
		),
		2 => array(
			'name' => '下列各句中，加框的熟语使用恰当的一句是（    ）',
			'type' => 'radio',
			'correct' => '3',
			'score' => 6,
			'advice' => '<strong>知识点分析：</strong><br/>
本题考查的是熟语运用题，需要学生对对题干里的熟语理解。<br/>
<strong>指导与建议：</strong><br/>
准确记忆所学熟语，并且在生活中准确使用，不要望文生义。<br/>
<strong>答题错误语：</strong><br/>
仅仅只是望文生义，没有准确理解词语的内在含义。',
			'options' => array(
				1 => array('text' => '王平与三十年前的同学李小东在黄山脚下［萍水相逢］，他们高兴得热泪盈眶。',
							'discription' => '选此项的同学不理解熟语意思；不了解熟语用法；“萍水相逢”的意思是以前从未见过的人第一次见面，所以不能用于老同学相见。',
						),
				2 => array('text' => '当代诗坛颇不景气，想起唐诗宋词的成就，不禁让人产生［今非昔比］的感觉。',
							'discription' => '选此项的同学不理解此熟语的特点；“今非昔比”是说同一事物不同时间的变化，在这里是“现代诗坛”和“唐诗宋词”，并非同一事物。',
						),
				3 => array('text' => '不能把凡是印在书本上的东西都当作［金科玉律］，那样会束缚我们的思想的。',
							'discription' => '选项正确',
						),
				4 => array('text' => '世界杯比赛时，几乎［万人空巷］，许多球迷都在家看电视，街上显得静悄悄的。',
							'discription' => '选此项的同学审题不认真；望文生义；“万人空巷”是说街道里弄里的人全部走空。指家家户户的人都从巷里出来了。多形容庆祝、欢迎等盛况。句子里的意思是在家里，所以错误。',
						),
			),
		
		),
		3 => array(
			'name' => '下列各句中没有语病的一句是：（     ）',
			'type' => 'radio',
			'correct' => '2',
			'score' => 6,
			'advice' => '<strong>知识点分析：</strong><br/>
这是一道病句练习题。主要是辨别语病，句子成分、语序、搭配等问题。<br/>
<strong>指导与建议：</strong><br/>
掌握主要句子成分和病句类型及修改方法。<br/>
<strong>答题错误语：</strong><br/>
对句子成分把握不到位。对常见的病句类型不熟悉。语感不好。 ',
			'options' => array(
				1 => array('text' => '考古学家对两干多年前在长沙马王堆一号墓新出土的文物进行了多方面的研究，对墓主所处时代有了进一步的了解。',
							'discription' => '选此项的同学没有掌握句子成分的组成；不了解语序排列规则；语序有错，“两千多年前”应在“文物前面。',
						),
				2 => array('text' => '纵观科学史，科学的发展与全人类的文化是分不开的，在西方是如此，在中国也是如此。',
							'discription' => '选项正确',
						),
				3 => array('text' => '从中西医结合到完成新药学的过程，必须是中医、西医、中西医结合三种力量同时发展，不断使中西医结合向深度发展。',
							'discription' => '选此项的同学词语搭配掌握不牢；语感不好；没有发现搭配不当，句子的主干“过程是发展”是错误的。',
						),
				4 => array('text' => '发展没有终点，实践不会终结，创新永无止境，因此解放思想也不会一劳永逸，难道我们能否认这不是真理吗？',
							'discription' => '选此项的同学不了解否定句；没有发现是三重否定句；不知道三种否定仍为否定这一知识点。',
						),
			),
		
		),
		4 => array(
			'name' => '下列有关文学常识的解说不正确的的一项是：（     ）',
			'type' => 'radio',
			'correct' => '2',
			'score' => 6,
			'advice' => '<strong>知识点分析：</strong><br/>
文学常识分析题<br/>
<strong>指导与建议：</strong><br/>
首先应该分析题干，找出描述对象的关键词和易错点。建议学生要重视课本上每一课的注释1.此处是易考和易错点。<br/>
<strong>答题错误语：</strong><br/>
对知识的把握不够细致，对文学尝试掌握不牢固，根本原因是方面的知识的薄弱。',
			'options' => array(
				1 => array('text' => '《左传》是我国第一部叙事详尽的编年史著作，相传为春秋末年鲁国史官左丘明所作，是我国研究先秦历史的重要文献，也是优秀的散文著作。',
							'discription' => '选此项的同学对《左传》内容缺乏了解；体裁不明；作者不了解',
						),
				2 => array('text' => '《战国策》主要记载战国时期谋臣策士纵横捭阖的斗争及有关的谋议或辞说，其中许多文章都是先秦诸子散文的名篇。《史记》是我国历史上第一部叙事详细的编年体史书，它的成就无与伦比，同时，作为一部人物传记亦有开宗立派之功。',
							'discription' => '选项正确 “诸子”应为“历史” “编年”应为“纪传”',
						),
				3 => array('text' => '毛泽东同志的《沁园春 长沙》和《采桑子 重阳》两首词，从形式上看是旧体诗，从内容看，属于中国现代诗。戴望舒的《雨巷》的发表，为他赢得“雨巷诗人”的桂冠。',
							'discription' => '选此项的同学不熟悉词的格式；不明白词的特点；对文学常识陌生',
						),
				4 => array('text' => '《大堰河——我的保姆》作者艾青，原名蒋海澄，我国现代著名诗人。代表性的诗篇除《大堰河——我的保姆》外，还有《黎明的通知》、《光的赞歌》等。',
							'discription' => '选此项的同学对文学常识陌生；对诗人生平不了解；课外相关拓展狭窄',
						),
			),
		
		),
		5 => array(
			'name' => '指出下列句子中用到比喻修辞的一句（     ）',
			'type' => 'radio',
			'correct' => '4',
			'score' => 6,
			'advice' => '<strong>知识点分析：</strong><br/>
本题考查修辞手法的运用<br/>
<strong>指导与建议：</strong><br/>
正确掌握各类修辞手法的运用。<br/>
<strong>答题错误语：</strong><br/>
没有准确掌握各类修辞手法的特点，不会运用。',
			'options' => array(
				1 => array('text' => '呈给大地上一切的，我的大堰河般的保姆和她们的儿子，呈给爱我如爱他自己的儿子般的大堰河。',
							'discription' => '选此项的同学不了解比喻句的特点；对比喻句的成分不清楚；把“如”完全当做比喻句的唯一标志',
						),
				2 => array('text' => '她彷徨在这只寂寥的雨巷，撑着油纸伞，像我一样，像我一样地，默默彳亍着，冷漠，凄清，又惆怅。',
							'discription' => '选此项的同学把“像”作为比喻句的唯一标志；分不清楚本体和喻体；不了解本体和喻体的关系',
						),
				3 => array('text' => '悄悄的我走了，正如我悄悄的来，我挥一挥衣袖，不带走一片云彩。',
							'discription' => '选此项的同学把“正如”当做比喻句的唯一标志；对本体和喻体不了解；缺乏整体观',
						),
				4 => array('text' => '指点江山，激扬文字，粪土当年万户侯。',
							'discription' => '选项正确',
						),
			),
		
		),
		6 => array(
			'name' => '下列各句中，加框的熟语使用恰当的一项是：（     ）',
			'type' => 'radio',
			'correct' => '2',
			'score' => 6,
			'advice' => '<strong>知识点分析：</strong><br/>
字形分析题的变形题<br/>
<strong>指导与建议：</strong><br/>
首先应该分析题干，找出选项中的熟语所处的位置及作用；分析它句子中的含义和感情色彩，在平时的时候应该注意这方面知识的积累。<br/>
<strong>答题错误语：</strong><br/>
没有认真阅读题干一定要细心，一定要重视平时语言知识的积累，此处的功夫应下在平时，一点一滴的积累，是在考察学生基础知识，也能反映学生学生的做题习惯和仔细程度。',
			'options' => array(
				1 => array('text' => '鲁迅先生对黑暗社会的几句剖析，言辞犀利，［语重心长］，随着时间的推移和生活阅历的增加，我越来越体会到蕴涵在其中的哲理。',
							'discription' => '选此项的同学不了解熟语的含义；不了解熟语的感情色彩；不了解句子的整体意义',
						),
				2 => array('text' => '在春都等上市公司由盛到衰的过程中，中国股市多次经受资金违规运营之痛，这与"监管风暴"的［姗姗来迟］有着很大的关系。',
							'discription' => '选项正确',
						),
				3 => array('text' => '印度洋海啸灾难之后，中国人民深表同情，社会各界纷纷伸出援助之手，北京、上海等地的红十字会募捐点一时［人满为患］。',
							'discription' => '选此项的同学对熟语意义把握不对；不了解熟语的感情色彩；不明白熟语的适当用法',
						),
				4 => array('text' => '近来国内某些景点门票价格大幅上调，有关部门虽振振有辞，但总是不愿触及"利益"二字，未免让人［不知所云］。',
							'discription' => '选此项的同学不明白熟语含义；补补了解熟语用法；对句子整体把握不到位',
						),
			),
		
		),
		7 => array(
			'name' => ' 阅读下面文言文选段，完成下面2题<br/>
夜缒而出，见秦伯，曰：“秦、晋围郑，郑既知亡矣。若亡郑而有益于君，敢以烦执事。越国以鄙远，君知其难也。焉用亡郑以陪邻?邻之厚，君之薄也。若舍郑以为东道主，行李之往来，共其乏困，君亦无所害。且君尝为晋君赐矣，许君焦、瑕，朝济而夕设版焉，君之所知也。夫晋，何厌之有?既东封郑，又欲肆其西封，若不阙秦，将焉取之?阙秦以利晋，唯君图之。”秦伯说，与郑人盟。使杞子、逢孙、杨孙戍之，乃还。<br/>
子犯请击之，公曰：“不可。微夫人之力不及此。因人之力而敝之，不仁；失其所与，不知；以乱易整，不武。吾其还也。”亦去之。<br/>
选出加框字解释不当的一项（      ）',
			'type' => 'radio',
			'correct' => '4',
			'score' => 6,
			'advice' => '<strong>知识点分析：</strong><br/>
这是一题字音题，考查学生对字音的掌握情况。<br/>
<strong>指导与建议：</strong><br/>
把常考的十八个文言虚词分别整理，多加练习，运用的时候一定要跟课文互相结合，在一定的语境中来解释和区分。<br/>
<strong>答题错误语：</strong><br/>
基础知识不牢固。对文言文的虚词掌握不够。应学会总结综合。',
			'options' => array(
				1 => array('text' => '［微］夫人之力（无，没有）',
							'discription' => '选此项的同学对“微”的用法把握不到；对文言虚词不熟练；对句子含义不了解',
						),
				2 => array('text' => '若不［阙］秦，将焉取之（侵损，削减）',
							'discription' => '选此项的同学对通假字不理解；对文言词语解法掌握不够；对课文内容不熟悉',
						),
				3 => array('text' => '又欲［肆］其西封（扩张）',
							'discription' => '选此项的同学对古今异义词用法没有掌握；不能顺利翻译句子；对课文内容不熟悉',
						),
				4 => array('text' => '以乱［易］整（改变）',
							'discription' => '选项正确  应为“代替”',
						),
			),
		
		),
		8 => array(
			'name' => '选出对下列两组加框字的意义和用法分析判断正确的一项（　　）<br/>
①[焉]用亡郑以陪邻　　②将[焉]取之　<br/>
③既东[封]郑　　　　  ④又欲肆其西[封]',
			'type' => 'radio',
			'correct' => '4',
			'score' => 6,
			'advice' => '<strong>知识点分析：</strong><br/>
这道题考察学生多义词和词类活用。<br/>
<strong>指导与建议：</strong><br/>
首先应该分析题干，结合课文知识，了解句子含义，把握文言文中多义词的各种含义，掌握有词类活用现象的词语。<br/>
<strong>答题错误语：</strong><br/>
基础知识不够扎实，做题不细心，对文言文的多义词和词类活用掌握不到位。',
			'options' => array(
				1 => array('text' => '①②同，③④同',
							'discription' => '选此项的同学不了解“焉”的用法；不理解“封”的用法；对词类或用不熟悉',
						),
				2 => array('text' => '①②同，③④不同',
							'discription' => '选此项的同学不了解“焉”的用法；对句意不理解；对课文不熟悉',
						),
				3 => array('text' => '①②不同，③④同',
							'discription' => '选此项的同学不了解不理解“封”的用法；对课文不熟悉；文言文基础薄弱',
						),
				4 => array('text' => '①②不同，③④不同',
							'discription' => '选项正确',
						),
			),
		
		),
		9 => array(
			'name' => '阅读下面文言文选段，完成2道题目<br/>
项王即日因留沛公与饮。项王、项伯东向坐，亚父南向坐。亚父者，范增也。沛公北向坐，张良西向侍。范增数目项王，举所佩玉玦以示之者三，项王默然不应。范增起，出，召项庄，谓曰：“君王为人不忍。若入前为寿，寿毕，请以剑舞，因击沛公于坐，杀之。不者，若属皆且为所虏。”庄则入为寿。寿毕，曰：“君王与沛公饮，军中无以为乐，请以剑舞。”项王曰：“诺。”项庄拔剑起舞，项伯亦拔剑起舞，常以身翼蔽沛公，庄不得击。<br/>
　　于是张良至军门见樊哙。樊哙曰：“今日之事何如？”良曰：“甚急！今者项庄拔剑舞，其意常在沛公也。”哙曰：“此迫矣！臣请入，与之同命。”哙即带剑拥盾入军门。交戟之卫士欲止不内，樊哙侧其盾以撞，卫士仆地，哙遂入，披帷西向立，瞋目视项王，头发上指，目眦尽裂。项王按剑而跽曰：“客何为者？”张良曰：“沛公之参乘樊哙者也。” 项王曰：“壮士，赐之卮酒。”则与斗卮酒。哙拜谢，起，立而饮之。项王曰：“赐之彘肩。”则与一生彘肩。樊哙覆其盾于地，加彘肩上，拔剑切而啖之。项王曰：“壮士！能复饮乎？”樊哙曰：“臣死且不避，卮酒安足辞！夫秦王有虎狼之心，杀人如不能举，刑人如恐不胜，天下皆叛之。怀王与诸将约曰：‘先破秦入咸阳者王之。’今沛公先破秦入咸阳，毫毛不敢有所近，封闭宫室，还军霸上，以待大王来。故遣将守关者，备他盗出入与非常也。<br/><br/>
与 “因击沛公于坐”中“因”字的意义和用法相同的一项是（     ）',
			'type' => 'radio',
			'correct' => '3',
			'score' => 6,
			'advice' => '<strong>知识点分析：</strong><br/>
这道题考察学生对文言文中多义词和课本知识的掌握情况。<br/>
<strong>指导与建议：</strong><br/>
平时学习多注意课内知识，注意文学常识的积累，加强对文言文中多义词的整理和训练。 <br/>
<strong>答题错误语：</strong><br/>
出现错误的同学主要原因是缺乏总结能力，在学习完一篇课文以后，一定注意把文中的各种重要词语进行综合。',
			'options' => array(
				1 => array('text' => '项王即日因留沛公与饮',
							'discription' => '选此项的同学对多义词“因”的各种用法不明确；对例句意思不明；不知道词语意思应为“于是”',
						),
				2 => array('text' => '因人之力而敝之',
							'discription' => '选此项的同学选此项的同学对多义词“因”的各种用法不明确；对例句意思不明；不知道词语意思应为“凭借”',
						),
				3 => array('text' => '不如因善遇之',
							'discription' => '选项正确',
						),
				4 => array('text' => '因循守旧',
							'discription' => '选此项的同学选此项的同学对多义词“因”的各种用法不明确；对例句意思不明；不知道词语意思应为“沿袭”',
						),
			),
		
		),
		10 => array(
			'name' => '下列词类活用不同于其他三项的一项是（     ）',
			'type' => 'radio',
			'correct' => '3',
			'score' => 6,
			'advice' => '<strong>知识点分析：</strong><br/>
考察学生文言文中词类活用的辨析的能力。<br/>
<strong>指导与建议：</strong><br/>
对学过的文言文中的此类活用进行整理。在课堂上做到笔记，把讲解的有关知识详细记录，在课下要重点练习，达到熟练的程度。 <br/>
<strong>答题错误语：</strong><br/>
题做得太少，没有认真对文言文各种词语变换现象进行综合整理，不够细心，只要加倍努力，一定可以提高。',
			'options' => array(
				1 => array('text' => '范增数目项王',
							'discription' => '选此项的同学不知道词类活用的基本形式；不理解句子意思；不了解此处选项是“名词用作动词”',
						),
				2 => array('text' => '籍吏民，封府库',
							'discription' => '选此项的同学基础知识薄弱；不明白句子含义，没有看出“名词用作动词”',
						),
				3 => array('text' => '常以身翼蔽沛公',
							'discription' => '选项正确',
						),
				4 => array('text' => '先破秦入咸阳者王',
							'discription' => '选此项的同学对词类活动把握不够，不知道是哪个词语在句子中活用；没有看出是“名词作动词”',
						),
			),
		
		),
	),
);


?>