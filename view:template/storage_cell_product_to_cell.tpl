<?php echo $header; ?><?php echo $column_left; ?>
<div id="content" class="storage-cell product-to-cell">
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
					<a href="javascript:void(0);" class="btn btn-primary"><?php echo $button_product_to_cell; ?></a>
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
						<div class="col-xs-12 col-sm-7 name">
							<input type="hidden" name="product_code_id" id="product-code-id" value="" />
							<div id="product-name" class="product-name" style="display: none;"></div>
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
						<div class="col-xs-12 col-sm-7 name">
							<input type="hidden" name="cell_id" id="cell-id" value="" />
							<div id="cell-name" class="cell-name" style="display: none;"></div>
						</div>
					</div>
					<br />
					<div class="bottom buttons">
						<div class="row">
							<div class="col-xs-12 col-sm-1"></div>
							<div class="col-xs-12 col-sm-4">
								<div class="row">
									<div class="col-xs-8">
										<button type="button" class="btn btn-success link" data-action="link" disabled><?php echo $text_link; ?></button>
									</div>
									<div class="col-xs-4">
										<button type="button" class="btn btn-danger unlink" data-action="unlink" disabled><?php echo $text_unlink; ?></button>
									</div>
								</div>
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
		button_link = $('button.link'),
		button_unlink = $('button.unlink'),
		modal_body = $('#notify .modal-body'),
		product_already_linked = false;

	$(document).ready(function() {
		$('.set-product input').focus();
	});

	$('#new').on('click', function() {
		modal_body.html('');
		hidePopup();
		button_link.prop('disabled', true);
		button_unlink.prop('disabled', true);
		$('input[name="product"]').val('').prop('disabled', false);
		$('input[name="cell"]').val('').prop('disabled', false);
		$('#product-name').html('');
		$('#product-code-id').val('');
		$('#cell-name').html('');
		$('#cell-id').val('');
		$('.set-product input').focus();
	});

	// input_block.on('keydown keyup keydown keyup keypress', '.input', function(e) {
	// 	setTimeout(function() {
	// 		findValue(_this.attr('data-method'), _this.val().trim());
	// 	}, 5000);
	// });

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
		product_already_linked = false;
		hidePopup();
		modal_body.html('');
		setTimeout(function() {
			checkForm();
		}, 50);
	});

	input_block.on('click', '.set', function() {
		var input = $(this).parent().find('.input');
		if (input.val().trim() !== '') {
			findValue(input.attr('data-method'), input.val().trim());
		}
	});

	$('.buttons').on('click', 'button', function() {
		action($(this).attr('data-action'));
	});

	$('.popup').on('click', '.close', function() {
		hidePopup();
	});

	function findValue(method, value) {
		hidePopup();
		$('.preloader').show();
		modal_body.html('');

		if (method == 'product') {
			$('#product-name').html('');
			$('#product-code-id').val('');
		}
		if (method == 'cell') {
			$('#cell-name').html('');
			$('#cell-id').val('');
		}
		
		value = value.replace('судд_', 'cell_');

		$.ajax({
			url: 'index.php?route=extension/module/storage_cell/findValue&operation=product_to_cell&method=' + method + '&value=' + value + '&token=<?php echo $token; ?>',
			dataType: 'json',
			success: function(json) {
				$('.preloader').hide();

				if (method == 'product') {
					if (json['error']) {
						$('#product-code-id').val('');
						if (json['already_linked']) {
							product_already_linked = true;
							$('#product-code-id').val(json['product_code_id']);
							$('input[name="product"]').prop('disabled', true);
							$('#product-name').html(json['product_name']).fadeIn(150);
							$('.set-cell input').focus();
						} else {
							product_already_linked = false;
						}
						modal_body.html('<div class="red">' + json['error'] + '</div>');
						showPopup();
					} else if (json['success']) {
						product_already_linked = false;
						$('#product-code-id').val(json['product_code_id']);
						$('input[name="product"]').prop('disabled', true);
						$('#product-name').html(json['product_name']).fadeIn(150);
						modal_body.html('<div class="green">' + json['success'] + '</div>');
						$('.set-cell input').focus();
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
						$('#cell-name').html(json['cell_name']).fadeIn(150);
						modal_body.html('<div class="green">' + json['success'] + '</div>');
						showPopup();
						setTimeout(function() {
							hidePopup();
						}, 1000);
					}
				}
				setTimeout(function() {
					checkForm();
				}, 50);
			}
		});
	}

	function action(action) {
		var product_code_id = $('#product-code-id').val(),
			cell_id = $('#cell-id').val();

		hidePopup();
		$('.preloader').show();
		modal_body.html('');

		$.ajax({
			url: 'index.php?route=extension/module/storage_cell/action&operation=product_to_cell&action=' + action + '&product_code_id=' + product_code_id + '&cell_id=' + cell_id + '&token=<?php echo $token; ?>',
			dataType: 'json',
			success: function(json) {
				$('.preloader').hide();
				if (json['error']) {
					modal_body.html('<div class="red">' + json['error'] + '</div>');
					showPopup();
				} else if (json['success']) {
					modal_body.html('<div class="green">' + json['success'] + '</div>');
					showPopup();
					button_link.prop('disabled', true);
					button_unlink.prop('disabled', true);
					$('input[name="product"]').val('').prop('disabled', false);
					$('input[name="cell"]').val('').prop('disabled', false);
					$('#product-name').html('');
					$('#product-code-id').val('');
					$('#cell-name').html('');
					$('#cell-id').val('');
					$('.set-product input').focus();
					setTimeout(function() {
						hidePopup();
					}, 1500);
				}
			}
		});
	}

	function checkForm() {
		if ($('#product-code-id').val() !== '') {
			if (product_already_linked == true) {
				button_link.prop('disabled', true);
				button_unlink.prop('disabled', false);
			} else {
				if ($('#cell-id').val() !== '') {
					button_link.prop('disabled', false);
				}
			}
		} else {
			button_link.prop('disabled', true);
			button_unlink.prop('disabled', true);
		}
		if ($('#cell-id').val() === '') {
			button_link.prop('disabled', true);
		}
	}

	function showPopup() {
		$('.popup').fadeIn(150);
	}

	function hidePopup() {
		$('.popup').fadeOut(150);
	}
</script>

<?php echo $footer; ?>