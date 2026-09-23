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
 * Prints an instance of mod_laplacesimulado.
 *
 * @package    mod_laplacesimulado
 * @copyright  2026 Voreios <fabio@voreios.com.br>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// Moodle 5.x: config.php fica um nível acima de public/, então este
// arquivo (public/mod/laplacesimulado/view.php) precisa de 3 níveis, não 2
// como seria no layout de core anterior ao Moodle 5.0.
require(__DIR__ . '/../../../config.php');
require_once(__DIR__ . '/lib.php');

$id = required_param('id', PARAM_INT);

$cm = get_coursemodule_from_id('laplacesimulado', $id, 0, false, MUST_EXIST);
$course = get_course($cm->course);
$moduleinstance = $DB->get_record('laplacesimulado', ['id' => $cm->instance], '*', MUST_EXIST);

require_login($course, true, $cm);

$context = context_module::instance($cm->id);
require_capability('mod/laplacesimulado:view', $context);

$PAGE->set_url('/mod/laplacesimulado/view.php', ['id' => $cm->id]);
$PAGE->set_title(format_string($moduleinstance->name));
$PAGE->set_heading(format_string($course->fullname));
$PAGE->set_context($context);

laplacesimulado_view($moduleinstance, $course, $cm, $context);

echo $OUTPUT->header();
echo $OUTPUT->heading(format_string($moduleinstance->name));

if ($moduleinstance->intro) {
    echo $OUTPUT->box(format_module_intro('laplacesimulado', $moduleinstance, $cm->id), 'generalbox mod_introbox');
}

// Quem gerencia atividades no curso monta o simulado direto na Laplace via
// deep-link de SSO, em vez de ver o resumo de resultados (que é por aluno).
if (has_capability('moodle/course:manageactivities', $context)) {
    try {
        $ssourl = (new \local_laplace\sso_service())->get_teacher_sso_url(
            $USER->id,
            $course->id,
            'criar-um-simulado?model=ensino-medio'
        );
    } catch (\local_laplace\api\api_exception $e) {
        echo $OUTPUT->notification(get_string('ssounavailable', 'mod_laplacesimulado', $e->getMessage()), 'error');
        echo $OUTPUT->footer();
        exit;
    }

    echo \local_laplace\output\activity_panel::render([], $ssourl, get_string('createinlaplace', 'mod_laplacesimulado'));
    echo $OUTPUT->footer();
    exit;
}

try {
    $syncservice = new \local_laplace\sync_service();
    $mapping = $syncservice->ensure_student_synced($USER->id, $course->id);
    $ssourl = get_config('local_laplace', 'ssobaseurl') . $mapping->ssohash;
} catch (\local_laplace\api\api_exception $e) {
    echo $OUTPUT->notification(get_string('ssounavailable', 'mod_laplacesimulado', $e->getMessage()), 'error');
    echo $OUTPUT->footer();
    exit;
}

$rows = [];
$emptymessage = null;

try {
    $assessments = (new \local_laplace\api\essays_client())->list_school_assessments($mapping->laplacestudentid);

    $total = count($assessments);
    $corrected = 0;
    $scores = [];

    foreach ($assessments as $assessment) {
        foreach (($assessment['essays'] ?? []) as $essay) {
            if ((int) ($essay['status'] ?? 0) === 3) {
                $corrected++;
                if (isset($essay['finalScore'])) {
                    $scores[] = (float) $essay['finalScore'];
                }
            }
        }
    }

    $rows[] = [get_string('stats_total', 'mod_laplacesimulado'), $total];
    $rows[] = [get_string('stats_corrected', 'mod_laplacesimulado'), $corrected];
    if (!empty($scores)) {
        $rows[] = [get_string('stats_average', 'mod_laplacesimulado'), format_float(array_sum($scores) / count($scores), 1)];
    }
} catch (\local_laplace\api\api_exception $e) {
    $emptymessage = get_string('statsunavailable', 'mod_laplacesimulado');
}

echo \local_laplace\output\activity_panel::render(
    $rows,
    $ssourl,
    get_string('gotolaplace', 'mod_laplacesimulado'),
    $emptymessage
);

echo $OUTPUT->footer();
