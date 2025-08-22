<?php echo $header; ?><?php echo $column_left; ?>
<div id="content" class="storage-cell service">
	<div class="page-header">
		<div class="container-fluid">
			<div class="pull-right">
				<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
			</div>
			<h1><?php echo $heading_title; ?></h1>
			<ul class="breadcrumb">
				<?php foreach ($breadcrumbs as $breadcrumb) { ?>
					<li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
				<?php } ?>
			</ul>
		</div>
	</div>
	<div class="container-fluid">
		<?php if ($error_warning) { ?>
			<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
				<button type="button" class="close" data-dismiss="alert">&times;</button>
			</div>
		<?php } ?>
		<?php if ($success) { ?>
			<div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
				<button type="button" class="close" data-dismiss="alert">&times;</button>
			</div>
		<?php } ?>
		<div class="panel panel-default">
		<div class="panel-heading">
				<div class="navigate">
					<a href="<?php echo $build_order_link; ?>" class="btn btn-default"><?php echo $button_build_order; ?></a>
					<a href="<?php echo $product_to_cell_link; ?>" class="btn btn-default"><?php echo $button_product_to_cell; ?></a>
					<a href="<?php echo $cell_check_link; ?>" class="btn btn-default"><?php echo $button_cell_check; ?></a>
					<a href="<?php echo $audit_link; ?>" class="btn btn-default"><?php echo $button_audit; ?></a>
					<a href="<?php echo $cell_editor_link; ?>" class="btn btn-default"><?php echo $button_cell_editor; ?></a>
					<a href="<?php echo $bay_link; ?>" class="btn btn-default"><?php echo $button_bay; ?></a>
					<a href="<?php echo $log_link; ?>" class="btn btn-default"><?php echo $button_log; ?></a>
					<a href="javascript:void(0);" class="btn btn-primary"><?php echo $button_service; ?></a>
				</div>
			</div>
			<form class="panel-body">
				<div class="form-horizontal">
					<div class="form-group">
						<div class="col-sm-12">
							<p><?php echo $text_warning_clear_codes; ?></p>
							<a href="<?php echo $action_clear_codes; ?>" class="btn btn-primary"><?php echo $button_clear_codes; ?></a>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<p><?php echo $text_warning_clear_links; ?></p>
							<a href="<?php echo $action_clear_links; ?>" class="btn btn-primary"><?php echo $button_clear_links; ?></a>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<p><?php echo $text_warning_clear_history; ?></p>
							<a href="<?php echo $action_clear_history; ?>" class="btn btn-primary"><?php echo $button_clear_history; ?></a>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12">
							<p><?php echo $text_warning_generate; ?></p>
							<a href="<?php echo $action_generate; ?>" class="btn btn-primary"><?php echo $button_generate; ?></a>
						</div>
					</div>
				</div>
		</div>
	</div>
</div>
</div>

<?php echo $footer; ?>