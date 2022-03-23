<?php

//fetch.php
session_start();


include 'connect.php';

//if not admin can't see all users

if($_SESSION['admin'] == 0)
{
    $api_url = "http://localhost/task_2/api/task_api.php?action=fetch_user&id=".$_SESSION['id'];
}
if($_SESSION['admin'] == 1)
{
    if(isset($_SESSION['order'])){

        if(isset($_SESSION['sort'])){
            $api_url = "http://localhost/task_2/api/task_api.php?action=fetch_sorted&column=".$_SESSION['order']."&order=".$_SESSION['sort'];
        }
        else{
            $api_url = "http://localhost/task_2/api/task_api.php?action=fetch_all";
        }
    }
    else{

        $api_url = "http://localhost/task_2/api/task_api.php?action=fetch_all";
    }

}
$client = curl_init($api_url);
curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($client);

$result = json_decode($response);

$output = '';
//if database isn't empty then fill the table
//if empty show no data found
if(count($result) > 0)
{
    foreach($result as $row)
    {
        $output .= '
         <tr>
           <td>'.$row->title.'</td>
           <td>'.$row->name.'</td>
           <td>'.$row->description.'</td>
           <td><button type="button" name="edit" class="btn btn-warning btn-xs edit" id="'.$row->id.'">Edit</button></td>
         </tr>
  ';
    }
}
else
{
    $output .= '
    <tr>
        <td colspan="4" align="center">No Data Found</td>
    </tr>
 ';
}

echo $output;

?>
