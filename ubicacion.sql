use leophard_dev;
create table ubigeo (
	ubigeo varchar(6),
	departamento varchar(255),
	provincia varchar(255),
	distrito varchar(255)
);

drop table ubigeo;

LOAD DATA INFILE 'C://Users//Marvig//Desktop//distritos.csv' INTO TABLE ubigeo
  FIELDS TERMINATED BY ',' 
  LINES TERMINATED BY '\r\n'
  IGNORE 1 LINES;
  
select * from ubigeo order by ubigeo;


select u.departamento,substr(u.ubigeo,1,2) cod_dpto 
from ubigeo u
group by departamento, cod_dpto;

select * from departamento where des_depto like '%madre%';


select u.departamento,substr(u.ubigeo,1,2) cod_dpto , d.des_depto
from ubigeo u
left join departamento d on d.des_depto like u.departamento 
group by departamento, cod_dpto, d.des_depto;

-- Cambio la estructura de la tabla de proveedores

ALTER TABLE `leophard_dev`.`proveedor` 
DROP FOREIGN KEY `provee_ibfk_1`,
DROP FOREIGN KEY `provee_ibfk_2`,
DROP FOREIGN KEY `provee_ibfk_3`,
DROP FOREIGN KEY `provee_ibfk_4`;
ALTER TABLE `leophard_dev`.`proveedor` 
CHANGE COLUMN `pais_prove` `pais_prove` INT(11) NULL COMMENT 'PAIS PROVEEDOR' ,
CHANGE COLUMN `depto_prove` `depto_prove` INT(11) NULL DEFAULT NULL COMMENT 'DEPARTAMENTO PROVEEDOR' ,
CHANGE COLUMN `provi_prove` `provi_prove` INT(11) NULL DEFAULT NULL COMMENT 'PROVINCIA PROVEEDOR' ,
CHANGE COLUMN `dtto_prove` `dtto_prove` INT(11) NULL DEFAULT NULL COMMENT 'DISTRITO PROVEEDOR' ;
ALTER TABLE `leophard_dev`.`proveedor` 
ADD CONSTRAINT `provee_ibfk_1`
  FOREIGN KEY (`pais_prove`)
  REFERENCES `leophard_dev`.`pais` (`id_pais`)
  ON UPDATE CASCADE,
ADD CONSTRAINT `provee_ibfk_2`
  FOREIGN KEY (`provi_prove`)
  REFERENCES `leophard_dev`.`provincia` (`id_prov`)
  ON UPDATE CASCADE,
ADD CONSTRAINT `provee_ibfk_3`
  FOREIGN KEY (`depto_prove`)
  REFERENCES `leophard_dev`.`departamento` (`id_depto`)
  ON UPDATE CASCADE,
ADD CONSTRAINT `provee_ibfk_4`
  FOREIGN KEY (`dtto_prove`)
  REFERENCES `leophard_dev`.`distrito` (`id_dtto`)
  ON UPDATE CASCADE;

-- desvinculo los registros de clientes de las tablas de provincia, departamento y distrito
update cliente set depto_cte = null,provi_cte = null, dtto_clte = null;

-- desvinculo los registros de proveedores de las tablas de provincia, departamento y distrito
update proveedor set depto_prove = null,provi_prove = null, dtto_prove = null;

-- modifico tabla de departamento
ALTER TABLE `departamento` DROP `prov_depto`;
ALTER TABLE `departamento` ADD `cod_depto` VARCHAR(2) NULL COMMENT 'CODIGO UBIGEO DEPARTAMENTO' AFTER `id_depto`, ADD UNIQUE (`cod_depto`);
ALTER TABLE `departamento` CHANGE `pais_depto` `pais_depto` INT(11) NULL;
ALTER TABLE `departamento` ADD FOREIGN KEY (`pais_depto`) REFERENCES `pais`(`id_pais`) ON DELETE RESTRICT ON UPDATE CASCADE;

-- Limpio la tabla de departamento
set foreign_key_checks = 0;
truncate table departamento;

-- Inserto los datos en la tabla departamento
insert into departamento (cod_depto,des_depto,pais_depto,status_depto,sucursal_depto) (
	select substr(u.ubigeo,1,2) cod_dpto,u.departamento, 241,1,1
	from ubigeo u
	group by departamento, cod_dpto
);
set foreign_key_checks = 1;

-- Modifico la tabla de provincia
ALTER TABLE `leophard_dev`.`provincia` 
DROP FOREIGN KEY `fx_pais_prov`;
ALTER TABLE `leophard_dev`.`provincia` 
DROP COLUMN `pais_prov`,
ADD COLUMN `cod_prov` VARCHAR(4) NULL DEFAULT 'null' AFTER `id_prov`,
ADD COLUMN `depto_prov` INT(11) NULL AFTER `des_prov`,
ADD INDEX `depto_prov` (`depto_prov` ASC),
ADD INDEX `cod_prov_UNIQUE` (`cod_prov` ASC),
DROP INDEX `fx_pais_prov_idx` ;
;
ALTER TABLE `leophard_dev`.`provincia` 
ADD CONSTRAINT `fk_depto_prov`
  FOREIGN KEY (`depto_prov`)
  REFERENCES `leophard_dev`.`departamento` (`id_depto`)
  ON DELETE RESTRICT
  ON UPDATE CASCADE;
  
ALTER TABLE `provincia` ADD `pais_prov` INT(11) NULL COMMENT 'PAIS PROVINCIA' AFTER `des_prov`, ADD INDEX (`pais_prov`);
ALTER TABLE `provincia` ADD FOREIGN KEY (`pais_prov`) REFERENCES `pais`(`id_pais`) ON DELETE RESTRICT ON UPDATE CASCADE;
  
-- Limpio la tabla de provincia
set foreign_key_checks = 0;
truncate table provincia;

-- Inserto los datos a la tabla de provincias
insert into provincia (cod_prov,des_prov,depto_prov,sucursal_prov,status_prov) (
select substr(u.ubigeo,1,4) cod_prov,u.provincia,substr(u.ubigeo,1,2) depto_prov,1,1
	from ubigeo u
	group by substr(u.ubigeo,1,4),u.provincia,substr(u.ubigeo,1,2));

update provincia set pais_prov = 241;
    
set foreign_key_checks = 1;


-- Limpio la tabla de distrito
set foreign_key_checks = 0;
truncate table distrito;

-- Modifico la tabla distrito
ALTER TABLE `distrito` ADD `cod_dtto` VARCHAR(6) NOT NULL COMMENT 'CODIGO DISTRITO' AFTER `id_dtto`, ADD INDEX (`cod_dtto`);
ALTER TABLE `distrito` CHANGE `des_dtto` `des_dtto` VARCHAR(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT 'DESCRIPCION DISTRITO';

-- Inserto los datos en la tabla distrito
insert into distrito (cod_dtto, des_dtto, pais_dtto, depto_dtto,prov_dtto,status_dtto,sucursal_dtto) (
		select 
    u.ubigeo cod_dtto,
    u.distrito,
    241,
    substr(u.ubigeo,1,2) depto_dtto,
    p.id_prov,
    1,
    1
	from ubigeo u
    inner join provincia p on p.cod_prov = substr(u.ubigeo,1,4) 
	group by u.ubigeo,u.distrito,substr(u.ubigeo,1,2),substr(u.ubigeo,3,2),p.id_prov limit 1, 2000
);
set foreign_key_checks = 1;

ALTER TABLE `empresa` ADD `pais_empresa` INT(11) NULL COMMENT 'PAIS EMPRESA' AFTER `correo_empresa`, ADD `depto_empresa` INT(11) NULL COMMENT 'DEPARTAMENTO EMPRESA' AFTER `pais_empresa`, ADD `prov_empresa` INT(11) NULL COMMENT 'PROVINCIA EMPRESA' AFTER `depto_empresa`, ADD `dtto_empresa` INT(11) NULL COMMENT 'DISTRITO EMPRESA' AFTER `prov_empresa`, ADD INDEX (`pais_empresa`), ADD INDEX (`depto_empresa`), ADD INDEX (`prov_empresa`), ADD INDEX (`dtto_empresa`);
ALTER TABLE `empresa` ADD FOREIGN KEY (`pais_empresa`) REFERENCES `pais`(`id_pais`) ON DELETE RESTRICT ON UPDATE CASCADE; ALTER TABLE `empresa` ADD FOREIGN KEY (`depto_empresa`) REFERENCES `departamento`(`id_depto`) ON DELETE RESTRICT ON UPDATE CASCADE; ALTER TABLE `empresa` ADD FOREIGN KEY (`prov_empresa`) REFERENCES `provincia`(`id_prov`) ON DELETE RESTRICT ON UPDATE CASCADE; ALTER TABLE `empresa` ADD FOREIGN KEY (`dtto_empresa`) REFERENCES `distrito`(`id_dtto`) ON DELETE RESTRICT ON UPDATE CASCADE;