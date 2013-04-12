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
	
	echo $this->Bl->pDry('Palestra: ' . $mail_data['MexcLecture']['name']);
	echo $this->Bl->pDry('Palestrante: ' . $mail_data['MexcSpeaker']['title_name']);
	
	echo $this->Bl->br();
	echo $this->Bl->br();

	foreach ($mail_data['MexcSchedule'] as $field => $data)
	{
		$label = MexcLectureDataHandler::getLabel($field);
		
		if (!empty($label))
		{
			if (!is_string($data = MexcLectureDataHandler::getValue($field, $mail_data)))
				continue;
			
			echo $this->Bl->pDry($this->Bl->bDry($label));
			echo h($data);
		}
	}
