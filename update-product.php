<?php require "./includes/header.php"; ?>

<?php
if (!isset($_SESSION["USER_ID"])) {
    header("Location: login.php");
    die();
}
?>

<div class="flex justify-center items-center bg-white my-20">
    <div class="bg-white rounded-lg shadow-md p-8 shadow-black w-[75%]">
        <h1 class="text-3xl font-semibold mb-5 text-black">Update Product</h1>
        <span id="form_error" class="text-red-500 font-bold text-center my-3 error_field"></span>
        <span id="form_success" class="text-green-500 font-bold text-center my-3 error_field"></span>
        <form class="mb-6" id="update_product_form">
            <div class="mb-4">
                <label for="title" class="text-black">Product Title:</label>
                <input type="text" class="w-full px-4 py-2 rounded-md border border-gray-300"
                    placeholder="Enter product title" name="title" id="title" />
            </div>
            <div class="mb-4">
                <label for="description" class="text-black">Product Description:</label>
                <textarea placeholder="Enter product description" name="description" id="description"
                    class="w-full px-4 py-2 rounded-md border border-gray-300 resize-y"></textarea>
            </div>
            <div class="mb-4">
                <label for="price" class="text-black">Product Price:</label>
                <input type="text" class="w-full px-4 py-2 rounded-md border border-gray-300"
                    placeholder="Enter product price" name="price" id="price" />
            </div>
            <div class="mb-4">
                <label for="stock" class="text-black">Product Stock:</label>
                <input type="text" class="w-full px-4 py-2 rounded-md border border-gray-300"
                    placeholder="Enter product stock" name="stock" id="stock" />
            </div>
            <div class="mb-4">
                <label for="category" class="text-black">Product Category:</label>
                <select name="category" id="category" class="mb-2 w-full px-4 py-2 rounded-md border border-gray-300">
                    <option value="">Select Category</option>
                </select>
            </div>
            <input type="hidden" name="action" value="update" />
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
            <button type="submit" id="update_product_submit"
                class="w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors disabled:bg-blue-200">Update
                Product</button>
        </form>
    </div>
</div>

<script>
    $(document).ready(function () {
        function fetchCategories() {
            $.ajax({
                url: "http://localhost:3000/includes/category.php?admin=true",
                type: "get",
                success: function (result) {
                    let categories = $.parseJSON(result);

                    categories.forEach(category => {
                        $("#category").append(`
                            <option value="${category.id}">${category.name}</option>
                        `);
                    })
                }
            })
        }

        fetchCategories();

        function fetchProduct() {
            $.ajax({
                url: "http://localhost:3000/includes/product.php?id=<?php echo $_GET['id']; ?>",
                type: "get",
                success: function (result) {
                    var data = $.parseJSON(result);

                    $("#title").val(data.title);
                    $("#description").val(data.description);
                    $("#category").val(data.category.id);
                    $("#price").val(data.price);
                    $("#stock").val(data.stock);
                }
            })
        }

        fetchProduct();

        $("#update_product_form").on("submit", function (e) {
            $(".error_field").html("");
            $("#update_product_submit").attr("disabled", true);
            $("#update_product_submit").text("Processing...");

            $.ajax({
                url: "http://localhost:3000/includes/product.php",
                type: "post",
                data: $("#update_product_form").serialize(),
                success: function (result) {
                    $("#update_product_submit").attr("disabled", false);
                    $("#update_product_submit").text("Update Product");

                    var data = $.parseJSON(result);

                    if (data.status === "error") {
                        $("#form_error").html(data.msg);
                    }

                    if (data.status === "success") {
                        $("#form_success").html(data.msg);
                        fetchProduct();
                    }
                }
            })

            e.preventDefault();
        })
    })
</script>

<?php require "./includes/footer.php"; ?>