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

class MexcLecture extends MexcLecturesAppModel
{
	var $name = 'MexcLecture';
	
	var $order = array('MexcLecture.name' => 'asc', 'MexcLecture.created' => 'desc');
	
	var $actsAs = array(
		'Containable', 
		'Dashboard.DashDashboardable',
		'Tags.Taggable',
		'Status.Status' => array('publishing_status'),
		'ContentStream.CsContentStreamHolder' => array(
			'streams' => array('content_stream_id' => 'lecture')
		),
		'MexcRelated.MexcHasRelatedContent' => array(
			'MexcDocument' => 'MexcDocuments.MexcDocument',
			'MexcGallery' => 'MexcGalleries.MexcGallery',
			'MexcLecture' => 'MexcLectures.MexcLecture'
		)
	);
	
	var $belongsTo = array(
		'MexcLectures.MexcSpeaker',
		'MexcSpace.MexcSpace'
	);

/**
 * beforeSave callback
 * 
 * Used to make sure that the mexc_space_id for both MexcLecture and MexcSpeaker is the same.
 * For NULLs mexc_space_id, it tryes to update the other using one
 * 
 * @access public
 * @param array $options 
 * @return boolean Return true, if both are the same or false, if different
 */
	function beforeSave($options)
	{
		if (!empty($this->data[$this->alias]['mexc_speaker_id']))
		{
			$this->MexcSpeaker->id = $this->data[$this->alias]['mexc_speaker_id'];
			$speaker_mexc_space_id = $this->MexcSpeaker->field('mexc_space_id');
			
			if (empty($speaker_mexc_space_id) && !empty($this->data[$this->alias]['mexc_space_id']))
				$this->MexcSpeaker->updateAll(
					array('MexcSpeaker.mexc_space_id' => '"'.$this->data[$this->alias]['mexc_space_id'].'"'),
					array('MexcSpeaker.id' => $this->data[$this->alias]['mexc_speaker_id'])
				);
			
			else if (!empty($speaker_mexc_space_id) && empty($this->data[$this->alias]['mexc_space_id']))
				$this->data[$this->alias]['mexc_space_id'] = $speaker_mexc_space_id;
			
			else if($speaker_mexc_space_id != $this->data[$this->alias]['mexc_space_id'])
				return false;
		}
		
		return true;
	}

/**
 * Creates a blank row in the table. It is part of the backstage contract.
 *
 * @access public
 */
	function createEmpty()
	{
		$data = array();
		$data[$this->alias]['publishing_status'] = 'draft';
		
		$this->create();
		return $this->save($data, false);
	}
	
/** 
 * The data that must be saved into the dashboard. Part of the Dashboard contract.
 *
 * @access public
 * @param string $id
 */
	function getDashboardInfo($id)
	{
		$this->contain();
		$data = $this->findById($id);
		
		if ($data == null)
			return null;
		
		$dashdata = array(
			'dashable_id' => $id,
			'mexc_space_id' => $data[$this->alias]['mexc_space_id'],
			'dashable_model' => $this->name,
			'type' => 'lecture',
			'status' =>		$data[$this->alias]['publishing_status'],
			'created' =>	$data[$this->alias]['created'],
			'modified' =>	$data[$this->alias]['modified'],
			'name' =>		$data[$this->alias]['name'],
			'info' =>		mb_substr($data[$this->alias]['description'], 0, 100),
			'idiom' => array()
		);
		
		return $dashdata;
	}
	
	/** When data is deleted from the Dashboard. Part of the Dashboard contract.
	 *  @todo Maybe we should study how to do it from Backstage contract.
	 */
	
	function dashDelete($id)
	{
		return $this->delete($id);
	}
}
