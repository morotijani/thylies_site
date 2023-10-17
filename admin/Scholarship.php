<?php 
	require ('./../connection/conn.php');

	include ('includes/header.php');
	include ('includes/left.side.bar.php');
	include ('includes/top.nav.bar.php');

    //
    $sql = "
        SELECT * FROM thylies_scholarship 
        ORDER BY createdAt DESC
    ";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $row = $statement->fetchAll();
    $count_row = $statement->rowCount();
	
?>

	<!--  -->
	<header>
		<div class="container-fluid">
			<div class="border-bottom pt-6">
				<div class="row align-items-center">
					<div class="col-sm col-12">
						<h1 class="h2 ls-tight">
							<span class="d-inline-block me-3">😎</span>Scholarhip, List view
						</h1>
					</div>
					<div class="col-sm-auto col-12 mt-4 mt-sm-0">
						<div class="hstack gap-2 justify-content-sm-end">
							<a href="<?= PROOT; ?>admin/Scholarship-import" class="btn btn-sm btn-neutral border-base">
								<span class="pe-2"><i class="bi bi-arrow-clockwise"></i> </span>
								<span>Refresh</span> 
							</a>
							<a href="<?= PROOT; ?>admin/index" class="btn btn-sm btn-primary">
								<span class="pe-2"><i class="bi bi-arrow-left"></i> </span>
								<span>Go Back</span>
							</a>
						</div>
					</div>
				</div>
				<ul class="nav nav-tabs overflow-x border-0">
					<li class="nav-item"><a href="<?= PROOT; ?>admin/Scholarship-import" class="nav-link">Import Data</a></li>
					<li class="nav-item"><a href="<?= PROOT; ?>admin/Scholarship" class="nav-link active">View all</a></li>
					<li class="nav-item"><a href="<?= PROOT; ?>admin/Scholarship/rejected" class="nav-link">Rejected</a></li>
					<li class="nav-item"><a href="<?= PROOT; ?>admin/Scholarship/accepted" class="nav-link">Accpted</a></li>
				</ul>
			</div>
		</div>
	</header>

	<main class="py-6 bg-surface-secondary">
		<div class="container-fluid">
			<?= $flash; ?>
			<div>
				
			</div>
		</div>
	</main>

    <main class="py-6 bg-surface-secondary">
        <div class="container-fluid">
            <div class="vstack gap-4">
                <div class="d-flex flex-column flex-md-row gap-3 justify-content-between">
                    <div class="d-flex gap-3">
                        <div class="input-group input-group-sm input-group-inline">
                            <span class="input-group-text pe-2"><i class="bi bi-search"></i> </span>
                            <input type="text" class="form-control" id="search" placeholder="Search" aria-label="Search">
                        </div>
                        <div>
                            <button type="button" class="btn btn-sm px-3 btn-neutral d-flex align-items-center">
                                <i class="bi bi-funnel me-2"></i> 
                                <span>Filters</span> 
                                <span class="vr opacity-20 mx-3"></span> 
                                <span class="text-xs text-primary">2</span>
                            </button>
                        </div>
                    </div>
                    <div class="btn-group">
                        <a href="#" class="btn btn-sm btn-neutral text-primary" aria-current="page">View all</a> 
                        <a href="<?= PROOT; ?>admin/Scholarship/trash" class="btn btn-sm btn-neutral">Trash</a> 
                        <a href="<?= PROOT; ?>admin/Scholarship/rejected" class="btn btn-sm btn-neutral">Rejected</a>
                    </div>
                </div>
                <div class="card">
                    <div id="load-content"></div>
                    
                </div>
            </div>
        </div>
    </main>
	
<?php include ('includes/footer.php'); ?>

<script>
    
    // SEARCH AND PAGINATION FOR CONTESTANTS
    function load_data(page, query = '') {
        $.ajax({
            url : "<?= PROOT; ?>/parsers/get.scholarship.list.php",
            method : "POST",
            data : {
                page : page, 
                query : query
            },
            success : function(data) {
                $("#load-content").html(data);
            }
        });
    }

    load_data(1);
    $('#search').keyup(function() {
        var query = $('#search').val();
        load_data(1, query);
    });

    $(document).on('click', '.page-link-go', function() {
        var page = $(this).data('page_number');
        var query = $('#search').val();
        load_data(page, query);
    });
</script>