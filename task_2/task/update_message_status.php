<?php

include('database.inc.php');
session_start();

//update the unseen to seen jobs (admin only)

$id=$_SESSION['id'];
mysqli_query($con,"update jobs set seen = 1");
