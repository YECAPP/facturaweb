load data infile '/var/lib/mysql/prod.csv'
into table y_producto 
fields terminated by ',' optionally enclosed by '"'
lines terminated by '\n'  
ignore 1 lines (CODIGO,DESCRIP,TAX,PRECIO);


select * from y_producto