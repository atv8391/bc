<?php
class ModelExtensionModuleStorageCell extends Model {

	private $lang_id = 2;

	public function getBay($bay_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "storage_cell_bay` WHERE id = '" . (int)$bay_id . "'");

		return $query->row;
	}

	public function getBays() {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "storage_cell_bay` ORDER BY type, sort_order, name ASC");

		$arr = array();

		if ($query->rows) {
			foreach ($query->rows as $row) {
				$arr[$row['id']] = $row;
			}
		}

		return $arr;
	}

	public function getCellToBay($cell_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "storage_cell_cell_to_bay` WHERE id = '" . (int)$cell_id . "'");

		return $query->row;
	}

	public function getCellToBays($type = '', $ids = array(), $count = false) {
		if ($count) {
			$sql = "SELECT ctb.*, (SELECT COUNT(ptc.product_code_id) FROM `" . DB_PREFIX . "storage_cell_product_to_cell` ptc WHERE ctb.id = ptc.cell_id) AS count FROM `" . DB_PREFIX . "storage_cell_cell_to_bay` ctb";
		} else {
			$sql = "SELECT * FROM `" . DB_PREFIX . "storage_cell_cell_to_bay` ctb";
		}

		if ($type) {
			$sql .= " WHERE room = '" . (int)$ids['room'] . "'";
			foreach ($ids as $type => $id) {
				if ($id) {
					$sql .= " AND " . $this->db->escape($type) . " = '" . (int)$id . "'";
				}
			}
		}

		$sql .= " ORDER BY ctb.room, ctb.row, ctb.stack, ctb.rack, ctb.cell ASC";

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getCellIdByData($data) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "storage_cell_cell_to_bay` WHERE room = '" . $data['room'] . "' AND row = '" . $data['row'] . "' AND stack = '" . $data['stack'] . "' AND rack = '" . $data['rack'] . "' AND cell = '" . $data['cell'] . "' LIMIT 1 ");

		return $query->row;
	}

	public function getStructuredCellToBays() {
		$cell_to_bays = $this->getCellToBays();
		$bays_info = $this->getBays();

		$bays = array();

		foreach ($bays_info as $bay_info) {
			$bays[$bay_info['type']][$bay_info['id']] = $bay_info['name'];
			$sort[$bay_info['type']][] = $bay_info['id'];
		}

		$structured_bays_temp = array();
		$structured_bays = array();

		foreach ($cell_to_bays as $cell_to_bay) {
			$structured_bays_temp['room'][$cell_to_bay['room']] = array(
				'id'			=> $cell_to_bay['room'],
				'name'		=> $bays['room'][$cell_to_bay['room']],
			);
		}
		foreach ($cell_to_bays as $cell_to_bay) {
			$structured_bays_temp['room'][$cell_to_bay['room']]['row'][$cell_to_bay['row']] = array(
				'id'			=> $cell_to_bay['row'],
				'name'		=> $bays['row'][$cell_to_bay['row']],
			);
		}
		foreach ($cell_to_bays as $cell_to_bay) {
			$structured_bays_temp['room'][$cell_to_bay['room']]['row'][$cell_to_bay['row']]['stack'][$cell_to_bay['stack']] = array(
				'id'			=> $cell_to_bay['stack'],
				'name'		=> $bays['stack'][$cell_to_bay['stack']],
			);
		}
		foreach ($cell_to_bays as $cell_to_bay) {
			$structured_bays_temp['room'][$cell_to_bay['room']]['row'][$cell_to_bay['row']]['stack'][$cell_to_bay['stack']]['rack'][$cell_to_bay['rack']] = array(
				'id'			=> $cell_to_bay['rack'],
				'name'		=> $bays['rack'][$cell_to_bay['rack']],
			);
		}
		foreach ($cell_to_bays as $cell_to_bay) {
			$structured_bays_temp['room'][$cell_to_bay['room']]['row'][$cell_to_bay['row']]['stack'][$cell_to_bay['stack']]['rack'][$cell_to_bay['rack']]['cell'][$cell_to_bay['cell']] = array(
				'cell_id'	=> $cell_to_bay['id'],
				'id'			=> $cell_to_bay['cell'],
				'name'		=> $bays['cell'][$cell_to_bay['cell']],
			);
		}

		foreach ($structured_bays_temp['room'] as $id => $room) {
			$key = array_search($id, $sort['room']);
			$structured_bays['room'][$key] = $room;
		}

		foreach ($structured_bays['room'] as $room_id => $room) {
			foreach ($room['row'] as $id => $value) {
				$key = array_search($id, $sort['row']);
				unset($structured_bays['room'][$room_id]['row'][$id]);
				$structured_bays['room'][$room_id]['row'][$key] = $value;
			}
		}

		foreach ($structured_bays['room'] as $room_id => $room) {
			foreach ($room['row'] as $row_id => $row) {
				foreach ($row['stack'] as $id => $value) {
					$key = array_search($id, $sort['stack']);
					unset($structured_bays['room'][$room_id]['row'][$row_id]['stack'][$id]);
					$structured_bays['room'][$room_id]['row'][$row_id]['stack'][$key] = $value;
				}
			}
		}

		foreach ($structured_bays['room'] as $room_id => $room) {
			foreach ($room['row'] as $row_id => $row) {
				foreach ($row['stack'] as $stack_id => $stack) {
					foreach ($stack['rack'] as $id => $value) {
						$key = array_search($id, $sort['rack']);
						unset($structured_bays['room'][$room_id]['row'][$row_id]['stack'][$stack_id]['rack'][$id]);
						$structured_bays['room'][$room_id]['row'][$row_id]['stack'][$stack_id]['rack'][$key] = $value;
					}
				}
			}
		}

		foreach ($structured_bays['room'] as $room_id => $room) {
			foreach ($room['row'] as $row_id => $row) {
				foreach ($row['stack'] as $stack_id => $stack) {
					foreach ($stack['rack'] as $rack_id => $rack) {
						foreach ($rack['cell'] as $id => $value) {
							$key = array_search($id, $sort['cell']);
							unset($structured_bays['room'][$room_id]['row'][$row_id]['stack'][$stack_id]['rack'][$rack_id]['cell'][$id]);
							$structured_bays['room'][$room_id]['row'][$row_id]['stack'][$stack_id]['rack'][$rack_id]['cell'][$key] = $value;
						}
					}
				}
			}
		}

		ksort($structured_bays['room']);

		foreach ($structured_bays['room'] as $room_id => $room) {
			ksort($structured_bays['room'][$room_id]['row']);
			foreach ($room['row'] as $row_id => &$row) {
				ksort($structured_bays['room'][$room_id]['row'][$row_id]['stack']);
				foreach ($row['stack'] as $stack_id => &$stack) {
					ksort($structured_bays['room'][$room_id]['row'][$row_id]['stack'][$stack_id]['rack']);
					foreach ($stack['rack'] as $rack_id => &$rack) {
						ksort($structured_bays['room'][$room_id]['row'][$row_id]['stack'][$stack_id]['rack'][$rack_id]['cell']);
					}
				}
			}
		}

		return $structured_bays;
	}

	public function editBay($data) {
		if ($data['bays']) {
			$db_bays_info = $this->getBays();

			$db_bays = array();

			if ($db_bays_info) {
				foreach ($db_bays_info as $db_bay) {
					$db_bays[$db_bay['id']] = $db_bay['id'];
				}
			}

			foreach ($data['bays'] as $type => $bays) {
				foreach ($bays as $bay_id => $value) {
					if (in_array($bay_id, $db_bays)) {
						$this->db->query("UPDATE `" . DB_PREFIX . "storage_cell_bay` SET type = '" . $this->db->escape($type) . "', name = '" . $this->db->escape($value['name']) . "', sort_order = '" . (int)$value['sort_order'] . "' WHERE id = '" . (int)$bay_id . "'");
					} else {
						$this->db->query("INSERT INTO `" . DB_PREFIX . "storage_cell_bay` SET type = '" . $this->db->escape($type) . "', name = '" . $this->db->escape($value['name']) . "', sort_order = '" . (int)$value['sort_order'] . "'");
					}
				}
			}
		}
	}

	public function editCell($data) {
		if ($data['cells']) {
			$db_cells_info = $this->getCellToBays();

			$db_cells = array();

			if ($db_cells_info) {
				foreach ($db_cells_info as $db_cell) {
					$db_cells[$db_cell['id']] = $db_cell['id'];
				}
			}

			foreach ($data['cells'] as $cell) {
				if (isset($cell['id']) && in_array($cell['id'], $db_cells)) {
					$this->db->query("UPDATE `" . DB_PREFIX . "storage_cell_cell_to_bay` SET room = '" . $this->db->escape($cell['room']) . "', row = '" . $this->db->escape($cell['row']) . "', stack = '" . $this->db->escape($cell['stack']) . "', rack = '" . $this->db->escape($cell['rack']) . "', cell = '" . $this->db->escape($cell['cell']) . "' WHERE id = '" . (int)$cell['id'] . "'");
				} else {
					$this->db->query("INSERT INTO `" . DB_PREFIX . "storage_cell_cell_to_bay` SET room = '" . $this->db->escape($cell['room']) . "', row = '" . $this->db->escape($cell['row']) . "', stack = '" . $this->db->escape($cell['stack']) . "', rack = '" . $this->db->escape($cell['rack']) . "', cell = '" . $this->db->escape($cell['cell']) . "'");
				}
			}
		}
	}

	public function checkProductBayLink($bay_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "storage_cell_bay` WHERE id = '" . (int)$bay_id . "'");

		if ($query->num_rows) {
			$type = $query->row['type'];
			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "storage_cell_cell_to_bay` WHERE " . $this->db->escape($type) . " = '" . (int)$bay_id . "'");

			if ($query->num_rows) {
				foreach ($query->rows as $row) {
					$query2 = $this->db->query("SELECT * FROM `" . DB_PREFIX . "storage_cell_product_to_cell` WHERE cell_id = '" . (int)$row['id'] . "'");

					if ($query2->num_rows) {
						return true;
					}
				}
			}
		}

		return false;
	}

	public function checkProductCellLink($cell_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "storage_cell_product_to_cell` WHERE cell_id = '" . (int)$cell_id . "'");

		if ($query->num_rows) {
			$query2 = $this->db->query("SELECT * FROM `" . DB_PREFIX . "storage_cell_cell_to_bay` WHERE id = '" . (int)$cell_id . "'");

			$bay_name = array();

			if ($query2->num_rows) {
				foreach ($query2->row as $type => $bay_id) {
					if ($type != 'id') {
						$bay = $this->getBay($bay_id);

						if ($bay) {
							$bay_name[] = $bay['name'];
						}
					}
				}
			}
			return implode(' - ', $bay_name);
		}

		return false;
	}

	public function removeBay($bay_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "storage_cell_bay` WHERE id = '" . (int)$bay_id . "'");

		if ($query->num_rows) {
			$type = $query->row['type'];
			$this->db->query("DELETE FROM `" . DB_PREFIX . "storage_cell_bay` WHERE id = '" . (int)$bay_id . "'");
			$this->db->query("DELETE FROM `" . DB_PREFIX . "storage_cell_cell_to_bay` WHERE " . $this->db->escape($type) . " = '" . (int)$bay_id . "'");
		}
	}

	public function removeCell($cell_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "storage_cell_cell_to_bay` WHERE id = '" . (int)$cell_id . "'");

		if ($query->num_rows) {
			$this->db->query("DELETE FROM `" . DB_PREFIX . "storage_cell_cell_to_bay` WHERE id = '" . (int)$cell_id . "'");
		}
	}

	public function removeProductCode($product_code_id) {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "storage_cell_product_code` WHERE id = '" . (int)$product_code_id . "'");
		$this->db->query("DELETE FROM `" . DB_PREFIX . "storage_cell_history` WHERE product_code_id = '" . (int)$product_code_id . "'");
	}

	public function getProductsWithOptions($data) {
		$products = array();

		$sql = "SELECT p.*, m.name AS manufacturer FROM `" . DB_PREFIX . "product` p LEFT JOIN `" . DB_PREFIX . "manufacturer` m ON (m.manufacturer_id = p.manufacturer_id)";

		if (isset($data['product_id']) && $data['product_id']) {
			$sql .= " WHERE p.product_id =" . (int)$data['product_id'];
		}

		$sql .= " ORDER BY product_id LIMIT " . $data['start'] . "," . $data['limit'];

		$query = $this->db->query($sql);

		if ($query->num_rows) {
			foreach ($query->rows as $row) {
				$products[$row['product_id']] = array(
					'product_id' 	=> $row['product_id'],
					'model' 			=> $row['model'],
					'manufacturer' => str_replace(' ', '', preg_replace("/[^a-zA-ZА-Яа-я0-9\s]/", '', $row['manufacturer'])),
					'quantity' 		=> $row['quantity'],
					'date_added' 	=> $row['date_added'],
				);
				$product_options = $this->db->query("SELECT * FROM `" . DB_PREFIX . "product_option_value` WHERE product_id = " . $row['product_id']);
				if ($product_options->num_rows) {
					$products[$row['product_id']]['options'] = $product_options->rows;
				}
			}
		}

		return $products;
	}

	public function getOptionDescription($option_id) {
		$query = $this->db->query("SELECT name FROM " . DB_PREFIX . "option_description WHERE option_id = '" . (int)$option_id . "' AND language_id = '" . (int)$this->lang_id . "'");

		return $query->row['name'];
	}

	public function getOptionValueDescription($option_value_id) {
		$query = $this->db->query("SELECT name FROM " . DB_PREFIX . "option_value_description WHERE option_value_id = '" . (int)$option_value_id . "' AND language_id = '" . (int)$this->lang_id . "'");

		return $query->row['name'];
	}

	public function addProductUniqueCode($data) {
		$this->db->query("INSERT INTO `" . DB_PREFIX . "storage_cell_product_code` SET product_id = '" . (int)$data['product_id'] . "', product_model = '" . $this->db->escape($data['model']) . "', manufacturer = '" . $this->db->escape($data['manufacturer']) . "', option_id = '" . (int)$data['option_id'] . "', option_value_id = '" . (int)$data['option_value_id'] . "', count = '" . (int)$data['count'] . "', unique_code = '" . $this->db->escape($data['unique_code']) . "', date_code_added = NOW()");
	}

	public function clearUniqueCodes() {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "storage_cell_product_code`");
	}

	public function clearUniqueCodeLinks() {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "storage_cell_product_to_cell`");
	}

	public function clearUniqueCodeHistory() {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "storage_cell_history`");
	}

	public function getProductByUniqueCode($product_unique_code) {
		$product = $this->db->query("SELECT pc.*, pd.name AS product_name, ptc.cell_id AS cell_id FROM `" . DB_PREFIX . "storage_cell_product_code` pc LEFT JOIN `" . DB_PREFIX . "product_description` pd ON (pd.product_id = pc.product_id) LEFT JOIN `" . DB_PREFIX . "storage_cell_product_to_cell` ptc ON (ptc.product_code_id = pc.id) WHERE pc.unique_code = '" . $this->db->escape($product_unique_code) . "' AND pd.language_id = '" . (int)$this->lang_id . "'");

		return $product->row;
	}

	public function getProductCodesByData($data) {
		$sql = "SELECT * FROM `" . DB_PREFIX . "storage_cell_product_code`";

		if (isset($data['product_id']) && $data['product_id']) {
			$sql .= " WHERE product_id = '" . (int)$data['product_id'] . "'";
		} elseif (isset($data['product_code_id']) && $data['product_code_id']) {
			$sql .= " WHERE id = '" . (int)$data['product_code_id'] . "'";
		}

		if ((isset($data['option_id']) && $data['option_id']) && (isset($data['option_value_id']) && $data['option_value_id'])) {
			$sql .= " AND option_id = '" . (int)$data['option_id'] . "' AND option_value_id = '" . (int)$data['option_value_id'] . "'";
		}

		$sql .= " ORDER BY product_id, option_id, option_value_id, count ASC";

		$result = $this->db->query($sql);

		return $result->rows;
	}

	public function getCellByProductCodeId($product_code_id) {
		$query = $this->db->query("SELECT ptc.cell_id FROM `" . DB_PREFIX . "storage_cell_product_to_cell` ptc WHERE product_code_id = '" . (int)$product_code_id . "'");

		return $query->row;
	}

	public function getCellById($cell_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "storage_cell_cell_to_bay` WHERE id = '" . (int)$cell_id . "'");

		$bay_name = array();

		if ($query->num_rows) {
			foreach ($query->row as $type => $bay_id) {
				if ($type != 'id' && $type != 'sort_order') {
					$bay = $this->getBay($bay_id);

					if ($bay) {
						$bay_name[] = $bay['name'];
					}
				}
			}
			return implode(' - ', $bay_name);
		}

		return false;
	}

	public function getCellAuditDate($cell_id) {
		$query = $this->db->query("SELECT date_audit FROM `" . DB_PREFIX . "storage_cell_cell_to_bay` WHERE id = '" . (int)$cell_id . "'");

		return $query->row['date_audit'];
	}

	public function linkProduct($product_code_id, $cell_id) {
		$this->db->query("INSERT INTO `" . DB_PREFIX . "storage_cell_product_to_cell` SET cell_id = '" . (int)$cell_id . "', product_code_id = '" . (int)$product_code_id . "'");

		$this->db->query("INSERT INTO `" . DB_PREFIX . "storage_cell_history` SET product_code_id = '" . (int)$product_code_id . "', history_action = 'link', date_history_action = NOW()");

		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "storage_cell_product_to_cell` WHERE cell_id = '" . (int)$cell_id . "' AND product_code_id = '" . (int)$product_code_id . "'");

		return $query->row;
	}

	public function unlinkProduct($product_code_id, $cell_id = '') {
		if ($cell_id) {
			$this->db->query("DELETE FROM `" . DB_PREFIX . "storage_cell_product_to_cell` WHERE cell_id = '" . (int)$cell_id . "' AND product_code_id = '" . (int)$product_code_id . "'");

			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "storage_cell_product_to_cell` WHERE cell_id = '" . (int)$cell_id . "' AND product_code_id = '" . (int)$product_code_id . "'");
		} else {
			$this->db->query("DELETE FROM `" . DB_PREFIX . "storage_cell_product_to_cell` WHERE product_code_id = '" . (int)$product_code_id . "'");

			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "storage_cell_product_to_cell` WHERE product_code_id = '" . (int)$product_code_id . "'");
		}

		$this->db->query("INSERT INTO `" . DB_PREFIX . "storage_cell_history` SET product_code_id = '" . (int)$product_code_id . "', history_action = 'unlink', date_history_action = NOW()");

		return $query->row;
	}

	public function fixProductCode($data) {
		$error = array();
		$new_data = array();

		if ($data) {
			foreach ($data as $value) {
				$query = $this->db->query("SELECT id FROM `" . DB_PREFIX . "storage_cell_product_code` WHERE unique_code = '" . $this->db->escape($value['product_code']) . "'");

				if ($query->row['id']) {
					$new_data[] = array(
						'order_id'				=> $value['order_id'],
						'product_code_id'	=> $query->row['id'],
					);
				} else {
					$error['error'][] = $value['product_code'];
				}
			}

			if (!$error) {
				foreach ($new_data as $value) {
					$this->db->query("INSERT INTO `" . DB_PREFIX . "storage_cell_order` SET order_id = '" . (int)$value['order_id'] . "', product_code_id = '" . (int)$value['product_code_id'] . "'");

					$this->db->query("DELETE FROM `" . DB_PREFIX . "storage_cell_product_to_cell` WHERE product_code_id = '" . (int)$value['product_code_id'] . "'");

					$this->db->query("INSERT INTO `" . DB_PREFIX . "storage_cell_history` SET product_code_id = '" . (int)$value['product_code_id'] . "', history_action = 'order', date_history_action = NOW()");
				}
				return 'ok';
			} else {
				return $error;
			}
		} else {
			return 'error_entry_data';
		}
	}

	public function setCellCheckDate($cell_id) {
		$this->db->query("UPDATE `" . DB_PREFIX . "storage_cell_cell_to_bay` SET date_audit = NOW() WHERE id = '" . (int)$cell_id . "'");
	}

	public function getAllManufacturers() {
		$query = $this->db->query("SELECT manufacturer_id, name FROM `" . DB_PREFIX . "manufacturer_description` WHERE language_id = '" . (int)$this->lang_id . "' ORDER BY manufacturer_id");

		$manufacturers = array();

		foreach ($query->rows as $row) {
			$manufacturers[$row['manufacturer_id']] = $row;
		}

		return $manufacturers;
	}

	public function getAllOptions() {
		$query = $this->db->query("SELECT ovd.option_value_id, ovd.name AS option_value_name, od.option_id, od.name AS option_name FROM `" . DB_PREFIX . "option_value_description` ovd LEFT JOIN `" . DB_PREFIX . "option_description` od ON (ovd.option_id = od.option_id AND od.language_id = '" . (int)$this->lang_id . "') WHERE ovd.language_id = '" . (int)$this->lang_id . "' ORDER BY od.option_id, ovd.option_value_id");

		$options = array();

		foreach ($query->rows as $row) {
			$options[$row['option_value_id']] = $row;
		}

		return $options;
	}

	public function getAllProductOptionValues($data = array()) {
		$sql = "SELECT pov.product_id, pov.option_id, pov.option_value_id, pov.quantity FROM `" . DB_PREFIX . "product_option_value` pov";

		if (!empty($data['filter_category'])) {
			$sql .= " LEFT JOIN `" . DB_PREFIX . "product_to_category` ptc ON (ptc.product_id = pov.product_id) WHERE ptc.category_id IN (" . implode(',', $data['filter_category']) . ")";
		}

		$sql .= " ORDER BY pov.product_id, pov.option_id, pov.option_value_id";

		$query = $this->db->query($sql);

		$option_values = array();

		foreach ($query->rows as $row) {
			$option_values[$row['product_id']][$row['option_id']][$row['option_value_id']] = $row['quantity'];
		}

		return $option_values;
	}

	public function getAllUniqueCodes($data = array()) {
		$sql = "SELECT scpc.*, scptc.cell_id, sco.*, o.order_id, o.order_status_id FROM `" . DB_PREFIX . "storage_cell_product_code` scpc LEFT JOIN `" . DB_PREFIX . "storage_cell_product_to_cell` scptc ON (scptc.product_code_id = scpc.id) LEFT JOIN `" . DB_PREFIX . "storage_cell_order` sco ON (sco.product_code_id = scpc.id) LEFT JOIN `" . DB_PREFIX . "order` o ON (o.order_id = sco.order_id)";

		if (!empty($data['filter_category'])) {
			$sql .= " LEFT JOIN `" . DB_PREFIX . "product_to_category` ptc ON (ptc.product_id = scpc.product_id) WHERE ptc.category_id IN (" . implode(',', $data['filter_category']) . ")";
		}

		$sql .= " ORDER BY scpc.product_id, o.order_id, scpc.unique_code";

		$query = $this->db->query($sql);

		$temp = array();

		foreach ($query->rows as $row) {
			$temp[$row['id']] = $row;
		}

		$codes = array();

		foreach ($temp as $value) {
			if ($data['filter_sold'] == 0) {
				if (!in_array($value['order_status_id'], array_merge($this->config->get('config_processing_status'), $this->config->get('config_complete_status'))) || $value['cell_id']) {
					$codes[$value['product_id']][$value['option_value_id']][] = $value;
				}
			} else {
				$codes[$value['product_id']][$value['option_value_id']][] = $value;
			}
		}

		return $codes;
	}

	public function getAllProductToCell($data = array()) {
		$sql = "SELECT * FROM `" . DB_PREFIX . "storage_cell_product_to_cell` scptc";

		if (!empty($data['filter_category'])) {
			$sql .= " LEFT JOIN `" . DB_PREFIX . "storage_cell_product_code` scpc ON (scpc.id = scptc.product_code_id) LEFT JOIN `" . DB_PREFIX . "product_to_category` ptc ON (ptc.product_id = scpc.product_id) WHERE ptc.category_id IN (" . implode(',', $data['filter_category']) . ")";
		}

		if (!empty($data['filter_code_cell'])) {
			$str = str_replace(array('storage_cell_', 'cell_'), array('', ''), $this->db->escape($data['filter_code_cell']));

			if (!empty($data['filter_category'])) {
				$sql .= " AND scptc.cell_id = '" . $str . "'";
			} else {
				$sql .= " WHERE scptc.cell_id = '" . $str . "'";
			}
		}

		$sql .= " ORDER BY scptc.product_code_id";

		$query = $this->db->query($sql);

		$ptc = array();

		foreach ($query->rows as $row) {
			$ptc[$row['product_code_id']] = $row['cell_id'];
		}

		return $ptc;
	}

	public function getProducts($data = array()) {
		$sql = "SELECT p.*, pd.name FROM `" . DB_PREFIX . "product` p LEFT JOIN `" . DB_PREFIX . "product_description` pd ON (pd.product_id = p.product_id)";

		if (!empty($data['filter_category'])) {
			$sql .= " LEFT JOIN `" . DB_PREFIX . "product_to_category` ptc ON (ptc.product_id = p.product_id)";
		}

		$sql .= " WHERE pd.language_id = '" . (int)$this->lang_id . "'";

		if (!empty($data['filter_product_id'])) {
			$sql .= " AND p.product_id IN (" . implode(',', $data['filter_product_id']) . ")";
		}

		if (!empty($data['filter_name'])) {
			$sql .= " AND (pd.name LIKE '%" . $this->db->escape($data['filter_name']) . "%' OR p.model LIKE '%" . $this->db->escape($data['filter_name']) . "%')";
		}

		if (!empty($data['filter_category'])) {
			$sql .= " AND ptc.category_id IN (" . implode(',', $data['filter_category']) . ")";
		}

		$sql .= " ORDER BY p.product_id ASC";

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		$products = array();

		if ($query->num_rows) {
			foreach ($query->rows as $row) {
				$products[$row['product_id']] = $row;
			}
		}

		return $products;
	}

	public function getAllOrders() {
		$query = $this->db->query("SELECT op.*, oo.*, o.*, pov.option_id, pov.option_value_id, pov.product_option_id, pov.product_option_value_id, sco.product_code_id FROM " . DB_PREFIX . "order_product op LEFT JOIN " . DB_PREFIX . "order_option oo ON (op.order_id = oo.order_id AND op.order_product_id = oo.order_product_id) LEFT JOIN " . DB_PREFIX . "order o ON (o.order_id = op.order_id) LEFT JOIN " . DB_PREFIX . "product_option_value pov ON (pov.product_option_id = oo.product_option_id AND pov.product_option_value_id = oo.product_option_value_id) LEFT JOIN " . DB_PREFIX . "storage_cell_order sco ON (o.order_id = sco.order_id) WHERE o.date_added >= NOW() - INTERVAL 3 MONTH AND o.order_status_id IN (" . implode(',', $this->config->get('config_processing_status')) . ")");

		return $query->rows;
	}

	public function getOrders($product_id) {
		$query = $this->db->query("SELECT op.*, oo.*, o.*, sco.product_code_id FROM " . DB_PREFIX . "order_product op LEFT JOIN " . DB_PREFIX . "order_option oo ON (op.order_id = oo.order_id AND op.order_product_id = oo.order_product_id) LEFT JOIN " . DB_PREFIX . "order o ON (o.order_id = op.order_id) LEFT JOIN " . DB_PREFIX . "storage_cell_order sco ON (o.order_id = sco.order_id) WHERE op.product_id = '" . (int)$product_id . "' AND o.date_added >= NOW() - INTERVAL 3 MONTH");

		return $query->rows;
	}

	public function getOrderHistory($product_code_id) {
		$query = $this->db->query("SELECT sco.*, o.order_status_id, o.date_added, os.name FROM `" . DB_PREFIX . "storage_cell_order` sco LEFT JOIN `" . DB_PREFIX . "order` o ON (o.order_id = sco.order_id) LEFT JOIN `" . DB_PREFIX . "order_status` os ON (o.order_status_id = os.order_status_id AND os.language_id = '" . (int)$this->lang_id . "') WHERE sco.product_code_id = '" . (int)$product_code_id . "' ORDER BY sco.order_id");

		$orders = array();

		if ($query->rows) {
			foreach ($query->rows as $row) {
				$orders[] = array(
					'order_id'				=> $row['order_id'],
					'order_status_id'	=> $row['order_status_id'],
					'order_name'			=> $row['name'],
					'date_added'			=> date('d.m.Y', strtotime($row['date_added'])),
				);
			}
		}

		return $orders;
	}

	public function getCodeHistory($product_code_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "storage_cell_history` WHERE product_code_id = '" . (int)$product_code_id . "' ORDER BY date_history_action");

		$history = array();

		if ($query->rows) {
			foreach ($query->rows as $row) {
				$history[] = array(
					'history_id'	=> $row['history_id'],
					'action'			=> $row['history_action'],
					'date'				=> date('d.m.Y h:i', strtotime($row['date_history_action'])),
				);
			}
		}

		return $history;
	}

	public function getByCode($data = array()) {
		$sql = "SELECT DISTINCT * FROM `" . DB_PREFIX . "storage_cell_product_code` scpc LEFT JOIN `" . DB_PREFIX . "product` p ON (p.product_id = scpc.product_id) LEFT JOIN `" . DB_PREFIX . "product_description` pd ON (pd.product_id = scpc.product_id) LEFT JOIN `" . DB_PREFIX . "storage_cell_product_to_cell` scptc ON (scptc.product_code_id = scpc.id) LEFT JOIN `" . DB_PREFIX . "storage_cell_order` sco ON (sco.product_code_id = scpc.id) LEFT JOIN `" . DB_PREFIX . "storage_cell_history` sch ON (sch.product_code_id = scpc.id) LEFT JOIN `" . DB_PREFIX . "order` o ON (o.order_id = sco.order_id)";

		$sql .= " WHERE pd.language_id = '" . (int)$this->lang_id . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND (pd.name LIKE '%" . $this->db->escape($data['filter_name']) . "%' OR p.model LIKE '%" . $this->db->escape($data['filter_name']) . "%')";
		}

		if (!empty($data['filter_code_product'])) {
			$sql .= " AND scpc.unique_code LIKE '%" . $this->db->escape($data['filter_code_product']) . "%'";
		}

		if (!empty($data['filter_code_cell'])) {
			$str = str_replace(array('storage_cell_', 'cell_'), array('', ''), $this->db->escape($data['filter_code_cell']));
			$sql .= " AND scptc.cell_id = '" . $str . "'";
		}

		if (!empty($data['filter_history'])) {
			$sql .= " AND sch.history_action = '" . $this->db->escape($data['filter_history']) . "'";

			if (!empty($data['filter_date_from'])) {
				$sql .= " AND DATE(sch.date_history_action) >= DATE('" . $this->db->escape($data['filter_date_from']) . "')";
			}

			if (!empty($data['filter_date_to'])) {
				$sql .= " AND DATE(sch.date_history_action) <= DATE('" . $this->db->escape($data['filter_date_to']) . "')";
			}
		}

		if (!empty($data['filter_product_id'])) {
			$sql .= " AND scpc.product_id IN (" . implode(',', $data['filter_product_id']) . ")";
		}

		if (!empty($data['filter_order_id'])) {
			$sql .= " AND sco.order_id IN (" . implode(',', $data['filter_order_id']) . ")";
		}

		if (!empty($data['filter_order_status'])) {
			$sql .= " AND o.order_status_id IN (" . implode(',', $data['filter_order_status']) . ")";
			$sql .= " GROUP BY p.product_id, scpc.option_id, scpc.option_value_id, scpc.count";
			$sql .= " HAVING COUNT(sco.order_id) >= '" . (int)$data['filter_order_qty'] . "'";
		} else {
			$sql .= " ORDER BY p.product_id, scpc.option_id, scpc.option_value_id, scpc.count ASC";
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getCategories() {
		$sql = "SELECT cp.category_id AS category_id, GROUP_CONCAT(cd1.name ORDER BY cp.level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') AS name, c1.parent_id, c1.sort_order, c1.status FROM " . DB_PREFIX . "category_path cp LEFT JOIN " . DB_PREFIX . "category c1 ON (cp.category_id = c1.category_id) LEFT JOIN " . DB_PREFIX . "category c2 ON (cp.path_id = c2.category_id) LEFT JOIN " . DB_PREFIX . "category_description cd1 ON (cp.path_id = cd1.category_id) LEFT JOIN " . DB_PREFIX . "category_description cd2 ON (cp.category_id = cd2.category_id) WHERE cd1.language_id = '" . (int)$this->config->get('config_language_id') . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY cp.category_id ORDER BY name ASC";

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function generateProductCodes($product_id) {
		$added_cnt = 0;

		$filter = array(
			'product_id' 	=> $product_id,
			'start' 			=> 0,
			'limit' 			=> 1,
		);

		$products_info = $this->getProductsWithOptions($filter);

		if ($products_info) {
			foreach ($products_info as $product_info) {
				$products_to_cell = array();
				$product_to_cell_db = array();
				$orders_info = array();
				$fixed_orders = array();

				$products_to_cell_info = $this->db->query("SELECT * FROM " . DB_PREFIX . "storage_cell_product_code WHERE product_id = '" . (int)$product_id . "' ORDER BY option_id, option_value_id, count");

				$orders_info_temp = $this->db->query("SELECT op.order_product_id AS order_prod_id, op.*, oo.*, o.* FROM " . DB_PREFIX . "order_product op LEFT JOIN " . DB_PREFIX . "order_option oo ON (op.order_id = oo.order_id AND op.order_product_id = oo.order_product_id) LEFT JOIN " . DB_PREFIX . "order o ON (op.order_id = o.order_id) WHERE op.product_id = '" . (int)$product_id . "' AND o.date_added >= NOW() - INTERVAL 1 MONTH");

				if ($products_to_cell_info->rows) {
					$products_to_cell = $products_to_cell_info->rows;
					foreach ($products_to_cell as &$product_to_cell_info) {
						$fixed_order_info_id = $this->db->query("SELECT MAX(order_id) AS order_id FROM " . DB_PREFIX . "storage_cell_order WHERE product_code_id = '" . (int)$product_to_cell_info['id'] . "' LIMIT 1");

						if ($fixed_order_info_id->row['order_id']) {
							$fixed_order_info = $this->db->query("SELECT op.order_product_id AS order_prod_id, op.*, oo.*, o.* FROM " . DB_PREFIX . "order_product op LEFT JOIN " . DB_PREFIX . "order_option oo ON (op.order_id = oo.order_id AND op.order_product_id = oo.order_product_id) LEFT JOIN " . DB_PREFIX . "order o ON (o.order_id = op.order_id) WHERE op.product_id = '" . (int)$product_id . "' AND o.order_id = '" . (int)$fixed_order_info_id->row['order_id'] . "'");
							if ($fixed_order_info->rows) {
								$product_to_cell_info['order_id'] = $fixed_order_info_id->row['order_id'];
								foreach ($fixed_order_info->rows as $row) {
									$fixed_orders[$row['order_prod_id']] = $row;
								}
							}
						}
					}
				}

				if ($orders_info_temp->rows) {
					foreach ($orders_info_temp->rows as $order_info_temp) {
						$orders_info[$order_info_temp['order_prod_id']] = $order_info_temp;
					}
				}

				if ($fixed_orders) {
					$orders_info = $orders_info + $fixed_orders;
				}

				$orders = array();
				$orders_tmp = array();

				if ($orders_info) {
					foreach ($orders_info as $order_info) {
						$orders_tmp[$order_info['order_id']]['order_status_id'] = $order_info['order_status_id'];

						if (isset($product_info['options'])) {
							foreach ($product_info['options'] as $product_option_value) {
								if (($order_info['product_option_id'] == $product_option_value['product_option_id']) && ($order_info['product_option_value_id'] == $product_option_value['product_option_value_id'])) {
									$orders_tmp[$order_info['order_id']]['option'][$product_option_value['option_id']][$product_option_value['option_value_id']] = $order_info['quantity'];
								}
							}
						} else {
							$orders_tmp[$order_info['order_id']]['product'] = $order_info['quantity'];
						}
					}
				}

				if ($orders_tmp) {
					foreach ($orders_tmp as $order_tmp_id => $order_tmp) {
						if (in_array($order_tmp['order_status_id'], $this->config->get('config_processing_status'))) {
							$orders[$order_tmp_id] = $order_tmp;
						}
					}
				}

				if ($products_to_cell) {
					foreach ($products_to_cell as $prod_to_cell) {
						$order_status = '';
						// $quantity = 0;

						if ($prod_to_cell['order_id']) {
							if ($orders_tmp[$prod_to_cell['order_id']]) {
								$order_status = $orders_tmp[$prod_to_cell['order_id']]['order_status_id'];
								// if ($prod_to_cell['option_id'] > 0) {
									// $quantity = $orders_tmp[$prod_to_cell['order_id']]['option'][$prod_to_cell['option_id']][$prod_to_cell['option_value_id']];
								// } else {
									// $quantity = $orders_tmp[$prod_to_cell['order_id']]['product'];
								// }
								unset($orders[$prod_to_cell['order_id']]);
							}
						}

						if ($prod_to_cell['option_id'] > 0) {
							$product_to_cell_db['option'][$prod_to_cell['option_id']][$prod_to_cell['option_value_id']][] = array(
								'order_id'				=> $prod_to_cell['order_id'],
								'order_status'		=> $order_status,
								// 'order_quantity' 	=> $quantity,
								'order_quantity' 	=> 1,
								'count'						=> $prod_to_cell['count'],
							);
						} else {
							$product_to_cell_db['product'][] = array(
								'order_id'				=> $prod_to_cell['order_id'],
								'order_status'		=> $order_status,
								// 'order_quantity' 	=> $quantity,
								'order_quantity' 	=> 1,
								'count'						=> $prod_to_cell['count'],
							);
						}
					}
				}

				if (isset($product_info['options']) || $product_info['options']) {
					foreach ($product_info['options'] as $product_option_value) {
						$option_value_cnt = 0;
						$last = 0;
						$pov_quantity = $product_option_value['quantity'];

						if ($product_option_value['quantity'] > 0) {
							if (isset($product_to_cell_db['option'][$product_option_value['option_id']][$product_option_value['option_value_id']])) {
								foreach ($product_to_cell_db['option'][$product_option_value['option_id']][$product_option_value['option_value_id']] as $opt_count) {
									if (empty($opt_count['order_status'])) {
										$option_value_cnt++;
									} elseif (!empty($opt_count['order_status']) && !in_array($opt_count['order_status'], array_merge($this->config->get('config_processing_status'), $this->config->get('config_complete_status')))) {
										$option_value_cnt += $opt_count['order_quantity'];
									}
								}
								$last = $product_to_cell_db['option'][$product_option_value['option_id']][$product_option_value['option_value_id']][count($product_to_cell_db['option'][$product_option_value['option_id']][$product_option_value['option_value_id']]) - 1]['count'];
								if ($orders) {
									foreach ($orders as $ord) {
										if (isset($ord['option'][$product_option_value['option_id']][$product_option_value['option_value_id']])) {
											$pov_quantity += $ord['option'][$product_option_value['option_id']][$product_option_value['option_value_id']];
										}
									}
								}
							}

							$diff = $pov_quantity - $option_value_cnt;

							if ($diff > 0) {
								for ($i = $last + 1; $i <= $last + $diff; $i++) {
									$product_to_cell = array(
										'product_id' 				=> $product_id,
										'model' 						=> $product_info['model'],
										'manufacturer' 			=> $product_info['manufacturer'],
										'option_id' 				=> $product_option_value['option_id'],
										'option_value_id'		=> $product_option_value['option_value_id'],
										'count' 						=> $i,
										'unique_code' 			=> $product_id . '_' . $product_option_value['option_id'] . '_' . $product_option_value['option_value_id'] . '_' . $i,
										'date_added'				=> date('Y-m-d h:i:s', time()),
									);

									$this->addProductUniqueCode($product_to_cell);
									$added_cnt++;
								}
							}
						}
					}
				} else {
					$product_cnt = 0;
					$last = 0;
					$prod_quantity = $product_info['quantity'];

					if (isset($product_to_cell_db['product'])) {
						foreach ($product_to_cell_db['product'] as $prod_count) {
							if (empty($prod_count['order_status'])) {
								$product_cnt++;
							} elseif (!empty($prod_count['order_status']) && !in_array($prod_count['order_status'], array_merge($this->config->get('config_processing_status'), $this->config->get('config_complete_status')))) {
								$product_cnt += $prod_count['order_quantity'];
							}
						}
						$last = $product_to_cell_db['product'][count($product_to_cell_db['product']) - 1]['count'];
						if ($orders) {
							foreach ($orders as $ord) {
								if (isset($ord['product'])) {
									$prod_quantity += $ord['product'];
								}
							}
						}
					}

					$diff = $prod_quantity - $product_cnt;

					if ($diff > 0) {
						for ($i = $last + 1; $i <= $last + $diff; $i++) {
							$product_to_cell = array(
								'product_id' 				=> $product_id,
								'model' 						=> $product_info['model'],
								'manufacturer' 			=> $product_info['manufacturer'],
								'option_id' 				=> '0',
								'option_value_id'		=> '0',
								'count' 						=> $i,
								'unique_code' 			=> $product_id . '___' . $i,
								'date_added'				=> date('Y-m-d h:i:s', time()),
							);

							$this->addProductUniqueCode($product_to_cell);
							$added_cnt++;
						}
					}
				}
			}
		}

		return $added_cnt;
	}
}
