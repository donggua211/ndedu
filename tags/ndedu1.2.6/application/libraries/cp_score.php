<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class cp_score
{
	function image($key, $image_info, $total_score, $cp_title)
	{
		switch($image_info['type'])
		{
			case 'histogram1':
				return $this->histogram($key, $image_info, $total_score, $cp_title, 1);
				break;
			case 'histogram2':
				return $this->histogram($key, $image_info, $total_score, $cp_title, 2);
				break;
			case 'histogram3':
				return $this->histogram($key, $image_info, $total_score, $cp_title, 3);
				break;
			case 'static_pic':
				return $this->static_pic($image_info);
				break;
			case 'cp_image_cat2cp1':
				return $this->cp_image($key, $total_score, 'cat2cp1');
				break;
			case 'cp_image_cat5cp1':
				return $this->cp_image($key, $total_score, 'cat5cp1');
				break;
			case 'cp_image_cat5cp2':
				return $this->cp_image($key, $total_score, 'cat5cp2');
				break;
			case 'cp_image_cat1cp5':
				return $this->cp_image($key, $total_score, 'cat1cp5');
				break;
		}		
	}
	
	
	function text($total_score, $result_info)
	{
		$finnal_text = '';
		
		switch($result_info['type'])
		{
			case 'nomal':
				$finnal_text .= $this->text_normal($total_score, $result_info);
				break;
			case 'text_2group':
				$finnal_text .= $this->text_2group($total_score, $result_info);
				break;
			case 'most_selection':
				$finnal_text .= $this->text_most_selection($total_score, $result_info);
				break;
			case 'most_multi_selection':
				$finnal_text .= $this->text_most_multi_selection($total_score, $result_info);
				break;
			case 'text_creative':
				$finnal_text .= $this->text_creative($total_score, $result_info);
				break;
			case 'text_memory':
				$finnal_text .= $this->text_memory($total_score, $result_info);
				break;
			case 'text_career':
				$finnal_text .= $this->text_career($total_score, $result_info);
				break;
			case 'text_career_tendency':
				$finnal_text .= $this->text_career_tendency($total_score, $result_info);
				break;
			case 'text_4group':
				$finnal_text .= $this->text_4group($total_score, $result_info);
				break;
		}
		
		return $finnal_text;
		
	}
	
	function score($this_answers, $answer_info)
	{
		switch($answer_info['type'])
		{
			case 'same_value':
				return $this->score_same_value($this_answers, $answer_info['score']);
				break;
			case 'odd_even':
				return $this->score_odd_even($this_answers, $answer_info['score']);
				break;
			case 'all_diff':
				return $this->score_all_diff($this_answers, $answer_info['score']);
				break;
			case 'groups_same_value':
				return $this->score_groups_same_value($this_answers, $answer_info);
				break;
			case 'factor_group_value':
				return $this->score_factor_group_value($this_answers, $answer_info);
				break;
			case 'correct_answre_value':
				return $this->correct_answre_value($this_answers, $answer_info['score'], $answer_info['factor']);
				break;
			case 'most_selection':
				return $this->most_selection_value($this_answers);
			case 'group_value':
				return $this->group_value($this_answers, $answer_info);
			case 'creative_value': //定制: cat:2 => 8 创造力.
				return $this->creative_value($this_answers, $answer_info);
			case 'memory_value': //定制: cat:2 => 9 记忆能力.
				return $this->memory_value($this_answers);
			case 'career_value': //定制: cat:2 => 9 记忆能力.
				return $this->career_value($this_answers, $answer_info);
		}
	}
	
	function score_same_value($this_answers, $score)
	{
		$total_score = 0;
		foreach($this_answers as $index => $answer)
		{
			$total_score += $score[$answer];
		}
		return $total_score;
	}
	
	function score_odd_even($this_answers, $score)
	{
		$total_score = 0;
		foreach($this_answers as $index => $answer)
		{
			if (1 & ($index + 1)) //odd
			{
				$total_score += $score['odd'][$answer];
			}
			else //even
			{
				$total_score += $score['even'][$answer];
			}
		}
		return $total_score;
	}
	
	function score_all_diff($this_answers, $score)
	{
		$total_score = 0;
		foreach($this_answers as $index => $answer)
		{
			$total_score += $score[$index][$answer];
		}
		return $total_score;
	}
	
	function score_groups_same_value($this_answers, $answer_info)
	{
		$total_score = array();
		foreach($this_answers as $index => $answer)
		{
			foreach($answer_info['group'] as $group_key => $group)
			{
				if(!isset($total_score[$group_key]))
						$total_score[$group_key] = 0;
				
				if (in_array($index, $group))
				{
					$total_score[$group_key] += $answer_info['score'][$answer];
					continue;
				}
			}
		}
		
		if(isset($answer_info['factor']) && !empty($answer_info['factor']))
		{
			foreach($total_score as $key => $val)
				$total_score[$key] = ceil($answer_info['factor'] * $val);
		}
		
		return $total_score;
	}
	
	function score_factor_group_value($this_answers, $answer_info)
	{
		$total_score = 0;
		foreach($this_answers as $index => $answer)
		{
			foreach($answer_info['group'] as $group)
			{
				if (in_array($index, $group['index'])) 
				{
					$total_score += $group['score'][$answer];
					continue;
				}
			}
		}
		return round($total_score * $answer_info['factor']);
	}
	
	function correct_answre_value($this_answers, $score, $factor)
	{
		$total_score = 0;
		foreach($this_answers as $index => $answer)
		{
			if($answer == $score[$index])
				$total_score += 1 * $factor;
		}
		return $total_score;
	}
	
	function most_selection_value($this_answers)
	{
		$total_score = array();
		foreach($this_answers as $index => $answer)
		{
			if(!isset($total_score[$answer]))
				$total_score[$answer] = 1;
			else
				$total_score[$answer] += 1;
		}
		return $total_score;
	}
	
	function group_value($this_answers, $answer_info)
	{
		$total_score = 0;
		foreach($this_answers as $index => $answer)
		{
			foreach($answer_info['group'] as $group)
			{
				if (in_array($index, $group['index'])) 
				{
					$total_score += $group['score'][$answer];
					continue;
				}
			}
		}
		return $total_score;
	}
	
	function creative_value($this_answers, $answer_info)
	{
		$total_score = array();
		$total =0;
		foreach($this_answers as $index => $answer)
		{
			//分group.
			foreach($answer_info['group'] as $group_key => $group)
			{
				//设置默认项.
				if(!isset($total_score[$group_key]))
						$total_score[$group_key] = 0;
						
				//答案分组.
				foreach($group as $group_detail)
				{
					if (in_array($index, $group_detail['index']))
					{
						$total_score[$group_key] += $group_detail['score'][$answer];
						$total += $group_detail['score'][$answer];
						continue;
					}
				}
			}
		}
		$total_score[] = $total;
		return $total_score;
	}
	
	function memory_value($this_answers)
	{
		$total_score = array();
		foreach($this_answers as $index => $answer)
		{
			if($index == 0 || $index == 1)
			{
				$total_score[$index] = $answer;
			}
			else
			{
				if(!isset($total_score[3][$answer]))
					$total_score[3][$answer] = 1;
				else
					$total_score[3][$answer] += 1;
			}
		}
		return $total_score;
	}
	
	function career_value($this_answers, $answer_info)
	{
		$total_score = array();
		foreach($this_answers as $index => $answer)
		{
			//分group.
			foreach($answer_info['group'] as $group_key => $group)
			{
				//设置默认项.
				if(!isset($total_score[$group_key]))
						$total_score[$group_key] = 0;
				
				if (in_array($index, $group))
				{
					//算分
					foreach($answer_info['score_group'] as $score_key => $score)
					{
						if (in_array($index, $score))
						{
								$total_score[$group_key] += $answer_info['score'][$score_key][$answer];
								continue;
						}
					}
					continue;
				}
			}
		}
		
		foreach($total_score as $key => $score)
		{
			$total_score[$key] = $answer_info['norm'][$key][$score];
		
		}
		
		//2Q3+2G+2C+E+N+Q1+Q2
		return (2 * $total_score['q3'] + 2 * $total_score['g'] + 2 * $total_score['c'] + $total_score['e'] + $total_score['n'] + $total_score['q1'] + $total_score['q2']);
	}
	
	
	
	function text_normal($total_score, $result_info)
	{
		foreach($result_info['text'] as $key => $text)
		{
			if($total_score <= $key)
			{
				return $text."\n";
				break;
			}
		}
	}
	
	function text_2group($total_score, $result_info)
	{
	
		if($total_score[0] == $total_score[1])
			return $result_info['group_text'][2];
		elseif($total_score[0] > $total_score[1])
			return $result_info['group_text'][0];
		elseif($total_score[0] < $total_score[1])
			return $result_info['group_text'][1];
		
	}
	
	function text_most_selection($total_score, $result_info)
	{
		
		arsort($total_score); //反向排序
		$keys = array_keys($total_score); //获取key
		$most_selection = array_shift($keys);
		return $result_info['text'][$most_selection];
	}
	
	function text_most_multi_selection($total_score, $result_info)
	{
		$result_text = '';
		arsort($total_score); //反向排序
		$keys = array_keys($total_score); //获取key
		$most_selection = array_shift($keys);
		
		foreach($total_score as $key => $val)
		{
			if($val == $total_score[$most_selection])
				$result_text .= $result_info['text'][$key];
		}
		return $result_text;
	}
	
	function text_creative($total_score, $result_info)
	{
		$result_text = '';
		foreach($total_score as $key => $group_score)
		{
			$result_text .= str_replace('POINT', $group_score, $result_info['text'][$key])."\n";
		}
		return $result_text;
	}
	
	function text_memory($total_score, $result_info)
	{
		$result_text = '';
		foreach($total_score as $index => $answer)
		{
			if($index == 0 || $index == 1)
			{
				$result_text .= $result_info['text'][$index][$answer]."\n";
			}
			else
			{
				foreach($answer as $key => $val)
				{
					if(!isset($answer[0]) || $answer[0] >= 13)
						$result_text .= $result_info['text'][3][13]."\n";
					elseif(!isset($answer[1]) || $answer[1] <= 5)
						$result_text .= $result_info['text'][3][5]."\n";
				}
			}
		}
		return $result_text;
	}
	
	function text_4group($total_score, $result_info)
	{
		//反向排序
		$result = '';
		arsort($total_score);
		
		foreach($total_score as $key => $score)
		{
			if($score >= 10)
				$result .= $result_info['text'][$key]."\n";
			else
				break;
		}
		return trim($result);
		
		//获取key
		/*
		if($total_score[$keys[0]] - $total_score[$keys[1]] >= 4)
			return $result_info['text'][$keys[0]];
		elseif($total_score[$keys[1]] - $total_score[$keys[2]] >= 4)
			return $result_info['text'][0]."\n".$result_info['text'][1];
		else
			return $result_info['text'][0]."\n".$result_info['text'][1]."\n".$result_info['text'][2];
		*/
	}
	
	function text_career($total_score, $result_info)
	{
		print_r($total_score);
		return str_replace('POINT', $total_score, $result_info['text']);
	}
	
	function text_career_tendency($total_score, $result_info)
	{
		$result = '';
		arsort($total_score); //反向排序
		foreach($total_score as $key => $score)
		{
			$result .= str_replace('POINT', $score, $result_info['text'][$key])."\n";
		}
		return $result;
	}
	
	function histogram($current_key, $image_info, $total_score, $cp_title, $type='1')
	{
		$text = '<table class="normal" width="100%" align="center" border="0" cellpadding="0" cellspacing="0"><tbody>';
		if(isset($image_info['level_data']) && !empty($image_info['level_data']))
		{
			$text .= '<tr>
				<td>&nbsp;</td>
				<td align="right"><img style="margin: 2pt;" src="'.base_url().'images/cp/result/l_arrow.gif" width="10" border="0" height="15"></td>
				<td width="400">
					<table bgcolor="#000000" border="0" cellpadding="0" cellspacing="1"><tbody>
						<tr class="compact" align="center">';
		
			$level_index = 0;
			$pre_key = 0;
			foreach($image_info['level_data'] as $key => $one_level)
			{
				$text .= '<td valign="bottom" width="'.ceil((($key-$pre_key)/$image_info['max_num'])*400).'px" style="background-color:rgb('.ceil(($level_index/(count($image_info['level_data'])-1)) * 255).', '.ceil(($level_index/(count($image_info['level_data'])-1)) * 255).', '.ceil(($level_index/(count($image_info['level_data'])-1)) * 255).')"><font color="#'.((ceil(($level_index/(count($image_info['level_data'])-1)) * 255) > 190) ? '000000' : 'ffffff').'">'.$one_level.'</font></td>';
				$level_index++;
				$pre_key = $key;
			}

			$text .= '		</tr>
						</tbody></table>
					</td>
					<td><img style="margin: 2pt;" src="'.base_url().'images/cp/result/r_arrow.gif" width="10" border="0" height="15"></td>
				</tr>';
		}
		
		if($type == 1)
		{
			foreach($image_info['score_index'] as $index)
			{
				$text .= '<tr>
					<td>'.$cp_title[$index]['cp_name'].'</td>
					<td width="50">得'.$total_score[$index].'分</td>
					<td width="400" style="border-top: 1pt solid #000000;border-right: 1pt solid #000000;border-left: 1pt solid #000000;" valign="center">
						<img class="colum" src="'.base_url().'images/cp/result/score_bg.gif" width="'.ceil(($total_score[$index]/$image_info['max_num'])*400).'" height="11">
					</td>
					<td>&nbsp;</td>
				</tr>';
			}	
		}
		else
		{
			if(isset($image_info['text']))
			{
				foreach($total_score[$current_key] as $key => $score)
				{
					if(isset($image_info['text'][$key]))
					{
						$text .= '<tr>
							<td align="center">'.$image_info['text'][$key].'</td>
							<td width="50">得'.$score.'分</td>
							<td width="400" style="border-top: 1pt solid #000000;border-right: 1pt solid #000000;border-left: 1pt solid #000000;" valign="center">
								<img class="colum" src="'.base_url().'images/cp/result/score_bg.gif" width="'.ceil(($score/$image_info['max_num'])*400).'" height="11">
							</td>
							<td>&nbsp;</td>
						</tr>';
					}
				}
			}
			else
			{
				$text .= '<tr>
						<td align="center">'.$cp_title[$current_key]['cp_name'].'</td>
						<td width="50">得'.$total_score[$current_key].'分</td>
						<td width="400" style="border-top: 1pt solid #000000;border-right: 1pt solid #000000;border-left: 1pt solid #000000;" valign="center">
							<img class="colum" src="'.base_url().'images/cp/result/score_bg.gif" width="'.ceil(($total_score[$current_key]/$image_info['max_num'])*400).'" height="11">
						</td>
						<td>&nbsp;</td>
					</tr>';
			}
		}
		$text .= '<tr>
					<td align="center"></td>
					<td width="50"></td>
					<td width="400" style="border-top: 1pt solid #000000;" valign="center"></td>
					<td>&nbsp;</td>
				</tr>';
		$text .= '</tbody></table>';
		return $text;
	}
	
	function static_pic($image_info)
	{
		return '<div style="text-align:center"><img src="'.base_url().'images/cp/result/'.$image_info['file'].'"></div>';
	}
	
	function cp_image($key, $total_score, $function)
	{
		$this_score = $total_score[$key];
		if(!is_array($this_score))
			$this_score = array($this_score);
		//return '<div style="text-align:center"><img src="'.site_url('cp_image/'.$function.'/'.implode('/',$this_score)).'"></div>';
		return '<div style="text-align:center"><img src="http://www.donggua211.com/ndedu/index.php/cp_image/'.$function.'/'.implode('/',$this_score).'"></div>';
	}
}