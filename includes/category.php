<?php
include "database.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_GET["id"])) {
        $id = mysqli_real_escape_string($con, $_GET["id"]);

        $res = mysqli_query($con, "SELECT * FROM category WHERE id='$id'");
        $row = mysqli_fetch_assoc($res);

        echo json_encode($row);
    }

    if (isset($_GET["admin"])) {
        $res = mysqli_query($con, "SELECT * FROM category");

        $category = [];
        if ($res) {
            while ($row = mysqli_fetch_assoc($res)) {
                $category[] = $row;
            }
        }

        echo json_encode($category);
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = mysqli_real_escape_string($con, $_POST["action"]);

    if ($action === "create") {
        $name = mysqli_real_escape_string($con, $_POST["name"]);

        if ($name === "") {
            $arr = array("status" => "error", "msg" => "Category name is required");
        } else {
            $check = mysqli_num_rows(mysqli_query($con, "SELECT * FROM category WHERE name='$name'"));

            if ($check > 0) {
                $arr = array("status" => "error", "msg" => "Category name already registered");
            } else {
                $targetDir = "../uploads/";
                $fileType = pathinfo(basename($_FILES["file"]["name"]), PATHINFO_EXTENSION);
                $fileName = uniqid() . "." . $fileType;
                $targetFilePath = $targetDir . $fileName;

                if (!empty($_FILES["file"]["name"])) {
                    $allowTypes = array("jpg", "png", "jpeg");
                    if (in_array($fileType, $allowTypes)) {
                        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                            $sql = "INSERT INTO category (name, image) VALUES ('$name', '$fileName')";

                            if (mysqli_query($con, $sql)) {
                                $arr = array("status" => "success", "msg" => "Category created successfully");
                            } else {
                                $arr = array("status" => "error", "msg" => mysqli_error($con));
                            }
                        } else {
                            $arr = array("status" => "error", "msg" => "Something went wrong, when upload your image");
                        }
                    } else {
                        $arr = array("status" => "error", "msg" => "Select a valid image type(jpg, jpeg and png required)");
                    }
                } else {
                    $arr = array("status" => "error", "msg" => "Select a image first");
                }
            }
        }

        echo json_encode($arr);
    }

    if ($action === "update") {
        $name = mysqli_real_escape_string($con, $_POST["name"]);
        $id = mysqli_real_escape_string($con, $_POST["id"]);

        if ($name === "") {
            $arr = array("status" => "error", "msg" => "Category name is required");
        } else {
            $res = mysqli_query($con, "SELECT * FROM category WHERE id='$id'");
            $row = mysqli_fetch_assoc($res);
            $check = mysqli_num_rows($res);

            if ($check > 0) {
                $check = mysqli_num_rows(mysqli_query($con, "SELECT * FROM category WHERE name='$name'"));

                if ($check > 0) {
                    $arr = array("status" => "error", "msg" => "Category name already registered");
                } else {
                    $sql = "UPDATE category SET name='$name' WHERE id=$id";

                    if (mysqli_query($con, $sql)) {
                        $arr = array("status" => "success", "msg" => "Category updated successfully");
                    } else {
                        $arr = array("status" => "error", "msg" => mysqli_error($con));
                    }
                }
            } else {
                $arr = array("status" => "error", "msg" => "Category id is invalid");
            }
        }

        echo json_encode($arr);
    }

    if ($action === "delete") {
        $id = mysqli_real_escape_string($con, $_POST["id"]);

        $res = mysqli_query($con, "SELECT * FROM category WHERE id=$id");
        $row = mysqli_fetch_assoc($res);
        $check = mysqli_num_rows($res);

        if ($check > 0) {
            if (gettype($row["image"]) === "string") {
                $file = "../uploads/" . $row["image"];

                if (file_exists($file)) {
                    unlink($file);
                } else {
                    $arr = array("status" => "error", "msg" => "File does not exists");
                }
            }

            $sql = "DELETE FROM category WHERE id=$id";

            if (mysqli_query($con, $sql)) {
                $arr = array("status" => "success", "msg" => "Category deleted successfully");
            } else {
                $arr = array("status" => "error", "msg" => mysqli_error($con));
            }
        } else {
            $arr = array("status" => "error", "msg" => "Invalid category id");
        }

        echo json_encode($arr);
    }
}
?>