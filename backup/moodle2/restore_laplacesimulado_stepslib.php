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

/**
 * Structure step to restore one mod_laplacesimulado activity.
 *
 * @package    mod_laplacesimulado
 * @copyright  2026 Voreios <fabio@voreios.com.br>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class restore_laplacesimulado_activity_structure_step extends restore_activity_structure_step {

    /**
     * Defines the structure to be restored.
     *
     * @return restore_path_element[]
     */
    protected function define_structure() {
        $paths = [];
        $paths[] = new restore_path_element('laplacesimulado', '/activity/laplacesimulado');

        return $this->prepare_activity_structure($paths);
    }

    /**
     * Processes the laplacesimulado restore data.
     *
     * @param array|stdClass $data
     */
    protected function process_laplacesimulado($data) {
        global $DB;

        $data = (object) $data;
        $data->course = $this->get_courseid();

        if (empty($data->timecreated)) {
            $data->timecreated = time();
        }
        if (empty($data->timemodified)) {
            $data->timemodified = time();
        }

        $newitemid = $DB->insert_record('laplacesimulado', $data);
        $this->apply_activity_instance($newitemid);
    }

    /**
     * Restores the files attached to the intro editor field.
     */
    protected function after_execute() {
        $this->add_related_files('mod_laplacesimulado', 'intro', null);
    }
}
