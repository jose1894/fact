ALTER TABLE `documento` CHANGE `pedido_doc` `pedido_doc` INT(11) NULL COMMENT 'PEDIDO DEL DOCUMENTO';
ALTER TABLE `documento` ADD `tipomov_doc` INT(11) NULL COMMENT 'TIPO MOVIMIENTO PARA GUIAS DE REMISION' AFTER `motivosunat_doc`, ADD INDEX (`tipomov_doc`);
ALTER TABLE `documento` DROP FOREIGN KEY `documento_ibfk_1`;
ALTER TABLE `documento` ADD  CONSTRAINT `documento_ibfk_1` FOREIGN KEY (`tipo_doc`) REFERENCES `tipo_documento`(`id_tipod`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `documento` DROP FOREIGN KEY `documento_ibfk_2`;
ALTER TABLE `documento` ADD  CONSTRAINT `documento_ibfk_2` FOREIGN KEY (`pedido_doc`) REFERENCES `pedido`(`id_pedido`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `documento` DROP FOREIGN KEY `documento_ibfk_3`;
ALTER TABLE `documento` ADD  CONSTRAINT `documento_ibfk_3` FOREIGN KEY (`numeracion_doc`) REFERENCES `numeracion`(`id_num`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `documento` DROP FOREIGN KEY `documento_ibfk_4`;
ALTER TABLE `documento` ADD  CONSTRAINT `documento_ibfk_4` FOREIGN KEY (`condpago_doc`) REFERENCES `cond_pago`(`id_condp`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `documento` DROP FOREIGN KEY `documento_ibfk_5`;
ALTER TABLE `documento` ADD  CONSTRAINT `documento_ibfk_5` FOREIGN KEY (`motivosunat_doc`) REFERENCES `motivo_ncredito`(`id_motivo`) ON DELETE RESTRICT ON UPDATE CASCADE;
ALTER TABLE `documento` ADD  FOREIGN KEY (`tipomov_doc`) REFERENCES `tipo_movimiento`(`id_tipom`) ON DELETE RESTRICT ON UPDATE CASCADE;

UPDATE `documento` SET tipomov_doc = 4 where tipo_doc = 3;
UPDATE `documento` SET `status_doc` = 2 WHERE `documento`.`tipo_doc` = 3 and status_doc = 1;

-- MODIFICACION PARA LA TABLA TRANSACCION_DETALLE PARA QUE ALMACENE COSTO
ALTER TABLE `trans_detalle` ADD `costo_detalle` DECIMAL(18,2) NOT NULL DEFAULT '0' COMMENT 'COSTO DETALLE' AFTER `cant_detalle`;

ALTER TABLE `transaccion`
DROP COLUMN `usuario_trans`,
ADD COLUMN `moneda_trans` INT(11) NULL COMMENT 'MONEDA TRANSACCION' AFTER `almacen_trans`,
CHANGE COLUMN `status_trans` `status_trans` INT(11) NOT NULL DEFAULT 0 COMMENT 'ESTATUS TRANSACCION 0=NO APROBADA, 1 = APROBADA, 2 = ANULADA' AFTER `sucursal_trans`,
DROP INDEX `usuario_trans` ;

ALTER TABLE transaccion
	ADD INDEX idx_moneda_trans (moneda_trans);

alter table transaccion
	add foreign key fk_moneda_trans (moneda_trans) references moneda (id_moneda) on update CASCADE on delete RESTRICT;
    
ALTER TABLE `leophard_dev`.`transaccion` 
CHANGE COLUMN `docref_trans` `docref_trans` VARCHAR(25) NULL DEFAULT NULL COMMENT 'DOCUMENTO REFERENCIA TRANSACCION' ;

create view v_prod_ult_precio as
select prod_cdetalle,max(fecha_compra),precio_cdetalle,sucursal_compra
from compra c
inner join compra_detalle cd on c.id_compra = cd.compra_cdetalle
group by prod_cdetalle,precio_cdetalle,sucursal_compra;

alter view v_productos as
SELECT 
`pr`.`id_prod` AS `id_prod`,
`pr`.`cod_prod` AS `cod_prod`,
`pr`.`des_prod` AS `des_prod`,
`pr`.`compra_prod` AS `compra_prod`,
`pr`.`venta_prod` AS `venta_prod`,
`pr`.`status_prod` AS `status_prod`,
`suc`.`id_suc` AS `sucursal_prod`,
`pr`.`tipo_prod` AS `tipo_prod`,
CONCAT(`pr`.`cod_prod`,
		' ',
		`pr`.`des_prod`,
		' - ',
		`um`.`des_und`) AS `texto`,
`suc`.`impuesto_suc` AS `impuesto_suc`,
`um`.`id_und` AS `id_und`,
`um`.`des_und` AS `des_und`,
`pr`.`stock_prod` - (SELECT 
		COALESCE(SUM(`pedido_detalle`.`cant_pdetalle`), 0) AS `cant_pedido`
	FROM
		(`pedido_detalle`
		JOIN `pedido` ON (`pedido`.`id_pedido` = `pedido_detalle`.`pedido_pdetalle`))
	WHERE
		`pedido_detalle`.`prod_pdetalle` = `pr`.`id_prod`
			AND `pedido`.`sucursal_pedido` = `suc`.`id_suc`
			AND `pedido`.`estatus_pedido` = 0) AS `stock_prod`,
(SELECT 
		COALESCE(SUM(`pedido_detalle`.`cant_pdetalle`), 0) AS `cant_pedido`
	FROM
		(`pedido_detalle`
		JOIN `pedido` ON (`pedido`.`id_pedido` = `pedido_detalle`.`pedido_pdetalle`))
	WHERE
		`pedido_detalle`.`prod_pdetalle` = `pr`.`id_prod`
			AND `pedido`.`sucursal_pedido` = `suc`.`id_suc`
			AND `pedido`.`estatus_pedido` = 0) AS `stock_asignado`,
`pr`.`stock_prod` AS `stock_prod_bruto`,
coalesce(up.precio_cdetalle,0) ult_precio_compra
FROM
`producto` `pr`
JOIN `unidad_medida` `um` ON (`um`.`id_und` = `pr`.`umed_prod`)
JOIN `sucursal` `suc` ON (`pr`.`sucursal_prod` = `suc`.`id_suc` and um.sucursal_und = `suc`.`id_suc`)
LEFT JOIN v_prod_ult_precio up on pr.id_prod = up.prod_cdetalle and up.sucursal_compra = suc.id_suc        
GROUP BY `pr`.`id_prod` , `pr`.`cod_prod` , `pr`.`des_prod` , `pr`.`compra_prod` , `pr`.`venta_prod` , `pr`.`status_prod` , `pr`.`stock_prod` , `suc`.`id_suc` , `pr`.`tipo_prod` , `suc`.`impuesto_suc` , `um`.`id_und` , `um`.`des_und`, up.precio_cdetalle 
ORDER BY `pr`.`cod_prod`;
    

    
    
    

