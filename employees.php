<?php

$conn = mysqli_connect('localhost', 'root', '', 'test_paychat');

if (isset($_POST['status'])) {  

    $status = mysqli_real_escape_string($conn, $_POST['status']);  
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $bday = mysqli_real_escape_string($conn, $_POST['bday']);
    $emp_id = mysqli_real_escape_string($conn, $_POST['id']);

    if ($status == 1) { 
        $query = "UPDATE employees SET firstname = '$fname', lastname = '$lname', position = '$title', birth_date = '$bday' WHERE id = '$emp_id';";
        if (mysqli_query($conn, $query)) {
            echo 'Employee record has been updated. ';
        } else {
            echo 'ERROR: ' . mysqli_error($conn);
        }
    } else {
        $query = "INSERT INTO employees(firstname, lastname, position, birth_date) VALUES ('$fname', '$lname', '$title', '$bday')";

        if (mysqli_query($conn, $query)) {
            echo 'Employee has been added to the list. ';
        } else {
            echo 'ERROR: ' . mysqli_error($conn);
        }
    }
} else if (isset($_GET['edit'])) {
    $id = mysqli_real_escape_string($conn, $_GET['edit']);

    $query = "SELECT * FROM employees WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    $emp = mysqli_fetch_all($result, MYSQLI_ASSOC);

    echo json_encode($emp);
} else if (isset($_GET['delete'])) {
    $id = mysqli_real_escape_string($conn, $_GET['delete']);

    $query = "DELETE FROM employees WHERE id='$id'";
    $result = mysqli_query($conn, $query);

    echo json_encode($result);

} else {
    $query = "SELECT * FROM employees";
    $result = mysqli_query($conn, $query);

    $employees = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo json_encode($employees);
}
