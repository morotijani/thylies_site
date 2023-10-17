<?php 

// SEARCH FOR CONTESTANTS

// DATABASE CONNECTION
    require_once $_SERVER['DOCUMENT_ROOT'] . "/thylies_site/connection/conn.php";


$limit = 10;
$page = 1;

if ($_POST['page'] > 1) {
	$start = (($_POST['page'] - 1) * $limit);
	$page = $_POST['page'];
} else {
	$start = 0;
}

$query = "
	SELECT * FROM thylies_scholarship 
";
$search_query = ((isset($_POST['query'])) ? sanitize($_POST['query']) : '');
$find_query = str_replace(' ', '%', $search_query);
if ($search_query != '') {
	$query .= '
		WHERE scholarship_id LIKE "%'.$find_query.'%" 
		OR student_name LIKE "%'.$find_query.'%" 
		OR student_dob LIKE "%'.$find_query.'%" 
		OR student_age LIKE "%'.$find_query.'%" 
		OR index_number LIKE "%'.$find_query.'%" 
		AND trash = 0 
	';
} else {
	$query .= 'ORDER BY createdAt DESC ';
}

$filter_query = $query . 'LIMIT ' . $start . ', ' . $limit . '';

$total_data = $conn->query("SELECT * FROM thylies_scholarship WHERE trash = 0")->rowCount();

$statement = $conn->prepare($filter_query);
$statement->execute();
$result = $statement->fetchAll();
$count_filter = $statement->rowCount();

$output = ' 
	<div class="card-header border-bottom d-flex align-items-center">
        <h5 class="me-auto">All list ' . $total_data . '</h5>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-nowrap">
            <thead class="table-light">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Created Date</th>
                    <th scope="col">Index Number</th>
                    <th scope="col">School</th>
                    <th scope="col">Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
';

if ($total_data > 0) {
	$i = 1;
	foreach ($result as $row) {
		
		$profile = 'svg/friendly-ghost.svg';
		if ($row["student_picture"] != '') {
			$profile = 'scholarship/' . $row["student_picture"];
		}

		$percentage = '0%';
		$percentageColor = 'default';
		if ($row['percentage'] >= 15) {
			$percentage = $row['percentage'];
			$percentageColor = 'danger';
		} else if ($percentage >= 25) {
			$percentage = $row['percentage'];
			$percentageColor = 'warning';
		}  else if ($percentage <= 40) {
			$percentage = $row['percentage'];
			$percentageColor = 'info';
		}   else if ($percentage >= 60) {
			$percentage = $row['percentage'];
			$percentageColor = 'primary';
		}    else if ($percentage >= 80) {
			$percentage = $row['percentage'];
			$percentageColor = 'success';
		}

		$output .= '
			<tr>
                <td>
                    <img alt="..." src="' . PROOT . 'assets/media/' . $profile . '" class="avatar avatar-sm rounded-circle me-2"> 
                    <a class="text-heading font-semibold" href="' . PROOT . 'admin/Scholarship-view/' . $row["scholarship_id"] . ' ">' . ucwords($row["student_name"]) . '</a>
                </td>
                <td>' . $row["student_dob"] . '</td>
                <td>
                    <span class="badge badge-lg badge-dot"><i class="bg-warning"></i>' . $row["index_number"] . '</span>
                </td>
                <td>' . $row["school_name"] . '</td>
                <td>
                    <div class="d-flex align-items-center">
                        <span class="me-2">' . $percentage . '%</span>
                        <div>
                            <div class="progress" style="width:100px">
                                <div class="progress-bar bg-' . $percentageColor . '" role="progressbar" aria-valuenow="38" aria-valuemin="0" aria-valuemax="100" style="width:' . $percentage . '%"></div>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="text-end">
                    <a href="' . PROOT . 'admin/Scholarship-view/' . $row["scholarship_id"] . '" class="btn btn-sm btn-neutral">View</a> 
                    <button type="button" class="btn btn-sm btn-square btn-neutral text-danger-hover">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            </tr>
		';
		$i++;
	}

} else {
	$output .= '
		<tr class="text-warning">
			<td colspan="5">No data found!</td>
		</tr>
	';
}

$output .= '
			</tbody>
        </table>
    </div>
   	<div class="card-footer border-0 py-5">
        <span class="text-muted text-sm">Showing ' . $count_filter . ' items out of ' . $total_data . ' results found</span>
    </div>
';

if ($total_data > 0) {
	$output .= '
		<div class="my-4 mx-4">
			<ul class="pagination">
	';

	$total_links = ceil($total_data / $limit);

	$previous_link = '';
	$next_link = '';
	$page_link = '';

	if ($total_links > 4) {
		if ($page < 5) {
			for ($count = 1; $count <= 5; $count++) {
				$page_array[] = $count;
			}
			$page_array[] = '...';
			$page_array[] = $total_links;
		} else {
			$end_limit = $total_links - 5;
			if ($page > $end_limit) {
				$page_array[] = 1;
				$page_array[] = '...';

				for ($count = $end_limit; $count <= $total_links; $count++) {
					$page_array[] = $count;
				}
			} else {
				$page_array[] = 1;
				$page_array[] = '...';
				for ($count = $page - 1; $count <= $page + 1; $count++) {
					$page_array[] = $count;
				}
				$page_array[] = '...';
				$page_array[] = $total_links;
			}
		}
	} else {
		for ($count = 1; $count <= $total_links; $count++) {
			$page_array[] = $count;
		}
	}

	for ($count = 0; $count < count($page_array); $count++) {
		if ($page == $page_array[$count]) {
			$page_link .= '
				<li class="page-item active">
					<a class="page-link" href="javascript:;">'.$page_array[$count].'</a>
				</li>
			';

			$previous_id = $page_array[$count] - 1;
			if ($previous_id > 0) {
				$previous_link = '
					<li class="page-item">
						<a class="page-link page-link-go" href="javascript:;" data-page_number="'.$previous_id.'">Previous</a>
					</li>
				';
			} else {
				$previous_link = '
					<li class="page-item disabled">
						<a class="page-link page-link-go" href="javascript:;">Previous</a>
					</li>
				';
			}

			$next_id = $page_array[$count] + 1;
			if ($next_id >= $total_links) {
				$next_link = '
					<li class="page-item disabled">
						<a class="page-link page-link-go" href="javascript:;">Next</a>
					</li>
				';
			} else {
				$next_link = '
					<li class="page-item">
						<a class="page-link page-link-go" href="javascript:;" data-page_number="'.$next_id.'">Next</a>
					</li>
				';
			}

		} else {
			
			if ($page_array[$count] == '...') {
				$page_link .= '
					<li class="page-item disabled">
						<a class="page-link" href="javascript:;">...</a>
					</li>
				';
			} else {
				$page_link .= '
					<li class="page-item">
						<a class="page-link page-link-go" href="javascript:;" data-page_number="'.$page_array[$count].'">'.$page_array[$count].'</a>
					</li>
				';
			}
		}

	}

	$output .= $previous_link. $page_link . $next_link;
}

echo $output;
