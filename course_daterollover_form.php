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
if (!defined('MOODLE_INTERNAL')) {
    die();
}
require_once($CFG->libdir.'/formslib.php');
global $course;
class course_daterollover_form extends moodleform {

    public function definition() {

        $mform =& $this->_form;
        $coursecontext = $this->_customdata['coursecontext'];
       
        
        
       //$mform->addElement('static', 'description', '' ,get_string('descriptiontitle','block_course_daterollover'));
        //set id to the value $course->id
       $mform->addElement('hidden', 'id', $coursecontext->instanceid);
       $mform->setType('id',PARAM_INT);  



        $years= array(
        'startyear' => 1970, 
        'stopyear'  => 2030,
        'timezone'  => 99,
        'step'      => 5
        );
        $mform->addElement('date_selector',
                           'date',
                           get_string('adjustdate', 'block_course_daterollover'),
                           $years);
        
        $mform->addRule('date', null, 'required', null, 'client');//required -if the value is not empty, integer 0 is not considered an empty value.
        $mform->addElement('submit', 'update', get_string('update', 'block_course_daterollover'));

    }

    public function validate($data) {
        if (empty($data['date']) || $data['date'] == -1) {
            $errors['date'] = get_string('invaliddate', 'block_course_daterollover');
        } else if ($data['date'] < time()) {
            $errors['date'] = get_string('pastdate', 'block_course_daterollover');
        }
        return $errors;
    }

    public function display() {
       
        if (!$this->_definition_finalized) {
            $this->_definition_finalized = true;
            $this->definition_after_data();
        }
        ob_start();
        $this->_form->display();
        $form = ob_get_clean();

        return $form;
    }


}
