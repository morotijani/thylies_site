<?php 
    require_once ("connection/conn.php");

    $title = 'Contact us - ';
    $navbar = 'navbar-light';

    include ('inc/header.inc.php');

    $contact_id = guidv4();
    $fname = ((isset($_POST['fname']) && !empty($_POST['fname'])) ? sanitize($_POST['fname']) : '');
    $lname = ((isset($_POST['lname']) && !empty($_POST['lname'])) ? sanitize($_POST['lname']) : '');
    $email = ((isset($_POST['email']) && !empty($_POST['email'])) ? sanitize($_POST['email']) : '');
    $message = ((isset($_POST['message']) && !empty($_POST['message'])) ? htmlspecialchars($_POST['message']) : '');

    $createdAt = date('Y-m-d H:m:s');

    if ($_POST) {
        // code...
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo js_alert("Email is not valid.");
        } else {
            $query = "
                INSERT INTO thylies_contacts (contact_id, fname, lname, email, message, createdAt) 
                VALUES (?, ?, ?, ?, ?, ?)
            ";
            $statement = $conn->prepare($query);
            $result = $statement->execute([$contact_id, $fname, $lname, $email, $message, $createdAt]);
            if (isset($result)) {
                // code...
                $name = ucwords($fname);
                $to = $email;
                $subject = "Message recieved.";
                $body = "
                    <h3>
                        {$name},</h3>
                    <p>
                        Thank you for contacting us, our team members and I do read every single email that comes through.
                        <br>
                        We will get in touch with you soon.
                        <br>
                        <br>
                        Best Regards,<br>
                        Thylies Ghana.
                    </p>
                ";
                send_email($name, $to, $subject, $body);
                echo js_alert('Message sent!');
            } else {
                echo js_alert('Something went wrong, please try again.');
            }
        }
    }

?>
     <!-- hero section -->
    <div class="bg-cover" style="background-image:linear-gradient(180deg, rgba(30, 24, 53, 0.4) 0%, rgba(30, 24, 53, 0.4) 90.16%),
            url(<?= PROOT; ?>assets/media/bg-1.jpg);">
        <div class="container">
            <div class="row">
                <div class="offset-lg-2 col-lg-8 col-md-12 col-12">
                    <div class="py-lg-20 py-12 text-white text-center">
                        <a class="popup-youtube icon-shape rounded-circle btn-play icon-xl
                                text-decoration-none mb-3" href="https://www.youtube.com/watch?v=JRzWRZahOVU">
                            <i class="fas fa-play"></i>
                        </a>
                        <!--heading-->
                        <h1 class="text-white mb-2 display-2">
                            Thylies Ghana
                        </h1>
                        <p class="mb-0 lead text-light mb-0">
                            world leading motivational speaker
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- about coach-->
    <div class="py-lg-16 py-6">
        <div class="container">
            <div class="row">
                <div class="offset-lg-2 col-lg-8 col-md-12 col-12">
                    <!--heading-->
                    <h2 class="mb-4">About Thylies</h2>
                    <!--para-->
                    <p>
                        My name is Coach and I want to get real with you for a minute.
                    </p>
                    <p>
                        I’ve always dreamed big, wanted to make something of my life, and deeply cared about people.
                    </p>
                    <p>
                        However, as a kid I suffered emotionally in a major way. I always felt like the dumbest person
                        in class.
                    </p>
                    <p>
                        I was tall, skinny, goofy looking, constantly made fun of and never felt I had any real friends
                        until later in high school.
                    </p>
                    <p>
                        Reading was a major challenge for me. I couldn’t comprehend and read out loud what I saw in
                        books. I was in the bottom of my class academically, insecure, and looking for ways to fit in.
                    </p>
                    <p>
                        There were many moments I didn’t understand why I was born; I was bullied, picked last in
                        sports, and experienced constant tension at home.
                    </p>
                    <!--para-->
                </div>
            </div>
        </div>
    </div>

<?php include ('inc/footer.inc.php'); ?>