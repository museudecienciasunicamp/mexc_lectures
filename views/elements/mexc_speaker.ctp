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

switch ($type[0])
{
	case 'buro':
		switch ($type[1])
		{
			case 'form':
				echo $this->element('mexc_speaker_form', array('plugin' => 'mexc_lectures', 'type' => $type));
			break;
			
			case 'view':
				echo $this->Bl->br();
				echo $this->Bl->pDry($data['MexcSpeaker']['title_name']);
				if (!empty($data['MexcSpeaker']['img_id']))
					echo $this->Bl->img(array(), array('id' => $data['MexcSpeaker']['img_id'], 'version' => 'filter'));
				echo $this->Bl->br();
			break;
		}
	break;
	
	case 'preview':
		if (!empty($data['MexcSpeaker']['img_id']))
			echo $this->Bl->img(array(), array('id' => $data['MexcSpeaker']['img_id'], 'version' => 'filter')),
				 $this->Bl->br();
		
		echo $this->Bl->anchor(
			array('class' => 'visitable'),
			array(
				'url' => array('controller' => 'mexc_speakers', 'action' => 'view', $data['MexcSpeaker']['id']),
				'space' => $currentSpace
			),
			$data['MexcSpeaker']['title_name']
		);
		echo $this->Bl->paraDry(explode("\n", $data['MexcSpeaker']['description']));
	break;
	
	case 'full':
	break;
}
