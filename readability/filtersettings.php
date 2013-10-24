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
 * @package    filter
 * @subpackage readability
 * @copyright  2013 Matt Bury <matt@matbury.com> {@link http://matbury.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {
    
    // Readability formula type
    $visiblename = get_string('type','filter_readability');
    $description = get_string('type_description','filter_readability');
    $defaultsetting = 'fkre';
    $choices = array(
        'fkre' => get_string('fkre','filter_readability'),
        'fkgl' => get_string('fkgl','filter_readability'),
        'gfi' => get_string('gfi','filter_readability'),
        'cli' => get_string('cli','filter_readability'),
        'smogi' => get_string('smogi','filter_readability'),
        'ari' => get_string('ari','filter_readability')
    );
    $settings->add(new admin_setting_configselect('filter_readability_type', $visiblename, $description, $defaultsetting, $choices));
    
    // Minimum text length
    $visiblename_len = get_string('min_length', 'filter_readability');
    $description_len = get_string('min_length_description', 'filter_readability');
    $settings->add(new admin_setting_configtext('filter_readability_min_length', $visiblename_len, $description_len, 500, PARAM_INT, 10));
    
}
