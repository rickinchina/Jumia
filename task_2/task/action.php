<?php

//action.php

session_start();

if(isset($_POST["action"])) {
    if ($_POST["action"] == 'insert')
    {
        $form_data = array(
            'title' => $_POST['title'],
            'description' => $_POST['description']
        );
        $api_url = "http://localhost/task_2/api/task_api.php?action=insert&id=".$_SESSION['id']."";
        $client = curl_init($api_url);
        curl_setopt($client, CURLOPT_POST, true);
        curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        curl_close($client);
        $result = json_decode($response, true);
        foreach ($result as $keys => $values)
        {
            if ($result[$keys]['success'] == '1')
            {
                echo 'insert';
            } else {
                echo 'error';
            }
        }
    }

    if($_POST["action"] == 'fetch_single')
    {
        $id = $_POST["id"];
        $api_url = "http://localhost/task_2/api/task_api.php?action=fetch_single&id=".$id."";
        $client = curl_init($api_url);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        echo $response;
    }

    if($_POST["action"] == 'update')
    {
        $form_data = array(
            'title' => $_POST['title'],
            'description'  => $_POST['description'],
            'id'   => $_POST['hidden_id']
        );
        $api_url = "http://localhost/task_2/api/task_api.php?action=update";
        $client = curl_init($api_url);
        curl_setopt($client, CURLOPT_POST, true);
        curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($client);
        curl_close($client);
        $result = json_decode($response, true);
        foreach($result as $keys => $values)
        {
            if($result[$keys]['success'] == '1')
            {
                echo 'update';
            }
            else
            {
                echo 'error';
            }
        }
    }
}
?>