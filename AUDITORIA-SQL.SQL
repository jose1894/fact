ALTER TABLE `almacen` 
ADD `created_by` INT NULL COMMENT 'CREADO POR' AFTER `sucursal_almacen`, 
ADD `created_at` INT NULL COMMENT 'CREADO EN' AFTER `created_by`, 
ADD `updated_by` INT NULL COMMENT 'ACTUALIZADO POR' AFTER `created_at`, 
ADD `updated_at` INT NULL COMMENT 'ACTUALIZADO EN' AFTER `updated_by`, 
ADD INDEX (`created_by`), 
ADD INDEX (`updated_by`);

ALTER TABLE `cliente` 
ADD `created_by` INT NULL COMMENT 'CREADO POR' AFTER `sucursal_clte`, 
ADD `created_at` INT NULL COMMENT 'CREADO EN' AFTER `created_by`, 
ADD `updated_by` INT NULL COMMENT 'ACTUALIZADO POR' AFTER `created_at`, 
ADD `updated_at` INT NULL COMMENT 'ACTUALIZADO EN' AFTER `updated_by`, 
ADD INDEX (`created_by`), 
ADD INDEX (`updated_by`);

ALTER TABLE `compra` 
ADD `created_by` INT NULL COMMENT 'CREADO POR' AFTER `sucursal_compra`, 
ADD `created_at` INT NULL COMMENT 'CREADO EN' AFTER `created_by`, 
ADD `updated_by` INT NULL COMMENT 'ACTUALIZADO POR' AFTER `created_at`, 
ADD `updated_at` INT NULL COMMENT 'ACTUALIZADO EN' AFTER `updated_by`, 
ADD INDEX (`created_by`), 
ADD INDEX (`updated_by`);

ALTER TABLE `cond_pago` 
ADD `created_by` INT NULL COMMENT 'CREADO POR' AFTER `sucursal_condp`, 
ADD `created_at` INT NULL COMMENT 'CREADO EN' AFTER `created_by`, 
ADD `updated_by` INT NULL COMMENT 'ACTUALIZADO POR' AFTER `created_at`, 
ADD `updated_at` INT NULL COMMENT 'ACTUALIZADO EN' AFTER `updated_by`, 
ADD INDEX (`created_by`), 
ADD INDEX (`updated_by`);

ALTER TABLE `departamento` 
ADD `created_by` INT NULL COMMENT 'CREADO POR' AFTER `sucursal_depto`, 
ADD `created_at` INT NULL COMMENT 'CREADO EN' AFTER `created_by`, 
ADD `updated_by` INT NULL COMMENT 'ACTUALIZADO POR' AFTER `created_at`, 
ADD `updated_at` INT NULL COMMENT 'ACTUALIZADO EN' AFTER `updated_by`, 
ADD INDEX (`created_by`), 
ADD INDEX (`updated_by`);

ALTER TABLE `distrito` 
ADD `created_by` INT NULL COMMENT 'CREADO POR' AFTER `sucursal_dtto`, 
ADD `created_at` INT NULL COMMENT 'CREADO EN' AFTER `created_by`, 
ADD `updated_by` INT NULL COMMENT 'ACTUALIZADO POR' AFTER `created_at`, 
ADD `updated_at` INT NULL COMMENT 'ACTUALIZADO EN' AFTER `updated_by`, 
ADD INDEX (`created_by`), 
ADD INDEX (`updated_by`);

ALTER TABLE `documento` 
ADD `created_by` INT NULL COMMENT 'CREADO POR' AFTER `sucursal_doc`, 
ADD `created_at` INT NULL COMMENT 'CREADO EN' AFTER `created_by`, 
ADD `updated_by` INT NULL COMMENT 'ACTUALIZADO POR' AFTER `created_at`, 
ADD `updated_at` INT NULL COMMENT 'ACTUALIZADO EN' AFTER `updated_by`, 
ADD INDEX (`created_by`), 
ADD INDEX (`updated_by`);

ALTER TABLE `empresa` 
ADD `created_by` INT NULL COMMENT 'CREADO POR' AFTER `direcc_empresa`, 
ADD `created_at` INT NULL COMMENT 'CREADO EN' AFTER `created_by`, 
ADD `updated_by` INT NULL COMMENT 'ACTUALIZADO POR' AFTER `created_at`, 
ADD `updated_at` INT NULL COMMENT 'ACTUALIZADO EN' AFTER `updated_by`, 
ADD INDEX (`created_by`), 
ADD INDEX (`updated_by`);

ALTER TABLE `inventario` 
ADD `created_by` INT NULL COMMENT 'CREADO POR' AFTER `sucursal_inv`, 
ADD `created_at` INT NULL COMMENT 'CREADO EN' AFTER `created_by`, 
ADD `updated_by` INT NULL COMMENT 'ACTUALIZADO POR' AFTER `created_at`, 
ADD `updated_at` INT NULL COMMENT 'ACTUALIZADO EN' AFTER `updated_by`, 
ADD INDEX (`created_by`), 
ADD INDEX (`updated_by`);

ALTER TABLE `lista_precios` 
ADD `created_by` INT NULL COMMENT 'CREADO POR' AFTER `sucursal_lista`, 
ADD `created_at` INT NULL COMMENT 'CREADO EN' AFTER `created_by`, 
ADD `updated_by` INT NULL COMMENT 'ACTUALIZADO POR' AFTER `created_at`, 
ADD `updated_at` INT NULL COMMENT 'ACTUALIZADO EN' AFTER `updated_by`, 
ADD INDEX (`created_by`), 
ADD INDEX (`updated_by`);

ALTER TABLE `moneda` 
ADD `created_by` INT NULL COMMENT 'CREADO POR' AFTER `sucursal_moneda`, 
ADD `created_at` INT NULL COMMENT 'CREADO EN' AFTER `created_by`, 
ADD `updated_by` INT NULL COMMENT 'ACTUALIZADO POR' AFTER `created_at`, 
ADD `updated_at` INT NULL COMMENT 'ACTUALIZADO EN' AFTER `updated_by`, 
ADD INDEX (`created_by`), 
ADD INDEX (`updated_by`);

ALTER TABLE `motivo_ncredito` 
ADD `created_by` INT NULL COMMENT 'CREADO POR' AFTER `sucursal_motivo`, 
ADD `created_at` INT NULL COMMENT 'CREADO EN' AFTER `created_by`, 
ADD `updated_by` INT NULL COMMENT 'ACTUALIZADO POR' AFTER `created_at`, 
ADD `updated_at` INT NULL COMMENT 'ACTUALIZADO EN' AFTER `updated_by`, 
ADD INDEX (`created_by`), 
ADD INDEX (`updated_by`);

ALTER TABLE `motivo_traslado` 
ADD `created_by` INT NULL COMMENT 'CREADO POR' AFTER `sucursal_motivo`, 
ADD `created_at` INT NULL COMMENT 'CREADO EN' AFTER `created_by`, 
ADD `updated_by` INT NULL COMMENT 'ACTUALIZADO POR' AFTER `created_at`, 
ADD `updated_at` INT NULL COMMENT 'ACTUALIZADO EN' AFTER `updated_by`, 
ADD INDEX (`created_by`), 
ADD INDEX (`updated_by`);

ALTER TABLE `numeracion` 
ADD `created_by` INT NULL COMMENT 'CREADO POR' AFTER `sucursal_num`, 
ADD `created_at` INT NULL COMMENT 'CREADO EN' AFTER `created_by`, 
ADD `updated_by` INT NULL COMMENT 'ACTUALIZADO POR' AFTER `created_at`, 
ADD `updated_at` INT NULL COMMENT 'ACTUALIZADO EN' AFTER `updated_by`, 
ADD INDEX (`created_by`), 
ADD INDEX (`updated_by`);

ALTER TABLE `pais` 
ADD `created_by` INT NULL COMMENT 'CREADO POR' AFTER `sucursal_pais`, 
ADD `created_at` INT NULL COMMENT 'CREADO EN' AFTER `created_by`, 
ADD `updated_by` INT NULL COMMENT 'ACTUALIZADO POR' AFTER `created_at`, 
ADD `updated_at` INT NULL COMMENT 'ACTUALIZADO EN' AFTER `updated_by`, 
ADD INDEX (`created_by`), 
ADD INDEX (`updated_by`);

ALTER TABLE `pedido` 
ADD `created_by` INT NULL COMMENT 'CREADO POR' AFTER `sucursal_pedido`, 
ADD `created_at` INT NULL COMMENT 'CREADO EN' AFTER `created_by`, 
ADD `updated_by` INT NULL COMMENT 'ACTUALIZADO POR' AFTER `created_at`, 
ADD `updated_at` INT NULL COMMENT 'ACTUALIZADO EN' AFTER `updated_by`, 
ADD INDEX (`created_by`), 
ADD INDEX (`updated_by`);

ALTER TABLE `producto` 
ADD `created_by` INT NULL COMMENT 'CREADO POR' AFTER `sucursal_prod`, 
ADD `created_at` INT NULL COMMENT 'CREADO EN' AFTER `created_by`, 
ADD `updated_by` INT NULL COMMENT 'ACTUALIZADO POR' AFTER `created_at`, 
ADD `updated_at` INT NULL COMMENT 'ACTUALIZADO EN' AFTER `updated_by`, 
ADD INDEX (`created_by`), 
ADD INDEX (`updated_by`);

ALTER TABLE `profile` 
ADD `created_by` INT NULL COMMENT 'CREADO POR' AFTER `sucursal`, 
ADD `created_at` INT NULL COMMENT 'CREADO EN' AFTER `created_by`, 
ADD `updated_by` INT NULL COMMENT 'ACTUALIZADO POR' AFTER `created_at`, 
ADD `updated_at` INT NULL COMMENT 'ACTUALIZADO EN' AFTER `updated_by`, 
ADD INDEX (`created_by`), 
ADD INDEX (`updated_by`);

ALTER TABLE `proveedor` 
ADD `created_by` INT NULL COMMENT 'CREADO POR' AFTER `sucursal_prove`, 
ADD `created_at` INT NULL COMMENT 'CREADO EN' AFTER `created_by`, 
ADD `updated_by` INT NULL COMMENT 'ACTUALIZADO POR' AFTER `created_at`, 
ADD `updated_at` INT NULL COMMENT 'ACTUALIZADO EN' AFTER `updated_by`, 
ADD INDEX (`created_by`), 
ADD INDEX (`updated_by`);

ALTER TABLE `provincia` 
ADD `created_by` INT NULL COMMENT 'CREADO POR' AFTER `sucursal_prov`, 
ADD `created_at` INT NULL COMMENT 'CREADO EN' AFTER `created_by`, 
ADD `updated_by` INT NULL COMMENT 'ACTUALIZADO POR' AFTER `created_at`, 
ADD `updated_at` INT NULL COMMENT 'ACTUALIZADO EN' AFTER `updated_by`, 
ADD INDEX (`created_by`), 
ADD INDEX (`updated_by`);

ALTER TABLE `tipo_cambio` 
ADD `created_by` INT NULL COMMENT 'CREADO POR' AFTER `sucursal_tipoc`, 
ADD `created_at` INT NULL COMMENT 'CREADO EN' AFTER `created_by`, 
ADD `updated_by` INT NULL COMMENT 'ACTUALIZADO POR' AFTER `created_at`, 
ADD `updated_at` INT NULL COMMENT 'ACTUALIZADO EN' AFTER `updated_by`, 
ADD INDEX (`created_by`), 
ADD INDEX (`updated_by`);

ALTER TABLE `series` 
ADD `created_by` INT NULL COMMENT 'CREADO POR' AFTER `sucursal_serie`, 
ADD `created_at` INT NULL COMMENT 'CREADO EN' AFTER `created_by`, 
ADD `updated_by` INT NULL COMMENT 'ACTUALIZADO POR' AFTER `created_at`, 
ADD `updated_at` INT NULL COMMENT 'ACTUALIZADO EN' AFTER `updated_by`, 
ADD INDEX (`created_by`), 
ADD INDEX (`updated_by`);

ALTER TABLE `sucursal` 
ADD `created_by` INT NULL COMMENT 'CREADO POR' AFTER `impuesto_suc`, 
ADD `created_at` INT NULL COMMENT 'CREADO EN' AFTER `created_by`, 
ADD `updated_by` INT NULL COMMENT 'ACTUALIZADO POR' AFTER `created_at`, 
ADD `updated_at` INT NULL COMMENT 'ACTUALIZADO EN' AFTER `updated_by`, 
ADD INDEX (`created_by`), 
ADD INDEX (`updated_by`);


ALTER TABLE `tipo_documento` 
ADD `created_by` INT NULL COMMENT 'CREADO POR' AFTER `sucursal_tipod`, 
ADD `created_at` INT NULL COMMENT 'CREADO EN' AFTER `created_by`, 
ADD `updated_by` INT NULL COMMENT 'ACTUALIZADO POR' AFTER `created_at`, 
ADD `updated_at` INT NULL COMMENT 'ACTUALIZADO EN' AFTER `updated_by`, 
ADD INDEX (`created_by`), 
ADD INDEX (`updated_by`);

ALTER TABLE `tipo_identificacion` 
ADD `created_by` INT NULL COMMENT 'CREADO POR' AFTER `sucursal_tipoi`, 
ADD `created_at` INT NULL COMMENT 'CREADO EN' AFTER `created_by`, 
ADD `updated_by` INT NULL COMMENT 'ACTUALIZADO POR' AFTER `created_at`, 
ADD `updated_at` INT NULL COMMENT 'ACTUALIZADO EN' AFTER `updated_by`, 
ADD INDEX (`created_by`), 
ADD INDEX (`updated_by`);

ALTER TABLE `tipo_listap` 
ADD `created_by` INT NULL COMMENT 'CREADO POR' AFTER `sucursal_lista`, 
ADD `created_at` INT NULL COMMENT 'CREADO EN' AFTER `created_by`, 
ADD `updated_by` INT NULL COMMENT 'ACTUALIZADO POR' AFTER `created_at`, 
ADD `updated_at` INT NULL COMMENT 'ACTUALIZADO EN' AFTER `updated_by`, 
ADD INDEX (`created_by`), 
ADD INDEX (`updated_by`);


ALTER TABLE `tipo_movimiento` 
ADD `created_by` INT NULL COMMENT 'CREADO POR' AFTER `sucursal_tipom`, 
ADD `created_at` INT NULL COMMENT 'CREADO EN' AFTER `created_by`, 
ADD `updated_by` INT NULL COMMENT 'ACTUALIZADO POR' AFTER `created_at`, 
ADD `updated_at` INT NULL COMMENT 'ACTUALIZADO EN' AFTER `updated_by`, 
ADD INDEX (`created_by`), 
ADD INDEX (`updated_by`);

ALTER TABLE `tipo_producto` 
ADD `created_by` INT NULL COMMENT 'CREADO POR' AFTER `sucursal_tpdcto`, 
ADD `created_at` INT NULL COMMENT 'CREADO EN' AFTER `created_by`, 
ADD `updated_by` INT NULL COMMENT 'ACTUALIZADO POR' AFTER `created_at`, 
ADD `updated_at` INT NULL COMMENT 'ACTUALIZADO EN' AFTER `updated_by`, 
ADD INDEX (`created_by`), 
ADD INDEX (`updated_by`);

ALTER TABLE `tipo_proveedor` 
ADD `created_by` INT NULL COMMENT 'CREADO POR' AFTER `sucursal_tprov`, 
ADD `created_at` INT NULL COMMENT 'CREADO EN' AFTER `created_by`, 
ADD `updated_by` INT NULL COMMENT 'ACTUALIZADO POR' AFTER `created_at`, 
ADD `updated_at` INT NULL COMMENT 'ACTUALIZADO EN' AFTER `updated_by`, 
ADD INDEX (`created_by`), 
ADD INDEX (`updated_by`);

ALTER TABLE `transportista` 
ADD `created_by` INT NULL COMMENT 'CREADO POR' AFTER `sucursal_transp`, 
ADD `created_at` INT NULL COMMENT 'CREADO EN' AFTER `created_by`, 
ADD `updated_by` INT NULL COMMENT 'ACTUALIZADO POR' AFTER `created_at`, 
ADD `updated_at` INT NULL COMMENT 'ACTUALIZADO EN' AFTER `updated_by`, 
ADD INDEX (`created_by`), 
ADD INDEX (`updated_by`);

ALTER TABLE `transaccion` 
ADD `created_by` INT NULL COMMENT 'CREADO POR' AFTER `sucursal_trans`, 
ADD `created_at` INT NULL COMMENT 'CREADO EN' AFTER `created_by`, 
ADD `updated_by` INT NULL COMMENT 'ACTUALIZADO POR' AFTER `created_at`, 
ADD `updated_at` INT NULL COMMENT 'ACTUALIZADO EN' AFTER `updated_by`, 
ADD INDEX (`created_by`), 
ADD INDEX (`updated_by`);

ALTER TABLE `unidad_medida` 
ADD `created_by` INT NULL COMMENT 'CREADO POR' AFTER `sucursal_und`, 
ADD `created_at` INT NULL COMMENT 'CREADO EN' AFTER `created_by`, 
ADD `updated_by` INT NULL COMMENT 'ACTUALIZADO POR' AFTER `created_at`, 
ADD `updated_at` INT NULL COMMENT 'ACTUALIZADO EN' AFTER `updated_by`, 
ADD INDEX (`created_by`), 
ADD INDEX (`updated_by`);


ALTER TABLE `unidad_transporte` 
ADD `created_by` INT NULL COMMENT 'CREADO POR' AFTER `sucursal_utransp`, 
ADD `created_at` INT NULL COMMENT 'CREADO EN' AFTER `created_by`, 
ADD `updated_by` INT NULL COMMENT 'ACTUALIZADO POR' AFTER `created_at`, 
ADD `updated_at` INT NULL COMMENT 'ACTUALIZADO EN' AFTER `updated_by`, 
ADD INDEX (`created_by`), 
ADD INDEX (`updated_by`);

ALTER TABLE `vendedor` 
ADD `created_by` INT NULL COMMENT 'CREADO POR' AFTER `sucursal_vend`, 
ADD `created_at` INT NULL COMMENT 'CREADO EN' AFTER `created_by`, 
ADD `updated_by` INT NULL COMMENT 'ACTUALIZADO POR' AFTER `created_at`, 
ADD `updated_at` INT NULL COMMENT 'ACTUALIZADO EN' AFTER `updated_by`, 
ADD INDEX (`created_by`), 
ADD INDEX (`updated_by`);

ALTER TABLE `zona` 
ADD `created_by` INT NULL COMMENT 'CREADO POR' AFTER `sucursal_zona`, 
ADD `created_at` INT NULL COMMENT 'CREADO EN' AFTER `created_by`, 
ADD `updated_by` INT NULL COMMENT 'ACTUALIZADO POR' AFTER `created_at`, 
ADD `updated_at` INT NULL COMMENT 'ACTUALIZADO EN' AFTER `updated_by`, 
ADD INDEX (`created_by`), 
ADD INDEX (`updated_by`);


