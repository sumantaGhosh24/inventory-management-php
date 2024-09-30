<?php
include "database.php";

session_start();

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_GET["id"])) {
        $id = mysqli_real_escape_string($con, $_GET["id"]);

        $res = mysqli_query($con, "SELECT * FROM customers WHERE id='$id'");
        $row = mysqli_fetch_assoc($res);

        echo json_encode($row);
    }

    if (isset($_GET["admin"])) {
        $res = mysqli_query($con, "SELECT * FROM customers");

        $customers = [];
        if ($res) {
            while ($row = mysqli_fetch_assoc($res)) {
                $customers[] = $row;
            }
        }

        echo json_encode($customers);
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = mysqli_real_escape_string($con, $_POST["action"]);

    if ($action === "create") {
        $email = mysqli_real_escape_string($con, $_POST["email"]);
        $mobileNumber = mysqli_real_escape_string($con, $_POST["mobileNumber"]);
        $fullname = mysqli_real_escape_string($con, $_POST["fullname"]);
        $dob = mysqli_real_escape_string($con, $_POST["dob"]);
        $gender = mysqli_real_escape_string($con, $_POST["gender"]);
        $city = mysqli_real_escape_string($con, $_POST["city"]);
        $state = mysqli_real_escape_string($con, $_POST["state"]);
        $country = mysqli_real_escape_string($con, $_POST["country"]);
        $zip = mysqli_real_escape_string($con, $_POST["zip"]);
        $addressline = mysqli_real_escape_string($con, $_POST["addressline"]);

        if ($email === "") {
            $arr = array("status" => "error", "msg" => "Customer email is required");
        } elseif ($mobileNumber === "") {
            $arr = array("status" => "error", "msg" => "Customer mobile number is required");
        } elseif ($fullname === "") {
            $arr = array("status" => "error", "msg" => "Customer fullname is required");
        } elseif ($dob === "") {
            $arr = array("status" => "error", "msg" => "Customer dob is required");
        } elseif ($gender === "") {
            $arr = array("status" => "error", "msg" => "Customer gender is required");
        } elseif ($city === "") {
            $arr = array("status" => "error", "msg" => "Customer city is required");
        } elseif ($state === "") {
            $arr = array("status" => "error", "msg" => "Customer state is required");
        } elseif ($country === "") {
            $arr = array("status" => "error", "msg" => "Customer country is required");
        } elseif ($zip === "") {
            $arr = array("status" => "error", "msg" => "Customer zip is required");
        } elseif ($addressline === "") {
            $arr = array("status" => "error", "msg" => "Customer addressline is required");
        } else {
            $sql = "INSERT INTO customers (email, mobileNumber, fullname, dob, gender, city, state, country, zip, addressline) VALUES ('$email', '$mobileNumber', '$fullname', '$dob', '$gender', '$city', '$state', '$country', '$zip', '$addressline')";

            if (mysqli_query($con, $sql)) {
                $arr = array("status" => "success", "msg" => "Customer created successfully");
            } else {
                $arr = array("status" => "error", "msg" => mysqli_error($con));
            }
        }

        echo json_encode($arr);
    }

    if ($action === "update") {
        $id = mysqli_real_escape_string($con, $_POST["id"]);
        $email = mysqli_real_escape_string($con, $_POST["email"]);
        $mobileNumber = mysqli_real_escape_string($con, $_POST["mobileNumber"]);
        $fullname = mysqli_real_escape_string($con, $_POST["fullname"]);
        $dob = mysqli_real_escape_string($con, $_POST["dob"]);
        $gender = mysqli_real_escape_string($con, $_POST["gender"]);
        $city = mysqli_real_escape_string($con, $_POST["city"]);
        $state = mysqli_real_escape_string($con, $_POST["state"]);
        $country = mysqli_real_escape_string($con, $_POST["country"]);
        $zip = mysqli_real_escape_string($con, $_POST["zip"]);
        $addressline = mysqli_real_escape_string($con, $_POST["addressline"]);

        if ($email === "") {
            $arr = array("status" => "error", "msg" => "Customer email is required");
        } elseif ($mobileNumber === "") {
            $arr = array("status" => "error", "msg" => "Customer mobile number is required");
        } elseif ($fullname === "") {
            $arr = array("status" => "error", "msg" => "Customer fullname is required");
        } elseif ($dob === "") {
            $arr = array("status" => "error", "msg" => "Customer dob is required");
        } elseif ($gender === "") {
            $arr = array("status" => "error", "msg" => "Customer gender is required");
        } elseif ($city === "") {
            $arr = array("status" => "error", "msg" => "Customer city is required");
        } elseif ($state === "") {
            $arr = array("status" => "error", "msg" => "Customer state is required");
        } elseif ($country === "") {
            $arr = array("status" => "error", "msg" => "Customer country is required");
        } elseif ($zip === "") {
            $arr = array("status" => "error", "msg" => "Customer zip is required");
        } elseif ($addressline === "") {
            $arr = array("status" => "error", "msg" => "Customer addressline is required");
        } else {
            $res = mysqli_query($con, "SELECT * FROM customers WHERE id='$id'");
            $row = mysqli_fetch_assoc($res);
            $check = mysqli_num_rows($res);

            if ($check > 0) {
                $sql = "UPDATE customers SET email='$email', mobileNumber='$mobileNumber', fullname='$fullname', dob='$dob', gender='$gender', city='$city', state='$state', country='$country', zip='$zip', addressline='$addressline' WHERE id=$id";

                if (mysqli_query($con, $sql)) {
                    $arr = array("status" => "success", "msg" => "Customer updated successfully");
                } else {
                    $arr = array("status" => "error", "msg" => mysqli_error($con));
                }
            } else {
                $arr = array("status" => "error", "msg" => "Customer id is invalid");
            }
        }

        echo json_encode($arr);
    }

    if ($action === "delete") {
        $id = mysqli_real_escape_string($con, $_POST["id"]);

        $res = mysqli_query($con, "SELECT * FROM customers WHERE id=$id");
        $row = mysqli_fetch_assoc($res);
        $check = mysqli_num_rows($res);

        if ($check > 0) {
            $sql = "DELETE FROM customers WHERE id=$id";

            if (mysqli_query($con, $sql)) {
                $arr = array("status" => "success", "msg" => "Customer deleted successfully");
            } else {
                $arr = array("status" => "error", "msg" => mysqli_error($con));
            }
        } else {
            $arr = array("status" => "error", "msg" => "Invalid customer id");
        }

        echo json_encode($arr);
    }
}
?>