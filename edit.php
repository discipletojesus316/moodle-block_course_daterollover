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
	
	The plugin adjust assignment dates according to the course start date, 
	it will set forward assignment items by x number of days, which includes allowsubmissionfrom,
	due-date, cutoffdate, upcoming events, in a course through one centralized screen  
	rather than having to go into each individual assignment activity. 
	This started as a fork from TsedeyT's original work.
	
	@creator					Tsedey Terefe <snort.test123@gmail.com>
	@forker					J. Anton Thelander <thelander7@outlook.com>
	@license					GNU General Public License version 3
	@package				block
	@subpackage			course_daterollover
*/

global $CFG,$DB,$course,$PAGE;

require_once('../../config.php');

require_once($CFG->dirroot."/course/lib.php");

require_once($CFG->libdir.'/filelib.php');

require_once($CFG->dirroot.'/blocks/course_daterollover/course_daterollover_form.php');

require_login($SITE);
$courseid=required_param('id',PARAM_INT);

$sql3=$DB->get_fieldset_select('assign','course','course=?',array($courseid));

//If there is at least one assignment for the course, enter this if-statement (if $sql3 is not empty).
 if (!empty($sql3))
{	
	$course= $DB->get_record('course',array ('id'=>$courseid),'*',MUST_EXIST);
	
	$coursecontext = context_course::instance($course->id);//returns an object not just an ID
	
	require_capability('block/course_daterollover:changedate', $coursecontext);
	
	block_load_class('course_daterollover');
	
	$block = new block_course_daterollover();
	$form = new course_daterollover_form(null, array('coursecontext' => $coursecontext));
	
	if ($data = $form->get_data())
	{
		$sql2=$DB->get_fieldset_select('course','startdate','id=?',array($courseid));
		
		$assignments = $DB->get_records('assign', array('course'=>$courseid));
		
		foreach($assignments as $assignment)
		{            
			$record = new stdClass();
			$record->id = $assignment->id;
			
			$currentime =time();
			
			$tiral3 =(($data->date) - ($sql2[0]));
			
			$record->duedate = ($assignment->duedate )+($data->date) - ($sql2[0]);
			
			$record->allowsubmissionsfromdate = ($assignment->allowsubmissionsfromdate )+($data->date) - ($sql2[0]);
			$record->cutoffdate = ($assignment->cutoffdate )+($data->date) - ($sql2[0]);
			$record->timemodified = $currentime;
			
			$DB->update_record('assign', $record);
		}
		
		
		$upcomingevents = $DB->get_records('event', array('courseid'=>$courseid));
		   
		foreach($upcomingevents as $upcomingevent)
		{
			$eventrecord = new stdClass();
			
			$eventrecord->id = $upcomingevent->id;
			
			$currentime =time();
			
	 		$eventrecord->timestart =($upcomingevent->timestart)+($data->date) - ($sql2[0]);
			
			$eventrecord->timemodified =  $currentime ;
			$DB->update_record('event', $eventrecord);
		}
		
		
		$as = $DB->get_records('course', array('id'=>$courseid));
		foreach ($as as  $a )
		{
			$courserecord = new stdClass();
			$courserecord->id = $a->id;
			$courserecord->startdate = $data->date;
			$DB->update_record('course', $courserecord);
		}
	}
}

//Go to the current course's homepage.
redirect($CFG->wwwroot.'/course/view.php?id='.$courseid, '', 0);

?>
