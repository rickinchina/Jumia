<?php

$ID = $_SESSION['id'];

$res_message=mysqli_query($con,"select users.name,jobs.title from jobs,users where jobs.seen = 0  and users.id = jobs.author_id");
$unread_count=mysqli_num_rows($res_message);

$sql_user="select id, name from users order by names asc";
$res_user=mysqli_query($con,$sql_user);

// get notifications of new jobs (admin only)

function notification($message, $count){

    if($_SESSION['admin'] == 1) {
        echo('<div id="notification_box">
        <ul>
            <li id="notifications_container">
                <div id="notifications_counter">'.$count.'</div>
                <div id="notifications_button">
                    <div class="notifications_bell white"></div>
                </div>
                <div id="notifications">
                    <h3>Jobs</h3>
                    <div style="height:300px;" id="show_notification">');
        if ($count > 0) {
            while ($row_message = mysqli_fetch_assoc($message)) {
                echo('<p><strong>' . $row_message['name'] . '</strong> just added <b>' . $row_message['title'] . '</p></b>');
            }
        }
        else{
            echo("<p><strong>No new jobs were created</strong></p>");
        }
        echo('</div></div></li></ul></div>');
    }
}
