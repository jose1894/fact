select t.*,
(
	(select COALESCE(sum(cant_detalle),0) from transaccion inner join trans_detalle on id_trans = trans_detalle where ope_trans = 'E' and fecha_trans < '2020-01-01' and prod_detalle = 633) 
    -
    (select COALESCE(sum(cant_detalle),0) from transaccion inner join trans_detalle on id_trans = trans_detalle where ope_trans = 'S' and fecha_trans < '2020-01-01' and prod_detalle = 633)
) saldo_ant,
(
	(select COALESCE(SUM(cant_detalle),0) from transaccion inner join trans_detalle on id_trans = trans_detalle where ope_trans = 'S' and fecha_trans > '2020-02-15' and prod_detalle = 633)
    -
    (select COALESCE(sum(cant_detalle),0) from transaccion inner join trans_detalle on id_trans = trans_detalle where ope_trans = 'E' and fecha_trans > '2020-02-15' and prod_detalle = 633)
)saldo_post
from 
( 
	select * from salidas_ajustes
    union
    select * from salidas_documentos
    union 
    select * from salidas_proformas
) as t
where fecha_trans between '2020-01-01' and '2020-02-15' and id_prod = 633;

select td.* 
from transaccion t 
inner join trans_detalle td on id_trans = trans_detalle 
where prod_detalle = 633 and t.ope_trans = 'E'