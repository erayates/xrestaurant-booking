<?php include_once("./includes/templates/header.php") ?>

<?php
if (isset($_POST['send_message'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $firstname = escape($firstname);
    $lastname = escape($lastname);
    $phone = escape($phone);
    $email = escape($email);
    $message = escape($message);

    if (preg_match($emailPattern, $email) && preg_match($mobilePattern, $phone)) {
        $query = "INSERT INTO messages(firstName,lastName,phone,email,message)";
        $query .= "VALUES('{$firstname}','{$lastname}','{$phone}','{$email}','{$message}')";
        $create_message_query = mysqli_query($conn, $query);

        if (confirmQuery($create_message_query)) {
            header("Location: contact-us.php?success");
            exit();
        }
    } else {
        header("Location: contact-us.php?invalidEmailOrPhone");
        exit();
    }
}
?>

<section class="page-hero">
    <div class="d-flex container flex-column justify-content-center align-items-center">
        <h2 class="h1 font-weight-bold">Contact Us</h2>
    </div>
</section>

<section id="map">
    <div>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3183.895932906358!2d35.35259237638858!3d37.059963053012886!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x15288dd594987ed3%3A0x56ee3443510a3144!2s%C3%87ukurova%20University!5e0!3m2!1sen!2str!4v1715890419470!5m2!1sen!2str" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</section>

<section class="section--space container mx-auto">
    <?php
    if (isset($_GET['success'])) {
        echo "
        <div class='alert alert-success alert-dismissible fade show text-center' role='alert'>
        <strong>SUCCESS!</strong> You have sent a message to our! We will contact with you as soon as possible.
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
        </div>";
        // header("refresh:2;url=contact-us.php");
    }

    if (isset($_GET['invalidEmailOrPhone'])) {
        echo "
        <div class='alert alert-danger alert-dismissible fade show text-center' role='alert'>
        <strong>ERROR!</strong> Invalid email or phone number!
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
        </div>";
        // header("refresh:2;url=contact-us.php");
    }
    ?>

    <div class="row">
        <div class="col-12 col-md-6">
            <h3 class="h2 font-weight-bold">
                Contact Details
            </h3>
            <div>
                <p>
                    <i class="fas fa-map-marker-alt"></i>
                    <span class="font-weight-bold">Address:</span>
                    <span>
                        Cukurova University,
                        <br>
                        Adana, Saricam
                    </span>
                </p>
                <p>
                    <i class="fas fa-phone-alt"></i>
                    <span class="font-weight-bold">Phone:</span>
                    <span>
                        +90 (044) 222-22-22
                    </span>
                </p>
                <p>
                    <i class="fas fa-envelope"></i>
                    <span class="font-weight-bold">E-mail:</span>
                    <span>
                        <a href="mailto:contact@xresto.com">contact@xresto.com </a>
                    </span>
                </p>

            </div>
        </div>

        <div class="col-12 col-md-6 mt-5 mt-md-0">
            <h3 class="h2 font-weight-bold">
                Contact Form
            </h3>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="firstname">Firstname: <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="firstname" id="firstname" required>
                </div>
                <div class="form-group">
                    <label for="lastname">Lastname: <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="lastname" id="lastname" required>
                </div>
                <div class="form-group">
                    <label for="email">E-mail: <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="email" id="email" required>
                </div>

                <div class="form-group">
                    <label for="phone" class="form-label">Phone: <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="phone" id="phone" pattern="[0][0-9]{10}" placeholder="05XXXXXXXXX" required>
                </div>

                <div class="form-group">
                    <label for="message">Message: <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="message" id="message" cols="30" rows="10" required style="resize: none;"></textarea>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="send_message" value="Send Message">
                </div>
            </form>
        </div>

    </div>
</section>

<?php include_once("./includes/templates/footer.php") ?>