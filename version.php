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
     *  block_course_daterollover
     *
     *  This plugin adjust assignment date according to the course start date, 
     *  it will set forward assignment items  by x number of days, which includes allowsubmissionfrom,
     *  due-date, cutoffdate, upcoming events, in a course through one centralized screen  
     *  rather than having to go into each individual assignment activity. 
     *  This started as a fork off of TsedeyT's original work.
     *
     * @creator     Tsedey Terefe <snort.test123@gmail.com>
     * @forker      J. Anton Thelander <thelander7@outlook.com>
     * @license     GNU General Public License version 3
     * @package     block
     * @subpackage  course_daterollover
     */

//If MOODLE_INTERNAL is not defined, then die(), which means terminating the program.
//Code copied from /moodle-block_assignment_daterollover/blob/master/assignment_daterollover_form.php
if (!defined('MOODLE_INTERNAL'))
{
    die();
}

//The version that this plugin is written for.
$plugin->version = 2014050100;

//The version that this plugin demands at least.
$plugin->requires = 2011120500;

//This plugin component, the name of it.
$plugin->component = 'block_course_daterollover';

?>
