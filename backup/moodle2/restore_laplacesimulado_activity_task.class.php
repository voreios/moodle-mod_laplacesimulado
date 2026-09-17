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

defined('MOODLE_INTERNAL') || die();

require_once($CFG->dirroot . '/mod/laplacesimulado/backup/moodle2/restore_laplacesimulado_stepslib.php');

/**
 * Restore task for mod_laplacesimulado.
 *
 * @package    mod_laplacesimulado
 * @copyright  2026 Voreios <fabio@voreios.com.br>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class restore_laplacesimulado_activity_task extends restore_activity_task {

    /**
     * No specific settings for this activity.
     */
    protected function define_my_settings() {
    }

    /**
     * Defines restore steps to restore the instance data.
     */
    protected function define_my_steps() {
        $this->add_step(new restore_laplacesimulado_activity_structure_step('laplacesimulado_structure', 'laplacesimulado.xml'));
    }

    /**
     * Defines the file areas restored by this task.
     *
     * @return string[]
     */
    public function get_fileareas() {
        return ['intro'];
    }

    /**
     * No configdata to encode.
     *
     * @return string[]
     */
    public function get_configdata_encoded_attributes() {
        return [];
    }

    /**
     * Defines contents needing link decoding.
     *
     * @return restore_decode_content[]
     */
    public static function define_decode_contents() {
        $contents = [];

        $contents[] = new restore_decode_content('laplacesimulado', ['intro'], 'laplacesimulado');

        return $contents;
    }

    /**
     * Defines the decode rules used by encode_content_links().
     *
     * @return restore_decode_rule[]
     */
    public static function define_decode_rules() {
        $rules = [];

        $rules[] = new restore_decode_rule('LAPLACESIMULADOVIEWBYID', '/mod/laplacesimulado/view.php?id=$1', 'course_module');

        return $rules;
    }
}
