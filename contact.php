<?php include 'header.php' ?>

<!-- PHP context to send mail -->
<?php
// echo $_SERVER['REQUEST_METHOD'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['submit'])){
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email_from = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
    
        $to_email = "pratik.kumar2402@gmail.com";
        $desc =
            "Contact Query from the user:
        Name: " . $firstname . " " . $lastname . "
        Email: " . $email_from . "
        Message: " . $message . "";
    
        if (mail($to_email, $subject, $desc)) {
            echo "<div class='alert alert-success' role='alert'>
            <strong>Success!</strong> author has been informed.
          </div>
          </div";
        } else {
            echo "Email sending failed...";
        }
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
        <form action="contact.php" method="POST">
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

            <input type="submit" value="Submit">
        </form>
    </div>
</body>

</html>
<?php include 'footer.php' ?>