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

echo $this->Bl->sbox(array(),array('size' => array('M' => 1, 'm' => -1)));
echo $this->Bl->ebox();

echo $this->Bl->sbox(array(),array('size' => array('M' => 10, 'g' => -1, 'm' => -2)));
	echo $this->Bl->sp();
		echo $this->Bl->anchor(
			array(), 
			array(
				'url' => array('plugin' => 'mexc_lectures', 'controller' => 'mexc_speakers', 'action' => 'view', $lecture['MexcSpeaker']['id']),
				'space' => $currentSpace
			),
			$lecture['MexcSpeaker']['title_name']
		);
		echo ' apresenta:';
	echo $this->Bl->ep();
	
	echo $this->Bl->h1Dry($lecture['MexcLecture']['name']);
	if (!empty($lecture['Tag']))
		echo $this->Bl->tagList(array('class' => 'small'), array('tags' => $lecture['Tag'], 'before' => ''));
	
	
	echo $this->Bl->br();
	$url = Router::url(array('plugin' => 'mexc_lectures', 'controller' => 'mexc_lectures', 'action' => 'agendamento', $lecture['MexcLecture']['id'], 'space' => $currentSpace));
	echo $this->Bl->button(
		array('onclick' => sprintf("location.href = '%s'", $url)),
		array(),
		__d('mexc', 'Agendar esta palestra', true)
	);
	echo $this->Bl->br();
	
	echo $this->Bl->hr(array('class' => 'double'));
	
	echo $this->Bl->sboxContainer(array(), array('size' => array('M' => 7, 'g' => -1), 'type' => 'column_container'));
		echo $this->Bl->sbox(array(), array('size' => array('M' => 6, 'g' => -1), 'type' => 'inner_column'));
			echo $this->Bl->h4Dry(__d('mexc_lecture', 'Descrição', true));
			echo $this->Jodel->insertModule('ContentStream.CsContentStream', array('full', 'mexc_lecture'), $lecture['MexcLecture']['content_stream_id']);
		
			echo $this->Bl->hr();
			echo $this->element('social_medias', array('plugin' => false, 'module' => 'MexcLecture'));
			echo $this->Bl->hr(array('class' => 'double'));
		
			// @todo Thread of comments
			
		echo $this->Bl->ebox();
		
	echo $this->Bl->eboxContainer();
	
	echo $this->Bl->sbox(array(), array('size' => array('M' => 3, 'g' => -1), 'type' => 'cloud'));
		echo $this->Jodel->insertModule('MexcLectures.MexcSpeaker', array('preview'), $lecture);
	echo $this->Bl->ebox();
	
	if (!empty($lecture['MexcRelatedContent']))
	{
		echo $this->Bl->boxContainer(
			array('style' => 'margin-left:30px;'),
			array('size' => array('M' => 3, 'g' => -1, 'm' => -1)),
			$this->Bl->h5Dry(__d('mexc', 'Documentos relacionados', true))
		);
		echo $this->Jodel->insertModule('MexcRelated.MexcRelatedContent', array('full', 3), $lecture);
	}
	
echo $this->Bl->ebox();
echo $this->Bl->sbox(array(),array('size' => array('M' => 1, 'g' => -1)));
echo $this->Bl->ebox();
