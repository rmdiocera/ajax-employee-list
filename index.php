<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee List</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>


    <!-- Delete Employee Modal -->
    <div class="modal fade" id="del_emp_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Delete Employee</h2>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form id="delete_form">
                    <div class="modal-body">
                        <p>Are you sure you want to delete this employee?</p>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-sm btn-danger" value="Delete">
                        <input type="hidden" name="emp_id" id="emp_id">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add/Edit Employee Modal -->
    <div class="modal fade" id="add_emp_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title edit-modal">Add Employee Form</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <form id="add_form">
                    <div class="modal-body">
                        <div id="emp_form" class="form-group">
                            <label for="fname">First Name</label>
                            <input class="form-control" type="text" name="fname" id="fname" required>
                            <label for="lname">Last Name</label>
                            <input class="form-control" type="text" name="lname" id="lname" required>
                            <label for="title">Position</label>
                            <input class="form-control" type="text" name="title" id="title" required>
                            <label for="bday">Birth Date</label>
                            <input class="form-control" type="date" name="bday" id="bday" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <!-- removed name="submit" -->
                        <input type="submit" class="btn btn-sm btn-info" value="Submit" id="submit">
                        <input type="hidden" id="status" name="status" value="0">
                        <input type="hidden" name="emp_id" id="emp_id">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row mt-3">
            <div class="col-md-8 offset-md-2">
                <div id="delete_alert" class="alert d-none alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <p>Employee successfully deleted.
                        <a href="#" class="alert-link" data-dismiss="alert">Close</a>
                    </p>
                </div>
                <div id="add_edit_alert" class="alert d-none alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <p id="add_edit_alert_content" class="my-0"></p>
                </div>
                <!-- <button class="btn btn-sm btn-primary float-left my-3" id="add_emp">Add New Employee</button> -->
                <button class="btn btn-sm btn-primary float-left mb-3" data-toggle="modal" data-target="#add_emp_modal">Add New Employee</button>
                <table class="table table-bordered" id="emp_table">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Position</th>
                            <th>Birth Date</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody id="emp_list"></tbody>
                </table>
            </div>
        </div>
    </div>

    <h1 id="test"></h1>
    <!-- <div id="add_emp_div">
        <form id="add_form">
            <div id="emp_form"></div>
        </form>
    </div> -->

    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            // Edit employee
            $('#emp_table').on('click', '.edit', function() {
                var id = $(this).attr('value');
                // var emp_id_exists = $('input[name=emp_id]'); 

                $('#add_emp_modal').modal('show');
                $('#add_emp_modal').find('.modal-title').text('Edit Employee');
                $.ajax({
                    url: 'employees.php',
                    type: "GET",
                    data: {
                        edit: id
                    },
                    dataType: 'json',
                    success: function(data) {
                        // Create hidden element with employee ID as value if emp_id element doesn't exist
                        // if (emp_id_exists.length <= 0) {
                        //     $('<input />', {
                        //     type: 'hidden',
                        //     id: 'emp_id',
                        //     name: 'emp_id'
                        // }).appendTo('#emp_form');
                        // }

                        for (let i in data) {
                            $('input[name=fname]').val(data[i].firstname);
                            $('input[name=lname]').val(data[i].lastname);
                            $('input[name=title]').val(data[i].position);
                            $('input[name=bday]').val(data[i].birth_date);
                            $('input[name=emp_id]').val(data[i].id);
                            $('input[name=status]').val(1);
                        }

                        // let output = '';
                        // for (let i in data) {
                        //     output +=
                        //         '<table>' +
                        //         '<thead>' +
                        //         '<tr>' +
                        //         '<th colspan="2">Edit Employee</th>' +
                        //         '</tr>' +
                        //         '</thead>' +
                        //         '<tbody>' +
                        //         '<tr>' +
                        //         '<td>First Name</td>' +
                        //         '<td><input value="' + data[i].firstname + '" type="text" name="" id="fname" required></td>' +
                        //         '</tr>' +
                        //         '<tr>' +
                        //         '<td>Last Name</td>' +
                        //         '<td><input value="' + data[i].lastname + '" type="text" name="" id="lname" required></td>' +
                        //         '</tr>' +
                        //         '<tr>' +
                        //         '<td>Position</td>' +
                        //         '<td><input value="' + data[i].position + '" type="text" name="" id="title" required></td>' +
                        //         '</tr>' +
                        //         '<tr>' +
                        //         '<td>Birth Date</td>' +
                        //         '<td><input value="' + data[i].birth_date + '" type="date" name="" id="bday" required></td>' +
                        //         '</tr>' +
                        //         '<tr>' +
                        //         '<td></td>' +
                        //         '<td><input type="submit" value="Save Changes" name="submit" id="submit"></td>' +
                        //         '</tr>' +
                        //         '<input type="hidden" id="status" value="1">' +
                        //         '<input type="hidden" id="emp_id" value="' + data[i].id + '">' +
                        //         '</tbody>' +
                        //         '</table>';
                        // }

                        // $('#emp_form').html(output);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            });

            // Confirm employee delete
            $('#emp_table').on('click', '.delete', function() {
                let id = $(this).attr('value');
                $('#del_emp_modal').modal('show');
                $('input[name=emp_id]').val(id);
            });

            // Delete employee from db
            $('#delete_form').on('submit', function(e) {
                e.preventDefault();
                let emp_id = $('input[name=emp_id]').val();

                $.ajax({
                    url: 'employees.php',
                    type: 'GET',
                    data: {
                        delete: emp_id
                    },
                    dataType: 'json',
                    success: function(result) {
                        if (result) {
                            $('#delete_alert').removeClass('d-none').fadeIn().delay(3000).fadeOut('slow', function(){$('#delete_alert').addClass('d-none')});
                            $('#del_emp_modal').modal('toggle');
                            return false;
                        }
                    }
                });
            });

            

        });

        // document.getElementById('add_emp').addEventListener('click', showEmployeeForm);

        document.getElementById('add_form').addEventListener('submit', saveEmployeeRecord);

        function showEmployees() {
            let xhr = new XMLHttpRequest();

            xhr.open('GET', 'employees.php', true);

            xhr.onload = function() {
                if (this.status == 200) {
                    let employees = JSON.parse(this.responseText);
                    let output = '';

                    for (let i in employees) {
                        output += '<tr>' +
                            '<td>' + employees[i].firstname + '</td>' +
                            '<td>' + employees[i].lastname + '</td>' +
                            '<td>' + employees[i].position + '</td>' +
                            '<td>' + employees[i].birth_date + '</td>' +
                            '<td><button id="edit" class="edit btn btn-sm btn-success" value="' + employees[i].id + '">Edit</button></td>' +
                            '<td><button id="delete" class="delete btn btn-sm btn-danger" value="' + employees[i].id + '" data-toggle="modal" data-target="#del_emp_modal">Delete</button></td>' +
                            '</tr>';
                    }

                    document.getElementById('emp_list').innerHTML = output;

                }
            }

            xhr.send();
        }

        function showEmployeeForm() {
            let xhr = new XMLHttpRequest();

            xhr.open('GET', 'index.php', true);

            xhr.onload = function() {
                if (this.status == 200) {
                    let output = '';

                    output += '<table>' +
                        '<thead>' +
                        '<tr>' +
                        '<th colspan="2">Add Employee Form</th>' +
                        '</tr>' +
                        '</thead>' +
                        '<tbody>' +
                        '<tr>' +
                        '<td>First Name</td>' +
                        '<td><input type="text" name="" id="fname" required></td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td>Last Name</td>' +
                        '<td><input type="text" name="" id="lname" required></td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td>Position</td>' +
                        '<td><input type="text" name="" id="title" required></td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td>Birth Date</td>' +
                        '<td><input type="date" name="" id="bday" required></td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td></td>' +
                        '<td><input type="submit" value="Submit" name="submit" id="submit"></td>' +
                        '</tr>' +
                        '<input type="hidden" name="status" id="status" value="0">' +
                        '</tbody>' +
                        '</table>';


                    document.getElementById('emp_form').innerHTML = output;
                }
            }

            xhr.send();
        }

        function saveEmployeeRecord(e) {
            e.preventDefault();
            let xhr = new XMLHttpRequest();

            let check_emp = document.getElementById('emp_id');
            if (check_emp) {
                emp_id = document.getElementById('emp_id').value;
            } else {
                emp_id = 0;
            }
            let status = document.getElementById('status').value;
            let fname = document.getElementById('fname').value;
            let lname = document.getElementById('lname').value;
            let title = document.getElementById('title').value;
            let bday = document.getElementById('bday').value;
            let params = "fname=" + fname + "&lname=" + lname + "&title=" + title + "&bday=" + bday + "&status=" + status + "&id=" + emp_id;

            xhr.open('POST', 'employees.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                var test = this.responseText;
                $('#add_edit_alert_content').html(
                    test + '<a href="#" class="alert-link" data-dismiss="alert">Close</a>'
                        );
                $('#add_edit_alert').removeClass('d-none').fadeIn().delay(3000).fadeOut('slow', function(){$('#add_edit_alert').addClass('d-none')});
                $('#add_emp_modal').modal('toggle');
                return false;
            }

            xhr.send(params);
        }



        // showEmployees();
        setInterval(showEmployees, 1000);
    </script>
</body>

</html>