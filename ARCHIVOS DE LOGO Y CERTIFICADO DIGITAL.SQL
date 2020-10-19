ALTER TABLE `empresa` add `image_empresa` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'NOMBRE DE LA IMAGEN DE LA EMPRESA' AFTER `direcc_empresa`;
ALTER TABLE `empresa` ADD `cert_empresa` VARCHAR(255) NULL COMMENT 'CERTFICADO SUNAT EMPRESA' AFTER `image_empresa`;
ALTER TABLE `empresa`
 ADD `usuariosol_empresa` VARCHAR(255) NULL COMMENT 'USUARIO SOL SUNAT' AFTER `cert_empresa`,
 ADD `passsol_empresa` VARCHAR(255) NULL COMMENT 'PASSWORD SOL SUNAT' AFTER `usuariosol_empresa`,
 ADD `passcrtsol_empresa` VARCHAR(255) NULL COMMENT 'PASSWORD CERTIFICADO SUNAT' AFTER `passsol_empresa`;
