<?php

require_once('config.php');

$PAGE->set_context(get_system_context());
$PAGE->set_pagelayout('guest');
$PAGE->set_title("Contact us");
$PAGE->set_heading("Contact us");
$PAGE->set_url($CFG->wwwroot.'/testblank.php');

echo $OUTPUT->header();
echo "Hello World";
echo $OUTPUT->footer();
?>