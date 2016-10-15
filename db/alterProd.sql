alter table y_producto 
	add column TAX decimal(10,2);


alter table y_facturaline
	add column TAX decimal(10,2)



CREATE TABLE `y_param` (
	`IDPARAM` int(4) NOT NULL AUTO_INCREMENT,
	`DESCRIP` varchar(50) NULL,
	`VALOR` varchar(50) NULL,
	`TP` tinyint(1) NULL,
  PRIMARY KEY (`IDPARAM`)
) ;


INSERT INTO `y_param` (DESCRIP,VALOR,TP ) VALUES("Tasa General","21",1);
INSERT INTO `y_param` (DESCRIP,VALOR,TP ) VALUES("Tasa Reducida","10",1);
INSERT INTO `y_param` (DESCRIP,VALOR,TP ) VALUES("Tasa Super Reducida","4",1);

select * from y_facturaline