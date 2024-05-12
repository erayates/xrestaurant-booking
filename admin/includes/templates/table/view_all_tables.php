<div class="col-xs-12" style="overflow-x: auto;">
    <table class="table ">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Capacity</th>
                <th scope="col">Status</th>
                <th scope="col"></th>
            </tr>
        </thead>

        <tbody>
            <?php
            $query = "SELECT * FROM tables";
            $get_all_tables = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($get_all_tables)) {
                $table_id = htmlspecialchars($row['table_id']);
                $name = htmlspecialchars($row['name']);
                $description = htmlspecialchars($row['description']);
                $capacity = htmlspecialchars($row['capacity']);
                $status = htmlspecialchars($row['status']);
            ?>


                <tr>
                    <th scope="row"><?php echo $table_id ?></th>
                    <td><?php echo $name ?></td>
                    <td><?php echo $description ?></td>
                    <td><?php echo $capacity ?></td>
                    <td><?php if ($status === "empty") { ?>
                            <span class='badge' style="background-color: blue;">Empty</span>
                        <?php } elseif ($status === "full") { ?>
                            <span class='badge' style="background-color: red;">Full</span>
                        <?php }
                        ?>
                    </td>
                    <td>
                        <a href="tables.php?source=edit_table&tid=<?php echo $table_id ?>" class="btn btn-primary">Edit</a>
                        <a href="tables.php?delete=<?php echo $table_id ?>" class="btn btn-danger" class="user_delete">Delete</a>
                    </td>


                </tr>
            <?php }
            ?>

            <?php
            if (isset($_GET['delete'])) {
                // isAdmin kontrolü tekrar eklenmeli
                $deleted_user_id = $_GET['delete'];
                $query = "DELETE FROM tables WHERE table_id = {$deleted_user_id}";
                $delete_query = mysqli_query($conn, $query);
                if ($delete_query) {
                    header("Location: tables.php?deleteSuccess");
                }
            }

            ?>

        </tbody>

    </table>
</div>