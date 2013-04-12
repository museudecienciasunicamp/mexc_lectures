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
	echo $this->Bl->h1Dry($speaker['MexcSpeaker']['title_name']);
	if (!empty($speaker['Tag']))
		echo $this->Bl->tagList(array('class' => 'small'), array('tags' => $speaker['Tag'], 'before' => ''));
	
	echo $this->Bl->hr(array('class' => 'double'));
	
	echo $this->Bl->sboxContainer(array(), array('size' => array('M' => 7), 'type' => 'column_container'));
		echo $this->Bl->sbox(array(), array('size' => array('M' => 6, 'g' => -1), 'type' => 'inner_column'));
	
			if (!empty($speaker['MexcSpeaker']['img_id']))
				echo $this->Bl->img(array(), array('id' => $speaker['MexcSpeaker']['img_id'], 'version' => 'about_text'));
			
			echo $this->Jodel->insertModule('ContentStream.CsContentStream', array('full', 'mexc_speaker'), $speaker['MexcSpeaker']['content_stream_id']);
	
			echo $this->Bl->br();
			echo $this->Bl->hr();
			echo $this->element('social_medias', array('plugin' => false, 'module' => 'MexcLecture'));
			echo $this->Bl->hr(array('class' => 'double'));
		
			// @todo Thread of comments
			
		echo $this->Bl->ebox();
		
	echo $this->Bl->eboxContainer();
echo $this->Bl->ebox();
