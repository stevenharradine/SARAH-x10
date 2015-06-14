<?php
	require_once '../../views/_secureHead.php';
	require_once '../../models/_edit.php';

	if( isset ($sessionManager) && $sessionManager->getUserType() == 'ADMIN' ) {
		$id = request_isset ('id');

		$settingsManager = new SettingsManager ();
		
		$record = $settingsManager->getRecord ($id);

		$page_title = 'Edit | X10';

		// build edit view
		$editView = new EditView ('Edit', 'update_by_id', $id);
		$editView->addRow ('key', 'Key', $record['key']);
		$editView->addRow ('value', 'Value', $record['value']);


		$views_to_load = array();
		$views_to_load[] = '../../views/_edit.php';

		include '../../views/_generic.php';
	}
?>