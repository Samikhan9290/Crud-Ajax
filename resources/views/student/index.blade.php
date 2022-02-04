@extends('layout.app')
@section('title','Student')
@section('content')
    <div class="container my-4">
        <div class="row">
            <div class="col-md-12">
                <div id="successMsg"></div>
                <div class="card">
                    <div class="card-header">
                        <h4>Add Student
                            <a data-bs-toggle="modal" data-bs-target="#AddStudent" href="#"
                               class="btn btn-primary float-end btn-small">Add student</a>
                        </h4>
                    </div>
                    <!-- start Modal -->
                    <div class="modal fade" id="AddStudent" tabindex="-1" aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <ul id="errors"></ul>
                                    <form>
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Name</label>
                                            <input type="text" name="name" class="name form-control"
                                                   id="exampleInputEmail1" aria-describedby="emailHelp">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">Email</label>
                                            <input type="email" name="email" class="email form-control"
                                                   id="exampleInputPassword1">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">phone</label>
                                            <input type="text" name="phone" class="phone form-control"
                                                   id="exampleInputPassword1">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">Adress</label>
                                            <input type="text" name="address" class="address form-control"
                                                   id="exampleInputPassword1">
                                        </div>


                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
                                    </button>
                                    <button type="button" class="btn btn-primary addStudent">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end Modal -->
                    <!-- start Edit Modal -->
                    <div class="modal fade" id="editStudent" tabindex="-1" aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit And Update Student</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <ul id="Edit_errors"></ul>
                                    <form>
                                        <div class="mb-3">
                                            <input type="hidden" name="name" class="name form-control"
                                                   id="edit_student_id" aria-describedby="emailHelp">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Name</label>
                                            <input type="text" name="name" class="name form-control" id="edit_name"
                                                   aria-describedby="emailHelp">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">Email</label>
                                            <input type="email" name="email" class="email form-control" id="edit_email">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">phone</label>
                                            <input type="text" name="phone" class="phone form-control" id="edit_phone">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">Adress</label>
                                            <input type="text" name="address" class="address form-control"
                                                   id="edit_address">
                                        </div>


                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
                                    </button>
                                    <button type="button" class="btn btn-primary update_student">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- end Edit Modal -->


                    <!-- start delete Modal -->
                    <div class="modal fade" id="deleteStudent" tabindex="-1" aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Student</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <form>
                                        <div class="mb-3">
                                            <input type="hidden" name="name" class="name form-control"
                                                   id="delete_student_id" aria-describedby="emailHelp">
                                        </div>
                                        <h4>Are you sure to delete Student</h4>


                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
                                    </button>
                                    <button type="button" class="btn btn-primary delete_student_btn">Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- end delete Modal -->
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>name</th>
                                <th>email</th>
                                <th>phone</th>
                                <th>Address</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            fetchStudent()

            function fetchStudent() {
                $.ajax({
                    type: 'GET',
                    url: "/fetchStudent",
                    dataType: 'json',
                    success: function (response) {
                        // console.log(response.students);
                        $('tbody').html('');
                        $.each(response.students, function (key, item) {
                            $('tbody').append(`<tr>
                                <td>${item.id}</td>
                                <td>${item.name}</td>
                                <td>${item.email}</td>
                                <td>${item.phone}</td>
                                <td>${item.address}</td>
                                <td><button type="button" value="${item.id}" class="edit_student btn btn-primary btn-sm">Edit</button></td>
                                <td><button type="button" value="${item.id}" class="delete_student btn btn-danger btn-sm">Delete</button></td>
                            </tr>`)

                        });

                    }
                });
            }

            $(document).on('click', '.delete_student', function (e) {
                e.preventDefault();
                let student_id = $(this).val()
                // alert(student_id);
                $('#delete_student_id').val(student_id);
                $('#deleteStudent').modal('show');

            });
            $(document).on('click', '.delete_student_btn', function (e) {
                e.preventDefault();
                $(this).text('deleting');
                let student_id = $('#delete_student_id').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'DELETE',
                    url: '/delete_student/' + student_id, success: function (response) {
                        // console.log(response)
                        $('#successMsg').addClass('alert alert-success');
                        $('#successMsg').text(response.message);
                        $('#deleteStudent').modal('hide');
                        $('.delete_student_btn').text('Delete');

                        fetchStudent();


                    }
                })

            })
            $(document).on('click', '.edit_student', function (e) {
                e.preventDefault();
                let student_id = $(this).val();
                // console.log(student_id);
                $('#editStudent').modal('show')
                $.ajax({
                    type: 'GET',
                    url: "/edit_student/" + student_id,
                    success: function (response) {
                        // console.log(response);
                        if (response.status == 400) {
                            $('#successMsg').html("")
                            $('#successMsg').addClass("alert alert-danger")
                            $('#successMsg').text(response.message)
                        } else {
                            $('#edit_name').val(response.student.name);
                            $('#edit_student_id').val(response.student.id);
                            $('#edit_email').val(response.student.email);
                            $('#edit_phone').val(response.student.phone);
                            $('#edit_address').val(response.student.address);
                        }

                    }
                });

            });
            $(document).on('click', '.update_student', function (e) {
                e.preventDefault();
                $(this).text('updating')
                let student_id = $('#edit_student_id').val();
                let data = {
                    'name': $('#edit_name').val(),
                    'email': $('#edit_email').val(),
                    'phone': $('#edit_phone').val(),
                    'address': $('#edit_address').val(),
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "PUT",
                    url: 'update_student/' + student_id,
                    data: data,
                    dataType: 'json',
                    success: function (response) {
                        // console.log(response)
                        if (response.status == 400) {
                            $('#Edit_errors').html("");
                            $('#Edit_errors').addClass("alert alert-danger");
                            $.each(response.errors, function (key, err_values) {
                                $('#Edit_errors').append('<li>' + err_values + '</li>');

                            });
                            $('.update_student').text('update')

                        } else if (response.status == 404) {
                            $('#Edit_errors').html("");
                            $("#successMsg").addClass('alert alert-success');
                            $("#successMsg").text(response.message);
                            $('.update_student').text('update')


                        } else {
                            $('#Edit_errors').html("");
                            $('#successMsg').html("");
                            $("#successMsg").addClass('alert alert-success');
                            $("#successMsg").text(response.message);
                            $("#editStudent").modal('hide');
                            $('.update_student').text('update')

                            fetchStudent()


                        }

                    }
                })

            });

            $(document).on('click', '.addStudent', function (e) {
                e.preventDefault();
                let data = {
                    'name': $('.name').val(),
                    'email': $('.email').val(),
                    'phone': $('.phone').val(),
                    'address': $('.address').val(),
                }
                // console.log(data);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: "/student",
                    data: data,
                    dataType: "json",
                    success: function (response) {
                        if (response.status == 400) {
                            $('#errors').html("");
                            $('#errors').addClass("alert alert-danger");
                            $.each(response.errors, function (key, err_values) {
                                $('#errors').append('<li>' + err_values + '</li>');

                            });
                        } else {
                            $('#errors').html("");
                            $("#successMsg").addClass('alert alert-success');
                            $("#successMsg").text(response.message);
                            $("#AddStudent").modal('hide');
                            $("#AddStudent").find('input').val('');
                            fetchStudent()

                        }

                    }
                });
            });
        });
    </script>
@endsection
