load data infile '/home/yec/Documentos/CLIENTESVER2.csv'
into table y_client 
fields terminated by ',' optionally enclosed by '"'
lines terminated by '\n'  
ignore 2 lines (CODIGO,NOMBRE,DIRECC,COD_POST,CDAD,ESTADO,COD_POST,TELEFONO,COD_VENDOR,EMAIL)



