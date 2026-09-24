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

        if (has_capability('moodle/course:manageactivities', $this->context)) {
            $mform->addElement('html', $this->render_teacher_link());
        }

        $this->standard_coursemodule_elements();

        $this->add_action_buttons();
    }

    /**
     * Monta o link "Criar simulado na Laplace" pra quem gerencia atividades
     * no curso, mostrado no topo desta seção — mesmo deep-link de SSO de
     * professor usado na view.php da atividade.
     *
     * @return string HTML pronto para um elemento 'html' do mform.
     */
    private function render_teacher_link(): string {
        global $USER;

        try {
            $ssourl = (new \local_laplace\sso_service())->get_teacher_sso_url(
                $USER->id,
                $this->course->id,
                'criar-um-simulado?model=ensino-medio'
            );
        } catch (\local_laplace\api\api_exception $e) {
            return \html_writer::div(
                get_string('ssounavailable', 'mod_laplacesimulado', $e->getMessage()),
                'alert alert-warning'
            );
        }

        return \html_writer::div(
            \html_writer::link($ssourl, get_string('createinlaplace', 'mod_laplacesimulado'), ['class' => 'btn btn-secondary', 'target' => '_blank']),
            'local-laplace-teacher-link mb-3'
        );
    }
}
