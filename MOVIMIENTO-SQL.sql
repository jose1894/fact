create view movimiento_producto as select t.*
from
(
	select * from salidas_ajustes
    union
    select * from salidas_documentos
    union
    select * from salidas_proformas
    union
    select * from entradas_ajustes
    union
    select * from entradas_compras
    union
    select * from entradas_documentos
) as t
 /*where  /* fecha_trans between '2019-11-25' and '2019-12-27' and  id_prod = 706**/
ORDER BY FECHA_TRANS asc;

select p.id_prod,p.des_prod,t.fecha_trans,p.stockini_prod,vp.stock_prod,td.cant_detalle,t.ope_trans,COD_DOC,ID_DOC,PEDIDO_DOC
from transaccion t
inner join trans_detalle td on id_trans = trans_detalle
inner join producto p on p.id_prod = td.prod_detalle
inner join v_productos vp on p.id_prod = vp.id_prod
JOIN DOCUMENTO ON ID_DOC = IDREFDOC_TRANS
where prod_detalle = 706 and t.ope_trans = 'S'
group by p.id_prod,p.des_prod,t.fecha_trans,p.stockini_prod,vp.stock_prod,td.cant_detalle,t.ope_trans,COD_DOC,ID_DOC,PEDIDO_DOC;

SELECT * FROM DOCUMENTO WHERE ID_DOC = 45;

SELECT * FROM PEDIDO WHERE ID_PEDIDO = 165;

select
sum(td.cant_detalle) ,
(
	select sum(td.cant_detalle)
    from transaccion t
    inner join trans_detalle td on t.id_trans = td.trans_detalle
    where fecha_trans < (
			select min(fecha_trans)
			from transaccion t
			inner join trans_detalle td on t.id_trans = td.trans_detalle
			where t.ope_trans = 'E' and td.prod_detalle = 633
    ) and t.ope_trans = 'S' and td.prod_detalle = 633
) stock_inicial,
sum(td.cant_detalle) -
(
	select sum(td.cant_detalle)
    from transaccion t
    inner join trans_detalle td on t.id_trans = td.trans_detalle
    where fecha_trans < (
			select min(fecha_trans)
			from transaccion t
			inner join trans_detalle td on t.id_trans = td.trans_detalle
			where t.ope_trans = 'E' and td.prod_detalle = 633 and t.status_trans = 1
    ) and t.ope_trans = 'S' and td.prod_detalle = 633
) cant_total_menos_stockini,
(			select sum(td.cant_detalle)
			from transaccion t
			inner join trans_detalle td on t.id_trans = td.trans_detalle
			where t.ope_trans = 'E' and td.prod_detalle = 633  and t.status_trans = 1
		) total_cant_compradas,
        p.stock_prod
from transaccion t
inner join trans_detalle td on id_trans = trans_detalle
inner join producto p on p.id_prod = td.prod_detalle
inner join v_productos vp on vp.id_prod = p.id_prod
where prod_detalle = 633 and ope_trans = 'S' and t.status_trans = 1
group by p.stock_prod;

SELECT
                 coalesce(SUM(`pedido_detalle`.`cant_pdetalle`), 0) AS `cant_pedido`
            FROM
                (`pedido_detalle`
                JOIN `pedido` ON (`pedido`.`id_pedido` = `pedido_detalle`.`pedido_pdetalle`))
            WHERE
                `pedido_detalle`.`prod_pdetalle` = 633
                    AND `pedido`.`sucursal_pedido` = 1
                    AND `pedido`.`estatus_pedido` in(2,3)
			;

-- group by p.id_prod,p.des_prod,t.fecha_trans,p.stockini_prod,p.stock_prod;

select
	coalesce((
		select sum(td.cant_detalle)
		from transaccion t
		inner join trans_detalle td on t.id_trans = td.trans_detalle
		where fecha_trans < (
				select min(fecha_trans)
				from transaccion t
				inner join trans_detalle td on t.id_trans = td.trans_detalle
				where t.ope_trans = 'E' and td.prod_detalle = 26
		) and t.ope_trans = 'S' and td.prod_detalle = 26
	),0) stock_inicial,
        coalesce((
		select sum(td.cant_detalle)
		from transaccion t
		inner join trans_detalle td on t.id_trans = td.trans_detalle
		where fecha_trans < (
				select min(fecha_trans)
				from transaccion t
				inner join trans_detalle td on t.id_trans = td.trans_detalle
				where td.prod_detalle = 26 and t.status_trans = 1 and fecha_trans between '2019-11-01' and '2020-10-31'
		) and td.prod_detalle = 26
	),0) saldo_anterior,
    (
			select sum(tdcc.cant_detalle)
			from transaccion tcc
			inner join trans_detalle tdcc on tcc.id_trans = tdcc.trans_detalle
			where tcc.ope_trans = 'E' and tdcc.prod_detalle = 26 and tcc.status_trans = 1 and fecha_trans between '2019-11-01' and '2020-10-31'
		) total_cant_compradas,
	sum(td.cant_detalle) total ,
    sum(td.cant_detalle) -
	coalesce((
		select sum(td.cant_detalle)
		from transaccion t
		inner join trans_detalle td on t.id_trans = td.trans_detalle
		where fecha_trans < (
				select min(fecha_trans)
				from transaccion t
				inner join trans_detalle td on t.id_trans = td.trans_detalle
				where td.prod_detalle = 26 and t.status_trans = 1 and fecha_trans between '2019-11-01' and '2020-10-31'
		) and td.prod_detalle = 26
	),0)
     /*-
	(
		select sum(td.cant_detalle)
		from transaccion t
		inner join trans_detalle td on t.id_trans = td.trans_detalle
		where fecha_trans < (
				select min(fecha_trans)
				from transaccion t
				inner join trans_detalle td on t.id_trans = td.trans_detalle
				where t.ope_trans = 'E' and td.prod_detalle = 633 and t.status_trans = 1
		) and t.ope_trans = 'S' and td.prod_detalle = 633
	) */
	cant_total_menos_stockini,
	p.stock_prod,
	(
		select sum(tdcc.cant_detalle)
		from transaccion tcc
		inner join trans_detalle tdcc on tcc.id_trans = tdcc.trans_detalle
		where tcc.ope_trans = 'E' and tdcc.prod_detalle = 26 and tcc.status_trans = 1 and fecha_trans between '2019-11-01' and '2020-10-31'
	) - sum(cant_detalle) stock_final
from transaccion t
inner join trans_detalle td on id_trans = trans_detalle
inner join producto p on p.id_prod = td.prod_detalle
inner join v_productos vp on vp.id_prod = p.id_prod
where prod_detalle = 26 and ope_trans = 'S' and t.status_trans = 1 and fecha_trans between '2019-11-01' and '2020-10-31'
group by td.prod_detalle,p.stock_prod;
