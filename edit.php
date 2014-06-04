<?php
global $CFG,$DB,$course,$PAGE;
require_once('../../config.php');

require_once($CFG->dirroot."/course/lib.php");

require_once($CFG->libdir.'/filelib.php');



require_once($CFG->dirroot.'/blocks/course_daterollover/course_daterollover_form.php');

require_login($SITE);
$courseid=required_param('id',PARAM_INT);

$sql3=$DB->get_fieldset_select('assign','course','course=?',array($courseid));

//if there is no assignment for the course
 if (!empty($sql3))
{


$course= $DB->get_record('course',array ('id'=>$courseid),'*',MUST_EXIST);



$coursecontext = context_course::instance($course->id);//returns an object not just an ID


require_capability('block/course_daterollover:changedate', $coursecontext);

block_load_class('course_daterollover');

$block = new block_course_daterollover();
$form = new course_daterollover_form(null, array('coursecontext' => $coursecontext));



if ($data = $form->get_data()) {


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
		$record->cutoff = ($assignment->cutoff )+($data->date) - ($sql2[0]);
		$record->timemodified = $currentime;
                $DB->update_record('assign', $record);

                
}


$upcomingevents = $DB->get_records('event', array('courseid'=>$courseid));
    foreach($upcomingevents as $upcomingevent)
{
             
                 $eventrecord = new stdClass();
                 $eventrecord->id = $upcomingevent->id;
		 
		 $currentime =time();
 		
                       
               
 		 $eventrecord->timestart =($assignment->timestart)+($data->date) - ($sql2[0]);
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
}else{

redirect($CFG->wwwroot.'/course/view.php?id='.$courseid, '', 0);
}
redirect($CFG->wwwroot.'/course/view.php?id='.$courseid, '', 0);

