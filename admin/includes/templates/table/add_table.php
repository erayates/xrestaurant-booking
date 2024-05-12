<form method="POST" action="functions.php" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Name: <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="name" id="name" required>
    </div>

    <div class="form-group">
        <label for="description">Description: <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="description" id="description" required>
    </div>

    <div class="form-group ">
        <label for="capacity">Capacity: <span class="text-danger">*</span></label>
        <select name="capacity" id="capacity" required>
            <option value=1>1</option>
            <option value=2>2</option>
            <option value=3>3</option>
            <option value=4>4</option>
            <option value=5>5</option>
            <option value=6>6</option>
            <option value=7>7</option>
            <option value=8>8</option>
        </select>
    </div>

    <div class="form-group ">
        <label for="status">Status: <span class="text-danger">*</span></label>
        <select name="status" id="status" required>
            <option value="empty">Empty</option>
            <option value="full">Full</option>
        </select>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_table" value="Create Table">
    </div>

</form>