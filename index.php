<?php
	require_once '../../views/_secureHead.php';
	require_once '../../models/_header.php';
	require_once '../../models/_add.php';
	require_once '../../models/_table.php';

	if( isset ($sessionManager)  && $sessionManager->isAuthorized () ) {
		$id = request_isset ('id');
		$name = request_isset ('name');
		$house = request_isset ('house');
		$unit = request_isset ('unit');

		$x10Manager = new X10Manager();

		switch ($page_action) {
			case 'add' :
				$x10Manager->addRecord ($name, $house, $unit);
				break;
			case 'delete_by_id' :
				$x10Manager->deleteRecord ($id);
				break;
			case 'update_by_id' :
				$x10Manager->updateRecord ($id, $name, $house, $unit);
				break;
		}
		
		$x10_data = $x10Manager->getAllRecords();
		
		$page_title = $app_title;
		$alt_menu = '<a href="#" class="add">Add</a>';

		$addView = new AddView ('Add', 'add');
		$addView->addRow ('name', 'Name');
		$addView->addRow ('house', 'House Code');
		$addView->addRow ('unit', 'Unit Code');

		$tableView = new TableView ( array ('Name', 'ON', 'OFF', '') );

		for ($i = 0; $i < count ($x10_data); $i++) {
			$this_id    = $x10_data[$i]['id'];
			$this_name  = $x10_data[$i]['name'];
			$this_house = $x10_data[$i]['house'];
			$this_unit  = $x10_data[$i]['unit'];

			$tableView->addRow ( array (
				TableView::createCell ('name', $this_name ),
				TableView::createCell ('on', "<a href='../Proxy/index.php?url=http://192.168.1.138:1771/?houseCode=$this_house&unitCode=$this_unit&statusCode=+'>ON</a>" ),
				TableView::createCell ('off', "<a href='../Proxy/index.php?url=http://192.168.1.138:1771/?houseCode=$this_house&unitCode=$this_unit&statusCode=-'>OFF</a>" ),
				TableView::createEdit ($this_id)
			));
		}

		$views_to_load = array();
		$views_to_load[] = '../../views/_add.php';
		$views_to_load[] = '../../views/_table.php';
		
		include '../../views/_generic.php';
	}