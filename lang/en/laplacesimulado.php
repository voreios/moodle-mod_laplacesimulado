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
 * Strings for mod_laplacesimulado.
 *
 * @package    mod_laplacesimulado
 * @copyright  2026 Voreios <fabio@voreios.com.br>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'Laplace — Mock exam';
$string['modulename'] = 'Laplace — Mock exam';
$string['modulenameplural'] = 'Laplace mock exams';
$string['modulename_help'] = 'Sends the student, via SSO, to take mock exams on the Laplace platform, showing a performance summary on the activity page itself.';

$string['laplacesimuladoname'] = 'Activity name';
$string['examid'] = 'Exam';
$string['examid_help'] = 'The Laplace exam (e.g. ENEM) used to filter the mock exams and performance summary for this activity.';
$string['examsunavailable'] = 'Could not load the list of exams from Laplace right now — try saving again shortly.';

$string['gotolaplace'] = 'Take mock exam on Laplace';
$string['stats_total'] = 'Assigned mock exams';
$string['stats_corrected'] = 'Corrected mock exams';
$string['stats_average'] = 'Average score';
$string['statsunavailable'] = 'No performance data is available yet — it will appear here after your first access to Laplace.';
$string['ssounavailable'] = 'Could not connect to Laplace right now ({$a}). Please try again shortly.';

$string['laplacesimulado:addinstance'] = 'Add a new Laplace mock exam activity';
$string['laplacesimulado:view'] = 'View the Laplace mock exam activity';

$string['privacy:metadata'] = 'mod_laplacesimulado does not store any personal data of its own — Laplace synchronisation data lives in local_laplace.';
