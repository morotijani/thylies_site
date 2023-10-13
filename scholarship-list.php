<?php 
    require_once ("connection/conn.php");

    $title = 'Scholarhip List - ';
    $navbar = 'navbar-light';

    include ('inc/header.inc.php');
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
                                   <form action="">
                                       <input type="text" class="form-control" placeholder="search ..">
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
                                            <tr>
                                                <td>1</td>
                                               <td class="align-middle">
                                                  e5BZptmrBl
                                               </td>
                                               <td class="align-middle">2021-12-07</td>
                                               <td class="align-middle">American Express ending in 1234</td>
                                               <td class="align-middle"><a href="#"><i class="fe fe-download"></i></a></td>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                               <td class="align-middle">
                                                  4aS1taQR4F
                                               </td>
                                               <td class="align-middle">2021-11-07</td>
                                               <td class="align-middle">American Express ending in 1234</td>
                                               <td class="align-middle"><a href="#"><i class="fe fe-download"></i></a></td>
                                            </tr>
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