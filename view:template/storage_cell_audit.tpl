<?php echo $header; ?><?php echo $column_left; ?>
<div id="content" class="storage-cell audit">
	<div class="page-header">
		<div class="container-fluid">
			<div class="pull-right">
				<button type="button" data-toggle="tooltip" title="<?php echo $entry_all_barcodes; ?>" id="all-barcodes" class="btn btn-success"><i class="fa fa-barcode"></i></button>
				<button type="button" form="form-product" formaction="<?php echo $action_generate; ?>" data-toggle="tooltip" title="<?php echo $entry_generate_code; ?>" id="generate-code" class="btn btn-primary"><i class="fa fa-bookmark"></i></button>
				<button type="button" form="form-product" formaction="<?php echo $action_remove; ?>" data-toggle="tooltip" title="<?php echo $entry_delete; ?>" id="delete-code" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
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
		<!-- <div class="text-center"><h1 style="color: red; margin: 0 0 20px;">ВЕДУТСЯ РАБОТЫ</h1></div> -->
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
					<a href="javascript:void(0);" class="btn btn-primary"><?php echo $button_audit; ?></a>
					<a href="<?php echo $cell_editor_link; ?>" class="btn btn-default"><?php echo $button_cell_editor; ?></a>
					<a href="<?php echo $bay_link; ?>" class="btn btn-default"><?php echo $button_bay; ?></a>
					<a href="<?php echo $log_link; ?>" class="btn btn-default"><?php echo $button_log; ?></a>
					<a href="<?php echo $service_link; ?>" class="btn btn-default"><?php echo $button_service; ?></a>
				</div>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-xs-12 col-sm-12">
						<div class="well filter">
							<div class="row">
								<div class="col-xs-12 col-sm-3">
									<div class="form-group">
										<label class="control-label" for="input-product"><?php echo $title_filter_product; ?></label>
										<select name="filter_product" id="input-product" class="form-control">
											<option value="*"></option>
											<?php foreach ($filters_product as $filter_p_value => $filter_p_name) { ?>
												<?php if ($filter_p_value == $filter_product) { ?>
													<option value="<?php echo $filter_p_value; ?>" selected="selected"><?php echo $filter_p_name; ?></option>
												<?php } else { ?>
													<option value="<?php echo $filter_p_value; ?>"><?php echo $filter_p_name; ?></option>
												<?php } ?>
											<?php } ?>
										</select>
									</div>									
								</div>
								<div class="col-xs-12 col-sm-5">
									<div class="form-group">
										<div class="filter-category">
											<label class="control-label" for="input-category"><?php echo $title_filter_category; ?></label>
											<select multiple="multiple" size="8" name="filter_category[]" id="input-category" class="form-control multisel">
												<!-- <option value="*"></option> -->
												<?php foreach ($categories as $category) { ?>
													<?php if (in_array($category['category_id'], $filter_category)) { ?>
														<option value="<?php echo $category['category_id']; ?>" selected="selected"><?php echo $category['name']; ?></option>
													<?php } else { ?>
														<option value="<?php echo $category['category_id']; ?>"><?php echo $category['name']; ?></option>
													<?php } ?>
												<?php } ?>
											</select>
										</div>
									</div>
								</div>
								<div class="col-xs-12 col-sm-2">
									<div class="form-group">
										<div style="margin-top: 27px;"><label><input type="checkbox" name="filter_sold" value="" id="input-sold" <?php echo $filter_sold == 1 ? 'checked' : ''; ?> /> <?php echo $title_filter_sold; ?></label></div>
									</div>
								</div>
								<div class="col-xs-12 col-sm-2 text-right">
									<div class="form-group">
										<label class="control-label">&nbsp;</label>
										<div><button type="button" id="button-filter-1" class="btn btn-primary" style="height: 40px;"><i class="fa fa-filter"></i> <?php echo $button_filter; ?></button></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-12">
						<div class="well filter">
							<div class="row">
								<div class="col-xs-12 col-sm-4">
									<div class="form-group">
										<label class="control-label" for="input-name"><?php echo $title_filter_name; ?></label>
										<input type="text" name="filter_name" value="<?php echo $filter_name; ?>" id="input-name" class="form-control" />
									</div>
								</div>
								<div class="col-xs-12 col-sm-4">
									<div class="form-group" style="border: none;">
										<label class="control-label" for="input-code"><?php echo $title_filter_code_product; ?></label>
										<input type="text" name="filter_code_product" value="<?php echo $filter_code_product; ?>" id="input-code-product" class="form-control" />
									</div>
								</div>
								<div class="col-xs-12 col-sm-4">
									<div class="form-group" style="border: none;">
										<label class="control-label" for="input-code"><?php echo $title_filter_code_cell; ?></label>
										<input type="text" name="filter_code_cell" value="<?php echo $filter_code_cell; ?>" id="input-code-cell" class="form-control" />
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-3">
									<div class="form-group" style="border: none;">
										<label class="control-label" for="input-history"><?php echo $title_filter_history; ?></label>
										<select name="filter_history" id="input-history" class="form-control">
											<!-- <option value="*"></option> -->
											<?php foreach ($histories as $history_action => $history_name) { ?>
												<?php if ($history_action == $filter_history) { ?>
													<option value="<?php echo $history_action; ?>" selected="selected"><?php echo $history_name; ?></option>
												<?php } else { ?>
													<option value="<?php echo $history_action; ?>"><?php echo $history_name; ?></option>
												<?php } ?>
											<?php } ?>
										</select>
									</div>
								</div>
								<div class="col-xs-12 col-sm-5">
									<div class="form-group">
										<div class="row">
											<div class="col-xs-12 col-sm-6">
												<label class="control-label" for="input-date-from"><?php echo $title_filter_date_from; ?></label>
												<div class="input-group date">
													<input type="text" name="filter_date_from" value="<?php echo $filter_date_from; ?>" data-date-format="YYYY-MM-DD" id="input-date-from" class="form-control" />
													<span class="input-group-btn">
														<button type="button" class="btn btn-default" style="height: 40px;"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>
											<div class="col-xs-12 col-sm-6">
												<label class="control-label" for="input-date-to"><?php echo $title_filter_date_to; ?></label>
												<div class="input-group date">
													<input type="text" name="filter_date_to" value="<?php echo $filter_date_to; ?>" data-date-format="YYYY-MM-DD" id="input-date-to" class="form-control" />
													<span class="input-group-btn">
														<button type="button" class="btn btn-default" style="height: 40px;"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xs-12 col-sm-4">
									<div class="form-group" style="border: none;">
										<div class="row">
											<div class="col-xs-8 col-sm-9 filter-order-left">
												<label class="control-label" for="input-order-status"><?php echo $title_filter_order_status; ?></label>
												<select multiple="multiple" size="8" name="filter_order_status[]" id="input-order-status" class="form-control multisel">
													<!-- <option value="*"></option> -->
													<?php foreach ($order_statuses as $order_status) { ?>
														<?php if (in_array($order_status['order_status_id'], $filter_order_status)) { ?>
															<option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
														<?php } else { ?>
															<option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
														<?php } ?>
													<?php } ?>
												</select>
											</div>
											<div class="col-xs-4 col-sm-3 filter-order-right">
												<label class="control-label" for="input-order-qty"><?php echo $title_filter_order_qty; ?></label>
												<input type="number" name="filter_order_qty" value="<?php echo $filter_order_qty; ?>" id="input-order-qty" class="form-control" />
											</div>
										</div>
									</div>
									<button type="button" id="button-filter-2" class="btn btn-primary pull-right"><i class="fa fa-filter"></i> <?php echo $button_filter; ?></button>
								</div>
							</div>
						</div>
					</div>
				</div>



				<div class="products">
					<form action="" method="post" enctype="multipart/form-data" id="form-product">
						<div class="table-responsive">
							<table class="table table-bordered table-hover">
								<thead>
									<tr>
										<td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
										<td class="text-center"><?php echo $column_image; ?></td>
										<td class="text-left"><?php echo $column_name; ?></td>
										<td class="text-left"><?php echo $column_code; ?></td>
										<td class="text-left"><?php echo $column_cell; ?></td>
										<td class="text-center"><?php echo $column_status; ?></td>
										<td class="text-left"><?php echo $column_history; ?></td>
										<td class="text-left"><?php echo $column_order; ?></td>
										<td></td>
									</tr>
								</thead>
								<tbody>
									<?php if ($products) { ?>
										<?php foreach ($products as $product) { ?>
											<?php foreach ($product['unique_codes'] as $unique_code) { ?>
												<?php if (!$unique_code['unique_code']) { ?>
													<tr style="background: rgb(255 0 0 / 5%);">
													<?php } elseif (!$unique_code['cell_id']) { ?>
													<tr style="background: rgb(239 255 0 / 8%);">
													<?php } else { ?>
													<tr>
													<?php } ?>
													<td class="text-center">
														<input type="checkbox" name="selected[]" value="<?php echo $product['product']['product_id']; ?>##<?php echo $unique_code['product_code_id']; ?>" class="code-select" data-code="<?php echo $unique_code['unique_code']; ?>" />
													</td>
													<td class="text-center"><?php if ($product['product']['image']) { ?>
															<img src="<?php echo $product['product']['image']; ?>" alt="<?php echo $product['product']['name']; ?>" class="img-thumbnail" />
														<?php } else { ?>
															<span class="img-thumbnail list"><i class="fa fa-camera fa-2x"></i></span>
														<?php } ?>
													</td>
													<td class="text-left">
														<?php if ($product['product']['name']) { ?>
															<div><a href="<?php echo $unique_code['href']; ?>" target="_blank"><span class="product-title"><?php echo $product['product']['name']; ?></span> (<span class="product-model"><?php echo $product['product']['model']; ?></span>)</a></div>
														<?php } ?>
														<div class="option-name">
															<?php if ($unique_code['option_name'] || $unique_code['option_value_name']) { ?>
																<?php echo $unique_code['option_name'] . ': ' . $unique_code['option_value_name']; ?>
															<?php } ?>
															</>
													</td>
													<td class="text-left unique-code"><?php echo $unique_code['unique_code']; ?></td>
													<td class="text-left"><?php echo $unique_code['cell_name']; ?></td>
													<td class="text-center">
														<?php if (isset($product['product']['status'])) { ?>
															<?php if ($product['product']['status']) { ?>
																<strong style="color: #34c734;"><?php echo $entry_enabled; ?></strong>
															<?php } else { ?>
																<strong style="color: #f15353;"><?php echo $entry_disabled; ?></strong>
															<?php } ?>
														<?php } else { ?>
															<strong><a href="<?php echo $unique_code['href']; ?>" target="_blank"><?php echo $unique_code['product_id']; ?></a> - <?php echo $entry_undefined; ?></strong>
														<?php } ?>
													</td>
													<td class="text-left">
														<table style="border: none;">
															<?php if ($unique_code['date_added']) { ?>
																<tr><td style="white-space: nowrap;"><span class="dot gray"></span> <?php echo $history_create; ?>&nbsp;&nbsp;</td><td><?php echo $unique_code['date_added']; ?></td></tr>
															<?php } ?>
															<?php if ($unique_code['history']) { ?>
																<?php foreach ($unique_code['history'] as $history) { ?>
																	<?php if ($history['action'] == 'link') { ?>
																		<tr><td style="white-space: nowrap;"><span class="dot green"></span> <?php echo $history_link; ?>&nbsp;&nbsp;</td><td><?php echo $history['date']; ?></td></tr>
																	<?php } elseif ($history['action'] == 'unlink') { ?>
																		<tr><td style="white-space: nowrap;"><span class="dot red"></span> <?php echo $history_unlink; ?>&nbsp;&nbsp;</td><td><?php echo $history['date']; ?></td></tr>
																	<?php } elseif ($history['action'] == 'order') { ?>
																		<tr><td style="white-space: nowrap;"><span class="dot orange"></span> <?php echo $history_order; ?>&nbsp;&nbsp;</td><td><?php echo $history['date']; ?></td></tr>
																	<?php } ?>
																<?php } ?>
															<?php } ?>
														</table>
													</td>
													<td class="text-left">
														<?php if ($unique_code['orders']) { ?>
															<?php foreach ($unique_code['orders'] as $order) { ?>
																<div><?php echo $order['date_added']; ?> - <?php echo $order['order_name']; ?> (<?php echo $order['order_id']; ?>)</div>
															<?php } ?>
														<?php } ?>
													</td>
													<td class="text-center">
														<?php if ($unique_code['unique_code']) { ?>
															<button type="button" data-toggle="tooltip" title="<?php echo $entry_barcode; ?>" class="btn btn-success barcode"><i class="fa fa-barcode"></i></button>
														<?php } ?>
													</td>
													</tr>
												<?php } ?>
											<?php } ?>
										<?php } else { ?>
											<tr>
												<td class="text-center" colspan="8"><?php echo $text_no_results; ?></td>
											</tr>
										<?php } ?>
								</tbody>
							</table>
						</div>
					</form>
					<div class="row">
						<div class="col-sm-6 text-left"><?php // echo $pagination; ?></div>
						<div class="col-sm-6 text-right"><?php // echo $results; ?></div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="barcode-modal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><?php echo $title_unique_code; ?></h4>
			</div>
			<div class="modal-body text-center">
				<div id="print-this">
					<div id="barcode"><svg></svg></div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary print"><?php echo $text_print; ?></button>
			</div>
		</div>
	</div>
</div>

<script src="/admin/view/javascript/JsBarcode.all.min.js"></script>

<script>
	$('#button-filter-1').on('click', function() {
		var url = 'index.php?route=extension/module/storage_cell/audit&token=<?php echo $token; ?>&filter_block=1';

		var filter_product = $('select[name=\'filter_product\']').val();

		if (filter_product != '*') {
			url += '&filter_product=' + encodeURIComponent(filter_product);
		}
		
		var filter_category = $('select#input-category').val();

		if (filter_category != '' && filter_category != null) {
			url += '&filter_category=' + encodeURIComponent(filter_category);
		}

		var filter_sold = $('input[name=\'filter_sold\']');

		if (filter_sold.is(':checked')) {
			url += '&filter_sold=1';
		}

		location = url;
	});

	$('#button-filter-2').on('click', function() {
		var url = 'index.php?route=extension/module/storage_cell/audit&token=<?php echo $token; ?>&filter_block=2';

		var filter_name = $('input[name=\'filter_name\']').val();

		if (filter_name) {
			url += '&filter_name=' + encodeURIComponent(filter_name);
		}

		var filter_code_product = $('input[name=\'filter_code_product\']').val();

		if (filter_code_product) {
			url += '&filter_code_product=' + encodeURIComponent(filter_code_product);
		}

		var filter_code_cell = $('input[name=\'filter_code_cell\']').val();

		if (filter_code_cell) {
			url += '&filter_code_cell=' + encodeURIComponent(filter_code_cell);
		}

		var filter_date_from = $('input[name=\'filter_date_from\']').val();

		if (filter_date_from) {
			url += '&filter_date_from=' + encodeURIComponent(filter_date_from);
		}

		var filter_date_to = $('input[name=\'filter_date_to\']').val();

		if (filter_date_to) {
			url += '&filter_date_to=' + encodeURIComponent(filter_date_to);
		}

		var filter_history = $('select#input-history').val();

		if (filter_history != '' && filter_history != '0' && filter_history != 0 && filter_history != null) {
			url += '&filter_history=' + encodeURIComponent(filter_history);
		}

		var filter_order_status = $('select#input-order-status').val();
		var filter_order_qty = $('input[name=\'filter_order_qty\']').val();

		if (filter_order_status != '' && filter_order_status != null) {
			url += '&filter_order_status=' + encodeURIComponent(filter_order_status);
			url += '&filter_order_qty=' + encodeURIComponent(filter_order_qty);
		}

		location = url;
	});

	$('#generate-code').on('click', function(e) {
		$('#form-product').attr('action', this.getAttribute('formAction'));

		$('#form-product').submit();
	});

	$('#delete-code').on('click', function(e) {
		$('#form-product').attr('action', this.getAttribute('formAction'));

		if (confirm('Вы уверены?')) {
			$('#form-product').submit();
		} else {
			return false;
		}
	});

	$('input[name=\'filter_name\']').autocomplete({
		'source': function(request, response) {
			$.ajax({
				url: 'index.php?route=extension/module/storage_cell/autocomplete&token=<?php echo $token; ?>&filter_name=' + encodeURIComponent(request),
				dataType: 'json',
				success: function(json) {
					response($.map(json, function(item) {
						return {
							label: item['name'],
							value: item['product_id']
						}
					}));
				}
			});
		},
		'select': function(item) {
			$('input[name=\'filter_name\']').val(item['label']);
		}
	});

	$('#all-barcodes').on('click', function() {
		let find_selected = false;
		let i = 0;
		$("#barcode svg").html('');
		$(".added_svg").remove();
		$("#barcode-modal .code-name").remove();
		$("#barcode-modal .code-text").remove();
		$('.code-select').each(function(index, element) {
			if ($(element).prop('checked')) {
				find_selected = true;
				let this_row = $(element).closest('tr'),
					code = $(element).attr('data-code'),
					product_name = this_row.find('.product-title').text(),
					product_model = this_row.find('.product-model').text(),
					option_name = this_row.find('.option-name').text();
					if (option_name.trim() != '') {
						product_name = '<span>' + product_name + '</span> (' + option_name.trim() + ')';
					}
				if (code != 'undefined' && code != '') {
					if (i === 0) {
						JsBarcode("#barcode svg", code, {
							text: false,
							fontSize: 0,
							height: 60,
							width: 1.8,
						});
						$("#barcode").append('<div class="code-name">' + product_name + '</div><div class="code-text"><div>' + code + '</div></div>');
					} else {
						const newSvg = '<div class="added_svg" id="barcode' + i + '"><svg></svg></div>';
						$('#print-this').append(newSvg);
						JsBarcode('#barcode' + i + ' svg', code, {
							text: false,
							fontSize: 0,
							height: 60,
							width: 1.8,
						});
						$("#barcode" + i).append('<div class="code-name">' + product_name + '</div><div class="code-text"><div>' + code + '</div></div>');
					}
					i++;
				}
			}
		});
		if (find_selected) {
			$('#barcode-modal').modal('show');
		}
	});

	$('.barcode').click(function() {
		let this_row = $(this).closest('tr'),
			code = this_row.find('.unique-code').text(),
			product_name = this_row.find('.product-title').text(),
			product_model = this_row.find('.product-model').text(),
			option_name = this_row.find('.option-name').text();
		if (option_name.trim() != '') {
			product_name = '<span>' + product_name + '</span> (' + option_name.trim() + ')';
		}
		$("#barcode svg").html('');
		$(".added_svg").remove();
		$("#barcode-modal .code-name").remove();
		$("#barcode-modal .code-text").remove();
		JsBarcode("#barcode svg", code, {
			text: false,
			fontSize: 0,
			height: 60,
			width: 1.8,
		});
		$("#barcode").append('<div class="code-name">' + product_name + '</div><div class="code-text"><div>' + code + '</div></div>');
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

	$(document).ready(function() {
		$('.multisel').multiselect({
			includeSelectAllOption: false,
			buttonClass: 'form-control custom-select',
			buttonWidth: '100%',
			buttonTextAlignment: 'left',
			maxHeight: 300,
			nonSelectedText: ''
		});
	});
</script>

<script src="view/javascript/jquery/multiselect/bootstrap-multiselect.min.js" type="text/javascript"></script>
<link href="view/javascript/jquery/multiselect/bootstrap-multiselect.min.css" type="text/css" rel="stylesheet" media="screen" />
<script src="view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<link href="view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css" type="text/css" rel="stylesheet" media="screen" />
<script>
	$('.date').datetimepicker({
		pickTime: false
	});
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
	}

	#print-this #barcode,
	#print-this .added_svg {
		margin: 0;
	}

	#print-this #barcode svg,
	#print-this .added_svg svg {
		overflow: unset;
	}

	#print-this .code-name {
		margin-top: -7px;
    color: #000;
		font-size: 11px;
		text-align: center;
	}
	
	#print-this .code-name span {
		text-overflow: ellipsis;
    max-width: 270px;
    white-space: nowrap;
    overflow: hidden;
    display: inline-block;
    vertical-align: bottom;
	}
	
	#print-this .code-text {
		font: 11px monospace;
		margin-top: 5px;
		color: #000;
		z-index: 1;
		position: relative;
		width: 100%;
		text-align: center;
	}

	#print-this .code-text > div {
		font-size: 45px;
    line-height: 44px;
	}
</style>

<?php echo $footer; ?>