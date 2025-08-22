<?php echo $header; ?><?php echo $column_left; ?>
<div id="content" class="storage-cell cells-editor">
	<div class="page-header">
		<div class="container-fluid">
			<div class="pull-right">
				<button type="submit" form="form-cell" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
				<button type="button" form="form-cell" formaction="<?php echo $action_remove; ?>" data-toggle="tooltip" title="<?php echo $entry_remove; ?>" id="button-remove" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
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
					<a href="javascript:void(0);" class="btn btn-primary"><?php echo $button_bay; ?></a>
					<a href="<?php echo $log_link; ?>" class="btn btn-default"><?php echo $button_log; ?></a>
					<a href="<?php echo $service_link; ?>" class="btn btn-default"><?php echo $button_service; ?></a>
				</div>
			</div>
			<div class="panel-body">
				<div class="tab-content">
					<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-cell" class="form-horizontal">
						<div class="row">
							<?php foreach ($bays_title as $bay_title) { ?>
								<div class="col-xs-12 col-sm-25">
									<div class="<?php echo $bay_title['pseudo']; ?>-table bay-block tab-content table-responsive">
										<table id="cell-value" class="table table-striped table-bordered table-hover">
											<thead>
												<tr>
													<td colspan="3" class="text-left"><?php echo $bay_title['title']; ?></td>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($bays as $type => $bay_values) { ?>
													<?php if ($type == $bay_title['pseudo']) { ?>
														<?php foreach ($bay_values as $bay_value) { ?>
															<tr>
																<td class="text-center">
																	<input type="checkbox" name="selected[]" value="<?php echo $bay_value['id']; ?>" class="bay-select">
																</td>
																<td class="text-left">
																	<input type="text" name="bays[<?php echo $bay_title['pseudo']; ?>][<?php echo $bay_value['id']; ?>][name]" value="<?php echo $bay_value['name']; ?>" class="form-control bay-input" />
																</td>
																<td class="text-left">
																	<input type="text" style="width: 50px;" name="bays[<?php echo $bay_title['pseudo']; ?>][<?php echo $bay_value['id']; ?>][sort_order]" value="<?php echo $bay_value['sort_order']; ?>" class="form-control" />
																</td>
															</tr>
														<?php } ?>
													<?php } ?>
												<?php } ?>
											</tbody>
											<tfoot>
												<tr>
													<td colspan="4" class="text-right"><button type="button" onclick="addRow(this, '<?php echo $bay_title['pseudo']; ?>');" data-toggle="tooltip" title="<?php echo $entry_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
												</tr>
											</tfoot>
										</table>
									</div>
								</div>
							<?php } ?>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	var last_id = <?php echo $bay_last_id; ?>;
	
	function addRow(that, type) {
		var html = '';
		html += '<tr>';
		html += '	<td class="text-center">';
		html += '	</td>';
		html += '	<td class="text-left">';
		html += '		<input type="text" name="bays[' + type + '][' + last_id + '][name]" value="" class="form-control bay-input" />';
		html += '	</td>';
		html += '	<td class="text-left">';
		html += '		<input type="text" style="width: 50px;" name="bays[' + type + '][' + last_id + '][sort_order]" value="" class="form-control" />';
		html += '	</td>';
		html += '</tr>';
		
		last_id += 1;

		$(that).closest('.bay-block').find('tbody').append(html);
	}

	$('#button-remove').on('click', function(e) {
		$('#form-cell').attr('action', this.getAttribute('formAction'));

		if (confirm('Вы уверены?')) {
			$('#form-cell').submit();
		} else {
			return false;
		}
	});
</script>

<?php echo $footer; ?>