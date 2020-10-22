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
insert into departamento (cod_depto,des_depto,pais_depto,status_depto,sucursal_depto) (
	select substr(u.ubigeo,1,2) cod_dpto,u.departamento, 241,1,1
	from ubigeo u
	group by departamento, cod_dpto
);
set foreign_key_checks = 1;
select * from ubigeo;

select substr(u.ubigeo,1,4) cod_prov,u.provincia,  241, substr(u.ubigeo,1,2) depto_prov,1,1
	from ubigeo u
	group by u.ubigeo,u.provincia;
    
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