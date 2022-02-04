@extends('layout.app')
@section('title',"post")
@section('content')
    <div class="container my-4">
        <div id="successMessage"></div>
        <div class="card">
            <div class="card-header">
                <h5>Total Student</h5>
                <a href="" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#AddPost">Add new Post</a>
            </div>

            <!-- start add post Modal -->
            <div class="modal fade" id="AddPost" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add new Post</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <ul id="formError"></ul>
                            <form id="frm">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">title</label>
                                    <input type="text" class="form-control title" id="title" aria-describedby="title">
                                <div id="title-error"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="desc" class="form-label">description</label>
                                    <input type="text" name="description" class="description form-control" id="desc">
                                    <div id="desc-error"></div>

                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary add-post-btn">Add Post</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end add post Modal -->


            <!-- start edit post Modal -->
            <div class="modal fade" id="EditPost" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit & update Post</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="frm">
                                <div class="mb-3">
                                    <input type="hidden" class="form-control edit-title" id="edit-post-id" aria-describedby="title">
                                </div> <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">title</label>
                                    <input type="text" class="form-control edit-title" id="edit-title" aria-describedby="title">
                                    <div id="edit-title-error"></div>
                                </div>
                                <div class="mb-3">
                                    <label for="desc" class="form-label">description</label>
                                    <input type="text" name="description" class="edit-description form-control" id="edit-desc">
                                    <div id="edit-desc-error"></div>

                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary update-post">Edit Post</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end edit post Modal -->
            <!-- start delete post Modal -->
            <div class="modal fade" id="deletePost" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">delete Post</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <input type="hidden"  name="name" class="name form-control" id="delete_post_id" aria-describedby="emailHelp">
                            </div>
                          <h5>are you sure to delete post</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary delete-post-btn">Delete post</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end edit post Modal -->
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>title</th>
                        <th>description</th>
                        <th>Edit</th>
                        <th>delete</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
@section('script')
<script>
    $(document).ready(function () {
        fetchPost();
        function fetchPost(){
            $.ajax({
                type: 'GET',
                url: "/fetchData",
                dataType: 'json',
                success:function (response) {
                    // console.log(response.posts);
                    $('tbody').html('');
                    $.each(response.posts,function (key,item) {
                        $('tbody').append(`<tr>
                        <td>${item.id}</td>
                        <td>${item.title}</td>
                        <td>${item.description}</td>

                        <td>
                            <button type="button" value="${item.id}" href="#"  class="edit-post-btn btn btn-info">Edit</button>
                        </td>
                        <td>
                            <button type="button" href="#" value="${item.id}" class="delete-post btn btn-danger">Delete</button>
                        </td>
                    </tr>`)

                    })

                }
            })

        }
$(document).on('click','.add-post-btn',function (e)     {
    e.preventDefault();
    let data={
        'title':$('.title').val(),
        'description':$('.description').val(),
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type:'post',
        url:'/AddPost',
        data:data,
        dataType:"json",
        success:function (response) {
            if (response.status==400){
                console.log(response.errors.title);
                console.log(response.errors.description);
                $('#title-error').html('');
                $('#desc-error').html('');
                $('#title-error').addClass('my-2 alert alert-danger');
                $('#desc-error').addClass('mt-2 alert alert-danger');
                $('#title-error').text(response.errors.title);
                $('#desc-error').text(response.errors.description);
                // $.each(response.errors,function (key,err_values) {
                //     $('#errors').append('<li>'+err_values+'</li>');

                // });


            }
            else{
                $('#formError').html('');
                $('#successMessage').addClass('alert alert-success');
                $('#successMessage').text(response.message);
                $('#AddPost').modal('hide');
                $('#AddPost').find('input').val('');
                fetchPost();



            }

        }

    })

})
$(document).on('click','.edit-post-btn',function (e) {
    e.preventDefault();
    let post_id=$(this).val();
    // console.log(post_id);
    $('#EditPost').modal('show');
    $.ajax({
        type:'get',
        url:'/edit-post/'+post_id,
        success:function (response) {
            if(response.status==400){
                $('#successMessage').html('');
                $('#successMessage').addClass('alert alert-danger');
                $('#successMessage').text(response.message);
            }
            else{
                $('#edit-post-id').val(response.posts.id);
                $('#edit-title').val(response.posts.title);
                $('#edit-desc').val(response.posts.description);
            }

        }
    });

});
        $(document).on('click','.update-post',function (e) {
            e.preventDefault();
            let postId=$('#edit-post-id').val();
            // console.log(postid);
            let data={
                'title':$('#edit-title').val(),
                'description':$('#edit-desc').val(),
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:'PUT',
                url:'/updatePost/'+postId,
                data:data,
                dataType:'json',
                success:function (response) {
                    if(response.status==400){
                        $('#edit-title-error').html('');
                        $('#edit-desc-error').html('');
                        $('#edit-title-error').addClass('my-2 alert alert-danger');
                        $('#edit-desc-error').addClass('mt-2 alert alert-danger');
                        $('#edit-title-error').text(response.errors.title);
                        $('#edit-desc-error').text(response.errors.description);

                    }
                    else if(response.status==404){

                        $('#edit-title-error').html('');
                        $('#edit-desc-error').html('');
                        $('#successMessage').addClass('alert alert-seccess');
                        $('#successMessage').text(response.message);
                    }
                    else{
                        $('#edit-title-error').html('');
                        $('#edit-desc-error').html('');
                        $('#successMessage').html('');
                        $('#successMessage').addClass('alert alert-success');
                        $('#EditPost').modal('hide');
                        fetchPost();


                    }


                }
            })
            // console.log(data);

        });
        $(document).on('click','.delete-post',function (e) {
            e.preventDefault();
            let post_id=$(this).val();
            console.log(post_id);
            // $('#delete_post_id').val(post_id);
            $('#delete_post_id').val(post_id);
            $('#deletePost').modal('show');

        });
        $(document).on('click','.delete-post-btn',function (e) {
            e.preventDefault();
           let post_id=$('#delete_post_id').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type:'DELETE',
                url:'/deletePost/'+post_id,
                success:function (response) {
                    // console.log(response)
                    $('#successMessage').addClass('alert alert-success');
                    $('#successMessage').text(response.message);
                    $('#deletePost').modal('hide');
                    // $('.delete_student_btn').text('Delete');

                    fetchPost();
                }

                })

        })
    });
</script>
@endsection
