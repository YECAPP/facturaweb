load data infile '/home/yec/Documentos/clientes.csv'
into table y_client 
fields terminated by ',' optionally enclosed by '"'
lines terminated by '\n'  
ignore 1 lines (CODIGO,NOMBRE,DIRECC,COD_POST,CDAD,ESTADO,TELEFONO,CODTRIB,EMAIL)



