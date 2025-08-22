<?php echo $header; ?><?php echo $column_left; ?>
<div id="content" class="storage-cell cell-check">
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
					<a href="javascript:void(0);" class="btn btn-primary"><?php echo $button_cell_check; ?></a>
					<a href="<?php echo $audit_link; ?>" class="btn btn-default"><?php echo $button_audit; ?></a>
					<a href="<?php echo $cell_editor_link; ?>" class="btn btn-default"><?php echo $button_cell_editor; ?></a>
					<a href="<?php echo $bay_link; ?>" class="btn btn-default"><?php echo $button_bay; ?></a>
					<a href="<?php echo $log_link; ?>" class="btn btn-default"><?php echo $button_log; ?></a>
					<a href="<?php echo $service_link; ?>" class="btn btn-default"><?php echo $button_service; ?></a>
				</div>
			</div>
			<div class="panel-body">
				<div class="tab-content">
					<div class="row">
						<div class="col-xs-12 col-sm-1"></div>
						<div class="col-xs-12 col-sm-4"><button type="button" id="new" class="btn btn-info new"><?php echo $button_new; ?></button> </div>
					</div>
					<br />
					<div class="row input-block">
						<div class="col-xs-12 col-sm-1">
							<div class="title"><?php echo $text_product; ?></div>
						</div>
						<div class="col-xs-12 col-sm-4">
							<div class="input-group set-product">
								<span class="input-group-addon clear"><i class="fa fa-times"></i></span>
								<input type="text" name="product" class="form-control text-center input" data-method="product" value="" />
								<span class="input-group-addon set"><i class="fa fa-check"></i></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 col-sm-1"></div>
						<div class="col-xs-12 col-sm-4">
							<div id="products">
								<div class="default">
									<div class="products"></div>
								</div>
								<div class="correct" style="display: none;">
									<div class="title"><?php echo $title_correct; ?></div>
									<div class="products"></div>
								</div>
								<div class="extra" style="display: none;">
									<div class="title"><?php echo $title_extra; ?></div>
									<div class="products"></div>
								</div>
								<div class="wrong" style="display: none;">
									<div class="title"><?php echo $title_wrong; ?></div>
									<div class="products"></div>
								</div>
							</div>
						</div>
					</div>
					<br />
					<div class="row input-block">
						<div class="col-xs-12 col-sm-1">
							<div class="title"><?php echo $text_cell; ?></div>
						</div>
						<div class="col-xs-12 col-sm-4">
							<div class="input-group set-cell">
								<span class="input-group-addon clear"><i class="fa fa-times"></i></span>
								<input type="text" name="cell" class="form-control text-center input" data-method="cell" value="" />
								<span class="input-group-addon set"><i class="fa fa-check"></i></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 col-sm-1"></div>
						<div class="col-xs-12 col-sm-4 text-center">
							<input type="hidden" name="cell_id" id="cell-id" value="" />
							<div id="cell-name" class="cell-name" style="display: none;"></div>
						</div>
					</div>
					<br />
					<div class="bottom buttons">
						<div class="row">
							<div class="col-xs-12 col-sm-1"></div>
							<div class="col-xs-12 col-sm-4">
								<button type="button" class="btn btn-success check" disabled><?php echo $button_check; ?></button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="popup" id="notify" style="display: none;">
		<div class="modal-content">
			<button type="button" class="close"><span aria-hidden="true">&times;</span></button>
			<div class="modal-body text-center"></div>
		</div>
	</div>

	<div class="preloader" style="display: none">
		<div class="loader"></div>
	</div>
</div>

<script>
	var input_block = $('.input-block'),
		button_check = $('button.check'),
		modal_body = $('#notify .modal-body'),
		input_products = {},
		html = '';

	$(document).ready(function() {
		$('.set-product input').focus();
	});

	$('#new').on('click', function() {
		modal_body.html('');
		button_check.prop('disabled', true);
		hidePopup();
		$('input[name="product"]').val('');
		$('input[name="cell"]').val('').prop('disabled', false);
		$('#cell-id').val('');
		$('#cell-name').html('').hide();
		$('.set-product input').focus();
		input_products = {};
		hideProducts();
		clearProducts()
	});

	input_block.on('paste input keypress', '.input', function(e) {
		var _this = $(this);
		if (e.keyCode == "13") {
			var input = _this.parent().find('.input');
			if (input.val().trim() !== '') {
				findValue(input.attr('data-method'), input.val().trim());
			}
		} else if (typeof(e.keyCode) != "undefined" && e.keyCode !== null) {
			e.preventDefault();
			_this.val(_this.val() + e.key);
		} else {
			if (_this.val().length > 1) {
				setTimeout(function() {
					findValue(_this.attr('data-method'), _this.val().trim());
				}, 5);
			}
		}
	});

	input_block.on('click', '.clear', function() {
		var this_input_block = $(this).closest('.input-block');
		this_input_block.find('.input').val('').prop('disabled', false).focus();
		this_input_block.find('.name div').fadeOut(150).html('');
		this_input_block.find('input[type="hidden"]').val('');
		hidePopup();
		modal_body.html('');
	});

	input_block.on('click', '.set', function() {
		var input = $(this).parent().find('.input');
		if (input.val().trim() !== '') {
			findValue(input.attr('data-method'), input.val().trim());
		}
	});

	$('body').on('click', '.delete-product', function() {
		delete input_products[$(this).parent('.product').attr('data-product-code-id')];
		$(this).parent('.product').remove();
		productsCounter();
	});

	$('.buttons').on('click', 'button', function() {
		action('check');
	});

	$('.popup').on('click', '.close', function() {
		hidePopup();
	});

	function productsCounter() {
		$('#products > div').each(function() {
			$(this).find('.product').each(function(i) {
				$(this).find('.cnt').text(i + 1);
			});
		});
	}

	function findValue(method, value) {
		hidePopup();
		$('.preloader').show();
		modal_body.html('');

		if (method == 'cell') {
			$('#cell-name').html('');
			$('#cell-id').val('');
			value = value.replace('судд_', 'cell_');
		}

		$.ajax({
			url: 'index.php?route=extension/module/storage_cell/findValue&operation=cell_check&method=' + method + '&value=' + value + '&token=<?php echo $token; ?>',
			dataType: 'json',
			success: function(json) {
				$('.preloader').hide();

				if (method == 'product') {
					if (json['error'] && !json['already_linked']) {
						modal_body.html('<div class="red">' + json['error'] + '</div>');
						showPopup();
					} else if ((json['success']) || (json['error'] && json['already_linked'])) {
						if (json['product_code_id'] in input_products) {

						} else {
							input_products[Number(json['product_code_id'])] = {
								"product_code_id": 	Number(json['product_code_id']),
								"product_name": 		json['product_name'],
								"unique_code": 			json['unique_code'],
							};
							$('#products .default .products').append(productHTML(json));
							showProducts('default');
						}
						$('.set-product input').val('').focus();
						modal_body.html('<div class="green">' + json['text_ok'] + '</div>');
						showPopup();
						setTimeout(function() {
							hidePopup();
						}, 1000);
					}
				}

				if (method == 'cell') {
					if (json['error']) {
						$('#cell-id').val('');
						modal_body.html('<div class="red">' + json['error'] + '</div>');
						showPopup();
					} else if (json['success']) {
						$('#cell-id').val(json['cell_id']);
						$('input[name="cell"]').prop('disabled', true);
						$('.set-product input').focus();
						$('#cell-name').html(json['cell_name'] + '<br/><?php echo $text_audit; ?>: ' + json['cell_audit_date']).fadeIn(150);
						button_check.prop('disabled', false);
						modal_body.html('<div class="green">' + json['success'] + '</div>');
						showPopup();
						setTimeout(function() {
							hidePopup();
						}, 1000);
					}
				}

				productsCounter();
			}
		});
	}

	function action(action) {
		var cell_id = $('#cell-id').val(),
			correct_products = {},
			extra_products = {},
			wrong_products = {};

		hidePopup();
		$('.preloader').show();
		modal_body.html('');

		$.ajax({
			url: 'index.php?route=extension/module/storage_cell/action&operation=cell_check&action=' + action + '&cell_id=' + cell_id + '&token=<?php echo $token; ?>',
			dataType: 'json',
			success: function(json) {
				$('.preloader').hide();
				if (json['error']) {
					modal_body.html('<div class="red">' + json['error'] + '</div>');
					showPopup();
				} else if (json['success']) {
					modal_body.html('<div class="green">' + json['success'] + '</div>');
					showPopup();

					hideProducts();
					clearProducts();

					if (Object.keys(input_products).length > 0) {
						for (code_id in input_products) {
							if (Number(code_id) in json['products']) {
								correct_products[code_id] = input_products[code_id];
							} else {
								extra_products[code_id] = input_products[code_id];
							}
						}
						for (code_id in json['products']) {
							if (Number(code_id) in input_products) {
								correct_products[code_id] = json['products'][code_id];
							} else {
								wrong_products[code_id] = json['products'][code_id];
							}
						}

						if (Object.keys(extra_products).length == 0 && Object.keys(wrong_products).length == 0) {
							modal_body.html('<div class="green"><?php echo $text_correct; ?></div>');
							showPopup();
							setTimeout(function() {
								hidePopup();
							}, 1500);
						} else {
							modal_body.html('<div class="red"><?php echo $error_divergence; ?></div>');
							showPopup();
							setTimeout(function() {
								hidePopup();
							}, 1500);
						}

						if (Object.keys(correct_products).length > 0) {
							for (code_id in correct_products) {
								$('#products .correct .products').append(productHTML(correct_products[code_id]));
								showProducts('correct');
							}
						}
						if (Object.keys(extra_products).length > 0) {
							for (code_id in extra_products) {
								$('#products .extra .products').append(productHTML(extra_products[code_id]));
								showProducts('extra');
							}
						}
						if (Object.keys(wrong_products).length > 0) {
							for (code_id in wrong_products) {
								$('#products .wrong .products').append(productHTML(wrong_products[code_id]));
								showProducts('wrong');
							}
						}
					} else {
						for (code_id in json['products']) {
							input_products[code_id] = json['products'][code_id];
							$('#products .default .products').append(productHTML(json['products'][code_id]));
							showProducts('default');
						}
					}

					productsCounter();

					$('.set-product input').val('').focus();
					setTimeout(function() {
						hidePopup();
					}, 1500);
				}
			}
		});
	}

	function productHTML(data) {
		html = '<div class="product" data-product-code-id="' + data['product_code_id'] + '" data-unique-code="' + data['unique_code'] + '" data-product-name="' + data['product_name'] + '"><span class="cnt"></span><span class="title">' + data['product_name'] + '<br/><a target="_blank" href="index.php?route=extension/module/storage_cell/audit&token=<?php echo $token; ?>&filter_block=2&filter_code_product=' + data['unique_code'] + '">' + data['unique_code'] + '</a></span><span class="delete-product"><i class="fa fa-times"></i></span></div>';
		return html;
	}

	function showProducts(block) {
		$('#products').find('.' + block).show();
	}

	function hideProducts() {
		$('#products > div').hide();
	}

	function clearProducts() {
		$('#products .default .products').html('');
		$('#products .correct .products').html('');
		$('#products .extra .products').html('');
		$('#products .wrong .products').html('');
	}

	function showPopup() {
		$('.popup').fadeIn(150);
	}

	function hidePopup() {
		$('.popup').fadeOut(150);
	}
</script>

<?php echo $footer; ?>