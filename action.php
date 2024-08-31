<?php 
if(!isset($_SESSION['username']) && !isset($_POST['username'])) {
    header('Location: login?error=1');
    exit();
}

if($_POST['action'] == 'add') {
    $name = $_POST['user_name'];
    $subject = $_POST['user_subject'];
    $mark = $_POST['user_mark'];
    $conn = createDatabaseConnection();

    $get_sql = "SELECT * FROM student_results WHERE name='$name' AND subject='$subject'"; 
    $result = $conn->query($get_sql);
    if ($result->num_rows > 0) {
        $update_sql = "UPDATE student_results SET name='$name', subject='$subject', marks='$mark' WHERE name='$name' AND subject='$subject'";
        if ($conn->query($update_sql) === TRUE) {
            header("Location: ".TAOH_SITE_URL_ROOT.'/student_list');
        } else {
            echo "Error: " . $update_sql . "<br>" . $conn->error;
        }
    }else{
        $sql = "INSERT INTO student_results (name, subject, marks) VALUES ('$name', '$subject', '$mark')";
        if ($conn->query($sql) === TRUE) {
            header("Location: ".TAOH_SITE_URL_ROOT.'/student_list');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
} 
if($_POST['action'] == 'edit') {
    $id = $_POST['user_id'];
    $name = $_POST['user_name'];
    $subject = $_POST['user_subject'];
    $mark = $_POST['user_mark'];
    $conn = createDatabaseConnection();
    $sql = "UPDATE student_results SET name='$name', subject='$subject', marks='$mark' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        header("Location: ".TAOH_SITE_URL_ROOT.'/student_list');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>