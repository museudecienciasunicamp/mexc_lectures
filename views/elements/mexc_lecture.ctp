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
				echo $this->element('mexc_lecture_form', array('plugin' => 'mexc_lectures', 'type' => $type));
			break;
			
			case 'view':
				echo $this->Bl->pDry($data['MexcLecture']['name']);
			break;
		}
	break;
	
	case 'column':
		echo $this->Bl->sp();
			echo $this->Bl->anchor(
				array('class' => 'visitable'),
				array(
					'url' => array('plugin' => 'mexc_lectures', 'controller' => 'mexc_speakers', 'action' => 'view', $data['MexcSpeaker']['id']),
					'space' => $currentSpace
				),
				$data['MexcSpeaker']['title_name']
			);
			echo ' apresenta:';
		echo $this->Bl->ep();
		
		echo $this->Bl->sh4();
			echo $this->Bl->anchor(
				array('class' => 'visitable'),
				array(
					'url' => array('plugin' => 'mexc_lectures', 'controller' => 'mexc_lectures', 'action' => 'read', $data['MexcLecture']['id']),
					'space' => $currentSpace
				),
				$data['MexcLecture']['name']
			);
		echo $this->Bl->eh4();
		echo $this->Bl->br();
		
		echo $this->Bl->paraDry(array_slice(explode("\n", $data['MexcLecture']['description']),0,1));
	break;
	
	case 'line':
		echo $this->Bl->sboxContainer(array('class' => 'mexc_list'), array('size' => array('M' => $type[1]), 'type' => 'column_container'));
			echo $this->Bl->box(
				array('class' => 'line_date'),
				array('size' => array('M'=> 1, 'm' => -1)),
				'&bull;'
			);
			echo $this->Bl->sbox(array('class' => 'mexc_list_link'), array('size' => array('M' => $type[1]-1, 'g' => -2)));
				echo $this->Bl->anchor(
					array('class' => 'visitable'),
					array(
						'url' => array('plugin' => 'mexc_lectures', 'controller' => 'mexc_lectures', 'action' => 'read', $data['MexcLecture']['id']),
						'space' => $currentSpace
					),
					$data['MexcLecture']['name']
				);
			echo $this->Bl->ebox();
			echo $this->Bl->floatBreak();
		echo $this->Bl->eboxContainer();
		echo $this->Bl->floatBreak();
	break;
	
	case 'preview':
		echo $this->Bl->box(
			array('class' => 'lecture_number'),
			array('size' => array('M' => 1, 'm' => -1)),
			$number
		);
	
		echo $this->Bl->sbox(array('class' => 'lecture_preview'),array('size' => array('M' => 8, 'm' => -2, 'g' => -1)));
		
			echo $this->Bl->sp();
				echo $this->Bl->anchor(
					array('class' => 'visitable'),
					array(
						'url' => array('plugin' => 'mexc_lectures', 'controller' => 'mexc_speakers', 'action' => 'view', $data['MexcSpeaker']['id']),
						'space' => $currentSpace
					),
					$data['MexcSpeaker']['title_name']
				);
				echo ' apresenta:';
			echo $this->Bl->ep();
		
			echo $this->Bl->sh4();
				echo $this->Bl->anchor(
					array('class' => 'visitable'),
					array(
						'url' => array('plugin' => 'mexc_lectures', 'controller' => 'mexc_lectures', 'action' => 'read', $data['MexcLecture']['id']),
						'space' => $currentSpace
					),
					$data['MexcLecture']['name']
				);
			echo $this->Bl->eh4();			
			
			echo $this->Bl->br();
			
			foreach ($data['Tag'] as $tag)
				echo $this->Bl->anchor(
					array('class' => 'light'),
					array(
						'url' => array('?' => array('search' => 'tag:'.$tag['name'])),
						'space' => $currentSpace
					),
					$tag['name']
				), '&ensp; ';
			
		echo $this->Bl->ebox();
		echo $this->Bl->floatBreak();
	break;
	
	case 'full':
		
	break;
}
