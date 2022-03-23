<?php

session_start();
include('database.inc.php');

include('get_notifications.php');

if(isset($_GET['order']))
{
    $order = $_GET['order'];
}
else{
    $order = 'title';
}
if(isset($_GET['sort']))
{
    $sort = $_GET['sort'];
}
else{
    $sort = 'ASC';
}

if($sort == 'ASC') {
    $sort = 'DESC';
}else{
    $sort = 'ASC';
}
$_SESSION['order'] = $order;
$_SESSION['sort'] = $sort;


?>
<!DOCTYPE html>
<html>
<head>
    <<title>Jumia Job Challenge</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <style>
        ul {
            display:block;
            background:#45619D;
            list-style:none;
            margin:0;
            padding:12px 10px;
            height:45px;
        }
        ul li {
            float:left;
            font:13px helvetica;
            margin:3px 0;
        }
        ul li a {
            color:#FFF;
            text-decoration:none;
            padding:6px 15px;
            cursor:pointer;
        }
        ul li a:hover {
            background:#425B90;
            text-decoration:none;
            cursor:pointer;
        }
        .text-info {
            color: #000 !important;
        }
        .container h2{
            margin-bottom:25px;
        }
        #notification_box{
            margin-bottom:10px;
        }
        #notifications_container {
            position:relative;
        }
        #notifications_button {
            width:22px;
            height:22px;
            line-height:22px;
            border-radius:50%;
            -moz-border-radius:50%;
            -webkit-border-radius:50%;
            margin:-3px 10px 0 10px;
            cursor:pointer;
        }
        #notifications_counter {
            display:block;
            position:absolute;
            background:#E1141E;
            color:#FFF;
            font-size:12px;
            font-weight:normal;
            padding:1px 3px;
            margin:-8px 0 0 25px;
            border-radius:2px;
            -moz-border-radius:2px;
            -webkit-border-radius:2px;
            z-index:1;
        }
        #notifications {
            display:none;
            width:430px;
            position:absolute;
            top:30px;
            left:0;
            background:#FFF;
            border:solid 1px rgba(100, 100, 100, .20);
            -webkit-box-shadow:0 3px 8px rgba(0, 0, 0, .20);
            z-index: 0;
        }
        #notifications:before {
            content: '';
            display:block;
            width:0;
            height:0;
            color:transparent;
            border:10px solid #CCC;
            border-color:transparent transparent #FFF;
            margin-top:-20px;
            margin-left:10px;
        }
        h3 {
            display:block;
            color:#333;
            background:#FFF;
            font-weight:bold;
            font-size:13px;
            padding:8px;
            margin:0;
            border-bottom:solid 1px rgba(100, 100, 100, .30);
        }
        #notifications_button .notifications_bell{
            background-color: white;
            background-repeat: no-repeat;
            background-size: auto;
            background-position: 0 -712px;
            height: 24px;
            width: 24px;
        }
        #show_notification p{
            margin-left:10px;
            margin-top:10px;
        }
    </style>
</head>
<body style="margin:0;padding:0;">
<?php
notification($res_message, $unread_count);
?>
<div class="container">
    <br />
    <h3 align="center">Ain't nothing like Jumia to look for a new job</h3>
    <br />
    <div align="right" style="margin-bottom:5px;">
        <button type="button" name="add_button" id="add_button" class="btn btn-success btn-xs">Add</button>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th><a href='?order=title&sort=<?php echo($sort) ?>'>Jobs</a></th>
                    <th><a href='?order=name&sort=<?php echo ($sort); ?>'>Author</a></th>
                    <th><a href='?order=description&sort=<?php echo ($sort); ?>'>Description</a></th>
                    <th>Edit</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
</body>
</html>

<div id="apicrudModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="api_crud_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Data</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Job Title</label>
                        <input type="text" name="title" id="title" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Job Description</label>
                        <input type="text" name="description" id="description" class="form-control" />
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="hidden_id" id="hidden_id" />
                    <input type="hidden" name="action" id="action" value="insert" />
                    <input type="submit" name="button_action" id="button_action" class="btn btn-info" value="Insert" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {

        //sort the lists
        $(document).ready(function(){
            $(document).on('click', '.column_sort', function(){
                var column = $(this).attr("id");
                var order = $(this).data("order");
                $.ajax({
                    url:"fetch.php",
                    method:"POST",
                    data:{column:column, order:order},
                    success:function(data)
                    {
                        $('tbody').html(data);
                    }
                })
            });
        });

        // update the notifications to the value 1 (seen)
        $('#notifications_button').click(function () {
            jQuery.ajax({
                url:'update_message_status.php',
                success:function(){
                    $('#notifications').fadeToggle('fast', 'linear');
                    $('#notifications_counter').fadeOut('slow');
                }
            })
            return false;
        });
        $(document).click(function () {
            $('#notifications').hide();
        });

        fetch_data();
        // to gather data about jobs from user/users
        function fetch_data() {
            $.ajax({
                url: "fetch.php",
                success: function (data) {
                    $('tbody').html(data);
                }
            })
        }

        // show the insert table
        $('#add_button').click(function() {
            $('#action').val('insert');
            $('#button_action').val('Insert');
            $('.modal-title').text('Add Job');
            $('#apicrudModal').modal('show');
        });

        // submit on insert / edit
        $('#api_crud_form').on('submit', function(event){
            event.preventDefault();
            if ($('#title').val() == '') {
                alert("Enter a title");
            } else if ($('#description').val() == '') {
                alert("Enter a description");
            } else {
                var form_data = $(this).serialize();
                $.ajax({
                    url: "http://localhost/task_2/task/action.php",
                    method: "POST",
                    data: form_data,
                    success:function(data)
                    {
                        fetch_data();
                        $('#api_crud_form')[0].reset();
                        $('#apicrudModal').modal('hide');
                        if (data == 'insert') {
                            alert("Data Inserted using PHP API");
                        }
                        if (data == 'update') {
                            alert("Data Updated using PHP API");
                        }
                    }
                });
            }
        });
    });
    // to show table and edit a job
    $(document).on('click', '.edit', function(){
        var id = $(this).attr('id');
        var action = 'fetch_single';
        $.ajax({
            url:"action.php",
            method:"POST",
            data:{id:id, action:action},
            dataType:"json",
            success:function(data)
            {
                $('#hidden_id').val(id);
                $('#title').val(data.title);
                $('#description').val(data.description);
                $('#action').val('update');
                $('#button_action').val('Update');
                $('.modal-title').text('Edit Job');
                $('#apicrudModal').modal('show');
            }
        });
    });
</script>