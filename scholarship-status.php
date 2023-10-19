<?php 
    require_once ("connection/conn.php");

    $title = 'Scholarhip Status - ';
    $navbar = 'navbar-light';

    include ('inc/header.inc.php');

    if (isset($_GET['scholarship'])) {
        $id = sanitize($_GET['scholarship']);

        // check if id exist in scholarship table
        $sql = "
            SELECT * FROM thylies_scholarship 
            WHERE scholarship_id = ? 
            AND status = ? AND 
            percentage > ? 
            LIMIT 1
        ";
        $statement = $conn->prepare($sql);
        $statement->execute([$id, 1, 0]);
        $row = $statement->fetchAll();
        if ($statement->rowCount() > 0) {

            $status = '';
            $status_class = '';
            if ($row[0]['status'] == 0) {
                $status = 'Pending';
                $status_class = 'info';
            } else if ($row[0]['status'] == 1) {
                $status = 'Success';
                $status_class = 'success';
            } else {
                $status = 'Rejected';
                $status_class = 'danger';
            }

            // check if id also exist in transaction
            $Query = "
                SELECT * FROM thylies_scholarship_transaction 
                WHERE scholarship_id = ? 
                LIMIT 1
            ";
            $statement = $conn->prepare($Query);
            $statement->execute([$id]);
            $sub_row = $statement->fetchAll();
            $sub_count = $statement->rowCount();

            if ($sub_count) {
                // code...
?>

    <section class="py-lg-13 py-6">
        <div class="container">
            <p class="mb-0">
                ID: <h2><?= $row[0]['scholarship_id']; ?></h2>
                Status: <h2 class="text-<?= $status_class; ?>"><?= $status; ?></h2>
                <br><br><a href="<?= PROOT; ?>scholarship-list">view all list.</a>
            </p>
        </div>
    </section>

<?php
            } else {
                redirect(PROOT . 'auth/pay-scholarship-fee/' . $id);
            }
        } else {
            redirect(PROOT . 'scholarship-list');
        }
                
    }
?>
<?php include ('inc/footer.inc.php'); ?>