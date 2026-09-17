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
 * Define the complete structure for backup, with file and id annotations.
 *
 * @package    mod_laplacesimulado
 * @copyright  2026 Voreios <fabio@voreios.com.br>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class backup_laplacesimulado_activity_structure_step extends backup_activity_structure_step {

    /**
     * Defines the structure of the resulting xml file.
     *
     * @return backup_nested_element
     */
    protected function define_structure() {
        $laplacesimulado = new backup_nested_element('laplacesimulado', ['id'], [
            'name', 'intro', 'introformat', 'examid', 'timecreated', 'timemodified',
        ]);

        $laplacesimulado->set_source_table('laplacesimulado', ['id' => backup::VAR_ACTIVITYID]);

        $laplacesimulado->annotate_files('mod_laplacesimulado', 'intro', null);

        return $this->prepare_activity_structure($laplacesimulado);
    }
}
