
    </main>

    <!-- footer -->
    <div class="footer pt-11 pb-3 bg-dark text-body">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="mb-4">
                        <h4 class="mb-4 text-white">About</h4>
                        <ul class="list-unstyled list-group">
                            <li class="list-group-item"><a href="<?= PROOT; ?>index" class="list-group-item-link">Thylies</a></li>
                            <li class="list-group-item"><a href="<?= PROOT; ?>scholarship-list" class="list-group-item-link">Scholarship list</a></li>
                            <li class="list-group-item"><a href="<?= PROOT; ?>student-in-business-list" class="list-group-item-link">Student in Business list</a></li>
                            <li class="list-group-item"><a href="<?= PROOT; ?>sanitary-welfare-list" class="list-group-item-link">Sanitary Welfare list</a></li>
                            <li class="list-group-item"><a href="<?= PROOT; ?>faq" class="list-group-item-link"> FAQ</a></li>
                            <li class="list-group-item"><a href="<?= PROOT; ?>contact-us" class="list-group-item-link">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="mb-4">
                        <h4 class="mb-4 text-white ">Resources</h4>
                        <ul class="list-unstyled list-group ">
                            <li class="list-group-item"><a href="<?= PROOT; ?>donate" class="list-group-item-link">Donate</a></li>
                            <li class="list-group-item"><a href="<?= PROOT; ?>scholarship" class="list-group-item-link">Scholarship</a></li>
                            <li class="list-group-item"><a href="<?= PROOT; ?>sanitary-welfare" class="list-group-item-link">Sanitary Welfare</a></li>
                            <li class="list-group-item"><a href="<?= PROOT; ?>student-in-business" class="list-group-item-link">Student in Business</a></li>
                            <li class="list-group-item"><a href="<?= PROOT; ?>auth/register" class="list-group-item-link">Join us</a></li>
                            <li class="list-group-item"><a href="<?= PROOT; ?>auth/login" class="list-group-item-link">Login</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="mb-4">
                        <h4 class="mb-4 text-white ">Follow Me</h4>
                        <ul class="list-unstyled list-group">
                            <li class="list-group-item"><a href="https://" class="list-group-item-link">Instagram</a></li>
                            <li class="list-group-item"><a href="https://" class="list-group-item-link"> Facebook</a></li>
                            <li class="list-group-item"><a href="https://" class="list-group-item-link"> LinkedIn</a></li>
                            <li class="list-group-item"><a href="https://" class="list-group-item-link">YouTube</a></li>
                            <li class="list-group-item"><a href="https://" class="list-group-item-link">Twitter</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-8 col-12">
                    <div class="mb-4">
                        <h4 class="mb-4 text-white">Subscribe to our newsletter</h4>
                        <div>
                            <p>Subscribe to get notified daily new motivational & inspiration tips.</p>
                            <form>
                                <div class="mb-3">
                                    <input type="email" name="subscribe" id="subscribe" class="form-control border-white" placeholder="Email Address" required>
                                </div>
                                <button type="button" onclick="subscribe_products(); return false;" class="btn btn-warning">Subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mt-8">
                        <ul class="list-inline">
                            <li class="list-inline-item">Copyright &copy; <script>document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))</script>
                            </span>Thylies, Ghana.</li>
                            <li class="list-inline-item"><a href="<?= PROOT; ?>privacy-policy" class="text-reset"> Privacy Policy </a></li>
                            <li class="list-inline-item"><a href="<?= PROOT; ?>terms" class="text-reset"> Terms</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->


    <!-- Libs JS -->
    <script src="<?= PROOT; ?>assets/js/jquery.min.js"></script>
    <script src="<?= PROOT; ?>assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?= PROOT; ?>assets/js/jquery.slimscroll.min.js"></script>



    <!-- Theme JS -->
    <script src="<?= PROOT; ?>assets/js/theme.min.js"></script>
    <script src="<?= PROOT; ?>assets/js/plyr.min.js"></script>

    <script>
        
        // Fade out messages
        $("#temporary").fadeOut(5000);

        // SUBSCRIBE TO NEW PRODUCTS
        function subscribe_products() {
            var email = $('#subscribe').val();

            if (email == '') {
                alert('Enter email to subscribe');
                return false;
            } else if (!isEmail(email)) {
                alert('Please enter a valid email.');
                return false;
            } else {
                $.ajax({
                    url : '<?= PROOT; ?>parsers/user_subscribe.php',
                    method : 'POST',
                    data : {email : email},
                    success : function(data) {
                        alert(data);
                        location.reload();
                    },
                    error : function() {
                        alert('Something went wrong.');
                    }
                });
            }

        }

        function isEmail(email) { 
            return /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))$/i.test(email);
        }
        
    </script>

</body>
</html>