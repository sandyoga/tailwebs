<?php
    if(!isset($_SESSION['username']) && !isset($_POST['username'])) {
        header('Location: login?error=1');
        exit();
    }
    if(!isset($_SESSION['username'])) {
        if($_POST['username'] == 'admin' && $_POST['password'] == 'admin') {
            $_SESSION['username'] = $_POST['username'];
        }else {
            header('Location: login?error=2');
            exit();
        }
    }

    $conn = createDatabaseConnection();
    $sql = "SELECT * FROM student_results";
    $result = $conn->query($sql);
    $students = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $students[] = $row;
        }
    }
    $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Marks</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.css">
    <style>
        
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">
                <span>tailwebs.</span>
            </div>
            <nav>
                <a href="">Home</a>
                <a href="<?php echo TAOH_SITE_URL_ROOT.'/logout' ?>">Logout</a>
            </nav>
        </header>
        <main>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Subject</th>
                        <th>Mark</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if(count($students) > 0) {
                        foreach($students as $student) { ?>
                        <tr>
                            <td>
                                <div class="name-cell">
                                    <div class="circle"><?= $student['name'][0] ?></div>
                                    <span><?= $student['name'] ?></span>
                                </div>
                            </td>
                            <td><?= $student['subject'] ?></td>
                            <td><?= $student['marks'] ?></td>
                            <td>
                                <div class="dropdown">
                                    <button class="dropbtn">&#9662;</button>
                                    <div class="dropdown-content">
                                        <a data-id="<?= $student['id'] ?>" data-bs-toggle="modal" data-bs-target="#editModal" class="edit_opt">Edit</a>
                                        <a data-id="<?= $student['id'] ?>" class="delete_opt">Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php } }else{ ?>
                        <tr>
                            <td colspan="4">No records found</td>
                        </tr>
                    <?php } ?>
                    
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
            <button type="button" class="add-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add
            </button>
        </main>
    </div>

<!-- The Modal -->
<div class="modal" tabindex="-1" id="exampleModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-body">
            <div class="form-container">
                <form id="student_form" method="POST" action="<?php echo TAOH_SITE_URL_ROOT.'/action' ?>">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person icon" viewBox="0 0 16 16">
                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                        </svg>
                        <input type="text" id="user_name" name="user_name" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-left-text icon" viewBox="0 0 16 16">
                            <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                            <path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6m0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"/>
                        </svg>
                        <input type="text" id="user_subject" name="user_subject" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label for="mark">Mark</label>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark icon" viewBox="0 0 16 16">
                            <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1z"/>
                        </svg>
                        <input type="text" id="user_mark" name="user_mark" placeholder="" required>
                    </div>
                    <input type="hidden" name="action" value="add">
                    <div class="form-group">
                        <button type="button" onclick="validateForm()">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
</div>

<div class="modal" tabindex="-1" id="editModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-body">
            <div class="form-container">
                <form id="edit_student_form" method="POST" action="<?php echo TAOH_SITE_URL_ROOT.'/action' ?>">
                    <div class="form-group">
                        <label for="edit_name">Name</label>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person icon" viewBox="0 0 16 16">
                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                        </svg>
                        <input type="text" id="edit_user_name" name="user_name" value="" placeholder="" required>
                        <input type="hidden" id="edit_user_id" name="user_id" value="">
                    </div>
                    <div class="form-group">
                        <label for="edit_subject">Subject</label>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-left-text icon" viewBox="0 0 16 16">
                            <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                            <path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6m0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"/>
                        </svg>
                        <input type="text" id="edit_user_subject" name="user_subject" placeholder="" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_mark">Mark</label>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark icon" viewBox="0 0 16 16">
                            <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1z"/>
                        </svg>
                        <input type="text" id="edit_user_mark" name="user_mark" placeholder="" required>
                    </div>
                    <input type="hidden" name="action" value="edit">
                    <div class="form-group">
                        <button type="button" onclick="editvalidateForm()">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  </div>
</div>

<script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
