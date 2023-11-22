<?php 
	require_once $_SERVER['DOCUMENT_ROOT'] . "/thylies_site/connection/conn.php";

    if (!admin_is_logged_in()) {
        admn_login_redirect();
    }

	include ('../includes/header.php');
	include ('../includes/left.side.bar.php');
	include ('../includes/top.nav.bar.php');
?>

	<!--  -->
	<header>
		<div class="container-fluid">
			<div class="border-bottom pt-6">
				<div class="row align-items-center">
					<div class="col-sm col-12">
						<h1 class="h2 ls-tight">
							<span class="d-inline-block me-3">❤</span>Gained, Sanitary Welfare view
						</h1>
					</div>
					<div class="col-sm-auto col-12 mt-4 mt-sm-0">
						<div class="hstack gap-2 justify-content-sm-end">
							<a href="<?= PROOT; ?>admin/gained" class="btn btn-sm btn-neutral border-base">
								<span class="pe-2"><i class="bi bi-arrow-clockwise"></i> </span>
								<span>Refresh</span> 
							</a>
							<a href="<?= PROOT; ?>admin/SW/" class="btn btn-sm btn-primary">
								<span class="pe-2"><i class="bi bi-arrow-left"></i> </span>
								<span>Go Back</span>
							</a>
						</div>
					</div>
				</div>
				<ul class="nav nav-tabs overflow-x border-0">
					<li class="nav-item"><a href="<?= PROOT; ?>admin/SW" class="nav-link">View all</a></li>
					<li class="nav-item"><a href="<?= PROOT; ?>admin/SW/rejected" class="nav-link">Rejected</a></li>
					<li class="nav-item"><a href="<?= PROOT; ?>admin/SW/gained" class="nav-link active">Gained</a></li>
				</ul>
			</div>
		</div>
	</header>

    <main class="py-6 bg-surface-secondary">
        <div class="container-fluid">
			<?= $flash; ?>
            <div class="vstack gap-4">
                <div class="d-flex flex-column flex-md-row gap-3 justify-content-between">
                    <div class="d-flex gap-3">
                        <div class="input-group input-group-sm input-group-inline">
                            <span class="input-group-text pe-2"><i class="bi bi-search"></i> </span>
                            <input type="text" class="form-control" id="search" placeholder="Search" aria-label="Search">
                        </div>
                        <div class="dropdown">
                            <button type="button" class="btn btn-sm px-3 btn-neutral d-flex align-items-center" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bi bi-clipboard-data-fill me-2"></i> 
                                <span>Export</span> 
                                <span class="vr opacity-20 mx-3"></span> 
                                <span class="text-xs text-primary">Data</span>
                            </button>
                            <div class="dropdown-menu">
                                <a href="<?= PROOT; ?>admin/SW/export/all/xlsx" class="dropdown-item">XLSX </a>
                                <a href="<?= PROOT; ?>admin/SW/export/all/xls" class="dropdown-item">XLS </a>
                                <a href="<?= PROOT; ?>admin/SW/export/all/csv" class="dropdown-item">CSV </a>
                            </div>
                        </div>
                    </div>
                    <div class="btn-group">
                        <a href="<?= PROOT; ?>admin/SW" class="btn btn-sm btn-neutral text-primary" aria-current="page">View all</a> 
                        <a href="<?= PROOT; ?>admin/SW/trash" class="btn btn-sm btn-neutral">Trash</a> 
                        <a href="<?= PROOT; ?>admin/SW/rejected" class="btn btn-sm btn-neutral">Rejected</a>
                    </div>
                </div>
                <div class="card">
                    <div id="load-content"></div>
                </div>
            </div>
        </div>
    </main>
	
<?php include ('../includes/footer.php'); ?>

<script>
    
    // SEARCH AND PAGINATION FOR LIST
    function load_data(page, query = '') {
        $.ajax({
            url : "<?= PROOT; ?>parsers/sw.gained.list.php",
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