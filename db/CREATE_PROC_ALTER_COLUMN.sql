

DROP PROCEDURE IF EXISTS PROC_ALTER_TABLE;
DROP PROCEDURE IF EXISTS PROC_ALTER_TABLE_ALTER_COLUMN;
DELIMITER //
CREATE PROCEDURE PROC_ALTER_TABLE_ALTER_COLUMN(_table VARCHAR(64),
									_field varchar(64), 
									_precision varchar(64),
									_bd varchar(64))
BEGIN
	DECLARE _stmt VARCHAR(1024);

	IF EXISTS(	
		SELECT COLUMN_NAME
		FROM information_schema.COLUMNS 
		WHERE 
		TABLE_SCHEMA = _bd
		AND TABLE_NAME = _table
		AND COLUMN_NAME = _field) 
	THEN
		SET @SQL :=CONCAT('ALTER TABLE ', _table,' MODIFY COLUMN ',_field,' ', _precision );
	ELSE
		SET @SQL :=CONCAT('ALTER TABLE ', _table,' ADD COLUMN ',_field, ' ', _precision );
	END IF ;

	#SELECT @SQL;

	PREPARE _stmt FROM @SQL;
	EXECUTE _stmt;
	DEALLOCATE PREPARE _stmt;

END//
