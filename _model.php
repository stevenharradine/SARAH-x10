<?php
	class X10Manager {
		private $table = "`sarah`.`x10`";
		private $table_key = "X10_ID";

		public function get_link () {
			global $DB_ADDRESS;
			global $DB_USER;
			global $DB_PASS;
			global $DB_NAME;

			return $link = DB_Connect($DB_ADDRESS, $DB_USER, $DB_PASS, $DB_NAME);
		}

		public function getRecord ($id) {
			$link = X10Manager::get_link();
			$USER_ID = $_SESSION['USER_ID'];

			$sql = <<<EOD
	SELECT *
	FROM $this->table
	WHERE `$this->table_key`='$id'
EOD;
			$data = $link->query($sql);
			return mysqli_fetch_array( $data );
		}

		public function addRecord ($name, $house, $unit) {
			$link = X10Manager::get_link();
			$USER_ID = $_SESSION['USER_ID'];

			$sql = <<<EOD
	INSERT INTO $this->table (
		`name`,
		`house`,
		`unit`
	) VALUES (
		'$name',
		'$house',
		'$unit'
	);
EOD;
echo $sql;
			return $link->query($sql);
		}

		public function deleteRecord ($id) {
			$link = X10Manager::get_link();
			$USER_ID = $_SESSION['USER_ID'];

			$sql = <<<EOD
	DELETE FROM $this->table
	WHERE `$this->table_key`='$id'
EOD;

			return $link->query($sql);
		}

		public function getAllRecords () {
			$link = X10Manager::get_link();
			$USER_ID = $_SESSION['USER_ID'];

			$sql = <<<EOD
	SELECT *
	FROM $this->table
EOD;
			$data = $link->query($sql);
			$return = array ();

			while (($row = mysqli_fetch_array( $data ) ) != null) {
				$dataset = array (
					'id' => $row['X10_ID'],
					'name' => $row['name'],
					'house' => $row['house'],
					'unit' => $row['unit']
				);

				array_push ($return, $dataset);
			}

			return $return;
		}

		public function updateRecord ($id, $name, $house, $unit) {
			$link = X10Manager::get_link();
			$USER_ID = $_SESSION['USER_ID'];

			$sql = <<<EOD
	UPDATE $this->table
	SET `name` = '$name',
		`house` = '$house',
		`unit` = '$unit'
	WHERE `$this->table_key`='$id'
EOD;
			
			return $link->query($sql);
		}
	}