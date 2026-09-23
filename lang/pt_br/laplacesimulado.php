<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Strings (pt_br) for mod_laplacesimulado.
 *
 * @package    mod_laplacesimulado
 * @copyright  2026 Voreios <fabio@voreios.com.br>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'Laplace — Simulado';
$string['modulename'] = 'Laplace — Simulado';
$string['modulenameplural'] = 'Simulados Laplace';
$string['modulename_help'] = 'Direciona o aluno, via SSO, para fazer simulados na plataforma Laplace, mostrando um resumo do desempenho na própria página da atividade.';

$string['laplacesimuladoname'] = 'Nome da atividade';
$string['examid'] = 'Exame';
$string['examid_help'] = 'O exame da Laplace (ex.: ENEM) usado para filtrar os simulados e o resumo de desempenho desta atividade.';
$string['examsunavailable'] = 'Não foi possível carregar a lista de exames da Laplace agora — tente salvar novamente em instantes.';

$string['gotolaplace'] = 'Fazer simulado na Laplace';
$string['createinlaplace'] = 'Criar simulado na Laplace';
$string['stats_total'] = 'Simulados atribuídos';
$string['stats_corrected'] = 'Simulados corrigidos';
$string['stats_average'] = 'Média das notas';
$string['statsunavailable'] = 'Ainda não há dados de desempenho disponíveis — eles aparecem aqui depois do seu primeiro acesso à Laplace.';
$string['ssounavailable'] = 'Não foi possível conectar com a Laplace agora ({$a}). Tente novamente em instantes.';

$string['laplacesimulado:addinstance'] = 'Adicionar uma nova atividade de simulado Laplace';
$string['laplacesimulado:view'] = 'Ver a atividade de simulado Laplace';

$string['privacy:metadata'] = 'O mod_laplacesimulado não guarda nenhum dado pessoal por conta própria — os dados de sincronização com a Laplace ficam em local_laplace.';
