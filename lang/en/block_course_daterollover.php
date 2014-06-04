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
     *  This plugin adjust assignment date according to the course start date , it will set forward assignment items  by x number of days, which includes allowsubmissionfrom,
     *  due-date, cutoffdate, upcoming events, in a course through one centralized screen  
     *  rather than having to go into each individual assignment activity.
     *
     * @author      Tsedey Terefe <snort.test123@gmail.com>
     * @license     GNU General Public License version 3
     * @package     block
     * @subpackage  course_daterollover
     */
defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = ' Course Date Rollover';
$string['pluginnameplural'] = 'Date Rollovers';
$string['update'] = 'Adjust All Dates';
$string['adjustdate'] = ' Select a new date for current course';
$string['invaliddate'] = 'The date and time selected was invalid';
$string['nodate'] = 'No Date was selected';
$string['pastdate'] = 'The time and date selected is in the past';
$string['description'] = 'test';
$string['descriptionfooter'] = 'The dates for all assignments in the  current course changes by the same number of days';
$string['descriptiontitle'] = 'Enter a new course start date  that will also set forward every assignments.';
