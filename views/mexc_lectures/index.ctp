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

echo $this->Bl->sboxContainer(array(),array('size' => array('M' => 1, 'g' => 1)));
	echo '&ensp;';
echo $this->Bl->eboxContainer();
	
echo $this->Bl->sboxContainer(array('class' => 'search'));
	echo $this->Form->create('', array('url' => $this->here,'type' => 'get'));
		echo $this->Bl->boxContainer(
			array(),
			array('size' => array('M' => 8, 'm' => -1, 'g' => -1)),
			$this->Form->input('search', array('id' => $input_id = $this->uuid('mexc', 'lectures'), 'label' => false, 'value' => isset($this->params['url']['search']) ? $this->params['url']['search'] : ''))
		);
		echo $this->Bl->button(array('type' => 'submit'), array(), __d('mexc', 'Buscar', true));
	echo $this->Form->end();
	
	echo $this->Bl->div(array('id' => $div_id = $this->uuid('mexc', 'lectures')));
	
	$url = Router::url(array('plugin' => 'mexc_lectures', 'controller' => 'mexc_lectures', 'action' => 'autocomplete', 'space' => $currentSpace));
	$this->BuroOfficeBoy->addHtmlEmbScript("new Mexc.Autocompleter('$input_id', '$div_id', '$url')");
echo $this->Bl->eboxContainer();



echo $this->Bl->floatBreak();
echo $this->Bl->hr();


echo $this->Bl->sboxContainer(array(),array('size' => array('M' => 1, 'g' => 1)));
	echo '&ensp;';
echo $this->Bl->eboxContainer();
echo $this->Bl->sboxContainer(array(),array('size' => array('M' => 8)));
	if (isset($this->params['url']['search']))
		echo $this->Paginator->counter('Exibindo %current% das %count% palestras encontradas na busca.');
	else
		echo $this->Paginator->counter('Exibindo %current% palestras de um total de %count%.');
echo $this->Bl->eboxContainer();


echo $this->Bl->floatBreak();
echo $this->Bl->hr();

$start = $this->Paginator->counter('%start%');
foreach ($lectures as $n => $lecture)
{
	$this->set('number', $n+$start);
	echo $this->Jodel->insertModule('MexcLectures.MexcLecture', array('preview'), $lecture);
}
echo $this->Bl->sbox(array(), array('size' => array('M' => 12)));
echo $this->element('pagination', array('modules' => 12, 'plugin' => false, 'labels' => array('next' => '', 'prev' => '')));
echo $this->Bl->ebox();


