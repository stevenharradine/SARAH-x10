<?php
	require_once '../../views/_secureHead.php';
	require_once '../../models/_edit.php';

	if( isset ($sessionManager) && $sessionManager->isAuthorized () ) {
		$id = request_isset ('id');

		$x10Manager = new X10Manager ();
		
		$record = $x10Manager->getRecord ($id);

		$page_title = 'Edit | X10';

		// build edit view
		$editView = new EditView ('Edit', 'update_by_id', $id);
		$editView->addRow ('name', 'Name', $record['name']);
		$editView->addRow ('house', 'House', $record['house']);
		$editView->addRow ('unit', 'Unit', $record['unit']);


		$views_to_load = array();
		$views_to_load[] = '../../views/_edit.php';

		include '../../views/_generic.php';
	}
?>