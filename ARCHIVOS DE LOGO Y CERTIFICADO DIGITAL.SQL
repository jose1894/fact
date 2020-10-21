ALTER TABLE `empresa` add `image_empresa` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'NOMBRE DE LA IMAGEN DE LA EMPRESA' AFTER `direcc_empresa`;
ALTER TABLE `empresa` ADD `cert_empresa` VARCHAR(255) NULL COMMENT 'CERTFICADO SUNAT EMPRESA' AFTER `image_empresa`;
ALTER TABLE `empresa`
 ADD `usuariosol_empresa` VARCHAR(255) NULL COMMENT 'USUARIO SOL SUNAT' AFTER `cert_empresa`,
 ADD `passsol_empresa` VARCHAR(255) NULL COMMENT 'PASSWORD SOL SUNAT' AFTER `usuariosol_empresa`,
 ADD `passcrtsol_empresa` VARCHAR(255) NULL COMMENT 'PASSWORD CERTIFICADO SUNAT' AFTER `passsol_empresa`;

alter view v_productos as SELECT 
`pr`.`id_prod` AS `id_prod`,
`pr`.`cod_prod` AS `cod_prod`,
`pr`.`des_prod` AS `des_prod`,
`pr`.`compra_prod` AS `compra_prod`,
`pr`.`venta_prod` AS `venta_prod`,
`pr`.`status_prod` AS `status_prod`,
`suc`.`id_suc` AS `sucursal_prod`,
`pr`.`tipo_prod` AS `tipo_prod`,
concat(`pr`.`cod_prod`,' ',`pr`.`des_prod`,' - ',`um`.`des_und`) AS `texto`,
`suc`.`impuesto_suc` AS `impuesto_suc`,
`um`.`id_und` AS `id_und`,
`um`.`des_und` AS `des_und`,
`pr`.`stock_prod` - 
(
	select coalesce(sum(`pedido_detalle`.`cant_pdetalle`),0) AS `cant_pedido` 
	from (`pedido_detalle` 
		join `pedido` on(`pedido`.`id_pedido` = `pedido_detalle`.`pedido_pdetalle`)
	) 
	where `pedido_detalle`.`prod_pdetalle` = `pr`.`id_prod` and `pedido`.`sucursal_pedido` = `suc`.`id_suc` and `pedido`.`estatus_pedido` = 0) AS `stock_prod`,
	`pr`.`stock_prod` AS `stock_prod_bruto`,
	(
		select coalesce(sum(`pedido_detalle`.`cant_pdetalle`),0) AS `cant_pedido` 
		from (`pedido_detalle` 
		join `pedido` on(`pedido`.`id_pedido` = `pedido_detalle`.`pedido_pdetalle`)) 
		where `pedido_detalle`.`prod_pdetalle` = `pr`.`id_prod` and `pedido`.`sucursal_pedido` = `suc`.`id_suc` and `pedido`.`estatus_pedido` = 0) AS stock_asignado 
from ((`producto` `pr` join `unidad_medida` `um` on(`um`.`id_und` = `pr`.`umed_prod`)) join `sucursal` `suc` on(`pr`.`sucursal_prod` = `suc`.`id_suc`)) 
group by `pr`.`id_prod`,`pr`.`cod_prod`,`pr`.`des_prod`,`pr`.`compra_prod`,`pr`.`venta_prod`,`pr`.`status_prod`,`pr`.`stock_prod`,`suc`.`id_suc`,`pr`.`tipo_prod`,`suc`.`impuesto_suc`,`um`.`id_und`,`um`.`des_und` 
order by `pr`.`cod_prod`;