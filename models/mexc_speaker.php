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

class MexcSpeaker extends MexcLecturesAppModel
{
	var $name = 'MexcSpeaker';
	var $displayField = 'name';
	var $virtualFields = array(
		'title_name' => 'CONCAT(MexcSpeaker.title, " ", MexcSpeaker.name)'
	);

	var $order = array('MexcSpeaker.name' => 'asc', 'MexcSpeaker.created' => 'desc');
	
	var $actsAs = array(
		'Containable', 
		'Dashboard.DashDashboardable',
		'Tags.Taggable',
		'Status.Status' => array('publishing_status'),
		'JjMedia.StoredFileHolder' => array('img_id'),
		'ContentStream.CsContentStreamHolder' => array(
			'streams' => array('content_stream_id' => 'speaker')
		)
	);
	
	var $belongsTo = array('MexcSpace.MexcSpace');
	
	var $hasMany = array(
		'MexcLecture' => array(
			'className' => 'MexcLectures.MexcLecture',
			'order' => array('MexcLecture.name' => 'asc'),
			'dependent' => true
		)
	);

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
			'type' => 'speaker',
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
