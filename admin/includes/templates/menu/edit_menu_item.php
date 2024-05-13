<?php
if (isset($_POST['edit_menu_item'])) {
    $item_name = $_POST['name'];
    $item_description = $_POST['description'];
    $item_price = $_POST['price'];
    $item_category = $_POST['category'];
    $item_image = $_FILES['image']['name'];
    $item_image_temp = $_FILES['image']['tmp_name'];

    if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        // Handle the error
        echo "File upload failed with error code: {$_FILES['image']['error']}";
    }

    $upload_directory = $_SERVER['DOCUMENT_ROOT'] . "/xrestaurant-booking/assets/images/menu/";
    move_uploaded_file($item_image_temp, $upload_directory . $item_image);



    $name = escape($item_name);
    $description = escape($item_description);
    $price = escape($item_price);
    $category = escape($item_category);

    $query = "UPDATE menu SET ";
    $query .= "name = '{$name}', ";
    $query .= "description = '{$description}', ";
    $query .= "price = '{$price}', ";
    $query .= "category = '{$category}', ";
    $query .= "image = '{$item_image}' ";
    $query .= "WHERE item_id = {$_GET['mid']}";

    $update_menu_item = mysqli_query($conn, $query);
    if (confirmQuery($update_menu_item)) {
        header("Location: menu.php?updateSuccess");
        exit();
    }
}
?>

<?php
if (isset($_GET['mid'])) {
    $query = "SELECT * FROM menu WHERE item_id = {$_GET['mid']}";
    $get_menu_item = mysqli_query($conn, $query);
    confirmQuery($get_menu_item);
    while ($row = mysqli_fetch_assoc($get_menu_item)) {
        $item_id = htmlspecialchars($row['item_id']);
        $name = htmlspecialchars($row['name']);
        $description = htmlspecialchars($row['description']);
        $price = htmlspecialchars($row['price']);
        $category = htmlspecialchars($row['category']);
        $image = htmlspecialchars($row['image']);

?>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" id="name" value="<?php echo $name ?>">
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" class="form-control" name="description" id="description" value="<?php echo $description ?>">
            </div>

            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" class="form-control" name="price" id="price" value="<?php echo $price ?>">
            </div>


            <div class="form-group ">
                <label for="category">Category:</label>
                <select name="category" id="category">
                    <option value="starters">Starters</option>
                    <option value="salads">Salads</option>
                    <option value="specialty">Specialty</option>
                </select>
            </div>

            <div class="form-group">
                <label for="post_author">Image:</label>
                <img src="/xrestaurant-booking/assets/images/menu/<?php echo $image ?>" alt="<?php echo $name ?>" width=" 100">
                <input type="file" class="form-control" name="image" id="image">
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" name="edit_menu_item" value="Edit Item">
            </div>

        </form>

<?php }
}
?>