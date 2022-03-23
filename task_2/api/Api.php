<?php
//api.php


class API
{
    private $connect ="";

    function __construct(){
        $this->database_connection();
    }

    function database_connection(){
        $this->connect = new PDO("mysql:host=localhost;dbname=api_users", "root","");
    }
    //database select to sort the lists (only admin)
    function fetch_sorted($column,$order){
        $query = "SELECT * FROM users INNER JOIN jobs WHERE users.id = jobs.author_id ORDER BY ".$column." ".$order;
        $statement = $this->connect->prepare($query);
        if($statement->execute()){
            while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                $data[] = $row;
            }
            return $data;
        }
    }
    //database select to get all data
    function fetch_all(){
        $query = "SELECT * FROM users INNER JOIN jobs WHERE users.id = jobs.author_id";
        $statement = $this->connect->prepare($query);
        if($statement->execute()){
            while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                $data[] = $row;
            }
            return $data;
        }
    }
    //select to get data of the user
    function fetch_user($id){
        $query = "SELECT * FROM users INNER JOIN jobs WHERE users.id = jobs.author_id AND users.id = ".$id;
        $statement = $this->connect->prepare($query);
        if($statement->execute()){
            while($row = $statement->fetch(PDO::FETCH_ASSOC)){
                $data[] = $row;
            }
            return $data;
        }

    }
    // Insert a new Job on the database
    function insert($id)
    {
        if(isset($_POST["title"]))
        {
            $form_data = array(
                ':title'  => $_POST["title"],
                ':description'  => $_POST["description"]
            );
            $query = "INSERT INTO jobs (title, author_id, description) VALUES (:title, ".$id.", :description)";
            $statement = $this->connect->prepare($query);
            if($statement->execute($form_data))
            {
                $data[] = array(
                    'success' => '1'
                );
            }
            else
            {
                $data[] = array(
                    'success' => '0'
                );
            }
        }
        else
        {
            $data[] = array(
                'success' => '0'
            );
        }
        return $data;
    }

    //function to check the edit data

    function fetch_single($id)
    {
        $query = "SELECT * FROM users INNER JOIN jobs WHERE users.id = jobs.author_id AND jobs.id = ".$id;
        $statement = $this->connect->prepare($query);
        if($statement->execute())
        {
            foreach($statement->fetchAll() as $row)
            {
                $data['title'] = $row['title'];
                $data['description'] = $row['description'];
            }
            return $data;
        }
    }

    //function to edit jobs

    function update()
    {
        if(isset($_POST["title"]))
        {
            $form_data = array(
                ':title' => $_POST['title'],
                ':description' => $_POST['description'],
                ':id'   => $_POST['id']
            );
            $query = "UPDATE jobs SET title = :title, description = :description WHERE id = :id";
            $statement = $this->connect->prepare($query);
            if($statement->execute($form_data))
            {
                $data[] = array(
                    'success' => '1'
                );
            }
            else
            {
                $data[] = array(
                    'success' => '0'
                );
            }
        }
        else
        {
            $data[] = array(
                'success' => '0'
            );
        }
        return $data;
    }
}
?>