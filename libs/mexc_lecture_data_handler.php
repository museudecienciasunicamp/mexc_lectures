<?php

/**
 *
 * Copyright 2011-2013, Museu Exploratório de Ciências da Unicamp (http://www.museudeciencias.com.br)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2011-2013, Museu Exploratório de Ciências da Unicamp (http://www.museudeciencias.com.br)
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link          https://github.com/museudecienciasunicamp/mexc_lectures.git Mexc Lectures public repository
 */

class MexcLectureDataHandler
{
	public static function getLabel($field)
	{
		return Configure::read('MexcLectures.field_to_string.'.$field);
	}
	
	public static function getValue($field, $all_data)
	{
		$value = $all_data['MexcSchedule'][$field];
		
		if (is_array($value))
		{
			$tmp = array();
			switch ($field)
			{
				case 'lect_space': $options = Configure::read('MexcLectures.space'); break;
				case 'gen_programs': 
					if (empty($value))
						$value = 'Não conhece';
					else
						$options = Configure::read('MexcLectures.programs');
				break;
			}
			if (isset($options))
			{
				foreach ($value as $q)
					$tmp[] = $options[$q];
				$value = implode(', ', $tmp);
			}
		}
		
		switch ($field)
		{
			case 'inst_tel2': case 'inst_email2':
			case 'resp_ac_email2': case 'resp_ac_tel2':
			case 'resp_ag_email2': case 'resp_ag_tel2':
			case 'lect_place_ag':
				return false;
			
			case 'resp_ac_same_ag':
			case 'resp_ac_name':
			case 'resp_ac_func':
			case 'resp_ac_email':
			case 'resp_ac_tel':
				if ($all_data['MexcSchedule']['resp_ac_same_ag'])
					return false;
				
			
			case 'inst_type':
				$value = Configure::read('MexcLectures.instTypes.'.$value);
			break;
		
		
			case 'lect_place':
				if ($value == 'outro')
					$value = 'Outro: '.$all_data['MexcSchedule']['lect_place_ag'];
				else
					$value = Configure::read('MexcLectures.places.' . $value);
			break;
			
			
			case 'date_1':
			case 'date_2':
			case 'date_3':
				$value .= ' ('.Configure::read('MexcLectures.datePeriods.'.$all_data['MexcSchedule'][$field.'_period']).')';
			break;
		}
		
		if ($value === '')
			$value = '[vazio]';
		
		if ($value === '0' || $value === '1')
			$value = $value ? 'Sim' : 'Não';
		
		return $value;
	}
}
