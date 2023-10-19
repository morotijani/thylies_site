<?php 

    require_once ("../connection/conn.php");

    if (!user_is_logged_in()) {
        redirect(PROOT . 'auth/logout');
    }

    $title = 'Scholarship Status - ';
    include ("inc/user.header.inc.php");

	// list all scholarships applied
	$query = "
		SELECT * FROM thylies_scholarship 
		WHERE user_id = ? 
		AND submitted = ? 
		ORDER BY createdAt DESC
	";
	$statement = $conn->prepare($query);
	$statement->execute([$user_data["user_unique_id"], 1]);
	$count_list = $statement->rowCount();
	$row_list = $statement->fetchAll();

?>

	<div class="pb-12 mt-lg-n18 mt-n10">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-9 col-md-8 col-12">
					<div class="card rounded-3 mb-4 ">
						<div class="card-header bg-white p-4">
							<h3 class="mb-0 h4">Scholarship history</h3>
						</div>
						<div class="card-body p-4">
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
	                                	<?php if ($count_list > 0): ?>
	                                		<?php $i = 1; foreach ($row_list as $row): ?>
			                                	<tr>
			                                       <td><?= $i; ?></td>
			                                       <td class="align-middle"><?= $row["scholarship_id"]; ?></td>
			                                       <td class="align-middle"><?= ucwords($row["student_name"]); ?></td>
			                                       <td class="align-middle"><?= pretty_date($row["createdAt"]); ?></td>
			                                       <td class="align-middle"><a href="<?= PROOT; ?>scholarship-status/<?= $row["scholarship_id"]; ?>">view status</a></td>
	                                        	</tr>
	                                		<?php $i++; endforeach; ?>
	                                	<?php else: ?>
	                                		<tr>
	                                			<td rowspan="7">No scholarships applied at the moment, click <a href="<?= PROOT; ?>user/apply-scholarship">here</a> to apply now for free.</td>
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
	</div>

    <?php include ('../inc/footer.inc.php'); ?>

