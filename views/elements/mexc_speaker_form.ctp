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

$belongsto = !empty($type[2]) && $type[2] == 'belongsto';

$callbacks = array();
if (!$belongsto)
	$callbacks = array(
		'onStart' => array('lockForm', 'js' => 'form.setLoading()'),
		'onComplete' => array('unlockForm', 'js' => 'form.unsetLoading()'),
		'onReject' => array('js' => '$("content").scrollTo(); showPopup("error");', 'contentUpdate' => 'replace'),
		'onSave' => array('js' => '$("content").scrollTo(); showPopup("notice");')
	);
	
echo $this->Buro->sform(array(), array('model' => 'MexcLectures.MexcSpeaker', 'callbacks' => $callbacks));
	echo $this->Buro->input(array(), array('fieldName' => 'id', 'type' => 'hidden'));
	
	if (!$belongsto)
		echo $this->Buro->input(
			array(),
			array(
				'type' => 'mexc_space'
			)
		);
	
	// Speaker name
	echo $this->Buro->input(
		array(),
		array(
			'fieldName' => 'name',
			'type' => 'text',
			'label' => __d('mexc_lecture', 'speaker form - name label', true),
			'instructions' => __d('mexc_lecture', 'speaker form - name instructions', true)
		)
	);
	
	// Speaker title
	echo $this->Buro->input(
		array(),
		array(
			'fieldName' => 'title',
			'type' => 'text',
			'label' => __d('mexc_lecture', 'speaker form - title label', true),
			'instructions' => __d('mexc_lecture', 'speaker form - title instructions', true)
		)
	);
	
	echo $this->Buro->input(
		array(),
		array(
			'fieldName' => 'img_id',
			'type' => 'image',
			'label' => __d('mexc_lecture', 'speaker form - img_id label', true),
			'instructions' => __d('mexc_lecture', 'speaker form - img_id instructions', true),
			'options' => array(
				'version' => 'filter'
			)
		)
	);
	
	echo $this->Buro->input(
		array(),
		array(
			'fieldName' => 'description',
			'type' => 'textarea',
			'label' => __d('mexc_lecture', 'speaker form - description label', true),
			'instructions' => __d('mexc_lecture', 'speaker form - description instructions', true)
		)
	);
	
	if (!$belongsto)
	{
		echo $this->Buro->input(
			array(),
			array(
				'type' => 'content_stream',
				'label' => __d('mexc_lecture', 'speaker form - content_stream label', true),
				'instructions' => __d('mexc_lecture', 'speaker form - content_stream instructions', true),
				'options' => array(
					'foreignKey' => 'content_stream_id'
				)
			)
		);
		
		echo $this->Buro->submitBox(array(),array('publishControls' => false));
	}
	else
	{
		echo $this->Buro->input(
			array(),
			array(
				'fieldName' => 'publishing_status',
				'type' => 'select',
				'label' => __d('mexc_lecture', 'speaker form - publishing_status label', true),
				'instructions' => __d('mexc_lecture', 'speaker form - publishing_status instructions', true),
				'options' => array(
					'options' => array(
						'published' => __d('mexc_lecture', 'Publicado', true),
						'draft' => __d('mexc_lecture', 'Rascunho', true)
					)
				)
			)
		);
		
		echo $this->Bl->br();
		
		echo $this->Buro->submit(
			array(),
			array(
				'label' => __d('mexc_lecture', 'save button label', true),
				'cancel' => array(
					'label' => __d('mexc_lecture', 'cancel link label', true)
				)
			)
		);
	}
	
echo $this->Buro->eform();
echo $this->Bl->floatBreak();
