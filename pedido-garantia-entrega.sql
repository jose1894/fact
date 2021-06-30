create table garantia (  id_garan int not null auto_increment comment 'ID UNICO',  des_garan varchar(255) not null comment 'DESCRIPCION DE LA GARANTIA',     status_garan int not null default 1 comment 'ESTATUS DE LA GARANTIA 1= ACTIVO, 0 = INACTIVO',     sucursal_garan int not null default 0 comment 'SUCURSAL DE LA GARANTIA',     created_by int null comment 'CREADO POR',     created_at int null comment 'CREADO EN',     updated_by int null comment 'ACTUALIZADO POR',     updated_at int null comment 'ACTUALIZADO EN',  PRIMARY KEY (`id_garan`),  KEY `sucursal_garan` (`sucursal_garan`),  KEY `created_by` (`created_by`),  KEY `updated_by` (`updated_by`) )ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COMMENT='GUARDA DATOS DE GARANTIA';
create table entrega (  id_entrega int not null auto_increment comment 'ID UNICO',  des_entrega varchar(255) not null comment 'DESCRIPCION DE LA ENTREGA',     status_entrega int not null default 1 comment 'ESTATUS DE LA ENTREGA 1= ACTIVO, 0 = INACTIVO',     sucursal_entrega int not null default 0 comment 'SUCURSAL DE LA ENTREGA',     created_by int null comment 'CREADO POR',     created_at int null comment 'CREADO EN',     updated_by int null comment 'ACTUALIZADO POR',     updated_at int null comment 'ACTUALIZADO EN',  PRIMARY KEY (`id_entrega`),  KEY `sucursal_entrega` (`sucursal_entrega`),  KEY `created_by` (`created_by`),  KEY `updated_by` (`updated_by`) )ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COMMENT='GUARDA DATOS DE ENTREGA';

alter table producto 
	add garantia_prod int null DEFAULT 0  comment 'GARANTIA DE PRODUCTO' after image_prod,
    ADD INDEX (`garantia_prod`);
    
alter table producto
	drop garantia_prod;
    
set foreign_key_checks=0;
ALTER TABLE producto
ADD CONSTRAINT fk_garantia_prod
FOREIGN KEY (garantia_prod) REFERENCES garantia(id_garan);

set foreign_key_checks=1;

alter table pedido
	add venc_pedido date null comment 'VENCIMIENTO DEL PEDIDO' after sucursal_pedido,
    add entrega_pedido int null comment 'ENTREGA DE PEDIDO' after venc_pedido,
    add index (entrega_pedido),
    ADD CONSTRAINT fk_entrega_pedido
    FOREIGN KEY (entrega_pedido) REFERENCES entrega(id_entrega);
