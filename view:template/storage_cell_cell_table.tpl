<div class="table-cell">
	<form action="" method="post" enctype="multipart/form-data" id="table-cell" class="form-horizontal">
		<table id="cell-value" class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<td class="text-left"><?php echo $entry_room_title; ?></td>
					<td class="text-left"><?php echo $entry_row_title; ?></td>
					<td class="text-left"><?php echo $entry_stack_title; ?></td>
					<td class="text-left"><?php echo $entry_rack_title; ?></td>
					<td class="text-left"><?php echo $entry_cell_title; ?></td>
				</tr>
			</thead>
			<tbody>
				<tr id="cell-value-row">
					<td class="text-left">
						<select name="cell[<?php echo $cell_info['id']; ?>][room]" class="room-name form-control">
							<?php foreach ($bays['room'] as $room) { ?>
								<?php if ($room['id'] == $cell_info['room']) { ?>
									<option value="<?php echo $room['id']; ?>" selected="selected"><?php echo $room['name']; ?></option>
								<?php } else { ?>
									<option value="<?php echo $room['id']; ?>"><?php echo $room['name']; ?></option>
								<?php } ?>
							<?php } ?>
						</select>
					</td>
					<td class="text-left">
						<select name="cell[<?php echo $cell_info['id']; ?>][row]" class="row-name form-control">
							<?php foreach ($bays['row'] as $row) { ?>
								<?php if ($row['id'] == $cell_info['row']) { ?>
									<option value="<?php echo $row['id']; ?>" selected="selected"><?php echo $row['name']; ?></option>
								<?php } else { ?>
									<option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
								<?php } ?>
							<?php } ?>
						</select>
					</td>
					<td class="text-left">
						<select name="cell[<?php echo $cell_info['id']; ?>][stack]" class="stack-name form-control">
							<?php foreach ($bays['stack'] as $stack) { ?>
								<?php if ($stack['id'] == $cell_info['stack']) { ?>
									<option value="<?php echo $stack['id']; ?>" selected="selected"><?php echo $stack['name']; ?></option>
								<?php } else { ?>
									<option value="<?php echo $stack['id']; ?>"><?php echo $stack['name']; ?></option>
								<?php } ?>
							<?php } ?>
						</select>
					</td>
					<td class="text-left">
						<select name="cell[<?php echo $cell_info['id']; ?>][rack]" class="rack-name form-control">
							<?php foreach ($bays['rack'] as $rack) { ?>
								<?php if ($rack['id'] == $cell_info['rack']) { ?>
									<option value="<?php echo $rack['id']; ?>" selected="selected"><?php echo $rack['name']; ?></option>
								<?php } else { ?>
									<option value="<?php echo $rack['id']; ?>"><?php echo $rack['name']; ?></option>
								<?php } ?>
							<?php } ?>
						</select>
					</td>
					<td class="text-left">
						<select name="cell[<?php echo $cell_info['id']; ?>][cell]" class="cell-name form-control">
							<?php foreach ($bays['cell'] as $cell) { ?>
								<?php if ($cell['id'] == $cell_info['cell']) { ?>
									<option value="<?php echo $cell['id']; ?>" selected="selected"><?php echo $cell['name']; ?></option>
								<?php } else { ?>
									<option value="<?php echo $cell['id']; ?>"><?php echo $cell['name']; ?></option>
								<?php } ?>
							<?php } ?>
						</select>
					</td>
				</tr>
			</tbody>
		</table>
	</form>
	<div class="text-center button">
		<button type="button" class="btn btn-primary save" style="margin: 15px 0;"><?php echo $button_save; ?></button>
	</div>
</div>

<script>
	$('body').on('click', '.save', function(e) {
		e.preventDefault();

		$('.table-cell .button').html('<div class="preloader"><div class="loader"></div></div>');

		$.ajax({
			url: 'index.php?route=extension/module/storage_cell/editCell&token=<?php echo $token; ?>',
			method: 'post',
			dataType: 'json',
			data: $('#table-cell').serialize(),
			success: function(json) {
				if (json == 'ok') {
					$('#edit-modal').modal('hide');
					$('.block.room').find('.title .buttons .collapse-btn').click();
				}
			}
		});
	});
</script>