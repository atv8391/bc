<?php echo $header; ?><?php echo $column_left; ?>
<div id="content" class="storage-cell build-order">
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
					<a href="javascript:void(0);" class="btn btn-primary"><?php echo $button_build_order; ?></a>
					<a href="<?php echo $product_to_cell_link; ?>" class="btn btn-default"><?php echo $button_product_to_cell; ?></a>
					<a href="<?php echo $cell_check_link; ?>" class="btn btn-default"><?php echo $button_cell_check; ?></a>
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
						<div class="col-xs-12 col-sm-6">
							<div class="fixed-input">
								<div class="row input-block">
									<div class="col-xs-12 col-sm-2">
										<div class="title"><?php echo $product_bays ? $text_product : $text_order; ?></div>
									</div>
									<div class="col-xs-12 col-sm-8">
										<?php if ($product_bays) { ?>
											<div class="input-group set-product">
												<span class="input-group-addon clear"><i class="fa fa-times"></i></span>
												<input type="text" name="product" class="form-control text-center input" value="" />
												<span class="input-group-addon set"><i class="fa fa-check"></i></span>
											</div>
										<?php } else { ?>
											<div class="input-group set-order">
												<span class="input-group-addon clear"><i class="fa fa-times"></i></span>
												<input type="text" name="order" class="form-control text-center input" value="" />
												<span class="input-group-addon set"><i class="fa fa-check"></i></span>
											</div>
										<?php } ?>
									</div>
								</div>
							</div>
							<?php if ($product_bays) { ?>
								<?php foreach ($product_bays as $room_name => $room) { ?>
									<div class="room-block">
										<div class="room-title"><?php echo $room_name; ?></div>
										<?php foreach ($room as $row_name => $row) { ?>

											<div class="title row-title"><?php echo $row_name; ?></div>
											<?php foreach ($row as $stack_name => $stack) { ?>

												<div class="title stack-title"><?php echo $stack_name; ?></div>
												<?php foreach ($stack as $rack_name => $rack) { ?>

													<div class="title rack-title"><?php echo $rack_name; ?></div>
													<?php foreach ($rack as $cell_name => $cell) { ?>

														<div class="title cell-title"><?php echo $cell_name; ?></div>
														<?php foreach ($cell as $order_id => $order) { ?>
															<div class="order-block">
																<div class="order-title"><?php echo $entry_order . $order_id; ?></div>
																<?php foreach ($order as $order_product_id => $products) { ?>
																	<?php foreach ($products as $product) { ?>
																		<div class="product-block">
																			<div class="product-title" data-order-id="<?php echo $order_id; ?>" data-order-product-id="<?php echo $order_product_id; ?>" data-option-id="<?php echo $product['option_id']; ?>" data-option-value-id="<?php echo $product['option_value_id']; ?>">
																				<?php echo $product['product_name']; ?><?php echo ' (' . $product['abstract_code'] . ')'; ?><br />
																				<?php echo $product['option_name'] ? ' * ' . $product['option_name'] . '<br/>' : ''; ?>
																				-- <span class="marked-code"></span>
																			</div>
																		</div>
																	<?php } ?>
																<?php } ?>
															</div>
														<?php } ?>

													<?php } ?>

												<?php } ?>

											<?php } ?>

										<?php } ?>
									</div>
								<?php } ?>
							<?php } else { ?>
								<div class="row">
									<div class="col-xs-12 col-sm-2"></div>
									<div class="col-xs-12 col-sm-8">
										<div class="orders"></div>
									</div>
								</div>
							<?php } ?>
							<br>
							<div class="buttons">
								<div class="row">
									<div class="col-xs-12 col-sm-2"></div>
									<div class="col-xs-12 col-sm-8">
										<?php if ($product_bays) { ?>
											<button type="button" class="btn btn-success fix" disabled><?php echo $text_fixed; ?></button>
										<?php } else { ?>
											<button type="button" class="btn btn-success ok" disabled><?php echo $text_ok; ?></button>
										<?php } ?>
									</div>
								</div>
							</div>
							<br>
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
		modal_body = $('#notify .modal-body'),
		product_count = <?php echo $product_count; ?>,
		codes_arr = [],
		order_codes = <?php echo json_encode($order_codes); ?>,
		orders = [];

	$(document).ready(function() {
		$('.set-product input').focus();
		$('.set-order input').focus();
	});

	input_block.on('paste input keypress', '.input', function(e) {
		var _this = $(this);
		if (e.keyCode == "13") {
			var input = _this.parent().find('.input');
			if (input.val().trim() !== '') {
				inputSet(input.val().trim());
			}
		} else if (typeof(e.keyCode) != "undefined" && e.keyCode !== null) {
			e.preventDefault();
			_this.val(_this.val() + e.key);
		} else {
			if (_this.val().length > 1) {
				setTimeout(function() {
					inputSet(_this.val().trim());
				}, 5);
			}
		}
	});

	input_block.on('click', '.clear', function() {
		var this_input_block = $(this).closest('.input-block');
		this_input_block.find('.input').val('').prop('disabled', false);
		hidePopup();
		modal_body.html('');
	});

	input_block.on('click', '.set', function() {
		var input = $(this).parent().find('.input');
		if (input.val().trim() !== '') {
			setTimeout(function() {
				inputSet(input.val().trim());
			}, 5);
		}
	});

	$('body').on('click', '.delete-order', function() {
		$(this).parent('.order').remove();
		checkOrderButton();
	});

	$('.buttons').on('click', '.ok', function() {
		sendOrders();
	});

	$('.buttons').on('click', '.fix', function() {
		fixCodes(codes_arr);
	});

	$('.popup').on('click', '.close', function() {
		hidePopup();
	});

	function inputSet(value) {
		$('.preloader').show();
		<?php if ($product_bays) { ?>
			markProduct(value);
		<?php } else { ?>
			setOrder(value);
		<?php } ?>
	}

	function checkOrderButton() {
		if (getOrders().length) {
			$('.buttons .ok').prop('disabled', false);
		} else {
			$('.buttons .ok').prop('disabled', true);
		}
	}

	function getOrders() {
		orders = [];
		$('.orders').find('.order').each(function(i) {
			orders.push(Number($(this).attr('data-order')));
			$(this).find('.cnt').text(i + 1);
		});
		return orders;
	}

	function setOrder(value) {
		hidePopup();
		modal_body.html('');

		var set_orders = '';

		if (orders.length) {
			set_orders = orders.join(',') + ',' + value;
		} else {
			set_orders = value;
		}

		$.ajax({
			url: 'index.php?route=extension/module/storage_cell/setOrder&token=<?php echo $token; ?>&order_id=' + set_orders,
			method: 'post',
			dataType: 'json',
			success: function(json) {
				$('.preloader').hide();
				$('.set-order input').val('').focus();

				if (json['error']) {
					modal_body.html('<div class="red">' + value + ' - ' + json['error'] + '</div>');
					showPopup();
				} else if (json['success']) {
					modal_body.html('<div class="green">' + value + ' - ' + json['success'] + '</div>');
					showPopup();
					setTimeout(function() {
						hidePopup();
					}, 1000);
					var f = true;
					$('.orders').find('.order').each(function() {
						if (Number($(this).attr('data-order')) == Number(value)) {
							f = false;
						}
					});
					if (f) {
						var html = '<div class="order" data-order="' + value + '"><span class="cnt"></span><span class="title">' + value + '</span><span class="delete-order"><i class="fa fa-times"></i></span></div>';
						$('.orders').append(html);
					}
				}
				checkOrderButton();
			}
		});
	}

	function sendOrders() {
		var orders_arr = getOrders();

		if (orders_arr.length) {
			var url = '<?php echo $build_order_link; ?>';
			window.location = url.replace(/&amp;/gm, '&') + orders_arr.join(',');
		}
	}

	function markProduct(value) {
		hidePopup();
		modal_body.html('');

		var d = false;

		if (typeof(order_codes[value]) != "undefined") {
			var code_data_info = order_codes[value];

			$('.product-block').each(function() {
				var product = $(this),
					title = product.find('.product-title'),
					marked_code = title.find('.marked-code'),
					order_id = Number(title.attr('data-order-id')),
					order_product_id = Number(title.attr('data-order-product-id')),
					option_id = Number(title.attr('data-option-id')),
					option_value_id = Number(title.attr('data-option-value-id'));

				if (typeof(code_data_info[order_id]) != "undefined") {
					var code_data = code_data_info[order_id];
					if (order_id == Number(code_data.order_id) && order_product_id == Number(code_data.order_product_id) && option_id == Number(code_data.option_id) && option_value_id == Number(code_data.option_value_id)) {
						if (product.hasClass('green')) {
							if (marked_code.text() == value) {
								modal_body.html('<div class="red">Товар уже отмечен</div>');
								showPopup();
								return false;
							}
						} else {
							marked_code.text(value);
							product.addClass('green');
							codes_arr.push({
								order_id: order_id,
								product_code: value
							});
							d = true;
							return false;
						}
					}
				}
			});
		} else {
			modal_body.html('<div class="red">Неверный код</div>');
			showPopup();
		}

		if (d === true) {
			modal_body.html('<div class="green">OK</div>');
			showPopup();
			$('.set-product input').val('').focus();
			setTimeout(function() {
				hidePopup();
			}, 1500);
		}

		if (codes_arr.length == Number(product_count)) {
			$('.buttons .fix').prop('disabled', false);
		}

		$('.preloader').hide();
	}

	function fixCodes(data) {
		hidePopup();
		$('.preloader').show();
		modal_body.html('');

		$.ajax({
			url: 'index.php?route=extension/module/storage_cell/fixOrderCodes&token=<?php echo $token; ?>',
			method: 'post',
			data: {
				array: JSON.stringify(data)
			},
			dataType: 'json',
			success: function(json) {
				$('.preloader').hide();

				if (json['error']) {
					modal_body.html('<div class="red">' + json['error'] + '</div>');
					showPopup();
				} else if (json['success']) {
					$('#content .tab-content').remove();
					modal_body.html('<div class="green">' + json['success'] + '</div>');
					showPopup();
				}
			}
		});
	}

	function showPopup() {
		$('.popup').fadeIn(150);
	}

	function hidePopup() {
		$('.popup').fadeOut(150);
	}
</script>

<?php echo $footer; ?>