<?php require "./includes/header.php"; ?>

<?php
if (!isset($_SESSION["USER_ID"])) {
    header("Location: login.php");
    die();
}
?>

<div class="flex justify-center items-center bg-white my-20">
    <div class="bg-white rounded-lg shadow-md p-8 shadow-black w-[75%]">
        <h1 class="text-3xl font-semibold mb-5 text-black">Create Customer</h1>
        <span id="form_error" class="text-red-500 font-bold text-center my-3 error_field"></span>
        <span id="form_success" class="text-green-500 font-bold text-center my-3 error_field"></span>
        <form class="mb-6" id="create_customer_form">
            <div class="mb-4">
                <label for="fullname" class="text-black">Customer Fullname:</label>
                <input type="text" class="w-full px-4 py-2 rounded-md border border-gray-300"
                    placeholder="Enter customer fullname" name="fullname" id="fullname" />
            </div>
            <div class="mb-4">
                <label for="email" class="text-black">Customer Email:</label>
                <input type="email" class="w-full px-4 py-2 rounded-md border border-gray-300"
                    placeholder="Enter customer email" name="email" id="email" />
            </div>
            <div class="mb-4">
                <label for="mobileNumber" class="text-black">Customer Mobile Number:</label>
                <input type="text" class="w-full px-4 py-2 rounded-md border border-gray-300"
                    placeholder="Enter customer mobile number" name="mobileNumber" id="mobileNumber" />
            </div>
            <div class="mb-4">
                <label for="dob" class="text-black">Customer DOB:</label>
                <input type="date" class="w-full px-4 py-2 rounded-md border border-gray-300"
                    placeholder="Enter customer dob" name="dob" id="dob" />
            </div>
            <div class="mb-4">
                <label for="gender" class="text-black">Customer Gender:</label>
                <input type="text" class="w-full px-4 py-2 rounded-md border border-gray-300"
                    placeholder="Enter customer gender" name="gender" id="gender" />
            </div>
            <div class="mb-4">
                <label for="city" class="text-black">Customer City:</label>
                <input type="text" class="w-full px-4 py-2 rounded-md border border-gray-300"
                    placeholder="Enter customer city" name="city" id="city" />
            </div>
            <div class="mb-4">
                <label for="state" class="text-black">Customer State:</label>
                <input type="text" class="w-full px-4 py-2 rounded-md border border-gray-300"
                    placeholder="Enter customer state" name="state" id="state" />
            </div>
            <div class="mb-4">
                <label for="country" class="text-black">Customer Country:</label>
                <input type="text" class="w-full px-4 py-2 rounded-md border border-gray-300"
                    placeholder="Enter customer country" name="country" id="country" />
            </div>
            <div class="mb-4">
                <label for="zip" class="text-black">Customer Zip:</label>
                <input type="text" class="w-full px-4 py-2 rounded-md border border-gray-300"
                    placeholder="Enter customer zip" name="zip" id="zip" />
            </div>
            <div class="mb-4">
                <label for="addressline" class="text-black">Customer Addressline:</label>
                <input type="text" class="w-full px-4 py-2 rounded-md border border-gray-300"
                    placeholder="Enter customer addressline" name="addressline" id="addressline" />
            </div>
            <input type="hidden" name="action" value="create" />
            <button type="submit" id="create_customer_submit"
                class="w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors disabled:bg-blue-200">Create
                Customer</button>
        </form>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#create_customer_form").on("submit", function (e) {
            $(".error_field").html("");
            $("#create_customer_submit").attr("disabled", true);
            $("#create_customer_submit").text("Processing...");

            var formData = new FormData(this);

            $.ajax({
                url: "http://localhost:3000/includes/customer.php",
                type: "post",
                data: formData,
                contentType: false,
                processData: false,
                success: function (result) {
                    $("#create_customer_submit").attr("disabled", false);
                    $("#create_customer_submit").text("Create Customer");

                    var data = $.parseJSON(result);

                    if (data.status === "error") {
                        $("#form_error").html(data.msg);
                    }

                    if (data.status === "success") {
                        $("#form_success").html(data.msg);
                        $("#create_customer_form")[0].reset();
                    }
                }
            })

            e.preventDefault();
        })
    })
</script>

<?php require "./includes/footer.php"; ?>