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

class MexcSpeakersController extends MexcLecturesAppController
{
	var $name = 'MexcSpeakers';
	
	var $paginate = array(
		'MexcSpeaker' => array(
			'limit' => 8,
			'contain' => array('Tag')
		)
	);
	
	function beforeFilter()
	{
		parent::beforeFilter();
		// Does not allow this section to be opened on regular page
		if (empty($this->currentSpace))
			$this->cakeError('erro404');
	}
	
	function index()
	{
		$conditions = $this->MexcSpace->getConditionsForSpaceFiltering($this->currentSpace, 'MexcSpeaker');
		$speakers = $this->paginate('MexcSpeaker', $conditions);
		$this->set(compact('speakers'));
	}
	
	function view($mexc_speaker_id = null)
	{
		$speaker = $this->MexcSpeaker->findById($mexc_speaker_id);
		if (empty($speaker))
			$this->cakeError('error404');
		
		$this->set(compact('speaker'));
	}
}
