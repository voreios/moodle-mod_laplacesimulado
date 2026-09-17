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
 * Library of interface functions and constants for mod_laplacesimulado.
 *
 * @package    mod_laplacesimulado
 * @copyright  2026 Voreios <fabio@voreios.com.br>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Declara os recursos suportados pela atividade.
 *
 * @param string $feature FEATURE_xx constant for requested feature
 * @return mixed True if module supports feature, false if not, null if doesn't know or string for the module purpose.
 */
function laplacesimulado_supports($feature) {
    switch ($feature) {
        case FEATURE_MOD_INTRO:
            return true;
        case FEATURE_COMPLETION_TRACKS_VIEWS:
            return true;
        case FEATURE_BACKUP_MOODLE2:
            return true;
        case FEATURE_MOD_PURPOSE:
            return MOD_PURPOSE_ASSESSMENT;
        default:
            return null;
    }
}

/**
 * Cria uma instância da atividade.
 *
 * @param stdClass $moduleinstance
 * @return int id da instância criada
 */
function laplacesimulado_add_instance(stdClass $moduleinstance): int {
    global $DB;

    $moduleinstance->timecreated = time();
    $moduleinstance->timemodified = $moduleinstance->timecreated;

    return $DB->insert_record('laplacesimulado', $moduleinstance);
}

/**
 * Atualiza uma instância da atividade.
 *
 * @param stdClass $moduleinstance
 * @return bool
 */
function laplacesimulado_update_instance(stdClass $moduleinstance): bool {
    global $DB;

    $moduleinstance->id = $moduleinstance->instance;
    $moduleinstance->timemodified = time();

    return $DB->update_record('laplacesimulado', $moduleinstance);
}

/**
 * Exclui uma instância da atividade.
 *
 * @param int $id Id da instância (não do course_module)
 * @return bool
 */
function laplacesimulado_delete_instance(int $id): bool {
    global $DB;

    if (!$DB->get_record('laplacesimulado', ['id' => $id])) {
        return false;
    }

    $DB->delete_records('laplacesimulado', ['id' => $id]);

    return true;
}

/**
 * Dispara o evento de visualização e marca a conclusão por visualização.
 *
 * @param stdClass $laplacesimulado
 * @param stdClass $course
 * @param cm_info|stdClass $cm
 * @param context_module $context
 */
function laplacesimulado_view($laplacesimulado, $course, $cm, $context): void {
    $params = [
        'context' => $context,
        'objectid' => $laplacesimulado->id,
    ];

    $event = \mod_laplacesimulado\event\course_module_viewed::create($params);
    $event->add_record_snapshot('course_modules', $cm);
    $event->add_record_snapshot('course', $course);
    $event->add_record_snapshot('laplacesimulado', $laplacesimulado);
    $event->trigger();

    $completion = new completion_info($course);
    $completion->set_module_viewed($cm);
}
