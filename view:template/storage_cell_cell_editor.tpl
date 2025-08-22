<?php echo $header; ?><?php echo $column_left; ?>
<div id="content" class="storage-cell cells-editor">
	<div class="page-header">
		<div class="container-fluid">
			<div class="pull-right">
				<button type="button" data-toggle="tooltip" title="<?php echo $button_selected_barcodes; ?>" id="all-barcodes" class="btn btn-success"><i class="fa fa-barcode"></i></button>&nbsp;&nbsp;&nbsp;&nbsp;
				<button type="submit" form="form-cell" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
				<button type="button" form="form-cell-remove" data-toggle="tooltip" title="<?php echo $entry_remove; ?>" id="button-remove" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
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
					<a href="javascript:void(0);" class="btn btn-primary"><?php echo $button_cell_editor; ?></a>
					<a href="<?php echo $bay_link; ?>" class="btn btn-default"><?php echo $button_bay; ?></a>
					<a href="<?php echo $log_link; ?>" class="btn btn-default"><?php echo $button_log; ?></a>
					<a href="<?php echo $service_link; ?>" class="btn btn-default"><?php echo $button_service; ?></a>
				</div>
			</div>
			<div class="panel-body">
				<div class="tab-content">
					<div class="empty-cells">
						<div style="font-weight: bold; margin-bottom: 5px;"><?php echo $text_empty_cells; ?>: <?php echo !$empty_cells ? $text_empty_cells_no : ''; ?></div>
						<div class="row">
							<?php if ($empty_cells) { ?>
								<?php foreach ($empty_cells as $empty_cell) { ?>
									<div class="col-xs-12 col-sm-3">
										<div>(<?php echo $empty_cell['id']; ?>)&nbsp;&nbsp;&nbsp;<?php echo $empty_cell['name']; ?></div>
									</div>
								<?php } ?>
							<?php } ?>
						</div>
					</div>

					<br />
					<div><label for="selectAll"><input type="checkbox" id="selectAll" value="" /> <?php echo $text_select_all; ?></label></div>

					<div class="tab-content table-responsive">
						<form action="<?php echo $action_remove; ?>" method="post" enctype="multipart/form-data" id="form-cell-remove" class="form-horizontal">
							<div class="bays">
								<?php foreach ($rooms as $id => $room) { ?>
									<div class="block room">
										<div class="title">
											<div class="name"><?php echo $room; ?></div>
											<div class="buttons">
												<button class="btn btn-default collapse-btn"><?php echo $button_collapse; ?></button>
												<button class="btn btn-default expand-btn all" data-type="room" data-room-id="<?php echo $id; ?>" data-row-id="" data-stack-id="" data-rack-id="" data-expand="all"><?php echo $button_expand_all; ?></button>
												<button class="btn btn-default expand-btn one" data-type="room" data-room-id="<?php echo $id; ?>" data-row-id="" data-stack-id="" data-rack-id="" data-expand="one"><?php echo $button_expand; ?></button>
											</div>
										</div>
										<div class="preloader" style="display: none">
											<div class="loader"></div>
										</div>
										<div class="body" style="display: none;"></div>
									</div>
								<?php } ?>
							</div>
						</form>

						<br />

						<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-cell" class="form-horizontal">
							<table id="cell-value" class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<td class="text-left"><?php echo $entry_room_title; ?></td>
										<td class="text-left"><?php echo $entry_row_title; ?></td>
										<td class="text-left"><?php echo $entry_stack_title; ?></td>
										<td class="text-left"><?php echo $entry_rack_title; ?></td>
										<td class="text-left"><?php echo $entry_cell_title; ?></td>
										<td class="text-center"></td>
									</tr>
								</thead>
								<tbody></tbody>
								<tfoot>
									<tr>
										<td colspan="5"></td>
										<td class="text-center"><button type="button" onclick="addcell();" data-toggle="tooltip" title="<?php echo $entry_add; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>
									</tr>
								</tfoot>
							</table>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header" style="border: none;">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body text-center">
					<div class="text"></div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="message-modal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header" style="border: none;">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body text-center">
					<div class="message"></div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="barcode-modal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title"><?php echo $text_cell_code; ?></h4>
				</div>
				<div class="modal-body text-center">
					<div id="print-this">
						<svg id="barcode"></svg>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary print"><?php echo $text_print; ?></button>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="/admin/view/javascript/JsBarcode.all.min.js"></script>

<script>
	$('.bays').on('click', '.collapse-btn', function(e) {
		e.preventDefault();
		$(this).closest('.block').find('.body').html('').hide();
	});

	$('.bays').on('click', '.expand-btn', function(e) {
		e.preventDefault();
		getBays($(this));
	});

	function getBays(that) {
		let _this = that,
			method = _this.attr('data-expand'),
			type = _this.attr('data-type'),
			room_id = _this.attr('data-room-id'),
			row_id = _this.attr('data-row-id'),
			stack_id = _this.attr('data-stack-id'),
			rack_id = _this.attr('data-rack-id'),
			block = _this.closest('.block');

		block.find('.preloader').show();

		$.ajax({
			url: 'index.php?route=extension/module/storage_cell/getBays&type=' + type + '&room_id=' + room_id + '&row_id=' + row_id + '&stack_id=' + stack_id + '&rack_id=' + rack_id + '&token=<?php echo $token; ?>',
			method: 'post',
			dataType: 'json',
			success: function(json) {
				if (json) {
					block.find('.preloader').hide();
					block.find('.body').html(json).show();

					setTimeout(function() {
						if (method == 'all') {
							block.find('.body').find('.expand-btn.all').click();
						}
					}, 10);
				}
			}
		});
	}

	var cell_row = <?php echo $bay_last_id + 1; ?>;

	function addcell() {
		var html = '';
		html += '<tr id="cell-value-row' + cell_row + '">';
		html += '	<td class="text-left">';
		html += '		<select name="cells[' + cell_row + '][room]" class="room-name form-control">';
		<?php foreach ($bays['room'] as $room) { ?>
			html += '				<option value="<?php echo $room['id']; ?>"><?php echo $room['name']; ?></option>';
		<?php } ?>
		html += '		</select>';
		html += '	</td>';
		html += '	<td class="text-left">';
		html += '		<select name="cells[' + cell_row + '][row]" class="row-name form-control">';
		<?php foreach ($bays['row'] as $row) { ?>
			html += '				<option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>';
		<?php } ?>
		html += '		</select>';
		html += '	</td>';
		html += '	<td class="text-left">';
		html += '		<select name="cells[' + cell_row + '][stack]" class="stack-name form-control">';
		<?php foreach ($bays['stack'] as $stack) { ?>
			html += '				<option value="<?php echo $stack['id']; ?>"><?php echo $stack['name']; ?></option>';
		<?php } ?>
		html += '		</select>';
		html += '	</td>';
		html += '	<td class="text-left">';
		html += '		<select name="cells[' + cell_row + '][rack]" class="rack-name form-control">';
		<?php foreach ($bays['rack'] as $rack) { ?>
			html += '				<option value="<?php echo $rack['id']; ?>"><?php echo $rack['name']; ?></option>';
		<?php } ?>
		html += '		</select>';
		html += '	</td>';
		html += '	<td class="text-left">';
		html += '		<select name="cells[' + cell_row + '][cell]" class="cell-name form-control">';
		<?php foreach ($bays['cell'] as $cell) { ?>
			html += '				<option value="<?php echo $cell['id']; ?>"><?php echo $cell['name']; ?></option>';
		<?php } ?>
		html += '		</select>';
		html += '	</td>';
		html += '	<td class="text-center"><button type="button" onclick="$(`#cell-value-row' + cell_row + '`).remove();" data-toggle="tooltip" title="<?php echo $entry_remove; ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i></button></td>';
		html += '</tr>';

		$('#cell-value tbody').append(html);

		cell_row++;
	}

	$('#selectAll').click(function() {
		if ($(this).prop('checked')) {
			$('.cell-select').prop('checked', true);
		} else {
			$('.cell-select').prop('checked', false);
		}
	});

	$('#button-remove').on('click', function(e) {
		if (confirm('Вы уверены?')) {
			$('#form-cell-remove').submit();
		} else {
			return false;
		}
	});

	$('.bays').on('click', '.edit', function(e) {
		e.preventDefault();
		let _this = $(this),
			cell_id = _this.attr('data-id')
		$('#edit-modal .message').html('');

		$('#edit-modal .text').load('index.php?route=extension/module/storage_cell/getCellTable&cell_id=' + cell_id + '&token=<?php echo $token; ?>');
		setTimeout(function() {
			$('#edit-modal').modal('show');
		}, 100);
	});

	$('.bays').on('click', '.remove', function(e) {
		e.preventDefault();
		let _this = $(this);
		$('#message-modal .message').html('');

		if (confirm('Вы уверены?')) {
			$.ajax({
				url: 'index.php?route=extension/module/storage_cell/removeCell&token=<?php echo $token; ?>&ajax=1',
				method: 'post',
				data: 'selected[]=' + _this.attr('data-id'),
				dataType: 'json',
				success: function(json) {
					if (json == 'ok') {
						_this.closest('.block.rack').find('.expand-btn.one').click();
					} else {
						$('#message-modal .message').html(json);
						$('#message-modal').modal('show');
					}
				}
			});
		} else {
			return false;
		}
	});

	$('#all-barcodes').on('click', function() {
		let find_selected = false;
		let i = 0;
		$("#barcode").html('');
		$(".added_svg").remove();
		$('.cell-select').each(function(index, element) {
			if ($(element).prop('checked')) {
				find_selected = true;
				let code = $(element).attr('data-code');
				let code_name = $(element).attr('data-fullname');
				if (i === 0) {
					JsBarcode("#barcode", code, {
						height: 80,
						fontSize: 24,
						text: code_name
					});
				} else {
					const newSvg = '<svg  class="added_svg" id="barcode' + i + '"></svg>';
					$('#print-this').append(newSvg);
					JsBarcode('#barcode' + i, code, {
						height: 80,
						fontSize: 24,
						text: code_name,
					});
				}
				i++;
			}
		});
		if (find_selected) {
			$('#barcode-modal').modal('show');
		}
	});

	$('body').on('click', '.barcode', function() {
		let code = $(this).attr('data-code'),
			code_name = $(this).attr('data-fullname');
		$("#barcode").html('');
		$(".added_svg").remove();
		JsBarcode("#barcode", code, {
			height: 80,
			fontSize: 24,
			text: code_name,
		});
		$('#barcode-modal').modal('show');
	});

	$(document).on("click", ".print", function() {
		printElement(document.getElementById("print-this"));
	});

	function printElement(elem) {
		var dom_clone = elem.cloneNode(true);

		var $printSection = document.getElementById("printSection");

		if (!$printSection) {
			var $printSection = document.createElement("div");
			$printSection.id = "printSection";
			document.body.appendChild($printSection);
		}

		$printSection.innerHTML = "";
		$printSection.appendChild(dom_clone);
		window.print();
	}
</script>

<style>
	@media screen {
		#printSection {
			display: none;
		}
	}

	@media print {

		#container *,
		body .modal-backdrop {
			visibility: hidden;
			height: 0px;
		}

		#printSection,
		#printSection * {
			visibility: visible;
		}

		#printSection {
			position: absolute;
			left: 0;
			top: 0;
		}

		#printSection #print-this {
			display: flex;
			flex-wrap: wrap;
			justify-content: space-between;
		}

		#printSection #print-this svg {
			margin: 10px 0;
		}
	}
</style>
<?php echo $footer; ?>