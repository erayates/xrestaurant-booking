<?php
if (isset($_GET['deleteSuccess'])) { ?>
    <div class="alert alert-danger col-xs-12" role="alert">
        <strong>SUCCESSFULL!</strong> You have deleted a menu item successfully.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true" style="color:red;">&times;</span>
        </button>
    </div>
<?php }
?>

<?php
if (isset($_GET['updateSuccess'])) { ?>
    <div class="alert alert-danger col-xs-12" role="alert">
        <strong>SUCCESSFULL!</strong> You have updated a menu item successfully.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true" style="color:red;">&times;</span>
        </button>
    </div>
<?php }
?>


<?php
if (isset($_GET['addSuccess'])) { ?>
    <div class="alert alert-danger col-xs-12" role="alert">
        <strong>SUCCESSFULL!</strong> You have added a new menu item successfully.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true" style="color:red;">&times;</span>
        </button>
    </div>
<?php }
?>

<div class="col-xs-12" style="overflow-x: auto;">
    <table class="table ">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Category</th>
                <th scope="col">Price</th>
                <th scope="col"></th>
            </tr>
        </thead>

        <tbody>
            <?php
            $query = "SELECT * FROM menu";
            $get_all_menu = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($get_all_menu)) {
                $item_id = htmlspecialchars($row['item_id']);
                $name = htmlspecialchars($row['name']);
                $description = htmlspecialchars($row['description']);
                $price = htmlspecialchars($row['price']);
                $category = htmlspecialchars($row['category']);
                $image = htmlspecialchars($row['image']);

            ?>
                <tr>
                    <th scope="row"><?php echo $item_id ?></th>
                    <td><img src="/xrestaurant-booking/assets/images/menu/<?php echo $image ?>" width="100" /></td>
                    <td><?php echo $name ?></td>
                    <td><?php echo $description ?></td>
                    <td><?php echo $category ?></td>
                    <td><?php echo $price ?></td>
                    <td>
                        <a href="menu.php?source=edit_menu_item&mid=<?php echo $item_id ?>" class="btn btn-primary">Edit</a>
                        <a href="menu.php?delete=<?php echo $item_id ?>" class="btn btn-danger" class="user_delete">Delete</a>
                    </td>


                </tr>
            <?php }
            ?>

            <?php
            if (isset($_GET['delete'])) {
                if (isAdmin()) {
                    $deleted_item_id = $_GET['delete'];
                    $query = "DELETE FROM menu WHERE item_id = {$deleted_item_id}";
                    $delete_query = mysqli_query($conn, $query);
                    if ($delete_query) {
                        header("Location: menu.php?deleteSuccess");
                    }
                }
            }

            ?>

        </tbody>

    </table>
</div>