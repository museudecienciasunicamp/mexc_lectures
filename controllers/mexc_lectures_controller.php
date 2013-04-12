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

class MexcLecturesController extends MexcLecturesAppController
{
	var $name = 'MexcLectures';
	
	var $components = array('MexcLectures.MexcSearch', 'MexcMail', 'Session');

	var $paginate = array(
		'MexcLecture' => array(
			'limit' => 20,
			'contain' => array('MexcSpeaker', 'Tag')
		)
	);
	
	function beforeFilter()
	{
		Configure::load('MexcLectures.config');
	}

	
	function index()
	{
		$conditions = $this->MexcSpace->getConditionsForSpaceFiltering($this->currentSpace, 'MexcLecture');
		$tagged = null;
		if (!empty($this->params['url']['search']))
		{
			$search = $this->MexcSearch->parseSearchString($this->params['url']['search']);
			
			if (!empty($search['palavra-chave']))
			{
				$tag_conditions = array();
				foreach ($search['palavra-chave'] as $tag)
					$tag_conditions[] = "Tag.name LIKE '%$tag%'";
				$tags = $this->MexcLecture->Tag->find('list', array('conditions' => $tag_conditions));

				$this->MexcLecture->bindModel(array('hasOne' => array(
					'Tagged' => array(
						'className' => 'Tags.Tagged',
						'conditions' => array('Tagged.model' => $this->MexcLecture->alias),
						'foreignKey' => 'foreign_key'
					)
				)), false);
				$this->paginate['MexcLecture']['contain'][] = 'Tagged';
				$conditions['Tagged.tag_id'] = array_keys($tags);
			}
			
			if (!empty($search['palestra']))
			{
				foreach ($search['palestra'] as $palestra)
				{
					$conditions[] = array('or' => array(
						"MexcLecture.name LIKE '%$palestra%'",
						"MexcLecture.description LIKE '%$palestra%'"
					));
				}
			}
			
			if (!empty($search['palestrante']))
			{
				foreach ($search['palestrante'] as $palestrante)
				{
					$conditions[] = "MexcSpeaker.name LIKE '%$palestrante%'";
				}
			}
			
			if (!empty($search[0]))
			{
				foreach ($search[0] as $search)
					$conditions[] = array(
						'or' => array(
							"MexcLecture.name LIKE '%$search%'",
							"MexcLecture.description LIKE '%$search%'",
							"MexcSpeaker.name LIKE '%$search%'"
						)
					);
			}
		}
		
		$lectures = $this->paginate('MexcLecture', $conditions);
		$this->set(compact('lectures'));
	}
	
	
	function autocomplete()
	{
		$this->view = 'JjUtils.Json';
		
		$type = false;
		$search = trim(array_pop(explode(',',$this->params['form']['search'])));
		if (strpos($search, ':') !== false)
			list($type, $search) = explode(':', $search);
		
		$jsonVars = false;
		if (empty($search))
		{
			$this->set('jsonVars', false);
			return;
		}
		
		if (!$type || $type == 'palavra-chave')
		{
			$tags = $this->MexcLecture->Tagged->find('cloud', array(
				'order' => array('occurrence' => 'desc'),
				'limit' => 10,
				'conditions' => array(
					'Tagged.model' => $this->MexcLecture->alias,
					'Tag.name LIKE' => '%'.$search.'%'
				),
			));
			if (!empty($tags))
			{
				foreach ($tags as &$tag)
					$tag = array(
						'label' => $tag['Tag']['name'] . ' (' . $tag['Tag']['occurrence'] .')',
						'search' => 'palavra-chave:' . $tag['Tag']['name']
					);
		
				$jsonVars['tags'] = array(
					'label' => __d('mexc', 'Pesquisar por pela palavra-chave:', true),
					'content' => $tags
				);
			}
		}
		
		
		if (!$type || $type == 'palestra')
		{
			$lectures = $this->MexcLecture->find('count', array(
				'contain' => false,
				'conditions' => array(
					'or' => array(
						'MexcLecture.name LIKE' => '%' . $search . '%',
						'MexcLecture.description LIKE' => '%' . $search . '%'
					)
				)
			));
			if ($lectures)
			{
				$jsonVars['lectures'] = array(
					'content' => array(
						'label' => sprintf(__d('mexc', 'Pesquisar "%s" nas palestras (%s resultado%s)', true), h($search), $lectures, $lectures != 1 ? 's':''),
						'search' => 'palestra:' . $search
					)
				);
			}
		}
		
		
		
		if (!$type || $type == 'palestrante')
		{
			$lectures = $this->MexcLecture->find('count', array(
				'contain' => 'MexcSpeaker',
				'conditions' => array(
					'MexcSpeaker.name LIKE' => '%' . $search . '%',
				)
			));
			if ($lectures)
			{
				$jsonVars['speakers'] = array(
					'content' => array(
						'label' => sprintf(__d('mexc', 'Pesquisar "%s" nos nomes dos palestrantes (%s resultado%s)', true), h($search),  $lectures, $lectures != 1 ? 's':''),
						'search' => 'palestrante:' . $search
					)
				);
			}
		}
		
		$this->set('jsonVars', $jsonVars);
	}
	
	function getLectures()
	{
		$results = $this->MexcLecture->find('list', array(
			'contain' => array('MexcSpeaker'),
			'recursive' => 0,
			'order' => array('MexcSpeaker.name' => 'asc', 'MexcLecture.name' => 'asc'),
			'fields' => array('MexcLecture.name', 'MexcLecture.name', 'MexcSpeaker.name')
		));
		return $results;
	}
	
	function read($mexc_lecture_id = false)
	{
		$this->MexcLecture->contain(array('MexcSpeaker', 'Tag', 'MexcRelatedContent'));
		$lecture = $this->MexcLecture->findById($mexc_lecture_id);
		
		if (empty($lecture))
			$this->cakeError('erro404');
		
		$this->set(compact('lecture', 'related_content'));
	}
	
	
	
	function agendamento($mexc_lecture_id = false)
	{
		if (!App::import('Lib', 'MexcLectures.MexcLectureDataHandler'))
		{
			trigger_error('MexcLectureDataHandler not fount!');
			$this->cakeError('error404');
		}
		
		$this->MexcLecture->contain(array('MexcSpeaker'));
		$lecture = $this->MexcLecture->findById($mexc_lecture_id);
		
		if (empty($lecture))
			$this->cakeError('error404');
		
		$this->set(compact('lecture'));

		$sent = false;
		if (!empty($this->data))
		{
			$this->loadModel('MexcLectures.MexcSchedule');
			$this->MexcSchedule->set($this->data);
			if ($this->MexcSchedule->validates())
			{
				$mail_data = $this->data+$lecture;
				
				$this->_saveRequest($mail_data);
				
				$this->set('mail_data', $mail_data);
				$sent = $this->MexcMail->send('unicamp.itinerante@gmail.com', 'Unicamp Itinerante', 'Pedido de agendamento de palestra', 'agendamento');
			}
		}
		$this->set(compact('sent'));
	}
	
	
	function _saveRequest($data)
	{
		$file_path = WWW_ROOT . 'files' . DS . 'palestras.csv';
		$create_header = !file_exists($file_path);
		$values = array();
		$header = array();
		
		$header[] = 'Palestra';
		$values[] = utf8_decode($data['MexcLecture']['name']);
		$header[] = 'Palestrante';
		$values[] = utf8_decode($data['MexcSpeaker']['name']);
		
		foreach (array_keys(Configure::read('MexcLectures.field_to_string')) as $field)
		{
			if (in_array($field, array('inst_tel2', 'inst_email2', 'resp_ac_email2', 'resp_ac_tel2', 'resp_ag_email2', 'resp_ag_tel2', 'lect_place_ag')))
				continue;
			$values[] = utf8_decode(MexcLectureDataHandler::getValue($field, $this->data));
			if ($create_header)
				$header[] = utf8_decode(MexcLectureDataHandler::getLabel($field));
		}

		if ($rsc = fopen($file_path, 'a+'))
		{
			if ($create_header)
				fputcsv($rsc, $header, ';');
			fputcsv($rsc, $values, ';');
			fclose($rsc);
		}
	}
}
