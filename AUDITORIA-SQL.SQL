ALTER TABLE `almacen` 
ADD `created_by` INT NULL COMMENT 'CREADO POR' AFTER `sucursal_almacen`, 
ADD `created_at` INT NULL COMMENT 'CREADO EN' AFTER `created_by`, 
ADD `updated_by` INT NULL COMMENT 'ACTUALIZADO POR' AFTER `created_at`, 
ADD `updated_at` INT NULL COMMENT 'ACTUALIZADO EN' AFTER `updated_by`, 
ADD INDEX (`created_by`), 
ADD INDEX (`updated_by`);