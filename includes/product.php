<?php
include "database.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_GET["id"])) {
        $id = mysqli_real_escape_string($con, $_GET["id"]);

        $sql = "SELECT p.id as productId, p.title, p.image, p.description, p.price, p.stock, p.categoryId, p.createdAt, p.updatedAt, c.id as category_id, c.name as category_name, c.image as category_image FROM products p JOIN category c ON p.categoryId = c.id WHERE p.id = $id";

        $result = mysqli_query($con, $sql);
        $product = mysqli_fetch_assoc($result);

        $category = [
            "id" => $product["category_id"],
            "name" => $product["category_name"],
            "image" => $product["category_image"]
        ];

        $finalResult = [
            "id" => $product["productId"],
            "title" => $product["title"],
            "image" => $product["image"],
            "description" => $product["description"],
            "price" => $product["price"],
            "stock" => $product["stock"],
            "createdAt" => $product["createdAt"],
            "updatedAt" => $product["updatedAt"],
            "category" => $category,
        ];

        echo json_encode($finalResult);
    }

    if (isset($_GET["admin"])) {
        $sql = "SELECT p.id as productId, p.title, p.image, p.description, p.price, p.stock, p.categoryId, p.createdAt, p.updatedAt, c.id as category_id, c.name as category_name, c.image as category_image FROM products p JOIN category c ON p.categoryId = c.id";

        $result = mysqli_query($con, $sql);
        $products = mysqli_fetch_all($result, MYSQLI_ASSOC);

        $finalResult = [];

        foreach ($products as $product) {
            $category = [
                "id" => $product["category_id"],
                "name" => $product["category_name"],
                "image" => $product["category_image"]
            ];

            $finalResult[] = [
                "id" => $product["productId"],
                "title" => $product["title"],
                "image" => $product["image"],
                "description" => $product["description"],
                "price" => $product["price"],
                "stock" => $product["stock"],
                "createdAt" => $product["createdAt"],
                "updatedAt" => $product["updatedAt"],
                "category" => $category
            ];
        }

        echo json_encode($finalResult);
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = mysqli_real_escape_string($con, $_POST["action"]);

    if ($action === "create") {
        $title = mysqli_real_escape_string($con, $_POST["title"]);
        $description = mysqli_real_escape_string($con, $_POST["description"]);
        $price = mysqli_real_escape_string($con, $_POST["price"]);
        $stock = mysqli_real_escape_string($con, $_POST["stock"]);
        $category = mysqli_real_escape_string($con, $_POST["category"]);

        if ($title === "") {
            $arr = array("status" => "error", "msg" => "Product title is required");
        } elseif ($description === "") {
            $arr = array("status" => "error", "msg" => "Product description is required");
        } elseif ($price === "") {
            $arr = array("status" => "error", "msg" => "Product price is required");
        } elseif ($stock === "") {
            $arr = array("status" => "error", "msg" => "Product stock is required");
        } elseif ($category === "") {
            $arr = array("status" => "error", "msg" => "Product category is required");
        } else {
            $targetDir = "../uploads/";
            $fileType = pathinfo(basename($_FILES["file"]["name"]), PATHINFO_EXTENSION);
            $fileName = uniqid() . "." . $fileType;
            $targetFilePath = $targetDir . $fileName;

            if (!empty($_FILES["file"]["name"])) {
                $allowTypes = array("jpg", "png", "jpeg");
                if (in_array($fileType, $allowTypes)) {
                    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                        $sql = "INSERT INTO products (title, description, image, price, stock, categoryId) VALUES ('$title', '$description', '$fileName', '$price', '$stock', '$category')";

                        if (mysqli_query($con, $sql)) {
                            $arr = array("status" => "success", "msg" => "Product created successfully");
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

        echo json_encode($arr);
    }

    if ($action === "update") {
        $id = mysqli_real_escape_string($con, $_POST["id"]);
        $title = mysqli_real_escape_string($con, $_POST["title"]);
        $description = mysqli_real_escape_string($con, $_POST["description"]);
        $price = mysqli_real_escape_string($con, $_POST["price"]);
        $stock = mysqli_real_escape_string($con, $_POST["stock"]);
        $category = mysqli_real_escape_string($con, $_POST["category"]);

        if ($title === "") {
            $arr = array("status" => "error", "msg" => "Product title is required");
        } elseif ($description === "") {
            $arr = array("status" => "error", "msg" => "Product description is required");
        } elseif ($price === "") {
            $arr = array("status" => "error", "msg" => "Product price is required");
        } elseif ($stock === "") {
            $arr = array("status" => "error", "msg" => "Product stock is required");
        } elseif ($category === "") {
            $arr = array("status" => "error", "msg" => "Product category is required");
        } else {
            $res = mysqli_query($con, "SELECT * FROM products WHERE id='$id'");
            $row = mysqli_fetch_assoc($res);
            $check = mysqli_num_rows($res);

            if ($check > 0) {
                $sql = "UPDATE products SET title='$title', description='$description', price='$price', stock='$stock', categoryId='$category' WHERE id=$id";

                if (mysqli_query($con, $sql)) {
                    $arr = array("status" => "success", "msg" => "Product updated successfully");
                } else {
                    $arr = array("status" => "error", "msg" => mysqli_error($con));
                }
            } else {
                $arr = array("status" => "error", "msg" => "Product id is invalid");
            }
        }

        echo json_encode($arr);
    }

    if ($action === "delete") {
        $id = mysqli_real_escape_string($con, $_POST["id"]);

        $res = mysqli_query($con, "SELECT * FROM products WHERE id=$id");
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

            $sql = "DELETE FROM products WHERE id=$id";

            if (mysqli_query($con, $sql)) {
                $arr = array("status" => "success", "msg" => "Product deleted successfully");
            } else {
                $arr = array("status" => "error", "msg" => mysqli_error($con));
            }
        } else {
            $arr = array("status" => "error", "msg" => "Invalid product id");
        }

        echo json_encode($arr);
    }
}
?>