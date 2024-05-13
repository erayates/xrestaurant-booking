<form method="POST" action="functions.php" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Name: <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="name" id="name" required>
    </div>

    <div class="form-group">
        <label for="description">Description: <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="description" id="description" required>
    </div>

    <div class="form-group">
        <label for="price">Price: <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="price" id="price" required>
    </div>


    <div class="form-group ">
        <label for="category">Category: <span class="text-danger">*</span></label>
        <select name="category" id="category">
            <option value="starters">Starters</option>
            <option value="salads">Salads</option>
            <option value="specialty">Specialty</option>
        </select>
    </div>

    <div class="form-group">
        <label for="post_author">Image: <span class="text-danger">*</span></label>
        <input type="file" class="form-control" name="image" id="image" required>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_menu_item" value="Create Item">
    </div>

</form>