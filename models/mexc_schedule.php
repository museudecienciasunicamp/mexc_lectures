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

class MexcSchedule extends MexcLecturesAppModel
{
	var $name = 'MexcSchedule';
	var $useTable = false;
	
	function __construct($id = false, $table = null, $ds = null)
	{
		Configure::load('MexcLectures.config');
		$datePeriods = array_keys(Configure::read('MexcLectures.datePeriods'));
		
		$this->validate = array(
			
			'date_1' => array(
				'fifteenDays' => array(
					'rule' => array('validWhen', 'after', '+15 days'),
					'message' => __d('mexc_lecture', 'Data 1: escolha uma data com até 15 dias de antecedência', true)),
				'hollidayDate' => array(
					'rule' => 'hollidayDate',
					'message' => __d('mexc_lecture', 'A data 1 cai num final de semana ou num feriado.', true)),
				'date' => array(
					'rule' => array('date', 'dmy'), 
					'message' => __d('mexc_lecture', 'A data 1 não está no formato válido. Por exemplo: 20/05/2012', true)),
				'notEmpty' => array(
					'required' => true, 
					'rule' => 'notEmpty', 
					'message' => __d('mexc_lecture', 'A data 1 é obrigatória', true)),
			),
			'date_2' => array(
				'fifteenDays' => array(
					'rule' => array('validWhen', 'after', '+15 days'),
					'message' => __d('mexc_lecture', 'Data 2: escolha uma data com até 15 dias de antecedência', true)),
				'hollidayDate' => array(
					'rule' => 'hollidayDate',
					'message' => __d('mexc_lecture', 'A data 2 cai num final de semana ou num feriado.', true)),
				'date' => array(
					'rule' => array('date', 'dmy'), 
					'message' => __d('mexc_lecture', 'A data 2 não está no formato válido. Por exemplo: 20/05/2012', true)),
				'notEmpty' => array(
					'required' => true, 
					'rule' => 'notEmpty', 
					'message' => __d('mexc_lecture', 'A data 2 é obrigatória', true)),
			),
			'date_3' => array(
				'fifteenDays' => array(
					'rule' => array('validWhen', 'after', '+15 days'),
					'message' => __d('mexc_lecture', 'Data 3: Digite uma data com até 15 dias de antecedência', true)),
				'hollidayDate' => array(
					'rule' => 'hollidayDate',
					'message' => __d('mexc_lecture', 'A data 3 cai num final de semana ou num feriado.', true)),
				'date' => array(
					'rule' => array('date', 'dmy'), 
					'message' => __d('mexc_lecture', 'A data 3 não está no formato válido. Por exemplo: 20/05/2012', true)),
				'notEmpty' => array(
					'required' => true, 
					'rule' => 'notEmpty', 
					'message' => __d('mexc_lecture', 'A data 3 é obrigatória', true)),
			),
			'date_1_period' => array(
				'inList' => array(
					'rule' => array('inList', $datePeriods),
					'message' => __d('mexc_lecture', 'Data 1: escolha um dos períodos indicados', true))
			),
			'date_2_period' => array(
				'inList' => array(
					'rule' => array('inList', $datePeriods),
					'message' => __d('mexc_lecture', 'Data 2: Escolha um dos períodos indicados', true))
			),
			'date_3_period' => array(
				'inList' => array(
					'rule' => array('inList', $datePeriods),
					'message' => __d('mexc_lecture', 'Data 3: Escolha um dos períodos indicados', true))
			),
			'lect_place_ag' => array(
				
			),
			'lect_place' => array(
				'inList' => array(
					'rule' => array('inList', array_keys(Configure::read('MexcLectures.places'))),
					'message' => __d('mexc_lecture', 'Escolha uma das opções de local', true))
			),
			'lect_space' => array(
				'notEmpty' => array(
					'required' => true,
					'rule' => array('multiple', array('min' => 1)),
					'message' => __d('mexc_lecture', 'Conte-nos algo sobre o espaço onde a palestra será realizada marcando as caixinhas pertinentes', true)
				)
			),
			'lect_ceiling' => array(
				'notEmpty' => array(
					'required' => true,
					'rule' => 'notEmpty',
					'message' => __d('mexc_lecture', 'Selecione uma opção sobre o espaço possuir ou não cobertura', true)
				)
			),
			'lect_lighting' => array(
				'notEmpty' => array(
					'required' => true,
					'rule' => 'notEmpty',
					'message' => __d('mexc_lecture', 'Selecione uma opção sobre o espaço ser ou não adequado para projeção', true)
				)
			),
			'lect_about_space' => array(),
			'lect_exp_num' => array(
				'numeric' => array(
					'rule' => 'numeric',
					'message' => __d('mexc_lecture', 'Indique o número de participantes escrevendo apenas um número', true)),
				'notEmpty' => array(
					'required' => true,
					'rule' => 'notEmpty',
					'message' => __d('mexc_lecture', 'O número de participantes é obrigatório', true)),
			),
			'lect_exp_grade' => array(
				'notEmpty' => array(
					'required' => true,
					'rule' => 'notEmpty',
					'message' => __d('mexc_lecture', 'O preenchimento das séries dos alunos é obrigatório', true)),
			),
			'gen_knowing' => array(),
			'gen_programs' => array(),
			'gen_obs' => array(),
		);
		
		return parent::__construct($id, $table, $ds);
	}

/**
 * Before validate callback used to skip the resp_ac inputs validation when resp_ac_same_ag is checked
 * 
 * @access public
 * @return boolean 
 */
	function beforeValidate()
	{
		foreach (array('cep') as $fieldName)
			if (isset($this->data[$this->alias][$fieldName]))
				$this->data[$this->alias][$fieldName] = preg_replace('/[^0-9]/','', $this->data[$this->alias][$fieldName]);
			
		if (isset($this->data[$this->alias]['resp_ac_same_ag']) && $this->data[$this->alias]['resp_ac_same_ag'])
		{
			foreach ($this->validate as $field => $rules)
				if (strpos($field, 'resp_ac') !== false)
					unset($this->validate[$field]);
		}
		return true;
	}

/**
 * Part of SUI contract
 * 
 * This method is called from SuiApplication model, for validating the POSTed data
 * 
 * @access public
 * @param array $data The POSTed data
 * @param array $application The current application being saved
 */
}
