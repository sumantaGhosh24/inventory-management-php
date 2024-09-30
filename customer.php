<?php require "./includes/header.php"; ?>

<?php
if (!isset($_SESSION["USER_ID"])) {
    header("Location: login.php");
    die();
}
?>

<div class="min-h-screen pt-8 bg-white container mx-auto">
    <div class="overflow-x-scroll">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold mb-4 text-black text-center">Manage Customers</h2>
            <span id="form_error" class="text-red-500 font-bold text-center my-3"></span>
            <span id="form_success" class="text-green-500 font-bold text-center my-3"></span>
            <a href="/create-customer.php"
                class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors w-fit">Create
                Customer</a>
        </div>
        <table class="min-w-full bg-white rounded-lg shadow-md mx-auto mt-5">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">ID</th>
                    <th class="py-3 px-6 text-left">Fullname</th>
                    <th class="py-3 px-6 text-left">Email</th>
                    <th class="py-3 px-6 text-left">Mobile Number</th>
                    <th class="py-3 px-6 text-left">DOB</th>
                    <th class="py-3 px-6 text-left">Gender</th>
                    <th class="py-3 px-6 text-left">City</th>
                    <th class="py-3 px-6 text-left">State</th>
                    <th class="py-3 px-6 text-left">Country</th>
                    <th class="py-3 px-6 text-left">Zip</th>
                    <th class="py-3 px-6 text-left">Addressline</th>
                    <th class="py-3 px-6 text-left">Created At</th>
                    <th class="py-3 px-6 text-left">Updated At</th>
                    <th class="py-3 px-6 text-left">Actions</th>
                </tr>
            </thead>
            <tbody id="customers"></tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function () {
        function fetchCustomers() {
            $.ajax({
                url: "http://localhost:3000/includes/customer.php?admin=true",
                type: "get",
                success: function (result) {
                    let customers = $.parseJSON(result);

                    $("#customers").html("");

                    customers.forEach(customer => {
                        $("#customers").append(`
                            <tr>
                                <td class="py-3 px-6 text-left">${customer.id}</td>
                                <td class="py-3 px-6 text-left">${customer.fullname}</td>
                                <td class="py-3 px-6 text-left">${customer.email}</td>
                                <td class="py-3 px-6 text-left">${customer.mobileNumber}</td>
                                <td class="py-3 px-6 text-left">${customer.dob}</td>
                                <td class="py-3 px-6 text-left">${customer.gender}</td>
                                <td class="py-3 px-6 text-left">${customer.city}</td>
                                <td class="py-3 px-6 text-left">${customer.state}</td>
                                <td class="py-3 px-6 text-left">${customer.country}</td>
                                <td class="py-3 px-6 text-left">${customer.zip}</td>
                                <td class="py-3 px-6 text-left">${customer.addressline}</td>
                                <td class="py-3 px-6 text-left">${customer.createdAt}</td>
                                <td class="py-3 px-6 text-left">${customer.updatedAt}</td>
                                <td class="py-3 px-6 text-left flex items-center gap-3">
                                    <a href="./update-customer.php?id=${customer.id}" class="w-fit bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition-colors disabled:bg-green-200">Update</a>
                                    <form class="customer_delete_form">
                                        <button type="submit" class="w-fit bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition-colors disabled:bg-red-200">Delete</button>
                                        <input type="hidden" name="id" value="${customer.id}" />
                                        <input type="hidden" name="action" value="delete" />
                                    </form>
                                </td>
                            </tr>
                        `);
                    })
                }
            })
        }

        fetchCustomers();

        $(document).on("submit", ".customer_delete_form", function (e) {
            e.preventDefault();

            let form = $(this);
            let button = form.find("button[type='submit']");

            $("#form_error").html("");
            $("#form_success").html("");
            button.attr("disabled", true).text("Processing...");

            $.ajax({
                url: "http://localhost:3000/includes/customer.php",
                type: "post",
                data: form.serialize(),
                success: function (result) {
                    button.attr("disabled", false).text("Delete");

                    var data = $.parseJSON(result);

                    if (data.status === "error") {
                        $("#form_error").html(data.msg);
                    }

                    if (data.status === "success") {
                        $("#form_success").html(data.msg);
                        fetchCustomers();
                    }
                }
            })
        })
    })
</script>

<?php require "./includes/footer.php"; ?>