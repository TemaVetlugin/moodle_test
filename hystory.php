<?php

require_once('../../config.php');

// Get global variables.
global $DB, $PAGE;

// Define constants.
$TABLE_NAME = 'block_solver';

// Set the page URL and context.
$PAGE->set_url('/blocks/solver/hystory.php');
$PAGE->set_context(context_system::instance());

// Get the records from the database.
$results = $DB->get_records($TABLE_NAME);

// Start the output.
echo $OUTPUT->header();
echo "<table border='1'>";
echo "<tr><th>a</th><th>b</th><th>c</th><th>x1</th><th>x2</th></tr>";

// Loop through the results and display them in a table.
foreach ($results as $result) {
    echo "<tr><td>{$result->a}</td><td>{$result->b}</td><td>{$result->c}</td>
    <td>{$result->x1}</td><td>{$result->x2}</td></tr>";
}

// End the output.
echo "</table>";
echo $OUTPUT->footer();
