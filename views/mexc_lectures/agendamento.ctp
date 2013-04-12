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

if ($sent != false)
{
	echo $this->Bl->h2Dry(__d('mexc_lecture', 'Pedido de agendamento enviado', true));
	echo $this->Bl->sbox(array(), array('size' => array('M' => 6, 'g' => -1), 'type' => 'cloud'));
		if ($sent === true)
			echo $this->Bl->pDry('Seu pedido foi enviado com sucesso!');
		else
			echo $this->Bl->pDry('Houve um problema ao enviar seu pedido. Tente novamente mais tarde.');
				
	echo $this->Bl->ebox();

}
else
{
	$this->Html->script('/js/maskedinput.js', array('inline' => false));
	
	echo $this->Bl->h2Dry(__d('mexc_lecture', 'Agendamento', true));

	echo $this->Bl->sboxContainer(array(), array('size' => array('M' => 6)));
		echo $this->Bl->sbox(array(), array('size' => array('M' => 6, 'g' => -1), 'type' => 'cloud'));
			echo $this->Bl->pDry(
				'Cadastro de grupo para participação na palestra "'
				. $lecture['MexcLecture']['name']
				. '" ministrada por '
				. $lecture['MexcSpeaker']['title_name']
				. ' do programa Unicamp Itinerante');


			echo $this->Bl->br();
			echo $this->Bl->span(array('class' => 'light small'),array(),'Este formulário deve ser preenchido, criando um cadastro para cada palestra solicitada.');
			echo $this->Bl->br();
			echo $this->Bl->span(array('class' => 'light small'),array(),'Todos os campos são de preenchimento obrigatório.');
		echo $this->Bl->ebox();
	
	
		$strings = Configure::read('MexcLectures.field_to_string');

		
		echo $this->Bl->sbox(array(), array('size' => array('M' => 6, 'g' => -1), 'type' => 'cloud'));
			echo $this->Form->create('MexcSchedule', array('url' => $this->here));

				echo $this->Form->input('mexc_lecture_id', array('type' => 'hidden', 'value' => $lecture['MexcLecture']['id']));
		
				echo $this->Bl->h3Dry('Dados da instituição:');
				echo $this->Form->input('inst_name', array('label' => $strings['inst_name']));
				echo $this->Form->input('inst_type', array('label' => $strings['inst_type'], 'options' => Configure::read('MexcLectures.instTypes')));
				echo $this->Form->input('inst_addr', array('label' => $strings['inst_addr'], 'type' => 'textarea', 'rows' => 2));
				echo $this->Form->input('inst_neib', array('label' => $strings['inst_neib']));

				echo $this->Bl->sboxContainer(array(), array('size' => array('M' => 4, 'g' => -1)));
				echo $this->Bl->sboxContainer(array(), array('size' => array('M' => 4, 'g' => -2)));
					echo $this->Form->input('inst_city', array('label' => $strings['inst_city'], 'error' => false));
				echo $this->Bl->eboxContainer();
				echo $this->Bl->eboxContainer();
				echo $this->Bl->sboxContainer(array(), array('size' => array('M' => 2, 'g' => -1)));
					echo $this->Form->input('inst_state', array('label' => $strings['inst_state'], 'options' => Configure::read('MexcLectures.states'), 'error' => false));
				echo $this->Bl->eboxContainer();
				echo $this->Bl->floatBreak();
				
				echo $this->Form->error('inst_city');
				echo $this->Form->error('inst_state');
				
				echo $this->Form->input('inst_cep', array('class' => 'cep', 'label' => $strings['inst_cep']));
				echo $this->Form->input('inst_tel', array('class' => 'telephone', 'label' => $strings['inst_tel']));
				echo $this->Form->input('inst_tel2', array('class' => 'telephone', 'label' => $strings['inst_tel2'], 'id' => $idtel = $this->uuid('input', 'mexc_lecture')));
				echo $this->Form->input('inst_email', array('label' => $strings['inst_email']));
				echo $this->Form->input('inst_email2', array('label' => $strings['inst_email2'], 'id' => $idmail = $this->uuid('input', 'mexc_lecture')));
			
				echo $this->Html->scriptBlock($this->Js->domReady("new Mexc.NoPaste('$idmail')"));
#				echo $this->Html->scriptBlock($this->Js->domReady("new Mexc.NoPaste('$idtel')"));
				echo $this->Html->scriptBlock("new MaskedInput('.cep', '99.999-999');");
			
			
			
				echo $this->Bl->br();
				echo $this->Bl->br();
				echo $this->Bl->h3Dry('Dados do responsável pelo agendamento:');
				echo $this->Form->input('resp_ag_name', array('label' => $strings['resp_ag_name']));
				echo $this->Form->input('resp_ag_func', array('label' => $strings['resp_ag_func']));
				echo $this->Form->input('resp_ag_email', array('label' => $strings['resp_ag_email']));
				echo $this->Form->input('resp_ag_email2', array('label' => $strings['resp_ag_email2'], 'id' => $idmail = $this->uuid('input', 'mexc_lecture')));
				echo $this->Form->input('resp_ag_tel', array('class' => 'telephone', 'label' => $strings['resp_ag_tel']));
				echo $this->Form->input('resp_ag_tel2', array('class' => 'telephone', 'label' => $strings['resp_ag_tel2'], 'id' => $idtel = $this->uuid('input', 'mexc_lecture')));

				echo $this->Html->scriptBlock($this->Js->domReady("new Mexc.NoPaste('$idmail')"));
#				echo $this->Html->scriptBlock($this->Js->domReady("new Mexc.NoPaste('$idtel')"));
			
			

			
				echo $this->Bl->br();
				echo $this->Bl->br();
				echo $this->Bl->h3Dry('Dados do responsável pelo acompanhamento da palestra na instituição:');
				echo $this->Form->input('resp_ac_same_ag', array('type' => 'checkbox', 'label' => $strings['resp_ac_same_ag'], 'id' => $ckb_id = $this->uuid('ckb', 'mexc_lecture')));
				echo $this->Bl->sdiv(array('id' => $id = $this->uuid('div', 'mexc_lecture')));
					echo $this->Form->input('resp_ac_name', array('label' => $strings['resp_ac_name']));
					echo $this->Form->input('resp_ac_func', array('label' => $strings['resp_ac_func']));
					echo $this->Form->input('resp_ac_email', array('label' => $strings['resp_ac_email']));
					echo $this->Form->input('resp_ac_email2', array('label' => $strings['resp_ac_email2'], 'id' => $idmail = $this->uuid('input', 'mexc_lecture')));
					echo $this->Form->input('resp_ac_tel', array('class' => 'telephone', 'label' => $strings['resp_ac_tel']));
					echo $this->Form->input('resp_ac_tel2', array('class' => 'telephone', 'label' => $strings['resp_ac_tel2'], 'id' => $idtel = $this->uuid('input', 'mexc_lecture')));

				echo $this->Bl->ediv();
				
				echo $this->Html->scriptBlock("$('$ckb_id').observe('change', function(ev){ if (Event.element(ev).checked) $('$id').blindUp(); else $('$id').blindDown(); })");
				echo $this->Html->scriptBlock("$('$ckb_id').checked ? $('$id').hide() : $('$id').show();");
				echo $this->Html->scriptBlock($this->Js->domReady("new Mexc.NoPaste('$idmail')"));
#				echo $this->Html->scriptBlock($this->Js->domReady("new Mexc.NoPaste('$idtel')"));
				echo $this->Html->scriptBlock($this->Js->domReady("new MaskedInput('.telephone', '(99) 9999-9999?9');"));


			
				echo $this->Bl->br();
				echo $this->Bl->br();
				echo $this->Bl->h3Dry('Dados da palestra:');
			
			
				echo $this->Bl->h4Dry('Nome da palestra:');
				echo $this->Bl->spanDry($lecture['MexcLecture']['name']);
				echo $this->Bl->br();
				echo $this->Bl->h4Dry('Nome do palestrante:');
				echo $this->Bl->spanDry($lecture['MexcSpeaker']['title_name']);
				echo $this->Bl->br();
				echo $this->Bl->br();
			
			
				echo $this->Bl->pDry('Sugestão de 3 datas para a realização da palestra:');

				echo $this->Bl->sboxContainer(array(), array('size' => array('M' => 6), 'type' => 'column_container'));
				foreach (array(1,2,3) as $i)
				{
					echo $this->Bl->sbox(array(), array('size' => array('M' => 2, 'g' => -1), 'type' => 'inner_column'));
						echo $this->Form->label('date_'.$i, $strings['date_'.$i]);
						echo $this->Form->input('date_'.$i, array('label' => false, 'class' => 'date'));
						echo $this->Form->input('date_'.$i.'_period', array('legend' => false, 'type' => 'radio', 'options' => Configure::read('MexcLectures.datePeriods')));
					echo $this->Bl->ebox();
				}
				
				echo $this->Html->scriptBlock("new MaskedInput('.date','99/99/9999')");
				
				echo $this->Bl->eboxContainer();
				echo $this->Bl->floatBreak();
				echo $this->Bl->br();
			
				$options = Configure::read('MexcLectures.places');
				if (!isset($this->data['MexcSchedule']['lect_place_ag']))
					$this->data['MexcSchedule']['lect_place_ag'] = 'Outros (especifique)';
				$options['outro'] = $this->Form->text('lect_place_ag', array('id' => $placeAgId = $this->uuid('input', 'mexc_lecture'), 'div' => false, 'style' => 'width: auto;'));
				echo $this->Form->input('lect_place', array('id' => $placeOut = $this->uuid('input', 'mexc_lecture'), 'legend' => $strings['lect_place'], 'options' => $options, 'type' => 'radio'));
				echo $this->Form->error('lect_place_ag');
				
				$placeOut = ucfirst($placeOut) . 'Outro';
				echo $this->Bl->br();
				echo $this->Html->scriptBlock("$('$placeOut').observe('focus', function(ev){ $('$placeAgId').focus(); });", array('inline' => true));
				echo $this->Html->scriptBlock("$('$placeAgId').observe('focus', function(ev){ var el = ev.findElement('input'); if (el.value == 'Outros (especifique)') el.value = '';});", array('inline' => true));
			
			
				$options = Configure::read('MexcLectures.space');
				echo $this->Form->input('lect_space', array('label' => $strings['lect_space'], 'options' => $options, 'multiple' => 'checkbox'));
				echo $this->Bl->br();
			
				echo $this->Form->input('lect_about_space', array('label' => $strings['lect_about_space'], 'type' => 'textarea', 'rows' => 4));
				echo $this->Form->input('lect_exp_num', array('label' => $strings['lect_exp_num']));
				echo $this->Form->input('lect_exp_grade', array('label' => $strings['lect_exp_grade']));

				echo $this->Form->input('gen_knowing', array('label' => $strings['gen_knowing'], 'type' => 'textarea', 'rows' => 4));

				$options = Configure::read('MexcLectures.programs');
				echo $this->Form->input('gen_programs', array('label' => $strings['gen_programs'], 'options' => $options, 'multiple' => 'checkbox'));
				echo $this->Bl->br();
			
				echo $this->Form->input('gen_obs', array('label' => $strings['gen_obs'], 'type' => 'textarea', 'rows' => 2));
			
				echo $this->Bl->br();
				echo $this->Bl->button(array('type' => 'submit'), array(), __d('mexc_lecture', 'Pedir o agendamento', true));
			echo $this->Form->end();
		echo $this->Bl->ebox();
	echo $this->Bl->eboxContainer();
}
