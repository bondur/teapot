<?php

require 'dbcon.php';

if(isset($_POST['save_tea']))
{
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $description = mysqli_real_escape_string($con, $_POST['description']);

    if($name == NULL || $description == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'Все поля обязательны для заполнения'
        ];
        echo json_encode($res);
        return;
    }

    $query = "INSERT INTO teapot (name, description) VALUES ('$name','$description')";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Добавление произошло успешно!!!'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Не удолось добавить запись'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_POST['update_tea']))
{
    $id = mysqli_real_escape_string($con, $_POST['id']);

    $name = mysqli_real_escape_string($con, $_POST['name']);
    $description = mysqli_real_escape_string($con, $_POST['description']);

    if($name == NULL || $description == NULL )
    {
        $res = [
            'status' => 422,
            'message' => 'Все поля обязательны для заполнения'
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE teapot SET name='$name', description='$description' 
                WHERE id='$id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Изменение произошло успешно!!!'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Не удалось изменить запись'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_GET['id']))
{
    $id = mysqli_real_escape_string($con, $_GET['id']);

    $query = "SELECT * FROM teapot WHERE id='$id'";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $tea = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Tea Fetch Successfully by id',
            'data' => $tea
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'tea Id Not Found '
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['delete_tea']))
{
    $id = mysqli_real_escape_string($con, $_POST['id']);

    $query = "DELETE FROM teapot WHERE id='$id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Удаление произошло успешно'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Не удалось удалить запись'
        ];
        echo json_encode($res);
        return;
    }
}

?>