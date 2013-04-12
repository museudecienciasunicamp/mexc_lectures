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
	case 'sui':
		switch ($type[1])
		{
			case 'subscription_form':
				Configure::load('MexcLectures.config');
				$strings = Configure::read('MexcLectures.field_to_string');
				$this->Html->script(
					'/js/maskedinput.js',
					array('inline' => false)
				);
		
				$url = array(
					'plugin' => 'sui', 'controller' => 'sui_subscriptions',
					'action' => 'save_step', $data['SuiSubscription']['slug'],
					$sui_application_id, $step
				);
				echo $this->Buro->sform(null, array(
					'model' => 'MexcLectures.MexcSchedule',
					'url' => $url,
					'callbacks' => array(
						'onComplete' => array(
							'js' => 'if((json = response.responseJSON) && json.redirect) location.href = json.redirect')
					)
				));
		
					$lectures = $this->requestAction(array(
						'plugin' => 'mexc_lectures',
						'controller' => 'mexc_lectures',
						'action' => 'getLectures'
					));

					echo $this->Buro->input(
						array(),
						array(
							'fieldName' => 'mexc_lecture_name',
							'type' => 'select',
							'label' => 'Palestra:',
							'options' => array(
								'options' => $lectures
							)
						)
					);
					echo $this->Bl->br();

					echo $this->Bl->pDry('Sugestão de 3 datas para a realização da palestra:');

					echo $this->Bl->sboxContainer(array(), array('size' => array('M' => 6), 'type' => 'column_container'));
					foreach (array(1,2,3) as $i)
					{
						$options = Configure::read('MexcLectures.datePeriods');
						echo $this->Bl->sbox(array(), array(
								'size' => array('M' => 2, 'g' => -1),
								'type' => 'inner_column'));
						
						
							echo $this->Buro->input(
								array('class' => 'date'),
								array(
									'type' => 'text',
									'fieldName' => 'date_' . $i,
									'label' => $strings['date_'.$i]
								)
							);
							echo $this->Buro->input(
								array(),
								array(
									'type' => 'radio',
									'fieldName' => 'date_'.$i.'_period',
									'label' => false,
									'options' => compact('options'),
									'container' => array(
										'style' => 'background: transparent;'
									)
								)
							);
						echo $this->Bl->ebox();
					}
			
					echo $this->Html->scriptBlock(
						"new MaskedInput('.date','99/99/9999')"
					);
			
					echo $this->Bl->eboxContainer();
					echo $this->Bl->floatBreak();
					echo $this->Bl->br();
					
					// About the place
					$options = Configure::read('MexcLectures.places');
					$placeAgId = $this->uuid('input', 'mexc_lecture');
					$placeOut = $this->uuid('input', 'mexc_lecture');
					
					$options['outro'] = $this->Buro->input(
						array(
							'id' => $placeAgId, 'style' => 'width: auto;'
						),
						array(
							'type' => 'text',
							'fieldName' => 'lect_place_ag',
							'container' => false,
							'label' => false,
							'options' => array(
								'default' => 'Outros (especifique)'
							)
						)
					);
					
					echo $this->Buro->input(
						array(),
						array(
							'type' => 'radio',
							'fieldName' => 'lect_place',
							'label' => $strings['lect_place'],
							'container' => array(
								'style' => 'background: transparent'
							),
							'options' => array(
								'options' => $options,
								'id' => $placeOut
							)
						)
					);
			
					$placeOut = ucfirst($placeOut) . 'Outro';
					echo $this->Bl->br();
					echo $this->Html->scriptBlock("
						$('$placeOut').observe('focus', function(ev) {
							$('$placeAgId').focus();
						});
						$('$placeAgId').observe('focus', function(ev) {
							var el = ev.findElement('input');
							if (el.value == 'Outros (especifique)')
								el.value = '';
						});", array('inline' => true));
		
					
					// Describe the space?
					$options = Configure::read('MexcLectures.lect_ceiling');
					echo $this->Buro->input(
						array(),
						array(
							'type' => 'radio',
							'fieldName' => 'lect_ceiling',
							'label' => $strings['lect_ceiling'],
							'options' => compact('options'),
							'container' => array(
								'style' => 'background: transparent;'
							)
						)
					);
					
					$options = Configure::read('MexcLectures.lect_lighting');
					echo $this->Buro->input(
						array(),
						array(
							'type' => 'radio',
							'fieldName' => 'lect_lighting',
							'label' => $strings['lect_lighting'],
							'options' => compact('options'),
							'container' => array(
								'style' => 'background: transparent;'
							)
						)
					);
					
					
					$options = Configure::read('MexcLectures.space');
					echo $this->Buro-> input(
						array(),
						array(
							'type' => 'multiple_checkbox',
							'fieldName' => 'lect_space',
							'label' => $strings['lect_space'],
							'options' => compact('options')
						)
					);
					echo $this->Bl->br();
					
					// More information about the space
					echo $this->Buro->input(
						array(),
						array(
							'type' => 'textarea',
							'fieldName' => 'lect_about_space',
							'label' => $strings['lect_about_space']
						)
					);

					// Number of people
					echo $this->Buro->input(
						array(),
						array(
							'type' => 'text',
							'fieldName' => 'lect_exp_num',
							'label' => $strings['lect_exp_num']
						)
					);

					// Student grades
					echo $this->Buro->input(
						array(),
						array(
							'type' => 'text',
							'fieldName' => 'lect_exp_grade',
							'label' => $strings['lect_exp_grade']
						)
					);

					// How get to know the program?
					echo $this->Buro->input(
						array(),
						array(
							'type' => 'textarea',
							'fieldName' => 'gen_knowing',
							'label' => $strings['gen_knowing']
						)
					);

					$options = Configure::read('MexcLectures.programs');
					echo $this->Buro->input(
						array(),
						array(
							'type' => 'multiple_checkbox',
							'fieldName' => 'gen_programs',
							'label' => $strings['gen_programs'],
							'options' => compact('options')
						)
					);
					echo $this->Bl->br();
		
					echo $this->Buro->input(
						array(),
						array(
							'type' => 'textarea',
							'fieldName' => 'gen_obs',
							'label' => $strings['gen_obs']
						)
					);
				echo $this->Buro->eform();
			break;
			
			case 'confirmation_step':
			break;
			
			case 'backstage_preview':
				echo $this->Bl->sbox(
						array(), array('size' => array('M' => 6, 'g' => -1))
					);

					echo $this->Bl->labelDry(__d('mexc_lecture', 'Palestra', true));
					echo $data['MexcSchedule']['mexc_lecture_name'];

				echo $this->Bl->ebox();
			break;
		}
	break;
}
