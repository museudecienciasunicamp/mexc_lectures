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

echo $this->Buro->sform(array(), array(
	'model' => $fullModelName,
	'callbacks' => array(
		'onStart' => array('lockForm', 'js' => 'form.setLoading()'),
		'onComplete' => array('unlockForm', 'js' => 'form.unsetLoading()'),
		'onReject' => array('js' => '$("content").scrollTo(); showPopup("error");', 'contentUpdate' => 'replace'),
		'onSave' => array('js' => '$("content").scrollTo(); showPopup("notice");'),
	)
));
	echo $this->Buro->input(array(), array('fieldName' => 'id', 'type' => 'hidden'));
	
	// Mexc space 
	echo $this->Buro->input(
		array(),
		array(
			'type' => 'mexc_space'
		)
	);

	// Lecture name
	echo $this->Buro->input(
		array(),
		array(
			'fieldName' => 'name',
			'label' => __d('mexc_lecture', 'form - name label', true),
			'instructions' => __d('mexc_lecture', 'form - name instructions', true)
		)
	);
	
	echo $this->Buro->input(
		array(),
		array(
			'type' => 'relational',
			'label' => __d('mexc_lecture', 'form - unitaryAutocomplete (Speaker) label', true),
			'instructions' => __d('mexc_lecture', 'form - unitaryAutocomplete (Speaker) instructions', true),
			'options' => array(
				'type' => 'unitaryAutocomplete',
				'model' => 'MexcLectures.MexcSpeaker',
				'queryField' => 'MexcSpeaker.name'
			)
		)
	);
	
	// Tags
	echo $this->Buro->input(array(), 
		array(
			'type' => 'tags',
			'fieldName' => 'tags',
			'label' => __d('mexc_lecture', 'form - tags input label', true),
			'instructions' => __d('mexc_lecture', 'form - tags input instructions', true),
			'options' => array(
				'type' => 'comma'
			)
		)
	);
	
//	echo $this->Buro->input(
//		array(),
//		array(
//			'fieldName' => 'description',
//			'type' => 'textarea',
//			'label' => __d('mexc_lecture', 'form - description label', true),
//			'instructions' => __d('mexc_lecture', 'form - description instructions', true)
//		)
//	);
	
	echo $this->Buro->input(
		array(),
		array(
			'type' => 'content_stream',
			'label' => __d('mexc_lecture', 'form - content_stream label', true),
			'instructions' => __d('mexc_lecture', 'form - content_stream instructions', true),
			'options' => array(
				'foreignKey' => 'content_stream_id'
			)
		)
	);
	
	echo $this->Buro->submitBox(array(),array('publishControls' => false));
echo $this->Buro->eform();
