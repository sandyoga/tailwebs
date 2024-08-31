<?php
include_once('function.php');
$conn = createDatabaseConnection();
if($_POST['action'] == 'edit') {
    $id = $_POST['id'];
    $sql = "SELECT * FROM student_results WHERE id='$id'";
    $result = $conn->query($sql);
    $student = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $student = $row;
        }
    }
    $conn->close();
    echo json_encode($student);
    exit();
}
if($_POST['action'] == 'delete') {
    $id = $_POST['id'];
    $sql = "DELETE FROM student_results WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error']);
    }
    $conn->close();
    exit();
}

?>