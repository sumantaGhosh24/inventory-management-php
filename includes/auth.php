<?php
include "database.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $id = $_SESSION["USER_ID"];

    $res = mysqli_query($con, "SELECT * FROM users WHERE id = '$id'");
    $row = mysqli_fetch_assoc($res);

    echo json_encode($row);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = mysqli_real_escape_string($con, $_POST["email"]);
    $password = mysqli_real_escape_string($con, $_POST["password"]);

    if ($email === "") {
        $arr = array("status" => "error", "msg" => "Email is required", "field" => "email_error");
    } elseif ($password === "") {
        $arr = array("status" => "error", "msg" => "Password is required", "field" => "password_error");
    } else {
        $result = mysqli_query($con, "SELECT * FROM users WHERE email = '$email'");

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row["password"])) {
                $_SESSION["USER_ID"] = $row["id"];

                $arr = array("status" => "success", "msg" => "Login success", "field" => "form_msg");
            } else {
                $arr = array("status" => "error", "msg" => "Invalid login credential", "field" => "email_error");
            }
        } else {
            $arr = array("status" => "error", "msg" => "Please enter a valid email address", "field" => "email_error");
        }
    }

    echo json_encode($arr);
}
?>