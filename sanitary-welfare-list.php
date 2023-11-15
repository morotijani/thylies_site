<?php 
    require_once ("connection/conn.php");

    $title = 'Sanitary Welfare List - ';
    $navbar = 'navbar-light';

    include ('inc/header.inc.php');


    // FETCH ALL STUDENT WHO HAS GAIN SCHOLARSHIP
    $sql = "
        SELECT * FROM thylies_sanitary_welfare 
        WHERE status = ? 
        ORDER BY student_name ASC
    ";
    if (isset($_GET['q'])) {
        $string = sanitize($_GET['q']);
        $sql = "
            SELECT * FROM thylies_sanitary_welfare 
            WHERE scholarship_id LIKE '%{$string}%'
            OR student_name LIKE '%{$string}%'
            AND status = ? 
            AND percentage > ?
        ";
    }
    $statement = $conn->prepare($sql);
    $statement->execute([1, 0]);
    $count_row = $statement->rowCount();
    $rows = $statement->fetchAll();
?>
        <section class="py-lg-13 py-6">
            <div class="container">
                <div class="card rounded-3 mb-4 ">
                    <div class="card-header bg-white p-4 border-bottom-0">
                        <?php if (isset($_GET['scholarship'])): ?>
                        <?php else: ?>
                       <h3 class="mb-0 h4">Scholarship List <?= date('Y'); ?></h3>
                       <br>
                       <div class="d-inline">
                            <form action="" class="row" method="GET">
                                <div class="mb-3 mb-2 mb-lg-0 col-lg-10 col-md-10 col-12">
                                    <input type="text" name="q" class="form-control" placeholder="search with name, scholarship id ..." required>
                                </div>
                                <div class="col-lg-2 col-md-2 col-12">
                                    <button class="btn btn-warning">Search</button>
                                </div>
                           </form>
                       </div>
                    </div>
                    <div class="">
                        <div class="table-responsive border-0">
                            <table class="table mb-0 text-nowrap ">
                                <thead class="bg-light ">
                                    <tr>
                                        <th scope="col" class="py-2 border-bottom-0">#</th>
                                        <th scope="col" class="py-2 border-bottom-0">ID</th>
                                        <th scope="col" class="py-2 border-bottom-0">FULL NAME</th>
                                        <th scope="col" class="py-2 border-bottom-0">SCHOOL</th>
                                        <th scope="col" class="py-2 border-bottom-0">INDEX NUMBER</th>
                                        <th scope="col" class="py-2 border-bottom-0">DATE</th>
                                        <th scope="col" class="py-2 border-bottom-0"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($_GET['q'])): ?>
                                        <div class="d-flex justify-content-between">
                                            <p class="px-3 text-muted small">Search result for '<?= $string; ?>'</p>
                                            <p class="px-3 text-muted small"><a href="<?= PROOT; ?>scholarship-list"><< go back</a></p>
                                            
                                        </div>
                                    <?php endif ?>

                                    <?php if ($count_row > 0): ?>
                                    <?php $i = 1; foreach ($rows as $row): ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                           <td class="align-middle">
                                              <?= $row['scholarship_id']; ?>
                                           </td>
                                           <td class="align-middle"><?= ucwords($row['student_name']); ?></td>
                                           <td class="align-middle"><?= ucwords($row['school_name']); ?></td>
                                           <td class="align-middle"><?= $row['index_number']; ?></td>
                                           <td class="align-middle"><?= pretty_date($row['createdAt']); ?></td>
                                           <td class="align-middle"><a href="<?= PROOT; ?>auth/auth-scholarship-status/<?= $row['scholarship_id']; ?>">view status</a></td>
                                        </tr>
                                    <?php $i++; endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5">No data found.</td>
                                        </tr>
                                    <?php endif ?>
                                 </tbody>
                            </table>
                        </div>
                    </div>
                    <?php endif ?>
                </div>
                    
            </div>

        </section>
<?php include ('inc/footer.inc.php'); ?>