<?php include 'header.php' ?>

<!-- PHP context to send mail -->
<?php
// echo $_SERVER['REQUEST_METHOD'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email_from = $_POST['email'];
    $subject = $_POST['subject'];
    $body = $_POST['message'];
    $headers = "Email from: $email_from";

    $to_email = "kumar.pratik2402@outlook.com";
    $message =
        "Contact Query from the user:
        Name: " . $firstname . " " . $lastname . "
        Message: " . $body . "";

    if (mail($to_email, $subject, $message, $headers)) {
        echo "<div class='alert alert-success' role='alert'>
            <strong>Success!</strong> message has been sent.
          </div>
          </div";
    } else {
        echo "<div class='alert alert-danger' role='alert'>
        <strong>Failure!</strong> author did not recieved the mail.
      </div>
      </div";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Me</title>
    <link rel="stylesheet" href="/css/contact.css">
</head>

<body>
    <div class="container">
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
            <label for="fname">First Name</label>
            <input type="text" id="fname" name="firstname" placeholder="Your name..">

            <label for="lname">Last Name</label>
            <input type="text" id="lname" name="lastname" placeholder="Your last name..">

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Your email id..">

            <label for="subject">Subject</label>
            <input type="text" id="subject" name="subject" placeholder="On what matter are you contacting..">

            <label for="message">Message</label>
            <textarea id="message" name="message" placeholder="Write something.." style="height:200px"></textarea>

            <input type="submit" value="submit">
        </form>
    </div>
</body>

</html>
<?php include 'footer.php' ?>