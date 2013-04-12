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

$config['MexcLectures.instTypes'] = array(
	'municipal' => 'Pública municipal', 
	'estadual' => 'Pública estadual', 
	'federal' => 'Pública federal', 
	'particular' => 'Particular', 
	'ong' => 'Ong', 
	'outra' => 'Outro'
);


$config['MexcLectures.datePeriods'] = array(
	'manha' => 'manhã', 
	'tarde' => 'tarde', 
	'noite' => 'noite'
);


$config['MexcLectures.states'] = array('AC' => 'Acre', 'AL' => 'Alagoas', 'AP' => 'Amapá', 'AM' => 'Amazonas', 'BA' => 'Bahia', 'CE' => 'Ceará', 'DF' => 'Distrito Federal', 'ES' => 'Espírito Santo', 'GO' => 'Goiás', 'MA' => 'Maranhão', 'MT' => 'Mato Grosso', 'MS' => 'Mato Grosso do Sul', 'MG' => 'Minas Gerais', 'PA' => 'Pará', 'PB' => 'Paraíba', 'PR' => 'Paraná', 'PE' => 'Pernambuco', 'PI' => 'Piauí', 'RJ' => 'Rio de Janeiro', 'RN' => 'Rio Grande do Norte', 'RS' => 'Rio Grande do Sul', 'RO' => 'Rondônia', 'RR' => 'Roraima', 'SP' => 'São Paulo', 'SC' => 'Santa Catarina', 'SE' => 'Sergipe', 'TO' => 'Tocantins');

$config['MexcLectures.places'] = array(
	'patio' => 'Pátio',
	'sala' => 'Sala de aula / vídeo',
	'auditorio' => 'Auditório',
	'quadra' => 'Quadra',
	'outro' => false
);

$config['MexcLectures.space'] = array(
	'power_plugs' => 'Possui tomadas (fornecimento de energia elétrica 110V ou 220V)',
	'sound' => 'Possui equipamento de som funcionando adequadamente',
	'projection' => 'Possui tela de projeção em condições de uso',
	'projector' => 'Possui aparelho data show funcionando adequadamente',
	'computer' => 'Possui computador com programa que lê arquivos de Power Point versão 2007 em condições de uso'
);

$config['MexcLectures.lect_ceiling'] = array(
	'yes' => 'Sim, possui',
	'no' => 'Não'
);

$config['MexcLectures.lect_lighting'] = array(
	'yes' => 'Sim, o ambiente é escuro',
	'no' => 'Não'
);


$config['MexcLectures.programs'] = array(
	'oficina_desafio' => 'Oficina Desafio',
	'nano_aventura' => 'NanoAventura',
	'praca_tempo_espaco' => 'Praça Tempo Espaço',
	'onhb' => 'Olimpíada Nacional em História do Brasil'
);

$config['MexcLectures.field_to_string'] = array(
	'inst_name' => 'Nome da instituição',
	'inst_type' => 'Tipo',
	'inst_addr' => 'Endereço da instituição (Logradouro, número, complemento e ponto de referência):',
	'inst_neib' => 'Bairro',
	'inst_city' => 'Cidade',
	'inst_state' => 'Estado',
	'inst_cep' => 'CEP',
	'inst_tel' => 'Telefone com DDD',
	'inst_tel2' => 'Repetir telefone com DDD (não use o recurso de copiar e colar)',
	'inst_email' => 'E-mail de contato',
	'inst_email2' => 'Repetir e-mail (não use o recurso de copiar e colar)',
	'resp_ag_name' => 'Nome',
	'resp_ag_func' => 'Função na escola',
	'resp_ag_email' => 'E-mail',
	'resp_ag_email2' => 'Repetir e-mail (não use o recurso de copia e colar)',
	'resp_ag_tel' => 'Telefone com DDD',
	'resp_ag_tel2' => 'Repetir telefone com DDD (não use o recurso de copia e colar)',
	'resp_ac_same_ag' => 'Será a mesma pessoa responsável pelo agendamento.',
	'resp_ac_name' => 'Nome',
	'resp_ac_func' => 'Função na escola',
	'resp_ac_email' => 'E-mail',
	'resp_ac_email2' => 'Repetir e-mail (não use o recurso de copia e colar)',
	'resp_ac_tel' => 'Telefone com DDD',
	'resp_ac_tel2' => 'Repetir telefone com DDD (não use o recurso de copia e colar)',
	'date_1' => 'Data 1',
	'date_2' => 'Data 2',
	'date_3' => 'Data 3',
	'lect_place' => 'Onde a palestra será realizada?',
	'lect_place_ag' => 'Outros',
	'lect_ceiling' => 'O espaço possui cobertura?',
	'lect_lighting' => 'Ambiente adequado para projeção com data show?',
	'lect_space' => 'Como é esse espaço? Assinale TODAS as alternativas pertinentes.',
	'lect_about_space' => 'Se considerar necessário, coloque mais informações sobre o espaço.',
	'lect_exp_num' => 'Qual o número de espectadores estimado para a palestra? Inclua professores e estudantes.',
	'lect_exp_grade' => 'Quais as séries/anos dos estudantes?',
	'gen_knowing' => 'Como ficou sabendo do Unicamp Itinerante?',
	'gen_programs' => 'Conhece os outros programas do Museu?',
	'gen_obs' => 'Observações',
);
