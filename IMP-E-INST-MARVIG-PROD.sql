use marvig_prod;

delete from compra;
select * from compra_detalle;
select * from cond_pago;
select * from departamento;
drop table depts;
select * from distrito;
select * from documento;
delete from documento;
select * from documento_detalle;
select * from empresa;
delete from empresa;
select * from inventario;
drop table inventario;
select * from lista_precios;
delete from lista_precios;
select * from menu;
select * from moneda;
select * from motivo_ncredito;
select * from motivo_traslado;
select * from numeracion;
select * from pais;
select * from pedido;
delete from pedido;
select * from pedido_detalle;
select * from precios;
delete from precios;

select * from proveedor;
delete from proveedor;
select * from series;
drop table series;
select * from sucursal;
select * from tipo_cambio;
delete from tipo_cambio;
select * from tipo_documento;
select * from tipo_identificacion;
select * from tipo_listap;
select * from tipo_movimiento;
select * from tipo_producto;
delete from tipo_producto;
select * from tipo_proveedor;
select * from trans_detalle;
select * from transaccion;
delete from transaccion;
select * from producto;
delete from producto;
select * from transportista;
select * from ubigeo;
drop table ubigeo;
select * from unidad_medida;
select * from unidad_transporte;
select * from user;
delete from user;
select * from vendedor;
select * from zona;

create table prodexist (
id int auto_increment,
CODIGO varchar(255),
DESCRIPCION varchar(255),
MARCA varchar(255),
PRECIO decimal(18,2),
LINEA varchar(255),
STOCK int(11),
key (id)
);

LOAD DATA INFILE 'C://existentes.txt' INTO TABLE prodexist
  FIELDS TERMINATED BY '\t'
  escaped by ''
  LINES TERMINATED BY '\r\n'
  IGNORE 1 LINES
  (id,codigo,descripcion,marca,precio,linea,stock);
  
  truncate table prodexist;
  drop table prodexist;
  select * from prodexist;
  
  select marca,1,1 from prodexist group by marca;
  
  USE LEOPHARD_DEV;
  create table marca(
	  id_marca int(11) auto_increment comment 'ID UNICO',
	  desc_marca varchar(255) comment 'DESCRIPCION MARCA',
	  status_marca int default 1 comment 'ESTATUS MARCA',
	  sucursal_marca int comment 'SUCURSAL MARCA',
      primary key (id_marca)
  ) ENGINE=InnoDB charset=utf8;
  
  select marca,1,1 from prodexist group by marca;
  
alter table marca add created_by int(11) default NULL comment 'CREADO POR', ADD INDEX (created_by); 
alter table marca add created_at int(11) default NULL comment 'CREADO EN', ADD INDEX (created_at); 
alter table marca add updated_by int(11) default NULL comment 'ACTUALIZADO POR', ADD INDEX (updated_by); 
alter table marca add updated_at int(11) default NULL comment 'ACTUALIZADO EN', ADD INDEX (updated_at); 
insert into marca (desc_marca,status_marca,sucursal_marca) (
select marca,1,1 from prodexist group by marca
);

ALTER TABLE `producto` ADD `marca_prod` INT NULL DEFAULT NULL COMMENT 'MARCA PRODUCTO' AFTER `tipo_prod`, ADD INDEX (`marca_prod`);

SELECT * 
FROM prodexist;

select linea,1,1 from prodexist group by linea;

insert into tipo_producto (desc_tpdcto,status_tpdcto,sucursal_tpdcto) (
select linea,1,1 from prodexist group by linea
);

select * from tipo_producto;

update prodexist p1 set 
descripcion = (
	select rtrim(ltrim(descripcion)) from prodexist where id = p1.id
), 
codigo = (
	select rtrim(ltrim(codigo)) from prodexist where id = p1.id
);

select * from prodexist;


/* unidades */
insert into producto (
cod_prod,
des_prod,
tipo_prod,
marca_prod,
umed_prod,
contenido_prod,
exctoigv_prod,
compra_prod,
venta_prod,
stockini_prod,
stockmax_prod,
stockmin_prod,
stock_prod,
status_prod,
sucursal_prod) (
select codigo,descripcion,tp.id_tpdcto,m.id_marca,2 umed_prod, 1 contenido_prod,0 exctoigv_prod, 1 compra_prod, 1 venta_prod, sum(p1.STOCK) stockini_prod,
 0 stockmax_prod, 0 stockmin_prod, sum(p1.stock) stock_prod, 1 status_prod, 1 sucursal_prod
from prodexist p1
inner join marca m on p1.marca = m.desc_marca
inner join tipo_producto tp on p1.linea = tp.desc_tpdcto
where descripcion not like '%set%'
group by codigo,descripcion,tp.id_tpdcto,m.id_marca
);

/* sets */

insert into producto (
cod_prod,
des_prod,
tipo_prod,
marca_prod,
umed_prod,
contenido_prod,
exctoigv_prod,
compra_prod,
venta_prod,
stockini_prod,
stockmax_prod,
stockmin_prod,
stock_prod,
status_prod,
sucursal_prod) (
select codigo,descripcion,tp.id_tpdcto,m.id_marca,2 umed_prod, 1 contenido_prod,0 exctoigv_prod, 1 compra_prod, 1 venta_prod, sum(p1.STOCK) stockini_prod,
 0 stockmax_prod, 0 stockmin_prod, sum(p1.stock) stock_prod, 1 status_prod, 1 sucursal_prod
from prodexist p1
inner join marca m on p1.marca = m.desc_marca
inner join tipo_producto tp on p1.linea = tp.desc_tpdcto
where descripcion like '%set%'
group by codigo,descripcion,tp.id_tpdcto,m.id_marca
);


select count(codigo),codigo,descripcion,tp.desc_tpdcto,m.id_marca,2 umed_prod, 1 contenido_prod,0 exctoigv_prod, 1 compra_prod, 1 venta_prod, sum(p1.STOCK) stockini_prod,
 0 stockmax_prod, 0 stockmin_prod, sum(p1.stock) stock_prod, 1 status_prod, 1 sucursal_prod
from prodexist p1
inner join marca m on p1.marca = m.desc_marca
inner join tipo_producto tp on p1.linea = tp.desc_tpdcto
where descripcion like '%set%'
group by codigo,descripcion,tp.desc_tpdcto,m.id_marca;


select codigo, count(codigo) from prodexist group by codigo;
select codigo, min(precio) from prodexist group by codigo;

insert into precios (select codigo, min(precio) from prodexist group by codigo);

update producto set umed_prod = 1 where des_prod like '%set%';

INSERT INTO lista_precios( TIPO_LISTA, prod_lista,precio_lista,sucursal_lista) (
SELECT 1 AS TIPO_LISTA,P.id_prod,PR.PRECIO,P.sucursal_prod
FROM producto P
	INNER JOIN PRECIOS PR ON P.COD_PROD = PR.CODIGO); 
    
    
    
    
    
    
create table prodnuevo(
id int auto_increment,
CODIGO varchar(255),
DESCRIPCION varchar(255),
MARCA varchar(255),
PRECIO decimal(18,2),
LINEA varchar(255),
STOCK int(11),
key (id)
);

LOAD DATA INFILE 'C://nuevos.txt' INTO TABLE prodnuevo
  FIELDS TERMINATED BY '\t'
  escaped by ''
  LINES TERMINATED BY '\r\n'
  IGNORE 1 LINES
  (id,codigo,descripcion,marca,precio,linea,stock);
  
truncate table prodnuevo;
drop table prodnuevo;
select * from prodnuevo;
select * from tipo_producto where desc_tpdcto like 'soport%';

/* tipo producto */
select pn.*,tp.desc_tpdcto 
from prodnuevo pn 
left join tipo_producto tp on tp.desc_tpdcto = pn.linea
where desc_tpdcto is null;

select pn.linea,1,1 
from prodnuevo pn 
left join tipo_producto tp on tp.desc_tpdcto = pn.linea
where desc_tpdcto is null
group by pn.linea;

insert into tipo_producto (desc_tpdcto,status_tpdcto,sucursal_tpdcto) (
select pn.linea,1,1 
from prodnuevo pn 
left join tipo_producto tp on tp.desc_tpdcto = pn.linea
where desc_tpdcto is null
group by pn.linea
);


/* marca */
select pn.marca,1,1
from prodnuevo pn 
left join marca m on m.desc_marca = pn.marca
where desc_marca is null
group by pn.marca
;

insert into marca (desc_marca,status_marca,sucursal_marca) (
select pn.marca,1,1
from prodnuevo pn 
left join marca m on m.desc_marca = pn.marca
where desc_marca is null
group by pn.marca
);

select *
from prodnuevo pn 
left join marca m on m.desc_marca = pn.marca
;

update prodnuevo p1 set 
descripcion = (
	select rtrim(ltrim(descripcion)) from prodnuevo where id = p1.id
), 
codigo = (
	select rtrim(ltrim(codigo)) from prodnuevo where id = p1.id
);

select * from prodnuevo;


select codigo,descripcion,tp.desc_tpdcto,m.id_marca,1 umed_prod, 1 contenido_prod,0 exctoigv_prod, 1 compra_prod, 1 venta_prod, sum(p1.STOCK) stockini_prod,
 0 stockmax_prod, 0 stockmin_prod, sum(p1.stock) stock_prod, 1 status_prod, 1 sucursal_prod
from prodnuevo p1
inner join marca m on p1.marca = m.desc_marca
inner join tipo_producto tp on p1.linea = tp.desc_tpdcto
where descripcion like '%set%'
group by codigo,descripcion,tp.desc_tpdcto,m.id_marca;

update prodnuevo set stock = 16 where id = 826;

select * from producto where cod_prod like 'cm03-son9';

start transaction;

/* sets */
insert into producto (
cod_prod,
des_prod,
tipo_prod,
marca_prod,
umed_prod,
contenido_prod,
exctoigv_prod,
compra_prod,
venta_prod,
stockini_prod,
stockmax_prod,
stockmin_prod,
stock_prod,
status_prod,
sucursal_prod) (
select codigo,descripcion,tp.id_tpdcto,m.id_marca,1 umed_prod, 1 contenido_prod,0 exctoigv_prod, 1 compra_prod, 1 venta_prod, sum(p1.STOCK) stockini_prod,
 0 stockmax_prod, 0 stockmin_prod, sum(p1.stock) stock_prod, 1 status_prod, 1 sucursal_prod
from prodnuevo p1
inner join marca m on p1.marca = m.desc_marca
inner join tipo_producto tp on p1.linea = tp.desc_tpdcto
where descripcion like '%set%'
group by codigo,descripcion,tp.id_tpdcto,m.id_marca
);
commit;


/* unidades */ 
start transaction;

select id,codigo,descripcion,tp.id_tpdcto,m.id_marca,2 umed_prod, 1 contenido_prod,0 exctoigv_prod, 1 compra_prod, 1 venta_prod, sum(p1.STOCK) stockini_prod,
 0 stockmax_prod, 0 stockmin_prod, sum(p1.stock) stock_prod, 1 status_prod, 1 sucursal_prod
from prodnuevo p1
inner join marca m on p1.marca = m.desc_marca
inner join tipo_producto tp on p1.linea = tp.desc_tpdcto
INNER JOIN PRODUCTO PROD on p1.codigo = prod.cod_prod
where descripcion not like '%set%'
group by id,codigo,descripcion,tp.id_tpdcto,m.id_marca;

/* sets */
insert into producto (
cod_prod,
des_prod,
tipo_prod,
marca_prod,
umed_prod,
contenido_prod,
exctoigv_prod,
compra_prod,
venta_prod,
stockini_prod,
stockmax_prod,
stockmin_prod,
stock_prod,
status_prod,
sucursal_prod) (
select codigo,descripcion,tp.id_tpdcto,m.id_marca,2 umed_prod, 1 contenido_prod,0 exctoigv_prod, 1 compra_prod, 1 venta_prod, sum(p1.STOCK) stockini_prod,
 0 stockmax_prod, 0 stockmin_prod, sum(p1.stock) stock_prod, 1 status_prod, 1 sucursal_prod
from prodnuevo p1
inner join marca m on p1.marca = m.desc_marca
inner join tipo_producto tp on p1.linea = tp.desc_tpdcto
where descripcion not like '%set%'
group by codigo,descripcion,tp.id_tpdcto,m.id_marca
);
rollback;

COMMIT;

select codigo, count(codigo) from prodnuevo group by codigo;
select * from producto;


update prodnuevo p1 set 
descripcion = (
	select REPLACE(descripcion,'"','') from prodnuevo where id = p1.id
);


select codigo, count(codigo) from prodnuevo group by codigo;
select codigo, min(precio) from prodnuevo group by codigo;

truncate table precios;
insert into precios (select codigo, min(precio) from prodnuevo group by codigo);

update producto set umed_prod = 1 where des_prod like '%set%';

INSERT INTO lista_precios( TIPO_LISTA, prod_lista,precio_lista,sucursal_lista) (
SELECT 1 AS TIPO_LISTA,P.id_prod,PR.PRECIO,P.sucursal_prod
FROM producto P
	INNER JOIN PRECIOS PR ON P.COD_PROD = PR.CODIGO); 
    
SELECT 1 AS TIPO_LISTA,P.id_prod,PR.PRECIO,P.sucursal_prod
FROM producto P
	INNER JOIN PRECIOS PR ON P.COD_PROD = PR.CODIGO
    
    
    
    
    