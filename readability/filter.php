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
 * Basic email protection filter.
 *
 * @package    filter
 * @subpackage readability
 * @copyright  2013 Matt Bury <matt@matbury.com> {@link http://matbury.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once('TextStatistics.php');

/**
 * This class calculates and prints readability statistics in texts.
 */
class filter_readability extends moodle_text_filter {
    
    function filter($text, array $options = array()) {
        
        if(strlen($text) < $CFG->filter_readability_min_length)
        {
            return $text;
        }
        global $CFG;
        
        $text_statistics = new TextStatistics();
        
        switch($CFG->filter_readability_type)
        {
            case 'fkre':
                $readability_stats = get_string('fkre','filter_readability').': '.$text_statistics->flesch_kincaid_reading_ease($text).' / 100';
                $readability_link = get_string('fkre_link','filter_readability');
                break;
            case 'fkgl';
                $readability_stats = get_string('fkgl','filter_readability').': '.$text_statistics->flesch_kincaid_grade_level($text);
                $readability_link = get_string('fkgl_link','filter_readability');
                break;
            case 'gfi';
                $readability_stats = get_string('gfi','filter_readability').': '.$text_statistics->gunning_fog_score($text);
                $readability_link = get_string('gfi_link','filter_readability');
                break;
            case 'cli';
                $readability_stats = get_string('cli','filter_readability').': '.$text_statistics->coleman_liau_index($text);
                $readability_link = get_string('cli_link','filter_readability');
                break;
            case 'smogi';
                $readability_stats = get_string('smogi','filter_readability').': '.$text_statistics->smog_index($text);
                $readability_link = get_string('smogi_link','filter_readability');
                break;
            case 'ari';
                $readability_stats = get_string('ari','filter_readability').': '.$text_statistics->automated_readability_index($text);
                $readability_link = get_string('ari_link','filter_readability');
                break;
            default:
                // Default to Flesch-Kincaid Reading Ease
                $readability_stats = get_string('fkre','filter_readability').': '.$text_statistics->flesch_kincaid_reading_ease($text).' / 100';
                $readability_link = get_string('fkre_link','filter_readability');
        }
        
        $readability_stats_style = '<div style="float: right; padding: 10px; font-size: small;"><div style="background-color: #EEE; padding: 5px;"><a href="'.$readability_link.'" target="_blank" title="'.get_string('whats_this','filter_readability').'" >'.$readability_stats.'</a></div></div>';
        
        return $readability_stats_style.$text;
    }
}
