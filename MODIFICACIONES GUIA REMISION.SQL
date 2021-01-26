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

ALTER TABLE `documento`
-- ADD `tiporem_doc` VARCHAR(2) NULL COMMENT 'TIPO REMITENTE DOCUMENTO - GUIA DE REMISION' AFTER `tipomov_doc`,
ADD `rem_doc` INT NULL COMMENT 'REMITENTE DOCUMENTO - GUIA DE REMISION' AFTER `tiporem_doc`, ADD INDEX (`rem_doc`),
ADD `ptoptda_doc` TEXT NULL COMMENT 'PUNTO DE PARTIDA GUIA REMISION' AFTER `rem_doc`,
ADD `ptolleg_doc` TEXT NULL COMMENT 'PUNTO DE LLEGADA GUIA DE REMISION' AFTER `ptoptda_doc`;

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

alter table moneda
	add column abrv_moneda varchar(3) null default null comment 'ABREVIACION DE MONEDA' after sunatm_moneda;

update tipo_cambio set monedac_tipoc = 2, moneda_tipoc = 1;

CREATE
     OR REPLACE ALGORITHM = UNDEFINED
    DEFINER = `root`@`localhost`
    SQL SECURITY DEFINER
VIEW `v_prod_ult_precio` AS
    SELECT
        `cd`.`prod_cdetalle` AS `id_prod`,
        MAX(`c`.`fecha_compra`) AS `fecha_compra`,
        `c`.`moneda_compra` AS `moneda_compra`,
        `m`.`tipo_moneda` AS `tipo_moneda`,
        sum(`cd`.`precio_cdetalle`) AS `costo`,
        `c`.`sucursal_compra` AS `sucursal`,
        `m`.`abrv_moneda` AS `abrv_moneda`
    FROM
        (((`compra` `c`
        JOIN `compra_detalle` `cd` ON (`c`.`id_compra` = `cd`.`compra_cdetalle`))
        JOIN `moneda` `m` ON (`c`.`moneda_compra` = `m`.`id_moneda`
            AND `m`.`sucursal_moneda` = `c`.`sucursal_compra`))
        JOIN `tipo_cambio` `tc` ON (`tc`.`fecha_tipoc` = `c`.`fecha_compra`
            AND `c`.`sucursal_compra` = `tc`.`sucursal_tipoc`))
    GROUP BY `cd`.`prod_cdetalle` , `c`.`moneda_compra` , `m`.`tipo_moneda` , `c`.`sucursal_compra` , `m`.`abrv_moneda`;

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
coalesce(up.costo,0) ult_precio_compra,up.moneda_compra,up.tipo_moneda,abrv_moneda
FROM
`producto` `pr`
JOIN `unidad_medida` `um` ON (`um`.`id_und` = `pr`.`umed_prod`)
JOIN `sucursal` `suc` ON (`pr`.`sucursal_prod` = `suc`.`id_suc` and um.sucursal_und = `suc`.`id_suc`)
LEFT JOIN v_prod_ult_precio up on pr.id_prod = up.id_prod and up.sucursal = suc.id_suc
GROUP BY `pr`.`id_prod` , `pr`.`cod_prod` , `pr`.`des_prod` , `pr`.`compra_prod` , `pr`.`venta_prod` , `pr`.`status_prod` , `pr`.`stock_prod` , `suc`.`id_suc` , `pr`.`tipo_prod` , `suc`.`impuesto_suc` , `um`.`id_und` , `um`.`des_und`, up.costo, ult_precio_compra,up.moneda_compra,up.tipo_moneda, abrv_moneda
ORDER BY `pr`.`cod_prod`;


/* ACTUALIZA LOS PRECIOS EN LA TABLA DE TRANSACCION DESDE LA TABLA DE COMPRAS */
update transaccion set moneda_trans = 1 where moneda_trans is null;

-- select fecha_compra,prod_cdetalle,prod_detalle,tipo_trans,precio_cdetalle,costo_detalle
-- from compra
update compra C
inner join compra_detalle CD on id_compra = compra_cdetalle
inner join transaccion T on idrefdoc_trans = id_compra and tipo_trans = 3
inner join trans_detalle TD on id_trans = trans_detalle and prod_detalle = prod_cdetalle
set TD.costo_detalle = CD.precio_cdetalle;


/* vista entradas compras 18 columnas */
alter view entradas_compras as
SELECT
        `p`.`id_prod` AS `id_prod`,
        `p`.`cod_prod` AS `cod_prod`,
        `p`.`des_prod` AS `des_prod`,
        `t`.`fecha_trans` AS `fecha_trans`,
        `pr`.`nombre_prove` AS `nombre_prove`
        ,
        CONCAT(`tds`.`abrv_tipod`,
                `numeracion`.`serie_num`,
                '-',
                SUBSTR(`c`.`cod_compra`, 4, 8)) AS `nro_doc`,
        'ENTRADA' AS `ope_trans`,
        `tm`.`id_tipom` AS `id_tipom`,
        `tm`.`des_tipom` AS `des_tipom`,
        `tds`.`id_tipod` AS `id_tipod`,
        `tds`.`des_tipod` AS `des_tipod`,
        `td`.`cant_detalle` AS `ingreso_unidades`,
        `m`.`des_moneda` AS `des_moneda`,
		sum(td.costo_detalle) precio,
        '' AS `salidas_unidades`,
        '' AS `tipo_pedido`,
        `t`.`sucursal_trans` AS `sucursal_trans`,
        `t`.`id_trans` AS `id_trans`
    FROM
        `transaccion` `t`
        JOIN `trans_detalle` `td` ON (`t`.`id_trans` = `td`.`trans_detalle`)
        JOIN `compra` `c` ON (`c`.`id_compra` = `t`.`idrefdoc_trans`
            AND `c`.`sucursal_compra` = `t`.`sucursal_trans`)
        JOIN `producto` `p` ON (`p`.`id_prod` = `td`.`prod_detalle`
            AND `t`.`sucursal_trans` = `p`.`sucursal_prod`)
        JOIN `proveedor` `pr` ON (`pr`.`id_prove` = `c`.`provee_compra`
            AND `pr`.`sucursal_prove` = `t`.`sucursal_trans`)
        JOIN `tipo_movimiento` `tm` ON (`tm`.`id_tipom` = `t`.`tipo_trans`
            AND `tm`.`sucursal_tipom` = `t`.`sucursal_trans`)
        left JOIN `moneda` `m` ON (`t`.`moneda_trans` = `m`.`id_moneda`
            AND `t`.`sucursal_trans` = `m`.`sucursal_moneda`)
        JOIN `tipo_cambio` ON (`c`.`fecha_compra` = `tipo_cambio`.`fecha_tipoc`
            AND `t`.`sucursal_trans` = `tipo_cambio`.`sucursal_tipoc`)
        JOIN `numeracion` ON (`t`.`numdoc_trans` = `numeracion`.`id_num`
            AND `t`.`sucursal_trans` = `numeracion`.`sucursal_num`)
        JOIN `tipo_documento` `tds` ON (`numeracion`.`tipo_num` = `tds`.`id_tipod`
            AND `t`.`sucursal_trans` = `tds`.`sucursal_tipod`)
    WHERE
        `t`.`ope_trans` = 'E'
    GROUP BY
    `p`.`id_prod` ,
    `p`.`cod_prod` ,
    `p`.`des_prod` ,
    `t`.`fecha_trans` ,
    `pr`.`nombre_prove` ,
    `tds`.`abrv_tipod` ,
    `numeracion`.`serie_num` ,
    `c`.`cod_compra` ,
    `tm`.`id_tipom` ,
    `tm`.`des_tipom` ,
    `tds`.`id_tipod` ,
    `tds`.`des_tipod` ,
    `td`.`cant_detalle` ,
    `m`.`des_moneda`,
    `t`.`sucursal_trans` ,
    `t`.`id_trans`;


/* vista ajustes de entradas 18 columnas*/
alter view entradas_ajustes as SELECT
        `p`.`id_prod` AS `id_prod`,
        `p`.`cod_prod` AS `cod_prod`,
        `p`.`des_prod` AS `des_prod`,
        `t`.`fecha_trans` AS `fecha_trans`,
        `t`.`docref_trans` AS `docref_trans`,
        CONCAT(`tds`.`abrv_tipod`,
                `nd`.`serie_num`,
                '-',
                SUBSTR(`t`.`codigo_trans`, 4, 8)) AS `nro_doc`,
        'ENTRADA' AS `ope_trans`,
        `tm`.`id_tipom` AS `id_tipom`,
        `tm`.`des_tipom` AS `des_tipom`,
        `tds`.`id_tipod` AS `id_tipod`,
        `tds`.`des_tipod` AS `des_tipod`,
        `td`.`cant_detalle` AS `ingreso_unidades`,
        m.des_moneda AS `moneda`,
        sum(costo_detalle) precio,
        '' AS `salidas_unidades`,
        '' AS `tipo_pedido`,
        `t`.`sucursal_trans` AS `sucursal_trans`,
        `t`.`id_trans` AS `id_trans`
    FROM
        `transaccion` `t`
        JOIN `trans_detalle` `td` ON `t`.`id_trans` = `td`.`trans_detalle`
        JOIN `producto` `p` ON `p`.`id_prod` = `td`.`prod_detalle`
            AND `t`.`sucursal_trans` = `p`.`sucursal_prod`
        JOIN `tipo_movimiento` `tm` ON `tm`.`id_tipom` = `t`.`tipo_trans`
            AND `t`.`sucursal_trans` = `tm`.`sucursal_tipom`
        JOIN `numeracion` `nd` ON `t`.`numdoc_trans` = `nd`.`id_num`
            AND `t`.`sucursal_trans` = `nd`.`sucursal_num`
        JOIN `tipo_documento` `tds` ON `nd`.`tipo_num` = `tds`.`id_tipod`
            AND `t`.`sucursal_trans` = `tds`.`sucursal_tipod`
            inner join moneda m on m.id_moneda = t.moneda_trans and t.sucursal_trans = m.sucursal_moneda
    WHERE
        `t`.`tipo_trans` IN (1 , 5, 9, 11)
    GROUP BY `p`.`id_prod` , `p`.`cod_prod` , `p`.`des_prod` , `t`.`fecha_trans` , `t`.`docref_trans` , `tds`.`abrv_tipod` , `nd`.`serie_num` , `t`.`codigo_trans` , `tm`.`id_tipom` , `tm`.`des_tipom` , `tds`.`id_tipod` , `tds`.`des_tipod` , `td`.`cant_detalle` ,m.des_moneda, `t`.`sucursal_trans` , `t`.`id_trans`;



/* vista `entradas_documentos` 18 columnas */
alter view entradas_documentos as
    SELECT
        `p`.`id_prod` AS `id_prod`,
        `p`.`cod_prod` AS `cod_prod`,
        `p`.`des_prod` AS `des_prod`,
        `t`.`fecha_trans` AS `fecha_trans`,
        `cliente`.`nombre_clte` AS `nombre_clte`,
        CONCAT(`tds`.`abrv_tipod`,
                `nd`.`serie_num`,
                '-',
                SUBSTR(`d`.`cod_doc`, 4, 8)) AS `nro_doc`,
        'ENTRADA' AS `ope_trans`,
        `tm`.`id_tipom` AS `id_tipom`,
        `tm`.`des_tipom` AS `des_tipom`,
        `tds`.`id_tipod` AS `id_tipod`,
        `tds`.`des_tipod` AS `des_tipod`,
        `td`.`cant_detalle` AS `ingreso_unidades`,
        `moneda`.`des_moneda` AS `moneda`,
        sum(costo_detalle) AS `precio_compra_ext`,
        '' AS `salidas_unidades`,
        '' AS `tipo_pedido`,
        `t`.`sucursal_trans` AS `sucursal_trans`,
        `t`.`id_trans` AS `id_trans`
    FROM
        `transaccion` `t`
        JOIN `trans_detalle` `td` ON `t`.`id_trans` = `td`.`trans_detalle`
        JOIN `producto` `p` ON `p`.`id_prod` = `td`.`prod_detalle`
            AND `t`.`sucursal_trans` = `p`.`sucursal_prod`
        JOIN `tipo_movimiento` `tm` ON `tm`.`id_tipom` = `t`.`tipo_trans`
            AND `t`.`sucursal_trans` = `tm`.`sucursal_tipom`
        JOIN `numeracion` `nd` ON `t`.`numdoc_trans` = `nd`.`id_num`
            AND `t`.`sucursal_trans` = `nd`.`sucursal_num`
        JOIN `tipo_documento` `tds` ON `nd`.`tipo_num` = `tds`.`id_tipod`
            AND `t`.`sucursal_trans` = `tds`.`sucursal_tipod`
        JOIN `documento` `d` ON `d`.`id_doc` = `t`.`idrefdoc_trans`
            AND `t`.`sucursal_trans` = `d`.`sucursal_doc`
        JOIN `documento` `dp` ON `dp`.`id_doc` = `d`.`docref_doc`
            AND `dp`.`sucursal_doc` = `t`.`sucursal_trans`
        JOIN `pedido` ON `dp`.`pedido_doc` = `pedido`.`id_pedido`
            AND `pedido`.`sucursal_pedido` = `t`.`sucursal_trans`
        JOIN `moneda` ON `moneda`.`id_moneda` = `t`.`moneda_trans`
            AND `t`.`sucursal_trans` = `moneda`.`sucursal_moneda`
        JOIN `cliente` ON `pedido`.`clte_pedido` = `cliente`.`id_clte`
            AND `t`.`sucursal_trans` = `cliente`.`sucursal_clte`
    WHERE
        `t`.`tipo_trans` = 7
    GROUP BY `p`.`id_prod` , `p`.`cod_prod` , `p`.`des_prod` , `t`.`fecha_trans` , `cliente`.`nombre_clte` , `tds`.`abrv_tipod` , `nd`.`serie_num` , `d`.`cod_doc` , `tm`.`id_tipom` , `tm`.`des_tipom` , `tds`.`id_tipod` , `tds`.`des_tipod` , `td`.`cant_detalle` , `moneda`.`des_moneda` , `t`.`sucursal_trans` , `t`.`id_trans`;


    /* `salidas_proformas` 18 columnas */

    alter view salidas_proformas as
    SELECT
        `producto`.`id_prod` AS `id_prod`,
        `producto`.`cod_prod` AS `cod_prod`,
        `producto`.`des_prod` AS `des_prod`,
        `t`.`fecha_trans` AS `fecha_trans`,
        `cliente`.`nombre_clte` AS `nombre_clte`,
        CONCAT(`tds`.`abrv_tipod`,
                `nd`.`serie_num`,
                '-',
                SUBSTR(`t`.`codigo_trans`, 4, 8)) AS `codigo_trans`,
        'SALIDA' AS `OPE_TRANS`,
        `tipo_movimiento`.`id_tipom` AS `id_tipom`,
        `tipo_movimiento`.`des_tipom` AS `des_tipom`,
        `tds`.`id_tipod` AS `id_tipod`,
        `tds`.`des_tipod` AS `des_tipod`,
        '' AS `ingreso_unidades`,
        '' AS `moneda`,
        '' AS `precio`,
        `td`.`cant_detalle` AS `salidas_unidades`,
        `pedido`.`tipo_pedido` AS `tipo_pedido`,
        `t`.`sucursal_trans` AS `sucursal_trans`,
        `t`.`id_trans` AS `id_trans`
    FROM
        (((((((`transaccion` `t`
        JOIN `trans_detalle` `td` ON (`t`.`id_trans` = `td`.`trans_detalle`))
        JOIN `producto` ON (`td`.`prod_detalle` = `producto`.`id_prod`
            AND `producto`.`status_prod` = 1
            AND `t`.`sucursal_trans` = `producto`.`sucursal_prod`))
        LEFT JOIN `tipo_movimiento` ON (`t`.`tipo_trans` = `tipo_movimiento`.`id_tipom`
            AND `tipo_movimiento`.`status_tipom` = 1
            AND `t`.`sucursal_trans` = `tipo_movimiento`.`sucursal_tipom`))
        LEFT JOIN `pedido` ON (`pedido`.`id_pedido` = `t`.`idrefdoc_trans`
            AND `pedido`.`estatus_pedido` = 3
            AND `t`.`sucursal_trans` = `pedido`.`sucursal_pedido`))
        JOIN `cliente` ON (`pedido`.`clte_pedido` = `cliente`.`id_clte`
            AND `t`.`sucursal_trans` = `cliente`.`sucursal_clte`))
        JOIN `numeracion` `nd` ON (`t`.`numdoc_trans` = `nd`.`id_num`
            AND `t`.`sucursal_trans` = `nd`.`sucursal_num`))
        JOIN `tipo_documento` `tds` ON (`nd`.`tipo_num` = `tds`.`id_tipod`
            AND `t`.`sucursal_trans` = `tds`.`sucursal_tipod`))
    WHERE
        `t`.`ope_trans` = 'S'
            AND `tipo_movimiento`.`id_tipom` = 8
    GROUP BY `producto`.`id_prod` , `producto`.`cod_prod` , `producto`.`des_prod` , `t`.`fecha_trans` , `cliente`.`id_clte` , `cliente`.`nombre_clte` , `tds`.`abrv_tipod` , `nd`.`serie_num` , `t`.`codigo_trans` , `t`.`id_trans` , `t`.`idrefdoc_trans` , `pedido`.`cod_pedido` , `tipo_movimiento`.`id_tipom` , `tipo_movimiento`.`des_tipom` , `tds`.`id_tipod` , `tds`.`des_tipod` , `pedido`.`tipo_pedido` , `td`.`cant_detalle` , `t`.`sucursal_trans` , `t`.`id_trans`
    ORDER BY `pedido`.`cod_pedido` , `producto`.`id_prod`;


    /* `salidas_documentos` 18 columnas */
    alter view salidas_documentos as SELECT
        `producto`.`id_prod` AS `id_prod`,
        `producto`.`cod_prod` AS `cod_prod`,
        `producto`.`des_prod` AS `des_prod`,
        `t`.`fecha_trans` AS `fecha_trans`,
        `cliente`.`nombre_clte` AS `nombre_clte`,
        CONCAT(`tipo_documento`.`abrv_tipod`,
                `numeracion`.`serie_num`,
                '-',
                SUBSTR(`documento`.`cod_doc`, 4, 8)) AS `nro_documento`,
        'SALIDA' AS `ope_trans`,
        `tipo_movimiento`.`id_tipom` AS `id_tipom`,
        `tipo_movimiento`.`des_tipom` AS `des_tipom`,
        `tds`.`id_tipod` AS `id_tipod`,
        `tds`.`des_tipod` AS `des_tipod`,
        '' AS `ingreso_unidades`,
        '' AS `moneda`,
        '' AS `precio`,
        `td`.`cant_detalle` AS `salidas_unidades`,
        `pedido`.`tipo_pedido` AS `tipo_pedido`,
        `t`.`sucursal_trans` AS `sucursal_trans`,
        `t`.`id_trans` AS `id_trans`
    FROM
        ((((((((((`transaccion` `t`
        JOIN `trans_detalle` `td` ON (`t`.`id_trans` = `td`.`trans_detalle`))
        JOIN `producto` ON (`td`.`prod_detalle` = `producto`.`id_prod`
            AND `producto`.`status_prod` = 1
            AND `t`.`sucursal_trans` = `producto`.`sucursal_prod`))
        JOIN `tipo_movimiento` ON (`t`.`tipo_trans` = `tipo_movimiento`.`id_tipom`
            AND `tipo_movimiento`.`status_tipom` = 1
            AND `tipo_movimiento`.`id_tipom` NOT IN (8 , 6)
            AND `t`.`sucursal_trans` = `tipo_movimiento`.`sucursal_tipom`))
        JOIN `documento` ON (`t`.`idrefdoc_trans` = `documento`.`id_doc`
            AND `documento`.`status_doc` IN (2 , 3)
            AND `t`.`sucursal_trans` = `documento`.`sucursal_doc`))
        JOIN `pedido` ON (`documento`.`pedido_doc` = `pedido`.`id_pedido`
            AND `pedido`.`estatus_pedido` IN (2 , 3, 4)
            AND `t`.`sucursal_trans` = `pedido`.`sucursal_pedido`))
        JOIN `cliente` ON (`pedido`.`clte_pedido` = `cliente`.`id_clte`
            AND `t`.`sucursal_trans` = `cliente`.`sucursal_clte`))
        JOIN `numeracion` ON (`documento`.`numeracion_doc` = `numeracion`.`id_num`
            AND `t`.`sucursal_trans` = `numeracion`.`sucursal_num`))
        JOIN `numeracion` `nd` ON (`t`.`numdoc_trans` = `nd`.`id_num`
            AND `t`.`sucursal_trans` = `nd`.`sucursal_num`))
        JOIN `tipo_documento` ON (`numeracion`.`tipo_num` = `tipo_documento`.`id_tipod`
            AND `t`.`sucursal_trans` = `tipo_documento`.`sucursal_tipod`))
        JOIN `tipo_documento` `tds` ON (`nd`.`tipo_num` = `tds`.`id_tipod`
            AND `t`.`sucursal_trans` = `tds`.`sucursal_tipod`))
    WHERE
        `t`.`ope_trans` = 'S'
    GROUP BY `producto`.`id_prod` , `producto`.`cod_prod` , `producto`.`des_prod` , `t`.`fecha_trans` , `cliente`.`nombre_clte` , `tipo_documento`.`abrv_tipod` , `numeracion`.`serie_num` , `documento`.`cod_doc` , `tipo_movimiento`.`id_tipom` , `tipo_movimiento`.`des_tipom` , `tds`.`id_tipod` , `tds`.`des_tipod` , `pedido`.`tipo_pedido` , `td`.`cant_detalle` , `t`.`sucursal_trans` , `t`.`id_trans`
    ORDER BY `documento`.`cod_doc` , `producto`.`id_prod`;



    /* `salidas_ajustes` 18 columnas*/
    alter view salidas_ajustes as SELECT
        `p`.`id_prod` AS `id_prod`,
        `p`.`cod_prod` AS `cod_prod`,
        `p`.`des_prod` AS `des_prod`,
        `t`.`fecha_trans` AS `fecha_trans`,
        `t`.`docref_trans` AS `docref_trans`,
        CONCAT(`tds`.`abrv_tipod`,
                `nd`.`serie_num`,
                '-',
                SUBSTR(`t`.`codigo_trans`, 4, 8)) AS `codigo_trans`,
        'SALIDA' AS `ope_trans`,
        `tm`.`id_tipom` AS `id_tipom`,
        `tm`.`des_tipom` AS `des_tipom`,
        `tds`.`id_tipod` AS `id_tipod`,
        `tds`.`des_tipod` AS `des_tipod`,
        '' AS `ingreso_unidades`,
        '' AS `moneda`,
        '' AS `precio`,
        `td`.`cant_detalle` AS `salidas_unidades`,
        '' AS `tipo`,
        `t`.`sucursal_trans` AS `sucursal_trans`,
        `t`.`id_trans` AS `id_trans`
    FROM
        (((((`transaccion` `t`
        JOIN `trans_detalle` `td` ON (`t`.`id_trans` = `td`.`trans_detalle`))
        JOIN `producto` `p` ON (`p`.`id_prod` = `td`.`prod_detalle`
            AND `t`.`sucursal_trans` = `p`.`sucursal_prod`))
        JOIN `tipo_movimiento` `tm` ON (`tm`.`id_tipom` = `t`.`tipo_trans`
            AND `t`.`sucursal_trans` = `tm`.`sucursal_tipom`))
        JOIN `numeracion` `nd` ON (`t`.`numdoc_trans` = `nd`.`id_num`
            AND `t`.`sucursal_trans` = `nd`.`sucursal_num`))
        JOIN `tipo_documento` `tds` ON (`nd`.`tipo_num` = `tds`.`id_tipod`
            AND `t`.`sucursal_trans` = `tds`.`sucursal_tipod`))
    WHERE
        `t`.`tipo_trans` IN (2 , 6, 10)
    GROUP BY `p`.`id_prod` , `p`.`cod_prod` , `p`.`des_prod` , `t`.`fecha_trans` , `t`.`docref_trans` , `tds`.`abrv_tipod` , `nd`.`serie_num` , `t`.`codigo_trans` , `tm`.`id_tipom` , `tm`.`des_tipom` , `tds`.`id_tipod` , `tds`.`des_tipod` , `t`.`fecha_trans` , `td`.`cant_detalle` , `t`.`sucursal_trans` , `t`.`id_trans`
    ORDER BY `t`.`id_trans`;
