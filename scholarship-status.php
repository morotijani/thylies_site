<?php 
    require_once ("connection/conn.php");

    $title = 'Scholarhip List - ';
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
            we good
        </div>
    </section>

<?php
            } else {
                redirect(PROOT . 'auth/pay-registration');
            }
        } else {
            redirect(PROOT . 'scholarship-list');
        }
                
    }
?>
<?php include ('inc/footer.inc.php'); ?>