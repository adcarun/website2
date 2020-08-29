<?php

	function createTable($tableName)
	{
		mysql_query("
					CREATE TABLE
						`".$tableName."`
					(
						`Id` INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
						`RegTime` DATETIME NOT NULL
					)
						ENGINE = innodb;");
	}
	
	function renameTable($oldName, $newName)
	{
		mysql_query("RENAME TABLE `".$oldName."`  TO `".$newName."` ;");
	}
	
	function dropTable($tableName)
	{
		mysql_query("DROP TABLE `".$tableName."`");
	}
	
	function addTableField($tableName, $fieldName, $dataType, $lengthValues, $beforeField)
	{
		mysql_query("ALTER TABLE
											`".$tableName."`
								ADD
											`".$fieldName."` ".$dataType." ".stripslashes($lengthValues)." NOT NULL AFTER `".$beforeField."` ;	
					") or die(mysql_error());
	}

	function editTableField($tableName, $oldFieldName, $fieldName, $dataType, $lengthValues)
	{
		mysql_query("ALTER TABLE
											`".$tableName."`
								CHANGE
											`".$oldFieldName."` `".$fieldName."` ".$dataType." ".stripslashes($lengthValues)." NOT NULL	
					") or die(mysql_error());
	}


	function deleteTableField($tableName, $fieldName)
	{
		mysql_query("ALTER TABLE `".$tableName."` DROP `".$fieldName."`;");
	}
	
	function getSecondLastFieldName($tableName)
	{
		$i = 0;
		$current = "";
		$last = "";
		$res = mysql_query("SHOW FULL COLUMNS FROM ".$tableName);
		while($obj = mysql_fetch_object($res))
		{
			$last = $current;
			$current = $obj -> Field;			
		}
		return $last;
	}
	
	function addUniqueKey($tableName, $fieldName)
	{
		mysql_query(" ALTER TABLE `".$tableName."` ADD UNIQUE (`".$fieldName."`) ");
	}
	
	function dropUniqueKey($tableName, $fieldName)
	{
		mysql_query("ALTER TABLE ".$tableName." DROP INDEX `".$fieldName."`");
	}

?>