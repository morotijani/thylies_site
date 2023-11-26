<?php 

    require_once $_SERVER['DOCUMENT_ROOT'] . "/thylies_site/connection/conn.php";

    if (!admin_is_logged_in()) {
        admn_login_redirect();
    }

    include ('includes/header.php');
    include ('includes/left.side.bar.php');
    include ('includes/top.nav.bar.php');

    $about_info = ((isset($_POST['about_info'])) ? sanitize($_POST['about_info']) : '');
    $query = "SELECT * FROM thylies_about";
    $statement = $conn->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row) {
        $about_info = ((isset($_POST['about_info'])) ? sanitize($_POST['about_info']): $row['about_info']);
    }

    if (isset($_POST['submit_form'])) {
        $about_info = $_POST['about_info'];

        if (empty($about_info) || $about_info == '') {
            echo js_alert("Empty field required.");
        } else {
            $updateQ = "
                UPDATE thylies_about
                SET about_info = :about_info
            ";
            $statement = $conn->prepare($updateQ);
            $update_result = $statement->execute([
                ':about_info'   => $about_info
            ]);

            if (isset($result)) {
                $_SESSION['flash_success'] = 'About us page has been successfully <span class="bg-info">UPDATED</span>';
                redirect(PROOT . 'admin/admin.about');
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

    
    </main>

    <!--  -->
    <header>
        <div class="container-fluid">
            <div class="border-bottom pt-6">
                <div class="row align-items-center">
                    <div class="col-sm col-12">
                        <h1 class="h2 ls-tight">
                            <span class="d-inline-block me-3">🏡</span>About, Thylies Ghana
                        </h1>
                    </div>
                    <div class="col-sm-auto col-12 mt-4 mt-sm-0">
                        <div class="hstack gap-2 justify-content-sm-end">
                            <a href="<?= PROOT; ?>admin/Scholarship/import" class="btn btn-sm btn-neutral border-base">
                                <span class="pe-2"><i class="bi bi-arrow-clockwise"></i> </span>
                                <span>Refresh</span> 
                            </a>
                            <a href="<?= PROOT; ?>admin/Scholarship" class="btn btn-sm btn-primary">
                                <span class="pe-2"><i class="bi bi-arrow-left"></i> </span>
                                <span>Go Back</span>
                            </a>
                        </div>
                    </div>
                </div>
                <ul class="nav nav-tabs overflow-x border-0">
                    <li class="nav-item"><a href="<?= PROOT; ?>admin/Scholarship/import" class="nav-link active">Import Data</a></li>
                    <li class="nav-item"><a href="<?= PROOT; ?>admin/Scholarship" class="nav-link">View all</a></li>
                    <li class="nav-item"><a href="<?= PROOT; ?>admin/Scholarship/rejected" class="nav-link">Rejected</a></li>
                    <li class="nav-item"><a href="<?= PROOT; ?>admin/Scholarship/gained" class="nav-link">Gained</a></li>
                </ul>
            </div>
        </div>
    </header>

    <main class="py-6 bg-surface-secondary">
        <div class="container-fluid">
            <?= $flash; ?>
            <div>
                <div class="row justify-content-center mt-10">
                    <div class="col-md-6">
                        <form method="POST">
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
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php 

    include ("includes/footer.inc.php");

?>
<script src="https://cdn.tiny.cloud/1/87lq0a69wq228bimapgxuc63s4akao59p3y5jhz37x50zpjk/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script type="text/javascript">
    // Testarea Editor
    tinymce.init({
        selector: '#about_info'
    });
</script>