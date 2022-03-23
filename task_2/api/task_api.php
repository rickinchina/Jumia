<?php

include('Api.php');

$api_object = new API();

session_start();

if($_GET["action"] == 'auth')
{
    $data = $api_object->auth();
}

if($_GET["action"] == 'fetch_all')
{
    $data = $api_object->fetch_all();

}if($_GET["action"] == 'fetch_sorted')
{
    $data = $api_object->fetch_sorted($_GET["column"],$_GET["order"]);
}

if($_GET["action"] == 'fetch_user')
{
    $data = $api_object->fetch_user($_GET["id"]);
}

if($_GET["action"] == 'insert')
{
    $data = $api_object->insert($_GET["id"]);
}

if($_GET["action"] == 'fetch_single')
{
    $data = $api_object->fetch_single($_GET["id"]);
}

if($_GET["action"] == 'update')
{
    $data = $api_object->update();
}
echo json_encode($data);

?>