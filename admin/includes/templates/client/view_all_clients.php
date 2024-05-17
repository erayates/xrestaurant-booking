<?php
if (isset($_GET['deleteSuccess'])) { ?>
    <div class="alert alert-danger col-xs-12" role="alert">
        <strong>SUCCESSFULL!</strong> You have deleted a client successfully.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true" style="color:red;">&times;</span>
        </button>
    </div>
<?php }
?>

<?php
if (isset($_GET['updateSuccess'])) { ?>
    <div class="alert alert-danger col-xs-12" role="alert">
        <strong>SUCCESSFULL!</strong> You have updated a client successfully.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true" style="color:red;">&times;</span>
        </button>
    </div>
<?php }
?>


<?php
if (isset($_GET['addSuccess'])) { ?>
    <div class="alert alert-danger col-xs-12" role="alert">
        <strong>SUCCESSFULL!</strong> You have added a client successfully.
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
                <th scope="col">Firstname</th>
                <th scope="col">Lastname</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Role</th>
                <th scope="col"></th>
            </tr>
        </thead>

        <tbody>
            <?php
            $query = "SELECT * FROM clients";
            $get_all_users = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($get_all_users)) {
                $client_id = htmlspecialchars($row['client_id']);
                $firstName = htmlspecialchars($row['firstName']);
                $lastName = htmlspecialchars($row['lastName']);
                $role = htmlspecialchars($row['role']);
                $phone = htmlspecialchars($row['phone']);
                $email = htmlspecialchars($row['email']);
            ?>
                <tr>
                    <th scope="row"><?php echo $client_id ?></th>
                    <td><?php echo $firstName ?></td>
                    <td><?php echo $lastName ?></td>
                    <td><?php echo $email ?></td>
                    <td><?php echo $phone ?></td>
                    <td><?php echo $role ?></td>
                    <td>
                        <a href="clients.php?source=edit_client&uid=<?php echo $client_id ?>" class="btn btn-primary">Edit</a>
                        <a href="clients.php?delete=<?php echo $client_id ?>" class="btn btn-danger" class="user_delete">Delete</a>
                    </td>


                </tr>
            <?php }
            ?>

            <?php
            if (isset($_GET['delete'])) {
                if (isAdmin()) {
                    $deleted_user_id = $_GET['delete'];
                    $query = "DELETE FROM clients WHERE client_id = {$deleted_user_id}";
                    $delete_query = mysqli_query($conn, $query);
                    header("Location: clients.php?deleteSuccess");
                }
            }

            ?>

        </tbody>

    </table>
</div>