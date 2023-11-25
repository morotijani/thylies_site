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
    <div class="bg-shape bg-cover" style=" background-image:linear-gradient(180deg, rgba(30, 24, 53, 0.4) 0%, rgba(30, 24, 53, 0.4) 90.16%),
       url(<?= PROOT; ?>assets/media/bg-4.jpg); ">
        <div class="container">
            <div class="row">
                <div class="offset-lg-2 col-lg-8 col-md-12 col-12">
                    <div class="text-center py-lg-20 py-12">
                        <h1 class="mb-3 display-4 text-white">Get Connect</h1>
                        <p class="lead text-light mb-4 mb-lg-0">
                            Our team gets hundreds of emails, notes, and requests for different opportunities every day.
                            And yes, our team members and I do read every single email that comes through.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- conatc form -->
    <div class="pb-16">
        <div class="container">
            <div class="row">
                <div class="offset-lg-2 col-lg-8 col-md-12 col-12">
                    <div class="card mt-n12 text-center mb-12">
                        <div class="card-body p-4 p-lg-8">
                            <div class="mb-5">
                                <h2 class="mb-3">We love Hearing From You</h2>
                                <p>
                                    If you are looking to reach out to us or for advice, please fill out this form. We will <br>find you and
                                    get in touch.
                                </p>
                            </div>
                            <form class="row" method="POST">
                                <div class=" col-md-6 col-12 mb-3">
                                    <label for="fname" class="sr-only">First Name</label>
                                    <input type="text" class="form-control" name="fname" id="fname" placeholder="First Name"
                                        name="fname" required>
                                </div>
                                <div class=" col-md-6 col-12 mb-3">
                                    <label for="lname" class="sr-only">Last Name</label>
                                    <input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name"
                                        name="lname">
                                </div>
                                <div class=" col-12 mb-3">
                                    <label for="email" class="sr-only"> Email</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" name="email"
                                        required>
                                </div>
                                <div class="mb-3 col-12 mb-3">
                                    <label for="message" class="sr-only">Message</label>
                                    <textarea name="message" class="form-control" id="message" cols="30" rows="10" required></textarea>
                                </div>
                                <div class="col-12">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-warning">
                                            Send Messages
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- contact info -->
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="text-center mb-6 mb-md-0">
                                <h4 class="h5 mb-2">Speaking inquiries:</h4>
                                <p class="text-warning fw-bold">123-456-7890</p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="text-center  mb-6 mb-md-0">
                                <h4 class="h5 mb-2">Business inquiries:</h4>
                                <a href="#" class="text-warning fw-bold">info@thylies.com</a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="text-center">
                                <h4 class="h5 mb-2">Press Contact:</h4>
                                <a href="#" class="text-warning fw-bold">contact-us@thylies.com
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- social media -->
                    <div class="row">
                        <div class="offset-lg-3 col-lg-6 col-md-12 col-12">
                            <div class="text-center mt-14">
                                <h4 class="mb-4">Follow us on</h4>
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <a href="" class="social-btn sb-facebook sb-round btn-light text-warning"><i
                                                class="fab fa-facebook-f"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="" class="social-btn sb-twitter sb-round btn-light text-warning"><i
                                                class="fab fa-twitter"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="" class="social-btn sb-linkedin sb-round btn-light text-warning"><i
                                                class="fab fa-linkedin"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="" class="social-btn sb-youtube sb-round btn-light text-warning"><i
                                                class="fab fa-youtube"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="" class="social-btn sb-instagram sb-round btn-light text-warning"><i
                                                class="fab fa-instagram"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include ('inc/footer.inc.php'); ?>