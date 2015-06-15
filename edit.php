<?php
	require_once '../../views/_secureHead.php';
	require_once $relative_base_path . 'models/edit.php';

	if( isset ($sessionManager) && $sessionManager->isAuthorized () ) {
		$id = request_isset ('id');

		$x10Manager = new X10Manager ();
		
		$record = $x10Manager->getRecord ($id);

		$page_title = 'Edit | ' . $app_title;

		// build edit view
		$editModel = new EditModel ('Edit', 'update_by_id', $id);
		$editModel->addRow ('name', 'Name', $record['name']);
		$editModel->addRow ('house', 'House', $record['house']);
		$editModel->addRow ('unit', 'Unit', $record['unit']);

		$views_to_load = array();
		$views_to_load[] = ' ' . EditView2::render($editModel);

		include '../../views/_generic.php';
	}
?>