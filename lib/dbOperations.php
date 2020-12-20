<?php
require_once('./config/db1.php');

function fetchRecordAll($entity, $start = 0, $end = 10)
{
    // fetch records for entity(category, article, comment) where status is true
    // start and end will control the behaviour for pagination  
    $sql = "select * from $entity where status = 'A' limit $start, $end";
    global $con;
    $res = mysqli_query($con, $sql);
    $data = array();
    if (mysqli_num_rows($res) > 0) {
        while ($record = mysqli_fetch_assoc($res)) {
            $data[] = $record;
        }
        return $data;
    } else {
        return false;
    }
}


function fetchRecordSpecific($entity, $primary)
{
    // fetch single record for entity(category, article, comment)
    $sql = "select * from $entity where id=$primary";
    global $con;
    $res = mysqli_query($con, $sql);
    $data = array();
    if (mysqli_num_rows($res) > 0) {
        while ($record = mysqli_fetch_assoc($res)) {
            $data = $record;
        }
        return $data;
    } else {
        return false;
    }
}


function insertRecord($entity, $data)
{
    // insert single record for entity(category, article, comment) with data passed
    //echo 'Insert Called';
    $sql = '';
    global $con;
    switch ($entity) {
        case 'user':
            $sql = "insert into user(name,email,pwd,status) values ('$data[user]','$data[email]','$data[pwd]', 'A')";
            break;

        case 'category';
            $sql = "";
            break;
        case 'article';
            $sql = "";
            break;
        case 'comment';
            $sql = "";
            break;
    }
    $res = mysqli_query($con, $sql);
    if (mysqli_affected_rows($con) > 0) {
        echo 'Inserted Successfully.<br>';
    } else {
        echo 'Insertion Failed.<br>';
        echo mysqli_error($con);
    }
}

function updateRecord($entity, $primary, $data)
{
    // update single record for entity(category, article, comment) using its primary key with data passed
    $sql = '';
    global $con;
    if ($entity == 'user') {
        $sql = "UPDATE `user` SET `name` = '$data[name]' ,`email` = '$data[email]',`pwd` = '$data[pwd]' ,`status` = '$data[status]'  where `id` = $primary ";
        $res = mysqli_query($con, $sql);
        if (mysqli_num_rows($res) > 0) {
            echo "updated record";
        } else {
            echo "not updated";
        }
    }
    if ($entity == 'category') {
        $sql = "UPDATE `category` SET `name`='$data[name]',`desc`='$data[desc]',`status`='$data[status]',`updated` = now(), `created` = now() WHERE `id` = $primary";
        $res = mysqli_query($con, $sql);
        /*if(@mysqli_affected_rows($res)>0){
                echo "updated record";
            }else{
                echo "not updated";
            }*/
    }
    if ($entity == 'article') {
        $sql = "UPDATE `article` SET `author`= '$data[author]' ,`category` = '$data[category]',`title` = '$data[title]',`content` = '$data[content]',`updated` = NOW()   where `id` = $primary ";
        $res = mysqli_query($con, $sql);
        if (mysqli_num_rows($res) > 0) {
            echo "updated record";
        } else {
            echo "not updated";
        }
    }
    if ($entity == 'user') {
        $sql = "UPDATE `comment` SET `person`= '$data[person]',`content`= '$data[content]',,`article`= '$data[article]',`status` = '$data[status]'  where `id` = $primary ";
        $res = mysqli_query($con, $sql);
        if (mysqli_num_rows($res) > 0) {
            echo "updated record";
        } else {
            echo "not updated";
        }
    }
}

function deleteRecord($entity, $primary)
{
    // delete single record for entity(category, article, comment) using its primary key
    global $con;
    $sql = "DELETE FROM `category` WHERE `id`=1";
    $res = mysqli_query($con, $sql);
    mysqli_affected_rows('res');
  
}

function authenticate($username, $pwd)
{
    // if successful, redirect to dashboard
    // else stay on login page
    require_once('config/db1.php');
    global $con;
    $sql = "select * from user where name='$username' and status='A' and pwd='$pwd'";
    $res = mysqli_query($con, $sql);
    return $res;
}