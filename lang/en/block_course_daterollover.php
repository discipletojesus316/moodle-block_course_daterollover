<?php

/*
	This file is part of Moodle - http://moodle.org/
    
	Moodle license:
    
	Moodle is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.
	
	Moodle is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.
	
	You should have received a copy of the GNU General Public License
	along with Moodle.  If not, see http://www.gnu.org/licenses/gpl-3.0.html
	 
	Plug-in name: block_course_daterollover
	
	Plug-in description:
	
	The plug-in adjust assignment dates according to the course start date, 
	it will set forward assignment items by x number of days, which includes allowsubmissionfrom,
	due-date, cutoffdate, upcoming events, in a course through one centralized screen  
	rather than having to go into each individual assignment activity. 
	This started as a fork from TsedeyT's original work.
	
	@creator					Tsedey Terefe <snort.test123@gmail.com>
	@forker					J. Anton Thelander <thelander7@outlook.com>
	@license					GNU General Public License version 3
	@package					block
	@subpackage			course_daterollover
*/

//If MOODLE_INTERNAL is not defined, then die(), which probably means terminating the plug-in.
//Code from /moodle-block_assignment_daterollover/blob/master/assignment_daterollover_form.php
if (!defined('MOODLE_INTERNAL'))
{
	die();
}

$string['pluginname'] = ' Course Date Rollover';
$string['pluginnameplural'] = 'Date Rollovers';
$string['update'] = 'Adjust All Dates';
$string['adjustdate'] = 'Select a new start-date for the current course:';
$string['invaliddate'] = 'The date and time selected was invalid';
$string['nodate'] = 'No date was selected';
$string['pastdate'] = 'The time and date selected is in the past';
$string['description'] = 'test';
$string['descriptionfooter'] = 'The dates for all assignments in the current course changes by the same number of days';
$string['descriptiontitle'] = 'Enter a new course start-date that also will set forward all assignments.';

?>
