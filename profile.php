<?php require "./includes/header.php"; ?>

<?php
if (!isset($_SESSION["USER_ID"])) {
    header("Location: login.php");
    die();
}
?>

<div class="bg-white min-h-screen my-20">
    <div class="container mx-auto">
        <div class="bg-white shadow-md p-5 rounded">
            <h1 class="text-2xl font-semibold mb-4 text-black">User Details</h1>
            <div class="flex flex-col gap-3" id="view_details"></div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        function fetchProfile() {
            $.ajax({
                url: "http://localhost:3000/includes/auth.php",
                type: "get",
                success: function (result) {
                    var data = $.parseJSON(result);

                    $("#view_details").html("");

                    $("#view_details").append(`<img src="/uploads/${data.filename}" alt="avatar" class="w-24 h-24 rounded-full" />`);
                    $("#view_details").append(`<p class="text-black"><strong>Id:</strong> <span>${data.id}</span></p>`);
                    $("#view_details").append(`<p class="text-black"><strong>Username:</strong> <span>${data.username}</span></p>`);
                    $("#view_details").append(`<p class="text-black"><strong>Name:</strong> <span>${data.firstName} ${data.lastName}</span></p>`);
                    $("#view_details").append(`<p class="text-black"><strong>Email:</strong> <span>${data.email}</span></p>`);
                    $("#view_details").append(`<p class="text-black"><strong>Mobile Number:</strong> <span>${data.mobileNumber}</span></p>`);
                    $("#view_details").append(`<p class="text-black"><strong>DOB:</strong> <span>${data.dob}</span></p>`);
                    $("#view_details").append(`<p class="text-black"><strong>Gender:</strong> <span>${data.gender}</span></p>`);
                    $("#view_details").append(`<p class="text-black"><strong>City:</strong> <span>${data.city}</span></p>`);
                    $("#view_details").append(`<p class="text-black"><strong>State:</strong> <span>${data.state}</span></p>`);
                    $("#view_details").append(`<p class="text-black"><strong>Country:</strong> <span>${data.country}</span></p>`);
                    $("#view_details").append(`<p class="text-black"><strong>Zip:</strong> <span>${data.zip}</span></p>`);
                    $("#view_details").append(`<p class="text-black"><strong>Addressline:</strong> <span>${data.addressline}</span></p>`);
                    $("#view_details").append(`<p class="text-black" ><strong>Status:</strong> <span class="capitalize font-extrabold">${data.status}</span></p>`);
                    $("#view_details").append(`<p class="text-black"><strong>Role:</strong> <span class="capitalize font-extrabold">${data.role}</span></p>`);
                    $("#view_details").append(`<p class="text-black"><strong>Created At:</strong> <span>${data.createdAt}</span></p>`);
                    $("#view_details").append(`<p class="text-black"><strong>Updated At:</strong> <span>${data.updatedAt}</span></p>`);
                }
            })
        }

        fetchProfile();
    })
</script>

<?php require "./includes/footer.php"; ?>