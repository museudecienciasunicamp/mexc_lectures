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

echo $this->Bl->sbox(array(),array('size' => array('M' => 12, 'g' => -1), 'type' => 'cloud'));
	echo $this->Bl->sboxContainer(array(), array('size' => array('M' => 12), 'type' => 'column_container'));
	foreach ($speakers as $n => $speaker)
	{
		echo $this->Bl->sbox(array(),array('size' => array('M' => 3, 'g' => -1), 'type' => 'inner_column'));
			echo $this->Jodel->insertModule('MexcLectures.MexcSpeaker', array('preview'), $speaker);
		echo $this->Bl->ebox();
		
		if (($n+1)%4 == 0)
			echo $this->Bl->floatBreak(), $this->Bl->br();
	}
	echo $this->Bl->eboxContainer();
	
	echo $this->element('pagination', array(
		'plugin' => false, 
		'modules' => 12, 
		'labels' => array('next' => '', 'prev' => '')
	));
	
echo $this->Bl->ebox();
