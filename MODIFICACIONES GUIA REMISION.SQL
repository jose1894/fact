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

UPDATE `documento` SET tipomov_doc = 4 where tipo_doc = 3
