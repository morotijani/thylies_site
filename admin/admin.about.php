<?php 

    require_once $_SERVER['DOCUMENT_ROOT'] . "/thylies_site/connection/conn.php";

    if (!admin_is_logged_in()) {
        admn_login_redirect();
    }

    include ("includes/header.inc.php");
    include ("includes/nav.inc.php");
    include ("includes/left-side-bar.inc.php");

    $about_info = ((isset($_POST['about_info']))?sanitize($_POST['about_info']):'');
    $query = "SELECT * FROM mifo_about";
    $statement = $conn->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
        $about_info = ((isset($_POST['about_info']))?sanitize($_POST['about_info']):$row['about_info']);
    }

    if (isset($_POST['submit_form'])) {
        $about_info = $_POST['about_info'];

        if (empty($about_info) || $about_info == '') {
            echo '<script>alert("Empty field required.");</script>';
        } else {
            $updateQ = "
                UPDATE mifo_about
                SET about_info = :about_info
            ";
            $statement = $conn->prepare($updateQ);
            $update_result = $statement->execute([
                ':about_info'   => $about_info
            ]);

            if (isset($result)) {
                $_SESSION['flash_success'] = 'About us page has been successfully <span class="bg-info">UPDATED</span>';
               echo '<script>window.location = "'.PROOT.'admin/about";</script>';
            }
        }

    }


?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">About us.</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <a href="<?= PROOT; ?>admin/about" class="btn btn-sm btn-outline-secondary">Refresh</a>
                    <a href="<?= PROOT; ?>admin/contacts" class="btn btn-sm btn-outline-secondary">Contacts</a>
                </div>
                <a href="<?= PROOT; ?>admin/index" class="btn btn-sm btn-outline-secondary">
                    <span data-feather="home"></span>
                    Home
                </a>
            </div>
        </div>
        <span><?= $flash; ?></span>

        
        <form method="POST" action="about.php">
            <div class="form-group mb-2">
                <label>Update about us.</label>
                <textarea class="form-control" rows="15" name="about_info" id="about_info">
                    <?= $about_info; ?>
                </textarea>
                <div class="form-text">After, it will update itself on the user page. click <a href="<?= PROOT; ?>about-us" target="blank">here...</a> to see changes</div>
            </div>
            <div class="form-group">
                <button class="btn btn-info" type="submit" name="submit_form" id="submit_form">Update.</button>
            </div>
        </form>
    </main>
<?php 

    include ("includes/footer.inc.php");

?>


<script type="text/javascript">
    // Testarea Editor
    tinymce.init({
        selector: '#about_info'
    });
</script>