<?php
	class X10Manager {
		private $table = "`sarah`.`x10`";
		private $table_key = "X10_ID";

		public function getRecord ($id) {
			$sql = <<<EOD
	SELECT *
	FROM $this->table
	WHERE `$this->table_key`='$id'
EOD;
			$data = mysql_query($sql) or die(mysql_error());
			return mysql_fetch_array( $data );
		}

		public function addRecord ($name, $house, $unit) {
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
			return mysql_query($sql) or die(mysql_error());
		}

		public function deleteRecord ($id) {
			$sql = <<<EOD
	DELETE FROM $this->table
	WHERE `$this->table_key`='$id'
EOD;

			return mysql_query($sql) or die(mysql_error());
		}

		public function getAllRecords () {
			$sql = <<<EOD
	SELECT *
	FROM $this->table
EOD;
			$data = mysql_query($sql) or die(mysql_error());

			return $data;
		}

		public function updateRecord ($id, $name, $house, $unit) {
			$sql = <<<EOD
	UPDATE $this->table
	SET `name` = '$name',
		`house` = '$house',
		`unit` = '$unit'
	WHERE `$this->table_key`='$id'
EOD;
			
			return mysql_query($sql) or die(mysql_error());
		}
	}