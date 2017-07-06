<?php
include 'autorun.php';
include 'network_constants.php';
if ($_SERVER ['REQUEST_METHOD'] == 'GET') {
    showAssignments();
} else {
    echo "This page is ment to be called with a get header </br>";
}
function showAssignments()
{
    $constants = new network_constants();
    $db = new PDO ('mysql:host='.$constants->host.';dbname='.$constants->dbname,$constants->username,$constants->password);
    $stmt = $db->query("SELECT * FROM ".$constants->assignment_table." WHERE done=0 ORDER by class_id ASC,due ASC");
    $temp_array = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $temp_array [] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode(array(
        "Assignments" => $temp_array
    ));
}

