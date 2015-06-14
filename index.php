<?php
	require_once '../../views/_secureHead.php';
	require_once '../../models/_header.php';
	require_once '../../models/_add.php';
	require_once '../../models/_table.php';

	if( isset ($sessionManager)  && $sessionManager->isAuthorized () ) {
		$id = request_isset ('id');
		$key = request_isset ('key');
		$value = request_isset ('value');

		$x10Manager = new X10Manager();

		switch ($page_action) {
			case 'add_setting' :
				$x10Manager->addRecord ($key, $value);
				break;
			case 'delete_by_id' :
				$x10Manager->deleteRecord ($id);
				break;
			case 'update_by_id' :
				$x10Manager->updateRecord ($id, $key, $value);
				break;
		}
		
		$x10_data = $x10Manager->getAllRecords();
		
		$page_title = 'X10';
		$alt_menu = '<a href="#" class="add">Add</a>';

		$addView = new AddView ('Add', 'add_setting');
		$addView->addRow ('key', 'Key');
		$addView->addRow ('value', 'Value');

		$tableView = new TableView ( array ('Key', 'Value', '') );

		while (($x10_row = mysql_fetch_array( $x10_data ) ) != null) {
			$tableView->addRow ( array (
				TableView::createCell ('key', $x10_row['key'] ),
				TableView::createCell ('value', $x10_row['value'] ),
				TableView::createEdit ($x10_row['X10_ID'])
			));
		}

		$views_to_load = array();
		$views_to_load[] = '../../views/_add.php';
		$views_to_load[] = '_warning.php';
		$views_to_load[] = '../../views/_table.php';
		
		include '../../views/_generic.php';
	}