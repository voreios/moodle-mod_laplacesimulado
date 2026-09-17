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
 * The main mod_laplacesimulado configuration form.
 *
 * @package    mod_laplacesimulado
 * @copyright  2026 Voreios <fabio@voreios.com.br>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/course/moodleform_mod.php');

/**
 * Module instance settings form.
 */
class mod_laplacesimulado_mod_form extends moodleform_mod {

    /**
     * Defines forms elements.
     */
    public function definition() {
        $mform = $this->_form;

        $mform->addElement('header', 'general', get_string('general', 'form'));

        $mform->addElement('text', 'name', get_string('laplacesimuladoname', 'mod_laplacesimulado'), ['size' => '64']);
        $mform->setType('name', PARAM_TEXT);
        $mform->addRule('name', null, 'required', null, 'client');
        $mform->addRule('name', get_string('maximumchars', '', 255), 'maxlength', 255, 'client');

        $this->standard_intro_elements();

        $mform->addElement('header', 'laplacesimuladoheader', get_string('pluginname', 'mod_laplacesimulado'));

        $exams = $this->get_exam_options();
        $mform->addElement('select', 'examid', get_string('examid', 'mod_laplacesimulado'), $exams);
        $mform->addRule('examid', null, 'required', null, 'client');
        $mform->addHelpButton('examid', 'examid', 'mod_laplacesimulado');

        $this->standard_coursemodule_elements();

        $this->add_action_buttons();
    }

    /**
     * Busca os exames disponíveis na API de Essays para popular o select.
     * Se a API estiver fora do ar, devolve uma lista vazia com uma opção
     * de aviso em vez de deixar a tela do formulário quebrar.
     *
     * @return array
     */
    private function get_exam_options(): array {
        try {
            $exams = (new \local_laplace\api\essays_client())->list_exams();
        } catch (\local_laplace\api\api_exception $e) {
            return ['' => get_string('examsunavailable', 'mod_laplacesimulado')];
        }

        $options = ['' => get_string('choosedots')];
        foreach ($exams as $exam) {
            $options[$exam['id']] = $exam['name'];
        }

        return $options;
    }
}
