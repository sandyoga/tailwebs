function validateForm() {
    // Get form elements
    var username = document.getElementById('user_name').value;
    var subject = document.getElementById('user_subject').value;
    var mark = document.getElementById('user_mark').value;

    // Simple validation checks
    if (username === "") {
        alert("Username must be filled out");
        return false;
    }

    if (subject === "") {
        alert("Subject must be filled out");
        return false;
    }

    // Check if age is a number and greater than 0
    if (mark === "" || isNaN(mark) || mark <= 0) {
        alert("Please enter a valid mark greater than 0");
        return false;
    }

    // If all validations pass, submit the form
    document.getElementById('student_form').submit();
}

function editvalidateForm() {
    // Get form elements
    var username = document.getElementById('edit_user_name').value;
    var subject = document.getElementById('edit_user_subject').value;
    var mark = document.getElementById('edit_user_mark').value;

    // Simple validation checks
    if (username === "") {
        alert("Username must be filled out");
        return false;
    }

    if (subject === "") {
        alert("Subject must be filled out");
        return false;
    }

    // Check if age is a number and greater than 0
    if (mark === "" || isNaN(mark) || mark <= 0) {
        alert("Please enter a valid mark greater than 0");
        return false;
    }

    // If all validations pass, submit the form
    document.getElementById('edit_student_form').submit();
}

document.addEventListener('DOMContentLoaded', function() {
    var editButtons = document.querySelectorAll('.edit_opt');
    var modal = document.getElementById('editModal');
    // When the Edit button is clicked
    editButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var id = this.getAttribute('data-id'); // Get the ID from the button's data attribute

            // Fetch data from the server
            fetch('ajax.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'id=' + id + '&action=edit'
            })
            .then(response => response.json())
            .then(data => {
                console.log(data.name);
                // Populate the modal fields with the fetched data
                document.getElementById('edit_user_name').value = data.name;
                document.getElementById('edit_user_subject').value = data.subject;
                document.getElementById('edit_user_mark').value = data.marks;
                document.getElementById('edit_user_id').value = data.id;

                // Open the modal
                //modal.style.display = 'block';
            })
            .catch(error => console.error('Error fetching data:', error));
        });
    });

});

document.addEventListener('DOMContentLoaded', function() {
    var delButtons = document.querySelectorAll('.delete_opt');
        delButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var id = this.getAttribute('data-id'); // Get the ID from the button's data attribute

                // Fetch data from the server
                fetch('ajax.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'id=' + id + '&action=delete'
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    location.reload();                   
                })
                .catch(error => console.error('Error fetching data:', error));
            });
        });
    });

