<?php
class ControllerExtensionModuleStorageCell extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/module/storage_cell');

		$data['token'] = $this->session->data['token'];

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('extension/module/storage_cell');
		$this->load->model('sale/order');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_storage'),
			'href' => $this->url->link('extension/module/storage_cell', 'token=' . $this->session->data['token'] . '&type=module', true)
		);

		$data['button_build_order'] = $this->language->get('button_build_order');
		$data['button_product_to_cell'] = $this->language->get('button_product_to_cell');
		$data['button_cell_check'] = $this->language->get('button_cell_check');
		$data['button_audit'] = $this->language->get('button_audit');
		$data['button_cell_editor'] = $this->language->get('button_cell_editor');
		$data['button_bay'] = $this->language->get('button_bay');
		$data['button_log'] = $this->language->get('button_log');
		$data['button_service'] = $this->language->get('button_service');

		$data['build_order_link'] = $this->url->link('extension/module/storage_cell/buildOrder', 'token=' . $this->session->data['token'], true);
		$data['product_to_cell_link'] = $this->url->link('extension/module/storage_cell/productToCell', 'token=' . $this->session->data['token'], true);
		$data['cell_check_link'] = $this->url->link('extension/module/storage_cell/cellCheck', 'token=' . $this->session->data['token'], true);
		$data['audit_link'] = $this->url->link('extension/module/storage_cell/audit', 'token=' . $this->session->data['token'], true);
		$data['cell_editor_link'] = $this->url->link('extension/module/storage_cell/cellEditor', 'token=' . $this->session->data['token'], true);
		$data['bay_link'] = $this->url->link('extension/module/storage_cell/bay', 'token=' . $this->session->data['token'], true);
		$data['log_link'] = $this->url->link('extension/module/storage_cell/log', 'token=' . $this->session->data['token'], true);
		$data['service_link'] = $this->url->link('extension/module/storage_cell/service', 'token=' . $this->session->data['token'], true);

		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/storage_cell', $data));
	}

	public function buildOrder() {
		$this->load->language('extension/module/storage_cell_build_order');

		$data['token'] = $this->session->data['token'];

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('extension/module/storage_cell');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['button_build_order'] = $this->language->get('button_build_order');
		$data['button_product_to_cell'] = $this->language->get('button_product_to_cell');
		$data['button_cell_check'] = $this->language->get('button_cell_check');
		$data['button_audit'] = $this->language->get('button_audit');
		$data['button_cell_editor'] = $this->language->get('button_cell_editor');
		$data['button_bay'] = $this->language->get('button_bay');
		$data['button_log'] = $this->language->get('button_log');
		$data['button_service'] = $this->language->get('button_service');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_new'] = $this->language->get('button_new');
		$data['text_order'] = $this->language->get('text_order');
		$data['text_product'] = $this->language->get('text_product');
		$data['text_cell'] = $this->language->get('text_cell');
		$data['text_link'] = $this->language->get('text_link');
		$data['text_unlink'] = $this->language->get('text_unlink');
		$data['entry_order'] = $this->language->get('entry_order');
		$data['text_fixed'] = $this->language->get('text_fixed');
		$data['text_ok'] = $this->language->get('text_ok');

		$data['error_warning'] = '';

		if (isset($this->session->data['error'])) {
			$data['error_warning'] = $this->session->data['error'];
			unset($this->session->data['error']);
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_storage'),
			'href' => $this->url->link('extension/module/storage_cell', 'token=' . $this->session->data['token'] . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/storage_cell/buildOrder', 'token=' . $this->session->data['token'], true)
		);

		$data['build_order_link'] = $this->url->link('extension/module/storage_cell/buildOrder', 'token=' . $this->session->data['token'], true);
		$data['product_to_cell_link'] = $this->url->link('extension/module/storage_cell/productToCell', 'token=' . $this->session->data['token'], true);
		$data['cell_check_link'] = $this->url->link('extension/module/storage_cell/cellCheck', 'token=' . $this->session->data['token'], true);
		$data['audit_link'] = $this->url->link('extension/module/storage_cell/audit', 'token=' . $this->session->data['token'], true);
		$data['cell_editor_link'] = $this->url->link('extension/module/storage_cell/cellEditor', 'token=' . $this->session->data['token'], true);
		$data['bay_link'] = $this->url->link('extension/module/storage_cell/bay', 'token=' . $this->session->data['token'], true);
		$data['log_link'] = $this->url->link('extension/module/storage_cell/log', 'token=' . $this->session->data['token'], true);
		$data['service_link'] = $this->url->link('extension/module/storage_cell/service', 'token=' . $this->session->data['token'], true);

		$done_product_bay = array();
		$data['product_count'] = 0;
		$data['order_codes'] = array();

		if (isset($this->request->get['order_id']) && $this->request->get['order_id']) {
			$orders_id = explode(',', $this->request->get['order_id']);
		}

		if (isset($orders_id)) {
			$check_order = $this->checkOrders($orders_id);

			if ($check_order['error']) {
				$this->session->data['error'] = $check_order['error'];

				$this->response->redirect($this->url->link('sale/order', 'token=' . $this->session->data['token'], true));
			}

			$data['order_codes'] = $check_order['order_codes'];

			$data['product_count'] += $check_order['product_count'];

			$cells = $this->model_extension_module_storage_cell->getCellToBays('', '', false);

			$products_bay = array();

			foreach ($cells as $cell) {
				foreach ($check_order['order_product_codes'] as $order_id => &$order_product_code) {
					foreach ($order_product_code as $order_product_id => &$product_code) {
						foreach ($product_code['codes'] as $code) {
							if ($code['cell_id'] == $cell['id'] && $product_code['quantity'] > 0) {
								$products_bay[$cell['id']][$order_id][$order_product_id][] = $code;
								$product_code['quantity']--;
							}
						}
					}
				}
			}

			$structured_bays = $this->model_extension_module_storage_cell->getStructuredCellToBays();

			foreach ($structured_bays['room'] as $room) {
				foreach ($room['row'] as $row) {
					foreach ($row['stack'] as $stack) {
						foreach ($stack['rack'] as $rack) {
							foreach ($rack['cell'] as $cell) {
								foreach ($products_bay as $id => &$product_bay) {
									if ($cell['cell_id'] == $id) {
										foreach ($product_bay as $order_id => &$order) {
											foreach ($order as $order_product_id => &$product) {
												foreach ($product as $product_code_id => &$product_code) {
													$option = array();
													$option_name = '';
													$abstract_code = $product_code['product_id'] . '_' . ($product_code['option_id'] ? $product_code['option_id'] : '') . '_' . ($product_code['option_value_id'] ? $product_code['option_value_id'] : '') . '_';
													if ($product_code['option_id']) {
														$option['option'] = $this->model_extension_module_storage_cell->getOptionDescription($product_code['option_id']);
														$option['value'] = $this->model_extension_module_storage_cell->getOptionValueDescription($product_code['option_value_id']);
														$option_name = $option['option'] . ': ' . $option['value'];
													}
													$product_code['product_name'] = $check_order['orders'][$order_id]['products'][$order_product_id]['name'];
													$product_code['abstract_code'] = $abstract_code;
													$product_code['option_name'] = $option_name;
												}
											}
										}

										$done_product_bay[$room['name']][$row['name']][$stack['name']][$rack['name']][$cell['name']] = $product_bay;
									}
								}
							}
						}
					}
				}
			}
		}

		$data['build_order_link'] = $this->url->link('extension/module/storage_cell/buildOrder', 'token=' . $this->session->data['token'] . '&order_id=', true);

		$data['product_bays'] = $done_product_bay;

		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/storage_cell_build_order', $data));
	}

	public function audit() {
		$this->load->language('extension/module/storage_cell_audit');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('extension/module/storage_cell');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['button_build_order'] = $this->language->get('button_build_order');
		$data['button_product_to_cell'] = $this->language->get('button_product_to_cell');
		$data['button_cell_check'] = $this->language->get('button_cell_check');
		$data['button_audit'] = $this->language->get('button_audit');
		$data['button_cell_editor'] = $this->language->get('button_cell_editor');
		$data['button_bay'] = $this->language->get('button_bay');
		$data['button_log'] = $this->language->get('button_log');
		$data['button_service'] = $this->language->get('button_service');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		$data['column_image'] = $this->language->get('column_image');
		$data['column_name'] = $this->language->get('column_name');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_date'] = $this->language->get('column_date');
		$data['column_code'] = $this->language->get('column_code');
		$data['column_cell'] = $this->language->get('column_cell');
		$data['column_order'] = $this->language->get('column_order');
		$data['column_history'] = $this->language->get('column_history');

		$data['entry_enabled'] = $this->language->get('entry_enabled');
		$data['entry_disabled'] = $this->language->get('entry_disabled');
		$data['entry_undefined'] = $this->language->get('entry_undefined');
		$data['entry_barcode'] = $this->language->get('entry_barcode');
		$data['entry_all_barcodes'] = $this->language->get('entry_all_barcodes');
		$data['entry_generate_code'] = $this->language->get('entry_generate_code');
		$data['entry_delete'] = $this->language->get('entry_delete');

		$data['button_filter'] = $this->language->get('button_filter');

		$data['title_filter_product'] = $this->language->get('title_filter_product');
		$data['title_filter_category'] = $this->language->get('title_filter_category');
		$data['title_filter_sold'] = $this->language->get('title_filter_sold');
		$data['title_filter_code_product'] = $this->language->get('title_filter_code_product');
		$data['title_filter_code_cell'] = $this->language->get('title_filter_code_cell');
		$data['title_filter_name'] = $this->language->get('title_filter_name');
		$data['title_filter_history'] = $this->language->get('title_filter_history');
		$data['title_filter_date_from'] = $this->language->get('title_filter_date_from');
		$data['title_filter_date_to'] = $this->language->get('title_filter_date_to');
		$data['title_filter_order_status'] = $this->language->get('title_filter_order_status');
		$data['title_filter_order_qty'] = $this->language->get('title_filter_order_qty');
		$data['title_unique_code'] = $this->language->get('title_unique_code');
		$data['text_print'] = $this->language->get('text_print');
		$data['history_create'] = $this->language->get('history_create');
		$data['history_link'] = $this->language->get('history_link');
		$data['history_unlink'] = $this->language->get('history_unlink');
		$data['history_order'] = $this->language->get('history_order');

		$data['error_warning'] = '';

		if (isset($this->session->data['error'])) {
			$data['error_warning'] = $this->session->data['error'];
			unset($this->session->data['error']);
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_storage'),
			'href' => $this->url->link('extension/module/storage_cell', 'token=' . $this->session->data['token'] . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/storage_cell/productToCell', 'token=' . $this->session->data['token'], true)
		);

		$data['build_order_link'] = $this->url->link('extension/module/storage_cell/buildOrder', 'token=' . $this->session->data['token'], true);
		$data['product_to_cell_link'] = $this->url->link('extension/module/storage_cell/productToCell', 'token=' . $this->session->data['token'], true);
		$data['cell_check_link'] = $this->url->link('extension/module/storage_cell/cellCheck', 'token=' . $this->session->data['token'], true);
		$data['audit_link'] = $this->url->link('extension/module/storage_cell/audit', 'token=' . $this->session->data['token'], true);
		$data['cell_editor_link'] = $this->url->link('extension/module/storage_cell/cellEditor', 'token=' . $this->session->data['token'], true);
		$data['bay_link'] = $this->url->link('extension/module/storage_cell/bay', 'token=' . $this->session->data['token'], true);
		$data['log_link'] = $this->url->link('extension/module/storage_cell/log', 'token=' . $this->session->data['token'], true);
		$data['service_link'] = $this->url->link('extension/module/storage_cell/service', 'token=' . $this->session->data['token'], true);

		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);

		$data['token'] = $this->session->data['token'];

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		if (isset($this->request->get['filter_block'])) {
			$filter_block = $this->request->get['filter_block'];
		} else {
			$filter_block = '';
		}

		if (isset($this->request->get['filter_product'])) {
			$filter_product = $this->request->get['filter_product'];
		} else {
			$filter_product = '';
		}

		if (isset($this->request->get['filter_sold'])) {
			$filter_sold = 1;
		} else {
			$filter_sold = 0;
		}

		if (isset($this->request->get['filter_product_id'])) {
			$filter_product_id = explode(',', $this->request->get['filter_product_id']);
		} else {
			$filter_product_id = '';
		}

		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = '';
		}

		if (isset($this->request->get['filter_code_product'])) {
			$filter_code_product = $this->request->get['filter_code_product'];
		} else {
			$filter_code_product = '';
		}

		if (isset($this->request->get['filter_code_cell'])) {
			$filter_code_cell = $this->request->get['filter_code_cell'];
		} else {
			$filter_code_cell = '';
		}

		if (isset($this->request->get['filter_history'])) {
			$filter_history = $this->request->get['filter_history'];
		} else {
			$filter_history = '';
		}

		if (isset($this->request->get['filter_date_from'])) {
			$filter_date_from = $this->request->get['filter_date_from'];
		} else {
			$filter_date_from = '';
		}

		if (isset($this->request->get['filter_date_to'])) {
			$filter_date_to = $this->request->get['filter_date_to'];
		} else {
			$filter_date_to = '';
		}

		if (isset($this->request->get['filter_category'])) {
			$filter_category = explode(',', $this->request->get['filter_category']);
		} else {
			$filter_category = '';
		}

		if (isset($this->request->get['filter_order_status'])) {
			$filter_order_status = explode(',', $this->request->get['filter_order_status']);
		} else {
			$filter_order_status = '';
		}

		if (isset($this->request->get['filter_order_qty'])) {
			$filter_order_qty = $this->request->get['filter_order_qty'];
		} else {
			$filter_order_qty = 1;
		}

		if (isset($this->request->get['filter_order_id'])) {
			$filter_order_id = explode(',', $this->request->get['filter_order_id']);
		} else {
			$filter_order_id = '';
		}

		$url = '';

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		if (isset($this->request->get['filter_block'])) {
			$url .= '&filter_block=' . $this->request->get['filter_block'];
		}

		if (isset($this->request->get['filter_product'])) {
			$url .= '&filter_product=' . $this->request->get['filter_product'];
		}

		if (isset($this->request->get['filter_sold'])) {
			$url .= '&filter_sold=1';
		}

		if (isset($this->request->get['filter_product_id'])) {
			$url .= '&filter_product_id=' . $this->request->get['filter_product_id'];
		}

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . $this->request->get['filter_name'];
		}

		if (isset($this->request->get['filter_code_product'])) {
			$url .= '&filter_code_product=' . $this->request->get['filter_code_product'];
		}

		if (isset($this->request->get['filter_code_cell'])) {
			$url .= '&filter_code_cell=' . $this->request->get['filter_code_cell'];
		}

		if (isset($this->request->get['filter_history'])) {
			$url .= '&filter_history=' . $this->request->get['filter_history'];
		}

		if (isset($this->request->get['filter_date_from'])) {
			$url .= '&filter_date_from=' . $this->request->get['filter_date_from'];
		}

		if (isset($this->request->get['filter_date_to'])) {
			$url .= '&filter_date_to=' . $this->request->get['filter_date_to'];
		}

		if (isset($this->request->get['filter_category'])) {
			$url .= '&filter_category=' . $this->request->get['filter_category'];
		}

		if (isset($this->request->get['filter_order_status'])) {
			$url .= '&filter_order_status=' . $this->request->get['filter_order_status'];
		}

		if (isset($this->request->get['filter_order_qty'])) {
			$url .= '&filter_order_qty=' . $this->request->get['filter_order_qty'];
		}

		if (isset($this->request->get['filter_order_id'])) {
			$url .= '&filter_order_id=' . $this->request->get['filter_order_id'];
		}

		$data['filters_product'] = array(
			'filter_wo_codes'					=> $this->language->get('filter_wo_codes'),
			'filter_wo_products'			=> $this->language->get('filter_wo_products'),
			'filter_wo_cells'					=> $this->language->get('filter_wo_cells'),
			// 'filter_wo_link_product'	=> $this->language->get('filter_wo_link_product'),
		);

		$data['categories'] = $this->model_extension_module_storage_cell->getCategories();

		$data['histories'] = array(
			'0'				=> '',
			'create'	=> $this->language->get('history_create'),
			'link'		=> $this->language->get('history_link'),
			'unlink'	=> $this->language->get('history_unlink'),
			'order'		=> $this->language->get('history_order'),
		);

		$this->load->model('localisation/order_status');

		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		$data['products'] = array();

		$product_total = 0;

		// $limit = $this->config->get('config_limit_admin');
		$limit = 1000000;

		$filter_data = array(
			'filter_product'	  	=> $filter_product,
			'filter_sold'	  			=> $filter_sold,
			'filter_product_id'	  => $filter_product_id,
			'filter_name'	  			=> $filter_name,
			'filter_code_product'	=> $filter_code_product,
			'filter_code_cell'		=> $filter_code_cell,
			'filter_history'			=> $filter_history,
			'filter_date_from' 		=> $filter_date_from,
			'filter_date_to' 			=> $filter_date_to,
			'filter_category' 		=> $filter_category,
			'filter_order_status' => $filter_order_status,
			'filter_order_qty'    => $filter_order_qty,
			'filter_order_id'	  	=> $filter_order_id,
			'start'           		=> ($page - 1) * $limit,
			'limit'           		=> $limit,
		);

		if ($filter_block) {
			if ($filter_block == 1) {
				if ($filter_data['filter_product']) {
					$data['products'] = $this->getFilterProductList($filter_data);
				}
			} elseif ($filter_block == 2) {
				if ($filter_data['filter_name'] || $filter_data['filter_product_id'] || $filter_data['filter_code_product'] || $filter_data['filter_code_cell'] || $filter_data['filter_history'] || $filter_data['filter_date_from'] || $filter_data['filter_date_to'] || $filter_data['filter_order_status'] || $filter_data['filter_order_id']) {
					$data['products'] = $this->getFilterCodeList($filter_data);
				}
			}
		}

		foreach ($data['products'] as $product) {
			$product_total += count($product['unique_codes']);
		}

		$pagination = new Pagination();
		$pagination->total = $product_total;
		$pagination->page = $page;
		$pagination->limit = $limit;
		$pagination->url = $this->url->link('extension/module/storage_cell', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($product_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($product_total - $limit)) ? $product_total : ((($page - 1) * $limit) + $limit), $product_total, ceil($product_total / $limit));

		$data['filter_product'] = $filter_product;
		$data['filter_sold'] = $filter_sold;
		$data['filter_name'] = $filter_name;
		$data['filter_code_product'] = $filter_code_product;
		$data['filter_code_cell'] = $filter_code_cell;
		$data['filter_history'] = $filter_history;
		$data['filter_date_from'] = $filter_date_from;
		$data['filter_date_to'] = $filter_date_to;
		$data['filter_category'] = $filter_category;
		$data['filter_order_status'] = $filter_order_status;
		$data['filter_order_qty'] = $filter_order_qty;

		$data['action_generate'] = $this->url->link('extension/module/storage_cell/auditGenerate', 'token=' . $this->session->data['token'] . $url, true);
		$data['action_remove'] = $this->url->link('extension/module/storage_cell/auditDelete', 'token=' . $this->session->data['token'] . $url, true);

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/storage_cell_audit', $data));
	}

	protected function getFilterProductList($filter) {
		$all_products = $this->model_extension_module_storage_cell->getProducts($filter);
		$all_manufacturers = $this->model_extension_module_storage_cell->getAllManufacturers();
		$all_options = $this->model_extension_module_storage_cell->getAllOptions();
		$all_product_options = $this->model_extension_module_storage_cell->getAllProductOptionValues($filter);
		$all_unique_codes = $this->model_extension_module_storage_cell->getAllUniqueCodes($filter);
		$all_product_to_cell = $this->model_extension_module_storage_cell->getAllProductToCell($filter);
		$all_orders = $this->model_extension_module_storage_cell->getAllOrders();

		$order_products = array();

		if ($all_orders) {
			foreach ($all_orders as $all_order) {
				if (!$all_order['product_code_id']) {
					if ($all_order['product_option_value_id']) {
						$order_products[$all_order['product_id']]['option'][$all_order['option_id']][$all_order['option_value_id']] = $all_order['quantity'];
					} else {
						$order_products[$all_order['product_id']]['product'] = $all_order['quantity'];
					}
				}
			}
		}

		$products = array();

		$product_wo_code = array();
		$code_wo_product = array();
		$code_wo_cell = array();

		foreach ($all_products as $product_id => &$product) {
			$product_info = array(
				'product_id'				=> $product['product_id'],
				'name'							=> $product['name'],
				'model'							=> $product['model'],
				'quantity'					=> $product['quantity'],
				'image'							=> ($product['image'] && is_file(DIR_IMAGE . $product['image'])) ? '/image/' . $product['image'] : '',
				'price'							=> (float)$product['price'],
				'status'						=> $product['status'],
				'manufacturer_id'		=> $product['manufacturer_id'],
				'href'							=> $this->url->link('catalog/product/edit', 'token=' . $this->session->data['token'] . '&product_id=' . $product['product_id'], true),
			);
			if (isset($all_manufacturers[$product['manufacturer_id']])) {
				$product_info['manufacturer_name'] = $all_manufacturers[$product['manufacturer_id']]['name'];
			}
			if (isset($all_product_options[$product['product_id']])) {
				foreach ($all_product_options[$product['product_id']] as $option_id => &$option_values) {
					foreach ($option_values as $pov_id => &$pov_quantity) {
						if (isset($order_products[$product['product_id']]['option'][$option_id][$pov_id])) {
							$pov_quantity += $order_products[$all_order['product_id']]['option'][$option_id][$pov_id];
						}

						if ($pov_quantity > 0) {
							for ($i = 0; $i <= $pov_quantity - 1; $i++) {
								if (isset($all_unique_codes[$product['product_id']][$pov_id][$i])) {
									$code_info = $all_unique_codes[$product['product_id']][$pov_id][$i];
									if (isset($all_product_to_cell[$code_info['id']])) {
										$cell_id = $all_product_to_cell[$code_info['id']];
										$cell_name = $this->model_extension_module_storage_cell->getCellById($cell_id);
									} else {
										$cell_id = '';
										$cell_name = '';
									}
									$history = $this->model_extension_module_storage_cell->getCodeHistory($code_info['id']);
									$orders = $this->model_extension_module_storage_cell->getOrderHistory($code_info['id']);
									$unique_code = array(
										'product_id' 					=> $product['product_id'],
										'product_code_id' 		=> $code_info['id'],
										'option_id' 					=> $code_info['option_id'],
										'option_value_id' 		=> $code_info['option_value_id'],
										'option_name' 				=> isset($all_options[$pov_id]) ? $all_options[$pov_id]['option_name'] : '',
										'option_value_name' 	=> isset($all_options[$pov_id]) ? $all_options[$pov_id]['option_value_name'] : '',
										'unique_code' 				=> $code_info['unique_code'],
										'cell_id' 						=> $cell_id,
										'cell_name' 					=> $cell_name,
										'date_added' 					=> date('d.m.Y h:i', strtotime($code_info['date_code_added'])),
										'history' 						=> $history,
										'orders' 							=> $orders,
										'href'								=> $this->url->link('catalog/product/edit', 'token=' . $this->session->data['token'] . '&product_id=' . $product_id, true),
									);
									$products[$product['product_id']]['product'] = $product_info;
									$products[$product['product_id']]['unique_codes'][] = $unique_code;
									if (isset($all_product_to_cell[$code_info['id']])) {
										unset($all_product_to_cell[$code_info['id']]);
									} else {
										$code_wo_cell[$product['product_id']]['product'] = $product_info;
										$code_wo_cell[$product['product_id']]['unique_codes'][] = $unique_code;
									}
									unset($all_unique_codes[$product['product_id']][$pov_id][$i]);
								} else {
									$unique_code = array(
										'product_id' 					=> $product['product_id'],
										'product_code_id' 		=> '',
										'option_id' 					=> $option_id,
										'option_value_id' 		=> $pov_id,
										'option_name' 				=> isset($all_options[$pov_id]) ? $all_options[$pov_id]['option_name'] : '',
										'option_value_name' 	=> isset($all_options[$pov_id]) ? $all_options[$pov_id]['option_value_name'] : '',
										'unique_code' 				=> '',
										'cell_id' 						=> '',
										'cell_name' 					=> '',
										'date_added' 					=> '',
										'history' 						=> '',
										'orders' 							=> '',
										'href'								=> $this->url->link('catalog/product/edit', 'token=' . $this->session->data['token'] . '&product_id=' . $product_id, true),
									);
									$products[$product['product_id']]['product'] = $product_info;
									$products[$product['product_id']]['unique_codes'][] = $unique_code;
									$product_wo_code[$product['product_id']]['product'] = $product_info;
									$product_wo_code[$product['product_id']]['unique_codes'][] = $unique_code;
								}
							}
						}
					}
				}
			} else {
				if (isset($order_products[$product['product_id']]['product'])) {
					$product['quantity'] += $order_products[$product['product_id']]['product'];
				}

				if ($product['quantity'] > 0) {
					for ($i = 0; $i <= $product['quantity'] - 1; $i++) {
						if (isset($all_unique_codes[$product['product_id']][0][$i])) {
							$code_info = $all_unique_codes[$product['product_id']][0][$i];
							if (isset($all_product_to_cell[$code_info['id']])) {
								$cell_id = $all_product_to_cell[$code_info['id']];
								$cell_name = $this->model_extension_module_storage_cell->getCellById($cell_id);
							} else {
								$cell_id = '';
								$cell_name = '';
							}
							$history = $this->model_extension_module_storage_cell->getCodeHistory($code_info['id']);
							$orders = $this->model_extension_module_storage_cell->getOrderHistory($code_info['id']);
							$unique_code = array(
								'product_id' 					=> $product['product_id'],
								'product_code_id' 		=> $code_info['id'],
								'option_id' 					=> '',
								'option_value_id' 		=> '',
								'unique_code' 				=> $code_info['unique_code'],
								'cell_id' 						=> $cell_id,
								'cell_name' 					=> $cell_name,
								'date_added' 					=> date('d.m.Y h:i', strtotime($code_info['date_code_added'])),
								'history' 						=> $history,
								'orders' 							=> $orders,
								'href'								=> $this->url->link('catalog/product/edit', 'token=' . $this->session->data['token'] . '&product_id=' . $product_id, true),
							);
							$products[$product['product_id']]['product'] = $product_info;
							$products[$product['product_id']]['unique_codes'][] = $unique_code;
							if (isset($all_product_to_cell[$code_info['id']])) {
								unset($all_product_to_cell[$code_info['id']]);
							} else {
								$code_wo_cell[$product['product_id']]['product'] = $product_info;
								$code_wo_cell[$product['product_id']]['unique_codes'][] = $unique_code;
							}
							unset($all_unique_codes[$product['product_id']][0][$i]);
						} else {
							$unique_code = array(
								'product_id' 					=> $product['product_id'],
								'product_code_id' 		=> '',
								'option_id' 					=> '',
								'option_value_id' 		=> '',
								'unique_code' 				=> '',
								'cell_id' 						=> '',
								'cell_name' 					=> '',
								'date_added' 					=> '',
								'history' 						=> '',
								'orders' 							=> '',
								'href'								=> $this->url->link('catalog/product/edit', 'token=' . $this->session->data['token'] . '&product_id=' . $product_id, true),
							);
							$products[$product['product_id']]['product'] = $product_info;
							$products[$product['product_id']]['unique_codes'][] = $unique_code;
							$product_wo_code[$product['product_id']]['product'] = $product_info;
							$product_wo_code[$product['product_id']]['unique_codes'][] = $unique_code;
						}
					}
				}
			}
		}

		if ($filter['filter_product'] == 'filter_wo_codes') {

			return $product_wo_code;
		} elseif ($filter['filter_product'] == 'filter_wo_products') {
			foreach ($all_unique_codes as $product_id => $product) {
				foreach ($product as $option_value_id => $unique_code) {
					if (!$unique_code) {
						unset($all_unique_codes[$product_id][$option_value_id]);
					}
				}
			}

			foreach ($all_unique_codes as $product_id => $product) {
				if (!$product) {
					unset($all_unique_codes[$product_id]);
				}
			}

			foreach ($all_unique_codes as $product_id => $product) {
				if (isset($all_products[$product_id])) {
					$code_wo_product[$product_id]['product'] = array(
						'product_id'				=> $product_id,
						'name'							=> $all_products[$product_id]['name'],
						'model'							=> $all_products[$product_id]['model'],
						'quantity'					=> $all_products[$product_id]['quantity'],
						'image'							=> ($all_products[$product_id]['image'] && is_file(DIR_IMAGE . $all_products[$product_id]['image'])) ? '/image/' . $all_products[$product_id]['image'] : '',
						'price'							=> (float)$all_products[$product_id]['price'],
						'status'						=> $all_products[$product_id]['status'],
						'manufacturer_id'		=> $all_products[$product_id]['manufacturer_id'],
					);
					if (isset($all_manufacturers[$all_products[$product_id]['manufacturer_id']])) {
						$code_wo_product[$product_id]['product']['manufacturer_name'] = $all_manufacturers[$all_products[$product_id]['manufacturer_id']]['name'];
					}
				}
				foreach ($product as $option_value_id => $unique_codes) {
					foreach ($unique_codes as $unique_code) {
						$cell_id = $all_product_to_cell[$unique_code['id']];
						$cell_name = $this->model_extension_module_storage_cell->getCellById($cell_id);
						$history = $this->model_extension_module_storage_cell->getCodeHistory($unique_code['id']);
						$orders = $this->model_extension_module_storage_cell->getOrderHistory($unique_code['id']);
						$unique_code['product_code_id'] = $unique_code['id'];
						// $unique_code['unique_code'] = $unique_code['unique_code'];
						$unique_code['option_name'] = isset($all_options[$unique_code['option_value_id']]) ? $all_options[$unique_code['option_value_id']]['option_name'] : '';
						$unique_code['option_value_name'] = isset($all_options[$unique_code['option_value_id']]) ? $all_options[$unique_code['option_value_id']]['option_value_name'] : '';
						$unique_code['cell_id'] = $cell_id;
						$unique_code['cell_name'] = $cell_name;
						$unique_code['history'] = $history;
						$unique_code['orders'] = $orders;
						$unique_code['date_added'] = date('d.m.Y h:i', strtotime($unique_code['date_code_added']));
						$unique_code['href'] = $this->url->link('catalog/product/edit', 'token=' . $this->session->data['token'] . '&product_id=' . $product_id, true);
						$code_wo_product[$product_id]['unique_codes'][] = $unique_code;
					}
				}
			}

			return $code_wo_product;
		} elseif ($filter['filter_product'] == 'filter_wo_cells') {

			return $code_wo_cell;
		} elseif ($filter['filter_product'] == 'filter_wo_link_product') {

			return $all_product_to_cell;
		}

		return $products;
	}

	protected function getFilterCodeList($filter) {
		// $all_products = $this->model_extension_module_storage_cell->getProducts($filter);
		// $all_manufacturers = $this->model_extension_module_storage_cell->getAllManufacturers();
		$all_options = $this->model_extension_module_storage_cell->getAllOptions();
		// $all_product_options = $this->model_extension_module_storage_cell->getAllProductOptionValues();
		// $all_unique_codes = $this->model_extension_module_storage_cell->getAllUniqueCodes();
		$all_product_to_cell = $this->model_extension_module_storage_cell->getAllProductToCell($filter);

		$products = array();

		$filter_products = $this->model_extension_module_storage_cell->getByCode($filter);

		if ($filter_products) {
			foreach ($filter_products as $filter_product) {
				if (isset($all_product_to_cell[$filter_product['id']])) {
					$cell_id = $all_product_to_cell[$filter_product['id']];
					$cell_name = $this->model_extension_module_storage_cell->getCellById($cell_id);
				} else {
					$cell_id = '';
					$cell_name = '';
				}
				$history = $this->model_extension_module_storage_cell->getCodeHistory($filter_product['id']);
				$orders = $this->model_extension_module_storage_cell->getOrderHistory($filter_product['id']);
				$product_info = array(
					'product_id'				=> $filter_product['product_id'],
					'name'							=> $filter_product['name'],
					'model'							=> $filter_product['model'],
					'quantity'					=> $filter_product['quantity'],
					'image'							=> ($filter_product['image'] && is_file(DIR_IMAGE . $filter_product['image'])) ? '/image/' . $filter_product['image'] : '',
					'price'							=> (float)$filter_product['price'],
					'status'						=> $filter_product['status'],
					'manufacturer_id'		=> $filter_product['manufacturer_id'],
					'manufacturer_name'	=> $filter_product['manufacturer'],
					'href'							=> $this->url->link('catalog/product/edit', 'token=' . $this->session->data['token'] . '&product_id=' . $filter_product['product_id'], true),
				);
				$unique_code = array(
					'product_id' 					=> $filter_product['product_id'],
					'product_code_id' 		=> $filter_product['id'],
					'option_id' 					=> $filter_product['option_id'],
					'option_value_id' 		=> $filter_product['option_value_id'],
					'option_name' 				=> isset($all_options[$filter_product['option_value_id']]) ? $all_options[$filter_product['option_value_id']]['option_name'] : '',
					'option_value_name' 	=> isset($all_options[$filter_product['option_value_id']]) ? $all_options[$filter_product['option_value_id']]['option_value_name'] : '',
					'unique_code' 				=> $filter_product['unique_code'],
					'cell_id' 						=> $cell_id,
					'cell_name' 					=> $cell_name,
					'date_added' 					=> date('d.m.Y h:i', strtotime($filter_product['date_code_added'])),
					'history' 						=> $history,
					'orders' 							=> $orders,
					'href'								=> $this->url->link('catalog/product/edit', 'token=' . $this->session->data['token'] . '&product_id=' . $filter_product['product_id'], true),
				);
				$products[$filter_product['product_id']]['product'] = $product_info;
				$products[$filter_product['product_id']]['unique_codes'][$filter_product['id']] = $unique_code;
			}

			/*
			if ($filter['filter_history']) {
				$new_products = array();
				$needle = false;
				
				foreach ($products as $id => $product) {
					foreach ($product['unique_codes'] as $unique_code) {
						foreach ($unique_code['history'] as $history) {
							if ($history['action'] == $filter['filter_history']) {
								$needle = true;
							}
							// if ($filter['filter_date_from'] || $filter['filter_date_from']) {
								// if ($remove == 2) {
									
								// }
							// }
						}
					}
					if ($needle == true) {
						$new_products[$id] = $product;
					}
				}
				$products = $new_products;
			}
			*/
		}

		return $products;
	}

	public function auditGenerate() {
		$this->load->language('extension/module/storage_cell_audit');

		$this->load->model('extension/module/storage_cell');

		$url = '';

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		if (isset($this->request->get['filter_block'])) {
			$url .= '&filter_block=' . $this->request->get['filter_block'];
		}

		if (isset($this->request->get['filter_product'])) {
			$url .= '&filter_product=' . $this->request->get['filter_product'];
		}

		if (isset($this->request->get['filter_product_id'])) {
			$url .= '&filter_product_id=' . $this->request->get['filter_product_id'];
		}

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . $this->request->get['filter_name'];
		}

		if (isset($this->request->get['filter_code_product'])) {
			$url .= '&filter_code_product=' . $this->request->get['filter_code_product'];
		}

		if (isset($this->request->get['filter_code_cell'])) {
			$url .= '&filter_code_cell=' . $this->request->get['filter_code_cell'];
		}

		if (isset($this->request->get['filter_history'])) {
			$url .= '&filter_history=' . $this->request->get['filter_history'];
		}

		if (isset($this->request->get['filter_date_from'])) {
			$url .= '&filter_date_from=' . $this->request->get['filter_date_from'];
		}

		if (isset($this->request->get['filter_date_to'])) {
			$url .= '&filter_date_to=' . $this->request->get['filter_date_to'];
		}

		if (isset($this->request->get['filter_category'])) {
			$url .= '&filter_category=' . $this->request->get['filter_category'];
		}

		if (isset($this->request->get['filter_order_status'])) {
			$url .= '&filter_order_status=' . $this->request->get['filter_order_status'];
		}

		if (isset($this->request->get['filter_order_qty'])) {
			$url .= '&filter_order_qty=' . $this->request->get['filter_order_qty'];
		}

		$added_cnt = 0;

		$combined_id = array();

		if (!empty($this->request->post['selected'])) {
			foreach ($this->request->post['selected'] as $value) {
				$implode = explode('##', $value);
				if ($implode[0]) {
					$combined_id[$implode[0]] = $implode[0];
				}
			}

			foreach ($combined_id as $product_id) {
				$added_cnt += $this->model_extension_module_storage_cell->generateProductCodes($product_id);
			}

			if ($added_cnt > 0) {
				$this->session->data['success'] = $this->language->get('text_generate_success') . $added_cnt;
			} else {
				$this->session->data['success'] = $this->language->get('text_generate_success_0');
			}
		} else {
			$this->session->data['error'] = $this->language->get('error_empty_selected');
		}

		$this->response->redirect($this->url->link('extension/module/storage_cell/audit', 'token=' . $this->session->data['token'] . $url, true));
	}

	public function auditDelete() {
		$this->load->language('extension/module/storage_cell_audit');

		$this->load->model('extension/module/storage_cell');

		$url = '';

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		if (isset($this->request->get['filter_block'])) {
			$url .= '&filter_block=' . $this->request->get['filter_block'];
		}

		if (isset($this->request->get['filter_product'])) {
			$url .= '&filter_product=' . $this->request->get['filter_product'];
		}

		if (isset($this->request->get['filter_product_id'])) {
			$url .= '&filter_product_id=' . $this->request->get['filter_product_id'];
		}

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . $this->request->get['filter_name'];
		}

		if (isset($this->request->get['filter_code_product'])) {
			$url .= '&filter_code_product=' . $this->request->get['filter_code_product'];
		}

		if (isset($this->request->get['filter_code_cell'])) {
			$url .= '&filter_code_cell=' . $this->request->get['filter_code_cell'];
		}

		if (isset($this->request->get['filter_history'])) {
			$url .= '&filter_history=' . $this->request->get['filter_history'];
		}

		if (isset($this->request->get['filter_date_from'])) {
			$url .= '&filter_date_from=' . $this->request->get['filter_date_from'];
		}

		if (isset($this->request->get['filter_date_to'])) {
			$url .= '&filter_date_to=' . $this->request->get['filter_date_to'];
		}

		if (isset($this->request->get['filter_category'])) {
			$url .= '&filter_category=' . $this->request->get['filter_category'];
		}

		if (isset($this->request->get['filter_order_status'])) {
			$url .= '&filter_order_status=' . $this->request->get['filter_order_status'];
		}

		if (isset($this->request->get['filter_order_qty'])) {
			$url .= '&filter_order_qty=' . $this->request->get['filter_order_qty'];
		}

		$deleted_cnt = 0;
		$error_codes = array();

		$this->session->data['success'] = '';
		$this->session->data['error'] = '';

		$product_code_ids = array();

		if (!empty($this->request->post['selected'])) {
			foreach ($this->request->post['selected'] as $value) {
				$implode = explode('##', $value);
				if ($implode[1]) {
					$product_code_ids[$implode[1]] = $implode[1];
				}
			}

			foreach ($product_code_ids as $product_code_id) {
				$cell = $this->model_extension_module_storage_cell->getCellByProductCodeId($product_code_id);
				if ($cell) {
					$filter = array(
						'product_code_id' => $product_code_id,
					);
					$code_info = $this->model_extension_module_storage_cell->getProductCodesByData($filter);
					$error_codes[] = $code_info[0]['unique_code'];
				} else {
					$this->model_extension_module_storage_cell->removeProductCode($product_code_id);
					$deleted_cnt++;
				}
			}

			if ($deleted_cnt > 0) {
				$this->session->data['success'] = $this->language->get('text_delete_success') . $deleted_cnt;
			} else {
				$this->session->data['success'] = $this->language->get('text_delete_success_0');
			}

			if ($error_codes) {
				$this->session->data['error'] = $this->language->get('text_delete_error') . '<br/>' . implode('<br/>', $error_codes);
			}
		} else {
			$this->session->data['error'] = $this->language->get('error_empty_selected');
		}

		$this->response->redirect($this->url->link('extension/module/storage_cell/audit', 'token=' . $this->session->data['token'] . $url, true));
	}

	public function productToCell() {
		$this->load->language('extension/module/storage_cell_product_to_cell');

		$data['token'] = $this->session->data['token'];

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('extension/module/storage_cell');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['button_build_order'] = $this->language->get('button_build_order');
		$data['button_product_to_cell'] = $this->language->get('button_product_to_cell');
		$data['button_cell_check'] = $this->language->get('button_cell_check');
		$data['button_audit'] = $this->language->get('button_audit');
		$data['button_cell_editor'] = $this->language->get('button_cell_editor');
		$data['button_bay'] = $this->language->get('button_bay');
		$data['button_log'] = $this->language->get('button_log');
		$data['button_service'] = $this->language->get('button_service');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_new'] = $this->language->get('button_new');
		$data['text_product'] = $this->language->get('text_product');
		$data['text_cell'] = $this->language->get('text_cell');
		$data['text_link'] = $this->language->get('text_link');
		$data['text_unlink'] = $this->language->get('text_unlink');

		$data['error_warning'] = '';

		if (isset($this->session->data['error'])) {
			$data['error_warning'] = $this->session->data['error'];
			unset($this->session->data['error']);
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_storage'),
			'href' => $this->url->link('extension/module/storage_cell', 'token=' . $this->session->data['token'] . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/storage_cell/productToCell', 'token=' . $this->session->data['token'], true)
		);

		$data['build_order_link'] = $this->url->link('extension/module/storage_cell/buildOrder', 'token=' . $this->session->data['token'], true);
		$data['product_to_cell_link'] = $this->url->link('extension/module/storage_cell/productToCell', 'token=' . $this->session->data['token'], true);
		$data['cell_check_link'] = $this->url->link('extension/module/storage_cell/cellCheck', 'token=' . $this->session->data['token'], true);
		$data['audit_link'] = $this->url->link('extension/module/storage_cell/audit', 'token=' . $this->session->data['token'], true);
		$data['cell_editor_link'] = $this->url->link('extension/module/storage_cell/cellEditor', 'token=' . $this->session->data['token'], true);
		$data['bay_link'] = $this->url->link('extension/module/storage_cell/bay', 'token=' . $this->session->data['token'], true);
		$data['log_link'] = $this->url->link('extension/module/storage_cell/log', 'token=' . $this->session->data['token'], true);
		$data['service_link'] = $this->url->link('extension/module/storage_cell/service', 'token=' . $this->session->data['token'], true);

		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/storage_cell_product_to_cell', $data));
	}

	public function cellCheck() {
		$this->load->model('extension/module/storage_cell');
		$this->load->language('extension/module/storage_cell_cell_check');

		$data['token'] = $this->session->data['token'];

		$this->document->setTitle($this->language->get('heading_title'));

		$data['heading_title'] = $this->language->get('heading_title');

		$data['button_build_order'] = $this->language->get('button_build_order');
		$data['button_product_to_cell'] = $this->language->get('button_product_to_cell');
		$data['button_cell_check'] = $this->language->get('button_cell_check');
		$data['button_audit'] = $this->language->get('button_audit');
		$data['button_cell_editor'] = $this->language->get('button_cell_editor');
		$data['button_bay'] = $this->language->get('button_bay');
		$data['button_log'] = $this->language->get('button_log');
		$data['button_service'] = $this->language->get('button_service');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_new'] = $this->language->get('button_new');
		$data['button_check'] = $this->language->get('button_check');
		$data['text_product'] = $this->language->get('text_product');
		$data['text_cell'] = $this->language->get('text_cell');
		$data['text_audit'] = $this->language->get('text_audit');
		$data['text_correct'] = $this->language->get('text_correct');
		$data['title_correct'] = $this->language->get('title_correct');
		$data['title_extra'] = $this->language->get('title_extra');
		$data['title_wrong'] = $this->language->get('title_wrong');
		$data['error_divergence'] = $this->language->get('error_divergence');

		$data['error_warning'] = '';

		if (isset($this->session->data['error'])) {
			$data['error_warning'] = $this->session->data['error'];
			unset($this->session->data['error']);
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_storage'),
			'href' => $this->url->link('extension/module/storage_cell', 'token=' . $this->session->data['token'] . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/storage_cell/productToCell', 'token=' . $this->session->data['token'], true)
		);

		$data['build_order_link'] = $this->url->link('extension/module/storage_cell/buildOrder', 'token=' . $this->session->data['token'], true);
		$data['product_to_cell_link'] = $this->url->link('extension/module/storage_cell/productToCell', 'token=' . $this->session->data['token'], true);
		$data['cell_check_link'] = $this->url->link('extension/module/storage_cell/cellCheck', 'token=' . $this->session->data['token'], true);
		$data['audit_link'] = $this->url->link('extension/module/storage_cell/audit', 'token=' . $this->session->data['token'], true);
		$data['cell_editor_link'] = $this->url->link('extension/module/storage_cell/cellEditor', 'token=' . $this->session->data['token'], true);
		$data['bay_link'] = $this->url->link('extension/module/storage_cell/bay', 'token=' . $this->session->data['token'], true);
		$data['log_link'] = $this->url->link('extension/module/storage_cell/log', 'token=' . $this->session->data['token'], true);
		$data['service_link'] = $this->url->link('extension/module/storage_cell/service', 'token=' . $this->session->data['token'], true);

		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/storage_cell_cell_check', $data));
	}

	public function cellEditor() {
		$this->load->language('extension/module/storage_cell_cell_editor');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('extension/module/storage_cell');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate() && $this->validateCell()) {
			$this->model_extension_module_storage_cell->editCell($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module/storage_cell/cellEditor', 'token=' . $this->session->data['token'] . '&type=module', true));
		}

		$data['token'] = $this->session->data['token'];

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_print'] = $this->language->get('text_print');
		$data['text_cell_code'] = $this->language->get('text_cell_code');
		$data['text_empty_cells'] = $this->language->get('text_empty_cells');
		$data['text_empty_cells_no'] = $this->language->get('text_empty_cells_no');
		$data['text_select_all'] = $this->language->get('text_select_all');
		$data['entry_room_title'] = $this->language->get('entry_room_title');
		$data['entry_row_title'] = $this->language->get('entry_row_title');
		$data['entry_stack_title'] = $this->language->get('entry_stack_title');
		$data['entry_rack_title'] = $this->language->get('entry_rack_title');
		$data['entry_cell_title'] = $this->language->get('entry_cell_title');
		$data['entry_sort'] = $this->language->get('entry_sort');
		$data['entry_barcode_title'] = $this->language->get('entry_barcode_title');
		$data['entry_add'] = $this->language->get('entry_add');
		$data['entry_remove'] = $this->language->get('entry_remove');

		$data['entry_admin'] = $this->language->get('entry_admin');
		$data['entry_status'] = $this->language->get('entry_status');

		$data['button_build_order'] = $this->language->get('button_build_order');
		$data['button_product_to_cell'] = $this->language->get('button_product_to_cell');
		$data['button_cell_check'] = $this->language->get('button_cell_check');
		$data['button_audit'] = $this->language->get('button_audit');
		$data['button_cell_editor'] = $this->language->get('button_cell_editor');
		$data['button_bay'] = $this->language->get('button_bay');
		$data['button_log'] = $this->language->get('button_log');
		$data['button_service'] = $this->language->get('button_service');
		$data['button_selected_barcodes'] = $this->language->get('button_selected_barcodes');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_expand'] = $this->language->get('button_expand');
		$data['button_expand_all'] = $this->language->get('button_expand_all');
		$data['button_collapse'] = $this->language->get('button_collapse');

		$data['error_warning'] = '';

		if (isset($this->session->data['error'])) {
			$data['error_warning'] = $this->session->data['error'];
			unset($this->session->data['error']);
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_storage'),
			'href' => $this->url->link('extension/module/storage_cell', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/storage_cell/cellEditor', 'token=' . $this->session->data['token'], true)
		);

		$data['build_order_link'] = $this->url->link('extension/module/storage_cell/buildOrder', 'token=' . $this->session->data['token'], true);
		$data['product_to_cell_link'] = $this->url->link('extension/module/storage_cell/productToCell', 'token=' . $this->session->data['token'], true);
		$data['cell_check_link'] = $this->url->link('extension/module/storage_cell/cellCheck', 'token=' . $this->session->data['token'], true);
		$data['audit_link'] = $this->url->link('extension/module/storage_cell/audit', 'token=' . $this->session->data['token'], true);
		$data['cell_editor_link'] = $this->url->link('extension/module/storage_cell/cellEditor', 'token=' . $this->session->data['token'], true);
		$data['bay_link'] = $this->url->link('extension/module/storage_cell/bay', 'token=' . $this->session->data['token'], true);
		$data['log_link'] = $this->url->link('extension/module/storage_cell/log', 'token=' . $this->session->data['token'], true);
		$data['service_link'] = $this->url->link('extension/module/storage_cell/service', 'token=' . $this->session->data['token'], true);

		$data['action'] = $this->url->link('extension/module/storage_cell/cellEditor', 'token=' . $this->session->data['token'], true);
		$data['action_remove'] = $this->url->link('extension/module/storage_cell/removeCell', 'token=' . $this->session->data['token'], true);
		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);

		$data['bays'] = array();

		$bays = $this->model_extension_module_storage_cell->getBays();

		if ($bays) {
			foreach ($bays as $bay) {
				$data['bays'][$bay['type']][$bay['id']] = $bay;

				if ($bay['type'] == 'room') {
					$sort[] = $bay['id'];
				}
			}
		}

		$cell_to_bays_values_info = $this->model_extension_module_storage_cell->getCellToBays('', '', true);

		$data['bay_last_id'] = 0;
		$data['empty_cells'] = array();

		foreach ($cell_to_bays_values_info as $item) {
			if ($item['id'] > $data['bay_last_id']) {
				$data['bay_last_id'] = $item['id'];
			}

			if ($item['count'] == 0) {
				$data['empty_cells'][] = array(
					'id'			=> $item['id'],
					'name'		=> $this->model_extension_module_storage_cell->getCellById($item['id']),
				);
			}

			$key = array_search($item['room'], $sort);
			$cell_to_bays_values[$key] = $item;
		}

		ksort($cell_to_bays_values);

		$data['rooms'] = array();

		foreach ($cell_to_bays_values as $cell_to_bays_value) {
			$data['rooms'][$cell_to_bays_value['room']] = $data['bays']['room'][$cell_to_bays_value['room']]['name'];
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/storage_cell_cell_editor', $data));
	}

	public function getBays() {
		$this->load->model('extension/module/storage_cell');
		$this->load->language('extension/module/storage_cell_cell_editor');

		$json = '';

		if (isset($this->request->get['type'])) {
			$type = $this->request->get['type'];
			$ids = array(
				'room'	=> $this->request->get['room_id'],
				'row'		=> $this->request->get['row_id'],
				'stack'	=> $this->request->get['stack_id'],
				'rack'	=> $this->request->get['rack_id'],
			);
		}

		if ($type) {
			switch ($type) {
				case 'room':
					$new_type = 'row';
					break;
				case 'row':
					$new_type = 'stack';
					break;
				case 'stack':
					$new_type = 'rack';
					break;
				case 'rack':
					$new_type = 'cell';
					break;
				default:
					break;
			}

			$bays = array();
			$blocks = array();

			$bays_info = $this->model_extension_module_storage_cell->getBays();

			if ($bays_info) {
				foreach ($bays_info as $bay_info) {
					$bays[$bay_info['type']][$bay_info['id']] = $bay_info;

					if ($bay_info['type'] == $new_type) {
						$sort[] = $bay_info['id'];
					}
				}
			}

			$cell_to_bays_values_info = $this->model_extension_module_storage_cell->getCellToBays($type, $ids, true);

			foreach ($cell_to_bays_values_info as $item) {
				$key = array_search($item[$new_type], $sort);
				$cell_to_bays_values[$key] = $item;
			}

			ksort($cell_to_bays_values);

			foreach ($cell_to_bays_values as $cell_to_bays_value) {
				switch ($type) {
					case 'room':
						$blocks[$cell_to_bays_value['row']] = array(
							'type'				=> 'row',
							'id'					=> $cell_to_bays_value['row'],
							'name'				=> $bays['row'][$cell_to_bays_value['row']]['name'],
							'room'				=> $cell_to_bays_value['room'],
							'row'					=> $cell_to_bays_value['row'],
							'stack'				=> '',
							'rack'				=> '',
						);
						break;

					case 'row':
						$blocks[$cell_to_bays_value['stack']] = array(
							'type'				=> 'stack',
							'id'					=> $cell_to_bays_value['stack'],
							'name'				=> $bays['stack'][$cell_to_bays_value['stack']]['name'],
							'room'				=> $cell_to_bays_value['room'],
							'row'					=> $cell_to_bays_value['row'],
							'stack'				=> $cell_to_bays_value['stack'],
							'rack'				=> '',
						);
						break;

					case 'stack':
						$blocks[$cell_to_bays_value['rack']] = array(
							'type'				=> 'rack',
							'id'					=> $cell_to_bays_value['rack'],
							'name'				=> $bays['rack'][$cell_to_bays_value['rack']]['name'],
							'room'				=> $cell_to_bays_value['room'],
							'row'					=> $cell_to_bays_value['row'],
							'stack'				=> $cell_to_bays_value['stack'],
							'rack'				=> $cell_to_bays_value['rack'],
						);
						break;

					case 'rack':
						$date_audit = $cell_to_bays_value['date_audit'] != '0000-00-00 00:00:00' ? date('d.m.Y H:i', strtotime($cell_to_bays_value['date_audit'])) : '';
						$blocks[$cell_to_bays_value['id']] = array(
							'type'				=> 'cell',
							'id'					=> $cell_to_bays_value['id'],
							'date_audit'	=> $date_audit,
							'product_qty'	=> $cell_to_bays_value['count'],
							'full_name'		=> $bays['room'][$cell_to_bays_value['room']]['name'] . ' - ' . $bays['row'][$cell_to_bays_value['row']]['name'] . ' - ' . $bays['stack'][$cell_to_bays_value['stack']]['name'] . ' - ' . $bays['rack'][$cell_to_bays_value['rack']]['name'] . ' - ' . $bays['cell'][$cell_to_bays_value['cell']]['name'],
							'name'				=> $bays['cell'][$cell_to_bays_value['cell']]['name'],
							'room'				=> $cell_to_bays_value['room'],
							'row'					=> $cell_to_bays_value['row'],
							'stack'				=> $cell_to_bays_value['stack'],
							'rack'				=> $cell_to_bays_value['rack'],
						);
						break;

					default:
						break;
				}
			}

			$json = '<div class="' . $new_type . 's' . ($new_type == "cell" ? ' row' : '') . '">';
			foreach ($blocks as $block) {
				if ($new_type == 'cell') $json .= '<div class="col-xs-12 col-sm-6">';
				$json .= '<div class="block ' . $block['type'] . '">';
				$json .= '<div class="title">';
				if ($new_type == 'cell') {
					$json .= '<div class="info">';
					$json .= '<span><input type="checkbox" name="selected[]" value="' . $block['id'] . '" class="cell-select" data-code="cell_' . $block['id'] . '" data-fullname="' . $block['full_name'] . '"></span>';
					$json .= '<span class="id">' . $block['id'] . '</span>';
					$json .= '<span class="name">' . $block['name'] . '</span>';
					$json .= '</div>';
				} else {
					$json .= '<div class="name">' . $block['name'] . '</div>';
				}
				$json .= '<div class="buttons">';
				if ($new_type == 'cell') {
					$json .= '<button type="button" class="btn btn-success barcode" data-code="cell_' . $block['id'] . '" data-fullname="' . $block['full_name'] . '" data-toggle="tooltip" title="' . $this->language->get('entry_barcode_title') . '"><i class="fa fa-barcode"></i></button><button class="btn btn-primary edit" data-id="' . $block['id'] . '" data-toggle="tooltip" title="' . $this->language->get('entry_edit') . '"><i class="fa fa-pencil"></i></button><button class="btn btn-danger remove" data-id="' . $block['id'] . '" data-toggle="tooltip" title="' . $this->language->get('entry_remove') . '"><i class="fa fa-times"></i></button>';
				} else {
					$json .= '<button class="btn btn-default collapse-btn">' . $this->language->get('button_collapse') . '</button>';
					$json .= '<button class="btn btn-default expand-btn all" data-type="' . $block['type'] . '" data-room-id="' . $block['room'] . '" data-row-id="' . $block['row'] . '" data-stack-id="' . $block['stack'] . '" data-rack-id="' . $block['rack'] . '" data-expand="all">' . $this->language->get('button_expand_all') . '</button>';
					$json .= '<button class="btn btn-default expand-btn one" data-type="' . $block['type'] . '" data-room-id="' . $block['room'] . '" data-row-id="' . $block['row'] . '" data-stack-id="' . $block['stack'] . '" data-rack-id="' . $block['rack'] . '" data-expand="one">' . $this->language->get('button_expand') . '</button>';
				}
				$json .= '</div>';
				$json .= '</div>';
				if ($new_type == 'cell') {
					$href = $this->url->link('extension/module/storage_cell/audit', 'token=' . $this->session->data['token'] . '&filter_block=2&filter_code_cell=' . $block['id'], true);
					if ($block['product_qty'] == 0) {
						$qty_text = '<a href="' . $href . '" target="_blank"><span>' . $this->language->get('text_products') . $block['product_qty'] . '</span></a>';
					} else {
						$qty_text = '<a href="' . $href . '" target="_blank">' . $this->language->get('text_products') . $block['product_qty'] . '</a>';
					}
					$json .= '<div class="body cell"><div>' . $this->language->get('text_audit') . $block['date_audit'] . '</div><div>' . $qty_text . '</div></div>';
				} else {
					$json .= '<div class="preloader" style="display: none"><div class="loader"></div></div>';
					$json .= '<div class="body" style="display: none;"></div>';
				}
				$json .= '</div>';
				if ($new_type == 'cell') $json .= '</div>';
			}
			$json .= '</div>';
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function bay() {
		$this->load->language('extension/module/storage_cell_bay');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('extension/module/storage_cell');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate() && $this->validateBay()) {
			$this->model_extension_module_storage_cell->editBay($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/module/storage_cell/bay', 'token=' . $this->session->data['token'] . '&type=module', true));
		}

		$data['token'] = $this->session->data['token'];

		$data['heading_title'] = $this->language->get('heading_title');

		$data['entry_room_title'] = $this->language->get('entry_room_title');
		$data['entry_row_title'] = $this->language->get('entry_row_title');
		$data['entry_stack_title'] = $this->language->get('entry_stack_title');
		$data['entry_rack_title'] = $this->language->get('entry_rack_title');
		$data['entry_cell_title'] = $this->language->get('entry_cell_title');
		$data['entry_sort'] = $this->language->get('entry_sort');
		$data['entry_barcode_title'] = $this->language->get('entry_barcode_title');
		$data['entry_add'] = $this->language->get('entry_add');
		$data['entry_remove'] = $this->language->get('entry_remove');

		$data['entry_admin'] = $this->language->get('entry_admin');
		$data['entry_status'] = $this->language->get('entry_status');

		$data['button_build_order'] = $this->language->get('button_build_order');
		$data['button_product_to_cell'] = $this->language->get('button_product_to_cell');
		$data['button_cell_check'] = $this->language->get('button_cell_check');
		$data['button_audit'] = $this->language->get('button_audit');
		$data['button_cell_editor'] = $this->language->get('button_cell_editor');
		$data['button_bay'] = $this->language->get('button_bay');
		$data['button_log'] = $this->language->get('button_log');
		$data['button_service'] = $this->language->get('button_service');
		$data['button_selected_barcodes'] = $this->language->get('button_selected_barcodes');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		$data['error_warning'] = '';

		if (isset($this->session->data['error'])) {
			$data['error_warning'] = $this->session->data['error'];
			unset($this->session->data['error']);
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_storage'),
			'href' => $this->url->link('extension/module/storage_cell', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/bay', 'token=' . $this->session->data['token'], true)
		);

		$data['build_order_link'] = $this->url->link('extension/module/storage_cell/buildOrder', 'token=' . $this->session->data['token'], true);
		$data['product_to_cell_link'] = $this->url->link('extension/module/storage_cell/productToCell', 'token=' . $this->session->data['token'], true);
		$data['cell_check_link'] = $this->url->link('extension/module/storage_cell/cellCheck', 'token=' . $this->session->data['token'], true);
		$data['audit_link'] = $this->url->link('extension/module/storage_cell/audit', 'token=' . $this->session->data['token'], true);
		$data['cell_editor_link'] = $this->url->link('extension/module/storage_cell/cellEditor', 'token=' . $this->session->data['token'], true);
		$data['bay_link'] = $this->url->link('extension/module/storage_cell/bay', 'token=' . $this->session->data['token'], true);
		$data['log_link'] = $this->url->link('extension/module/storage_cell/log', 'token=' . $this->session->data['token'], true);
		$data['service_link'] = $this->url->link('extension/module/storage_cell/service', 'token=' . $this->session->data['token'], true);

		$data['bays_title'] = array(
			0 => array(
				'title'			=> $this->language->get('entry_room_title'),
				'pseudo'		=> 'room',
			),
			1 => array(
				'title'			=> $this->language->get('entry_row_title'),
				'pseudo'		=> 'row',
			),
			2 => array(
				'title'			=> $this->language->get('entry_stack_title'),
				'pseudo'		=> 'stack',
			),
			3 => array(
				'title'			=> $this->language->get('entry_rack_title'),
				'pseudo'		=> 'rack',
			),
			4 => array(
				'title'			=> $this->language->get('entry_cell_title'),
				'pseudo'		=> 'cell',
			),
		);

		$data['bay_last_id'] = 0;

		$bays = $this->model_extension_module_storage_cell->getBays();

		if ($this->request->post['bays']) {
			$data['bays'] = $this->request->post['bays'];
		} elseif ($bays) {
			foreach ($bays as $bay) {
				$data['bays'][$bay['type']][] = $bay;
				if ($bay['id'] > $data['bay_last_id']) {
					$data['bay_last_id'] = $bay['id'];
				}
			}
		} else {
			$data['bays'] = array();
		}

		$data['bay_last_id'] += 1;

		$data['action'] = $this->url->link('extension/module/storage_cell/bay', 'token=' . $this->session->data['token'], true);

		$data['action_remove'] = $this->url->link('extension/module/storage_cell/removeBay', 'token=' . $this->session->data['token'], true);

		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/storage_cell_bay', $data));
	}

	public function log() {
		$this->load->language('extension/module/storage_cell_log');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['token'] = $this->session->data['token'];

		$data['heading_title'] = $this->language->get('heading_title');

		$data['button_build_order'] = $this->language->get('button_build_order');
		$data['button_product_to_cell'] = $this->language->get('button_product_to_cell');
		$data['button_cell_check'] = $this->language->get('button_cell_check');
		$data['button_audit'] = $this->language->get('button_audit');
		$data['button_cell_editor'] = $this->language->get('button_cell_editor');
		$data['button_bay'] = $this->language->get('button_bay');
		$data['button_log'] = $this->language->get('button_log');
		$data['button_service'] = $this->language->get('button_service');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['button_download'] = $this->language->get('button_download');
		$data['button_clear'] = $this->language->get('button_clear');

		$data['error_warning'] = '';

		if (isset($this->session->data['error'])) {
			$data['error_warning'] = $this->session->data['error'];
			unset($this->session->data['error']);
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_storage'),
			'href' => $this->url->link('extension/module/storage_cell', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/storage_cell/service', 'token=' . $this->session->data['token'], true)
		);

		$data['build_order_link'] = $this->url->link('extension/module/storage_cell/buildOrder', 'token=' . $this->session->data['token'], true);
		$data['product_to_cell_link'] = $this->url->link('extension/module/storage_cell/productToCell', 'token=' . $this->session->data['token'], true);
		$data['cell_check_link'] = $this->url->link('extension/module/storage_cell/cellCheck', 'token=' . $this->session->data['token'], true);
		$data['audit_link'] = $this->url->link('extension/module/storage_cell/audit', 'token=' . $this->session->data['token'], true);
		$data['cell_editor_link'] = $this->url->link('extension/module/storage_cell/cellEditor', 'token=' . $this->session->data['token'], true);
		$data['bay_link'] = $this->url->link('extension/module/storage_cell/bay', 'token=' . $this->session->data['token'], true);
		$data['log_link'] = $this->url->link('extension/module/storage_cell/log', 'token=' . $this->session->data['token'], true);
		$data['service_link'] = $this->url->link('extension/module/storage_cell/service', 'token=' . $this->session->data['token'], true);

		$data['download'] = $this->url->link('extension/module/storage_cell/logDownload', 'token=' . $this->session->data['token'], true);
		$data['clear'] = $this->url->link('extension/module/storage_cell/logClear', 'token=' . $this->session->data['token'], true);

		$data['log'] = '';

		$file = DIR_LOGS . 'storage_cell_log.log';

		if (file_exists($file)) {
			$size = filesize($file);

			if ($size >= 5242880) {
				$suffix = array(
					'B',
					'KB',
					'MB',
					'GB',
					'TB',
					'PB',
					'EB',
					'ZB',
					'YB'
				);

				$i = 0;

				while (($size / 1024) > 1) {
					$size = $size / 1024;
					$i++;
				}

				$data['error_warning'] = sprintf($this->language->get('error_warning'), basename($file), round(substr($size, 0, strpos($size, '.') + 4), 2) . $suffix[$i]);
			} else {
				$data['log_content'] = file_get_contents($file, FILE_USE_INCLUDE_PATH, null);
			}
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/storage_cell_log', $data));
	}

	public function logDownload() {
		$this->load->language('extension/module/storage_cell_log');

		$file = DIR_LOGS . 'storage_cell_log.log';

		if (file_exists($file) && filesize($file) > 0) {
			$this->response->addheader('Pragma: public');
			$this->response->addheader('Expires: 0');
			$this->response->addheader('Content-Description: File Transfer');
			$this->response->addheader('Content-Type: application/octet-stream');
			$this->response->addheader('Content-Disposition: attachment; filename="' . 'storage_cell_log_' . date('d-m-Y_H-i', time()) . '.log"');
			$this->response->addheader('Content-Transfer-Encoding: binary');

			$this->response->setOutput(file_get_contents($file, FILE_USE_INCLUDE_PATH, null));
		} else {
			$this->session->data['error'] = sprintf($this->language->get('error_warning'), basename($file), '0B');

			$this->response->redirect($this->url->link('extension/module/storage_cell/log', 'token=' . $this->session->data['token'], true));
		}
	}

	public function logClear() {
		$this->load->language('extension/module/storage_cell_log');

		if (!$this->user->hasPermission('modify', 'tool/log')) {
			$this->session->data['error'] = $this->language->get('error_permission');
		} else {
			$file = DIR_LOGS . 'storage_cell_log.log';

			$handle = fopen($file, 'w+');

			fclose($handle);

			$this->session->data['success'] = $this->language->get('text_success');
		}

		$this->response->redirect($this->url->link('extension/module/storage_cell/log', 'token=' . $this->session->data['token'], true));
	}

	public function service() {
		$this->load->language('extension/module/storage_cell_service');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['token'] = $this->session->data['token'];

		$data['heading_title'] = $this->language->get('heading_title');

		$data['button_build_order'] = $this->language->get('button_build_order');
		$data['button_product_to_cell'] = $this->language->get('button_product_to_cell');
		$data['button_cell_check'] = $this->language->get('button_cell_check');
		$data['button_audit'] = $this->language->get('button_audit');
		$data['button_cell_editor'] = $this->language->get('button_cell_editor');
		$data['button_bay'] = $this->language->get('button_bay');
		$data['button_log'] = $this->language->get('button_log');
		$data['button_service'] = $this->language->get('button_service');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['text_warning_clear_codes'] = $this->language->get('text_warning_clear_codes');
		$data['text_warning_clear_links'] = $this->language->get('text_warning_clear_links');
		$data['text_warning_clear_history'] = $this->language->get('text_warning_clear_history');
		$data['text_warning_generate'] = $this->language->get('text_warning_generate');
		$data['button_clear_codes'] = $this->language->get('button_clear_codes');
		$data['button_clear_links'] = $this->language->get('button_clear_links');
		$data['button_clear_history'] = $this->language->get('button_clear_history');
		$data['button_generate'] = $this->language->get('button_generate');

		$data['error_warning'] = '';

		if (isset($this->session->data['error'])) {
			$data['error_warning'] = $this->session->data['error'];
			unset($this->session->data['error']);
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_storage'),
			'href' => $this->url->link('extension/module/storage_cell', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/storage_cell/service', 'token=' . $this->session->data['token'], true)
		);

		$data['build_order_link'] = $this->url->link('extension/module/storage_cell/buildOrder', 'token=' . $this->session->data['token'], true);
		$data['product_to_cell_link'] = $this->url->link('extension/module/storage_cell/productToCell', 'token=' . $this->session->data['token'], true);
		$data['cell_check_link'] = $this->url->link('extension/module/storage_cell/cellCheck', 'token=' . $this->session->data['token'], true);
		$data['audit_link'] = $this->url->link('extension/module/storage_cell/audit', 'token=' . $this->session->data['token'], true);
		$data['cell_editor_link'] = $this->url->link('extension/module/storage_cell/cellEditor', 'token=' . $this->session->data['token'], true);
		$data['bay_link'] = $this->url->link('extension/module/storage_cell/bay', 'token=' . $this->session->data['token'], true);
		$data['log_link'] = $this->url->link('extension/module/storage_cell/log', 'token=' . $this->session->data['token'], true);
		$data['service_link'] = $this->url->link('extension/module/storage_cell/service', 'token=' . $this->session->data['token'], true);

		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);

		$data['action_clear_codes'] = $this->url->link('extension/module/storage_cell/clearUniqueProductCodes', 'token=' . $this->session->data['token'], true);
		$data['action_clear_links'] = $this->url->link('extension/module/storage_cell/clearLinksProductCodes', 'token=' . $this->session->data['token'], true);
		$data['action_clear_history'] = $this->url->link('extension/module/storage_cell/clearHistoryProductCodes', 'token=' . $this->session->data['token'], true);
		$data['action_generate'] = $this->url->link('extension/module/storage_cell/generateUniqueProductCodes', 'token=' . $this->session->data['token'], true);

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/storage_cell_service', $data));
	}

	public function clearUniqueProductCodes() {
		$this->load->language('extension/module/storage_cell_service');

		$this->load->model('extension/module/storage_cell');

		$this->model_extension_module_storage_cell->clearUniqueCodes();

		$this->session->data['success'] = $this->language->get('text_success_clear_codes');

		$this->response->redirect($this->url->link('extension/module/storage_cell/service', 'token=' . $this->session->data['token'] . '&type=module', true));
	}

	public function clearLinksProductCodes() {
		$this->load->language('extension/module/storage_cell_service');

		$this->load->model('extension/module/storage_cell');

		$this->model_extension_module_storage_cell->clearUniqueCodeLinks();

		$this->session->data['success'] = $this->language->get('text_success_clear_links');

		$this->response->redirect($this->url->link('extension/module/storage_cell/service', 'token=' . $this->session->data['token'] . '&type=module', true));
	}

	public function clearHistoryProductCodes() {
		$this->load->language('extension/module/storage_cell_service');

		$this->load->model('extension/module/storage_cell');

		$this->model_extension_module_storage_cell->clearUniqueCodeHistory();

		$this->session->data['success'] = $this->language->get('text_success_clear_history');

		$this->response->redirect($this->url->link('extension/module/storage_cell/service', 'token=' . $this->session->data['token'] . '&type=module', true));
	}

	public function generateUniqueProductCodes() {
		$this->load->language('extension/module/storage_cell_service');

		$this->load->model('extension/module/storage_cell');

		$this->model_extension_module_storage_cell->clearUniqueCodes();

		$limit = 5000000;
		$offset = isset($this->request->get['offset']) ? (int) $this->request->get['offset'] : 0;

		$filter = array(
			'start'		=> $offset,
			'limit'		=> $limit,
		);

		$products = $this->model_extension_module_storage_cell->getProductsWithOptions($filter);

		$data = array();

		if ($products) {
			foreach ($products as $product) {
				if ($product['options']) {
					foreach ($product['options'] as $option) {
						if ($option['quantity'] > 0) {
							for ($i = 1; $i <= $option['quantity']; $i++) {
								$data = array(
									'product_id' 				=> $product['product_id'],
									'model' 						=> $product['model'],
									'manufacturer' 			=> $product['manufacturer'],
									'option_id' 				=> $option['option_id'],
									'option_value_id' 	=> $option['option_value_id'],
									'count' 						=> $i,
									'unique_code' 			=> $product['product_id'] . '_' . $option['option_id'] . '_' . $option['option_value_id'] . '_' . $i,
									'date_added' 				=> $product['date_added'],
								);
								$this->model_extension_module_storage_cell->addProductUniqueCode($data);
							}
						}
					}
				} else {
					if ($product['quantity'] > 0) {
						for ($i = 1; $i <= $product['quantity']; $i++) {
							$data = array(
								'product_id' 				=> $product['product_id'],
								'model' 						=> $product['model'],
								'manufacturer' 			=> $product['manufacturer'],
								'option_id' 				=> '',
								'option_value_id' 	=> '',
								'count' 						=> $i,
								'unique_code' 			=> $product['product_id'] . '___' . $i,
								'date_added' 				=> $product['date_added'],
							);
							$this->model_extension_module_storage_cell->addProductUniqueCode($data);
						}
					}
				}
			}
		}
		// if (isset($offset)) header('Refresh:0; url=index.php?route=extension/storage_cell/generateUniqueProductCodes&key=' . $this->secret_key . '&offset=' . $offset);

		$this->session->data['success'] = $this->language->get('text_success_generate');

		$this->response->redirect($this->url->link('extension/module/storage_cell/service', 'token=' . $this->session->data['token'] . '&type=module', true));
	}

	public function removeBay() {
		$this->load->language('extension/module/storage_cell_bay');

		$this->load->model('extension/module/storage_cell');

		$bay_check = array();
		$success = false;

		if (!empty($this->request->post['selected'])) {
			foreach ($this->request->post['selected'] as $bay_id) {
				$product_bay_link = $this->model_extension_module_storage_cell->checkProductBayLink($bay_id);

				if ($product_bay_link) {
					$bay_info = $this->model_extension_module_storage_cell->getBay($bay_id);
					if ($bay_info) {
						$bay_check[] = $bay_info['name'];
					}
				} else {
					$this->model_extension_module_storage_cell->removeBay($bay_id);
					$success = true;
				}
			}
			if ($bay_check) {
				$this->session->data['error']  = $this->language->get('error_remove_cell') . '<br/>';
				$this->session->data['error'] .= implode('<br/>', $bay_check);
			}
		} else {
			$this->session->data['error'] = $this->language->get('error_empty_selected');
		}

		if ($success) {
			$this->session->data['success'] = $this->language->get('text_remove_success');
		}

		$this->response->redirect($this->url->link('extension/module/storage_cell/bay', 'token=' . $this->session->data['token'] . '&type=module', true));
	}

	public function getCellTable() {
		$this->load->language('extension/module/storage_cell_cell_editor');

		$this->load->model('extension/module/storage_cell');

		if (isset($this->request->get['cell_id'])) {
			$data['entry_room_title'] = $this->language->get('entry_room_title');
			$data['entry_row_title'] = $this->language->get('entry_row_title');
			$data['entry_stack_title'] = $this->language->get('entry_stack_title');
			$data['entry_rack_title'] = $this->language->get('entry_rack_title');
			$data['entry_cell_title'] = $this->language->get('entry_cell_title');
			$data['button_save'] = $this->language->get('button_save');

			$data['token'] = $this->session->data['token'];

			$cell_id = $this->request->get['cell_id'];

			$data['bays'] = array();

			$bays = $this->model_extension_module_storage_cell->getBays();

			if ($bays) {
				foreach ($bays as $bay) {
					$data['bays'][$bay['type']][] = $bay;
				}
			}

			$data['cell_info'] = $this->model_extension_module_storage_cell->getCellToBay($cell_id);
		}

		$this->response->setOutput($this->load->view('extension/module/storage_cell_cell_table', $data));
	}

	public function editCell() {
		$json = '';
		$data = array();

		if (!empty($this->request->post['cell'])) {
			$this->load->model('extension/module/storage_cell');

			foreach ($this->request->post['cell'] as $id => $value) {
				$data['cells'][] = array(
					'id'		=> $id,
					'room' 	=> $value['room'],
					'row' 	=> $value['row'],
					'stack'	=> $value['stack'],
					'rack' 	=> $value['rack'],
					'cell' 	=> $value['cell'],
				);
			}

			$this->model_extension_module_storage_cell->editCell($data);

			$json = 'ok';
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function removeCell() {
		$this->load->language('extension/module/storage_cell_cell_editor');

		$this->load->model('extension/module/storage_cell');

		$cell_check = array();
		$success = false;

		if (!empty($this->request->post['selected'])) {
			foreach ($this->request->post['selected'] as $cell_id) {
				$product_cell_link = $this->model_extension_module_storage_cell->checkProductCellLink($cell_id);

				if ($product_cell_link) {
					$cell_check[] = $product_cell_link;
				} else {
					$this->model_extension_module_storage_cell->removeCell($cell_id);
					$success = true;
				}
			}
			if ($cell_check) {
				$this->session->data['error']  = $this->language->get('error_remove_cell') . '<br/>';
				$this->session->data['error'] .= implode('<br/>', $cell_check);
			}
		} else {
			$this->session->data['error'] = $this->language->get('error_empty_selected');
		}

		if ($success) {
			$this->session->data['success'] = $this->language->get('text_remove_success');
		}

		if (isset($this->request->get['ajax'])) {
			$json = '';
			if (isset($this->session->data['error']) && $this->session->data['error']) {
				$json = '<span style="color: red; font-weight: bold;">' . $this->language->get('error_remove_cell_one') . '</span>';
			} elseif (isset($this->session->data['success']) && $this->session->data['success']) {
				$json = 'ok';
			}
			unset($this->session->data['error']);
			unset($this->session->data['success']);

			$this->response->addHeader('Content-Type: application/json');
			$this->response->setOutput(json_encode($json));
		} else {
			$this->response->redirect($this->url->link('extension/module/storage_cell/cellEditor', 'token=' . $this->session->data['token'] . '&type=module', true));
		}
	}

	public function findValue() {
		$json = array();
		$json['already_linked'] = false;

		$this->load->language('extension/module/storage_cell_product_to_cell');

		$operation = $this->request->get['operation'];
		$method = $this->request->get['method'];
		$value = $this->request->get['value'];

		$this->load->model('extension/module/storage_cell');

		switch ($method) {
			case 'product':
				$product = $this->model_extension_module_storage_cell->getProductByUniqueCode($value);
				if ($product) {
					if ($product['cell_id']) {
						$json['error'] = $this->language->get('error_product_already_link');
						$json['already_linked'] = true;
						switch ($operation) {
							case 'product_to_cell':
								$this->writeLog($this->language->get('log_input_product') . $value . '&nbsp;&nbsp;&nbsp;(' . $this->language->get('error_product_already_link') . ')');
								break;
							default:
								break;
						}
					} else {
						$json['success'] = $this->language->get('success_product_found');
						$json['already_linked'] = false;
						switch ($operation) {
							case 'product_to_cell':
								$this->writeLog($this->language->get('log_input_product') . $value . '&nbsp;&nbsp;&nbsp;(' . $this->language->get('success_product_found') . ')');
								break;
							default:
								break;
						}
					}
					$json['product_name'] = html_entity_decode($product['product_name']);
					$json['product_code_id'] = $product['id'];
					$json['unique_code'] = $product['unique_code'];
					$json['text_ok'] = $this->language->get('text_ok');
				} else {
					$json['already_linked'] = false;
					$json['error'] = $this->language->get('error_product_not_found');
					switch ($operation) {
						case 'product_to_cell':
							$this->writeLog($this->language->get('log_input_product') . $value . '&nbsp;&nbsp;&nbsp;(' . $this->language->get('error_product_not_found') . ')');
							break;
						default:
							break;
					}
				}
				break;

			case 'cell':
				$cell_id = str_replace('cell_', '', $value);
				$cell = $this->model_extension_module_storage_cell->getCellById($cell_id);
				if ($cell) {
					$audit_date = $this->model_extension_module_storage_cell->getCellAuditDate($cell_id);
					if ($audit_date != '0000-00-00 00:00:00') {
						$audit_date = date('d.m.Y h:i', strtotime($audit_date));
					} else {
						$audit_date = '';
					}
					$this->model_extension_module_storage_cell->setCellCheckDate($cell_id);
					$json['success'] = $this->language->get('success_cell_found');
					$json['cell_name'] = $cell;
					$json['cell_id'] = $cell_id;
					$json['cell_audit_date'] = $audit_date;
					switch ($operation) {
						case 'product_to_cell':
							$this->writeLog($this->language->get('log_input_cell') . $value . '&nbsp;&nbsp;&nbsp;(' . $this->language->get('success_cell_found') . ')');
							break;
						default:
							break;
					}
				} else {
					$json['error'] = $this->language->get('error_cell_not_found');
					switch ($operation) {
						case 'product_to_cell':
							$this->writeLog($this->language->get('log_input_cell') . $value . '&nbsp;&nbsp;&nbsp;(' . $this->language->get('error_cell_not_found') . ')');
							break;
						default:
							break;
					}
				}
				break;

			default:
				break;
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function action() {
		$json = array();

		$this->load->language('extension/module/storage_cell_product_to_cell');

		$operation = $this->request->get['operation'];
		$action = $this->request->get['action'];
		$cell_id = $this->request->get['cell_id'] ? $this->request->get['cell_id'] : '';
		$product_code_id = $this->request->get['product_code_id'] ? $this->request->get['product_code_id'] : '';

		$this->load->model('extension/module/storage_cell');

		switch ($action) {
			case 'link':
				$query = $this->model_extension_module_storage_cell->linkProduct($product_code_id, $cell_id);
				if ($query) {
					$json['success'] = $this->language->get('success_product_link');
					switch ($operation) {
						case 'product_to_cell':
							$product = $this->model_extension_module_storage_cell->getProductCodesByData(array('product_code_id' => $product_code_id));
							$this->writeLog($this->language->get('log_link_product') . $product[0]['unique_code'] . ' 🠖 cell_' . $cell_id . '&nbsp;&nbsp;&nbsp;(' . $this->language->get('success_product_link') . ')');
							break;
						default:
							break;
					}
				} else {
					$json['error'] = $this->language->get('error_unknown');
					switch ($operation) {
						case 'product_to_cell':
							$product = $this->model_extension_module_storage_cell->getProductCodesByData(array('product_code_id' => $product_code_id));
							$this->writeLog($this->language->get('log_link_product') . $product[0]['unique_code'] . ' 🠖 cell_' . $cell_id . '&nbsp;&nbsp;&nbsp;(' . $this->language->get('error_unknown') . ')');
							break;
						default:
							break;
					}
				}
				break;

			case 'unlink':
				$query = $this->model_extension_module_storage_cell->unlinkProduct($product_code_id, $cell_id);
				if ($query) {
					$json['error'] = $this->language->get('error_unknown');
					switch ($operation) {
						case 'product_to_cell':
							$product = $this->model_extension_module_storage_cell->getProductCodesByData(array('product_code_id' => $product_code_id));
							$this->writeLog($this->language->get('log_unlink_product') . $product[0]['unique_code'] . ($cell_id ? ' 🠔 cell_' . $cell_id : '') . '&nbsp;&nbsp;&nbsp;(' . $this->language->get('error_unknown') . ')');
							break;
						default:
							break;
					}
				} else {
					$json['success'] = $this->language->get('success_product_unlink');
					switch ($operation) {
						case 'product_to_cell':
							$product = $this->model_extension_module_storage_cell->getProductCodesByData(array('product_code_id' => $product_code_id));
							$this->writeLog($this->language->get('log_unlink_product') . $product[0]['unique_code'] . ($cell_id ? ' 🠔 cell_' . $cell_id : '') . '&nbsp;&nbsp;&nbsp;(' . $this->language->get('success_product_unlink') . ')');
							break;
						default:
							break;
					}
				}
				break;

			case 'check':
				$this->load->language('extension/module/storage_cell_cell_check');
				$products = array();
				$cell_products = $this->model_extension_module_storage_cell->getByCode(array('filter_code_cell' => $cell_id));
				if ($cell_products) {
					foreach ($cell_products as $cell_product) {
						$products[$cell_product['id']] = array(
							'product_code_id'		=> $cell_product['id'],
							'product_name'			=> $cell_product['name'],
							'unique_code'				=> $cell_product['unique_code'],
							// 'cell_name'					=> $this->model_extension_module_storage_cell->getCellById($cell_id),
						);
					}
					$json['products'] = $products;
					$json['success'] = $this->language->get('text_ok');
				} else {
					$json['error'] = $this->language->get('error_cell_empty');
				}
				break;

			default:
				break;
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function setOrder() {
		$json = array();

		$this->load->language('extension/module/storage_cell_build_order');

		$orders_id = array();

		if (isset($this->request->get['order_id'])) {
			$orders_id = explode(',', $this->request->get['order_id']);
			$orders_id = array_unique($orders_id);
		}

		if ($orders_id) {
			$check_order = $this->checkOrders($orders_id);
			if ($check_order['error']) {
				$json['error']  = $this->language->get('error_error');
				$json['error'] .= '<br/><small>' . $check_order['error'] . '</small>';
			} else {
				$json['success'] = $this->language->get('text_ok');
			}
		} else {
			$json['error'] = $this->language->get('error_order_not_found');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function checkOrders($orders_id) {
		$this->load->model('extension/module/storage_cell');
		$this->load->model('sale/order');
		$this->load->language('extension/module/storage_cell_build_order');

		$error = array();
		$out = array();
		$order_product_codes = array();
		$codes_array = array();
		$order_codes = array();
		$orders = array();
		$product_count = 0;

		foreach ($orders_id as $order_id) {
			$order_info = $this->model_sale_order->getOrder($order_id);

			if (!$order_info) {
				return array(
					'error' => $order_id . ' - ' . $this->language->get('error_order_not_found'),
				);
			}

			$orders[$order_id] = $order_info;
			$order_products = $this->model_sale_order->getOrderProducts($order_id);
			foreach ($order_products as $order_product) {
				$orders[$order_id]['products'][$order_product['order_product_id']] = $order_product;
				$order_product_options = $this->model_sale_order->getOrderOptions($order_id, $order_product['order_product_id']);
				$orders[$order_id]['products'][$order_product['order_product_id']]['options'] = $order_product_options;
			}
		}

		ksort($orders);

		foreach ($orders as $order) {
			$product_count += count($order['products']);
			foreach ($order['products'] as $product) {
				$product_data = array(
					'product_id'	=> $product['product_id']
				);
				if ($product['options']) {
					foreach ($product['options'] as $order_product_option) {
						$product_data['option_id'] = $order_product_option['option_id'];
						$product_data['option_value_id'] = $order_product_option['option_value_id'];
						$codes = $this->model_extension_module_storage_cell->getProductCodesByData($product_data);
						if ($codes) {
							foreach ($codes as $code) {
								$cell = $this->model_extension_module_storage_cell->getCellByProductCodeId($code['id']);
								if ($cell) {
									$order_codes[$code['unique_code']][$order['order_id']] = array(
										'order_id'					=> $order['order_id'],
										'order_product_id'	=> $product['order_product_id'],
										'option_id'					=> $order_product_option['option_id'],
										'option_value_id'		=> $order_product_option['option_value_id'],
									);
								}
							}
							for ($i = 1; $i <= $product['quantity']; $i++) {
								foreach ($codes as $code) {
									if (!in_array($code['id'], $codes_array)) {
										// $code_history = $this->model_extension_module_storage_cell->getCodeHistory($code['id']);
										$cell = $this->model_extension_module_storage_cell->getCellByProductCodeId($code['id']);
										if ($cell) {
											$codes_array[$code['id']] = $code['id'];
											$order_product_codes[$order['order_id']][$product['order_product_id']]['quantity'] = $product['quantity'];
											$order_product_codes[$order['order_id']][$product['order_product_id']]['codes'][$code['id']] = $code;
											$order_product_codes[$order['order_id']][$product['order_product_id']]['codes'][$code['id']]['cell_id'] = $cell['cell_id'];
											break;
										} else {
											$error[$order_product_option['order_option_id']][] = array(
												'name'				=> $product['name'],
												'href'				=> $this->url->link('extension/module/storage_cell/audit', 'token=' . $this->session->data['token'] . '&filter_block=2&filter_product_id=' . $product['product_id'], true),
												'unique_code'	=> $code['unique_code'],
												'option'			=> $order_product_option['name'] . ': ' . $order_product_option['value'],
												'order_id'		=> $order['order_id'],
												'text'				=> $this->language->get('error_product_not_linked'),
											);
										}
									}
								}
							}
						} else {
							$error[$order_product_option['order_option_id']][] = array(
								'name'				=> $product['name'],
								'href'				=> $this->url->link('extension/module/storage_cell/audit', 'token=' . $this->session->data['token'] . '&filter_block=2&filter_product_id=' . $product['product_id'], true),
								'unique_code'	=> '',
								'option'			=> $order_product_option['name'] . ': ' . $order_product_option['value'],
								'order_id'		=> $order['order_id'],
								'text'				=> $this->language->get('error_product_not_found'),
							);
						}

						if (count($order_product_codes[$order['order_id']][$product['order_product_id']]['codes']) >= $product['quantity']) {
							unset($error[$order_product_option['order_option_id']]);
						} else {
							$error[$order_product_option['order_option_id']][] = array(
								'name'				=> $product['name'],
								'href'				=> $this->url->link('extension/module/storage_cell/audit', 'token=' . $this->session->data['token'] . '&filter_block=2&filter_product_id=' . $product['product_id'], true),
								'unique_code'	=> '',
								'option'			=> $order_product_option['name'] . ': ' . $order_product_option['value'],
								'order_id'		=> $order['order_id'],
								'text'				=> $this->language->get('error_product_not_found'),
							);
						}
					}
				} else {
					$codes = $this->model_extension_module_storage_cell->getProductCodesByData($product_data);
					$order_product_codes[$order['order_id']][$product['order_product_id']]['quantity'] = $product['quantity'];
					if ($codes) {
						foreach ($codes as $code) {
							$cell = $this->model_extension_module_storage_cell->getCellByProductCodeId($code['id']);
							if ($cell) {
								$order_codes[$code['unique_code']][$order['order_id']] = array(
									'order_id'					=> $order['order_id'],
									'order_product_id'	=> $product['order_product_id'],
									'option_id'					=> '',
									'option_value_id'		=> '',
								);
							}
						}
						for ($i = 1; $i <= $product['quantity']; $i++) {
							foreach ($codes as $code) {
								if (!in_array($code['id'], $codes_array)) {
									// $code_history = $this->model_extension_module_storage_cell->getCodeHistory($code['id']);
									$cell = $this->model_extension_module_storage_cell->getCellByProductCodeId($code['id']);
									if ($cell) {
										$codes_array[$code['id']] = $code['id'];
										$order_product_codes[$order['order_id']][$product['order_product_id']]['codes'][$code['id']] = $code;
										$order_product_codes[$order['order_id']][$product['order_product_id']]['codes'][$code['id']]['cell_id'] = $cell['cell_id'];
										break;
									} else {
										$error[$product['order_product_id']][] = array(
											'name'				=> $product['name'],
											'href'				=> $this->url->link('extension/module/storage_cell/audit', 'token=' . $this->session->data['token'] . '&filter_block=2&filter_product_id=' . $product['product_id'], true),
											'unique_code'	=> $code['unique_code'],
											'option'			=> '',
											'order_id'		=> $order['order_id'],
											'text'				=> $this->language->get('error_product_not_linked'),
										);
									}
								}
							}
						}
					} else {
						$error[$product['order_product_id']][] = array(
							'name'				=> $product['name'],
							'href'				=> $this->url->link('extension/module/storage_cell/audit', 'token=' . $this->session->data['token'] . '&filter_block=2&filter_product_id=' . $product['product_id'], true),
							'unique_code'	=> '',
							'option'			=> '',
							'order_id'		=> $order['order_id'],
							'text'				=> $this->language->get('error_product_not_found'),
						);
					}

					if (count($order_product_codes[$order['order_id']][$product['order_product_id']]['codes']) >= $product['quantity']) {
						unset($error[$product['order_product_id']]);
					} else {
						$error[$product['order_product_id']][] = array(
							'name'				=> $product['name'],
							'href'				=> $this->url->link('extension/module/storage_cell/audit', 'token=' . $this->session->data['token'] . '&filter_block=2&filter_product_id=' . $product['product_id'], true),
							'unique_code'	=> '',
							'option'			=> '',
							'order_id'		=> $order['order_id'],
							'text'				=> $this->language->get('error_product_not_found'),
						);
					}
				}
			}
		}

		$error_text = array();

		if ($error) {
			foreach ($error as $erro) {
				foreach ($erro as $err) {
					$error_text[] = '<strong>' . $this->language->get('entry_order') . $err['order_id'] . ' - ' . $err['text'] . ($err['unique_code'] ? ' (' . $err['unique_code'] . ')' : '') . '</strong><br/><a target="_blank" href="' . $err['href'] . '">' . $err['name'] . ($err['option'] ? ' (' . $err['option'] . ')' : '') . '</a>';
				}
			}
			$error_text = implode('<br/><br/>', $error_text);
		}

		return array(
			'orders'							=> $orders,
			'order_product_codes'	=> $order_product_codes,
			'order_codes'					=> $order_codes,
			'product_count'				=> $product_count,
			'error'								=> $error_text,
		);
	}

	public function fixOrderCodes() {
		$json = array();

		$this->load->language('extension/module/storage_cell_build_order');

		$data = json_decode($_POST['array'], true);

		$this->load->model('extension/module/storage_cell');

		$fix_info = $this->model_extension_module_storage_cell->fixProductCode($data);

		if ($fix_info == 'error_entry_data') {
			$json['error'] = $this->language->get('error_entry_data');
		} elseif (isset($fix_info['error'])) {
			$json['error'] = $this->language->get('error_error') . '<br/>' . implode('<br/>', $fix_info['error']);
		} elseif ($fix_info == 'ok') {
			$json['success'] = $this->language->get('text_done');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name'])) {
			// $this->load->model('catalog/product');
			$this->load->model('extension/module/storage_cell');

			if (isset($this->request->get['filter_name'])) {
				$filter_name = $this->request->get['filter_name'];
			} else {
				$filter_name = '';
			}

			if (isset($this->request->get['limit'])) {
				$limit = $this->request->get['limit'];
			} else {
				$limit = 10;
			}

			$filter_data = array(
				'filter_name'  => $filter_name,
				'start'        => 0,
				'limit'        => $limit
			);

			$results = $this->model_extension_module_storage_cell->getProducts($filter_data);

			foreach ($results as $result) {
				$json[] = array(
					'product_id' => $result['product_id'],
					'name'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),
					'model'      => $result['model'],
					'price'      => $result['price'],
				);
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	protected function validateBay() {
		foreach ($this->request->post['bays'] as $bay) {
			if (empty($bay)) {
				$this->error['warning'] = $this->language->get('error_empty_name');
			}
		}

		return !$this->error;
	}

	protected function validateCell() {
		foreach ($this->request->post['cells'] as $cell) {

			if (!isset($cell['id'])) {
				$cell_id = $this->model_extension_module_storage_cell->getCellIdByData($cell);

				if ($cell_id) {
					$this->error['warning'] = $this->language->get('error_cell_exists');
				}
			}
		}

		return !$this->error;
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/storage_cell')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	public function writeLog($message) {
		fwrite(fopen(DIR_LOGS . 'storage_cell_log.log', 'a'), date('d.m.Y H:i:s') . ' - ' . print_r($message, true) . "\n");
	}
}
