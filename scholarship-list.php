<?php 
    require_once ("connection/conn.php");

    $title = 'Scholarhip List - ';
    $navbar = 'navbar-light';

    include ('inc/header.inc.php');


    $sql = "
        SELECT * FROM thylies_scholarship 
        ORDER BY student_name ASC
    ";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $count_row = $statement->rowCount();
    $rows = $statement->fetchAll();
?>
        <section class="py-lg-13 py-6">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8">
                        <div class="card rounded-3 mb-4 ">
                            <div class="card-header bg-white p-4 border-bottom-0">
                               <h3 class="mb-0 h4">Scholarship List <?= date('Y'); ?></h3>
                               <br>
                               <div class="d-inline">
                                    <form action="" class="row">
                                        <div class="mb-3 mb-2 mb-lg-0 col-lg-10 col-md-10 col-12">
                                            <input type="text" class="form-control" placeholder="search with name, scholarship id ...">
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-12">
                                            <button class="btn btn-warning" type="submit">Search</button>
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
                                                <th scope="col" class="py-2 border-bottom-0">DATE</th>
                                                <th scope="col" class="py-2 border-bottom-0"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($count_row > 0): ?>
                                            <?php $i = 1; foreach ($rows as $row): ?>
                                                <tr>
                                                    <td><?= $i; ?></td>
                                                   <td class="align-middle">
                                                      <?= $row['scholarship_id']; ?>
                                                   </td>
                                                   <td class="align-middle"><?= ucwords($row['student_name']); ?></td>
                                                   <td class="align-middle"><?= pretty_date($row['createdAt']); ?></td>
                                                   <td class="align-middle"><a href="<?= PROOT; ?>scholarship-list/<?= $row['scholarship_id']; ?>">view status</a></td>
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
                        </div>
                    </div>
                </div>
            </div>

        </section>
<?php include ('inc/footer.inc.php'); ?>