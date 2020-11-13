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
				where t.ope_trans = 'E' and td.prod_detalle = 633
		) and t.ope_trans = 'S' and td.prod_detalle = 633
	),0) stock_inicial,
        coalesce((
		select sum(td.cant_detalle)
		from transaccion t
		inner join trans_detalle td on t.id_trans = td.trans_detalle
		where fecha_trans < '2020-06-01'/*(
				select min(fecha_trans)
				from transaccion t
				inner join trans_detalle td on t.id_trans = td.trans_detalle
				where td.prod_detalle = 633 and t.status_trans = 1 and fecha_trans < '2020-06-01'/*between '2020-06-01' and '2020-07-31'
		) */ and td.prod_detalle = 633 and ope_trans = 'E'
	),0) entradas_anteriores,
    coalesce((
		select sum(td.cant_detalle)
		from transaccion t
		inner join trans_detalle td on t.id_trans = td.trans_detalle
		where fecha_trans < '2020-06-01'/*(
				select min(fecha_trans)
				from transaccion t
				inner join trans_detalle td on t.id_trans = td.trans_detalle
				where td.prod_detalle = 633 and t.status_trans = 1 and fecha_trans < '2020-06-01'/*between '2020-06-01' and '2020-07-31'
		) */ and td.prod_detalle = 633 and ope_trans = 'S'
	),0) salidas_anteriores,
    /*(
			select sum(tdcc.cant_detalle)
			from transaccion tcc
			inner join trans_detalle tdcc on tcc.id_trans = tdcc.trans_detalle
			where tcc.ope_trans = 'E' and tdcc.prod_detalle = 633 and tcc.status_trans = 1 and fecha_trans between '2020-10-15' and '2020-10-15'
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
				where td.prod_detalle = 633 and t.status_trans = 1 and fecha_trans between '2020-10-15' and '2020-10-15'
		) and td.prod_detalle = 633
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
		where tcc.ope_trans = 'E' and tdcc.prod_detalle = 633 and tcc.status_trans = 1 and fecha_trans between '2020-10-15' and '2020-10-15'
	) - sum(cant_detalle) stock_final
from transaccion t
inner join trans_detalle td on id_trans = trans_detalle
inner join producto p on p.id_prod = td.prod_detalle
inner join v_productos vp on vp.id_prod = p.id_prod
where prod_detalle = 633 and ope_trans = 'S' and t.status_trans = 1 and fecha_trans between '2020-06-01' and '2020-07-31'
group by td.prod_detalle,p.stock_prod;

SELECT 
`vp`.`id_prod`, 
(
	SELECT coalesce(sum(cant_detalle),0) AS `stock_inicial` 
    FROM `transaccion` 
    INNER JOIN `trans_detalle` ON id_trans = trans_detalle 
    WHERE (`sucursal_trans` = 1) AND (`status_trans` = '1') AND (`ope_trans` = 'S') AND (`fecha_trans` < '2019-12-27') AND (`prod_detalle` = '633')
) AS `stock_inicial`, 
(
	SELECT coalesce(sum(cant_detalle),0) AS `saldo_anterior` 
    FROM `transaccion` 
    INNER JOIN `trans_detalle` ON id_trans = trans_detalle 
    WHERE (`sucursal_trans` = 1) AND (`status_trans` = '1') AND (`fecha_trans` < '') AND (`prod_detalle` = '633')
) AS `saldo_anterior`, 
`p`.`stock_prod` 
FROM `transaccion` `t` 
inner join `trans_detalle` `td` ON t.id_trans = td.trans_detalle 
inner join `producto` `p` ON p.id_prod = td.prod_detalle 
inner join `v_productos` `vp` ON vp.id_prod = td.prod_detalle 
WHERE (`vp`.`id_prod` = '633') AND (`t`.`ope_trans` = 'S') AND (`t`.`status_trans` = 1) AND (`t`.`sucursal_trans` = 1) 
GROUP BY `vp`.`id_prod`, `p`.`stock_prod`;


SELECT 
	`vp`.`id_prod`, 
    `vp`.`cod_prod`, 
    `vp`.`des_prod`, 
    (
		SELECT coalesce(sum(cant_detalle),0) AS `stock_inicial` 
        FROM `transaccion` 
        INNER JOIN `trans_detalle` ON id_trans = trans_detalle 
        WHERE (`sucursal_trans` = 1) AND 
			  (`status_trans` = 1) AND 
              (`ope_trans` = 'E') AND 
              (`fecha_trans` < NULL) AND 
              (`prod_detalle` = 633)
	) AS `stock_inicial`, 
    (
		SELECT coalesce(sum(cant_detalle),0) AS `saldo_anterior` 
        FROM `transaccion` INNER JOIN `trans_detalle` ON id_trans = trans_detalle 
        WHERE (`sucursal_trans` = 1) AND 
			  (`status_trans` = 1) AND 
              (`fecha_trans` < '2020-10-15') AND 
              (`prod_detalle` = 633)
	) AS `saldo_anterior`, 
    (
		SELECT coalesce(sum(cant_detalle),0) AS `salidas_anteriores` 
        FROM `transaccion` INNER JOIN `trans_detalle` ON id_trans = trans_detalle 
        WHERE (`sucursal_trans` = 1) AND 
			  (`status_trans` = 1) AND 
              (`fecha_trans` < '2020-10-15') AND 
              (`prod_detalle` = 633)
	) AS `salidas_anteriores`, 
    `p`.`stock_prod`, 
    `vp`.`stock_prod_bruto` 
FROM `transaccion` `t` 
inner join `trans_detalle` `td` ON t.id_trans = td.trans_detalle 
inner join `producto` `p` ON p.id_prod = td.prod_detalle 
inner join `v_productos` `vp` ON vp.id_prod = td.prod_detalle 
WHERE (`vp`.`id_prod` = 633) AND 
		  (`t`.`ope_trans` = 'S') AND 
          (`t`.`status_trans` = 1) AND 
          (`t`.`sucursal_trans` = 1) 
GROUP BY `vp`.`id_prod`, `vp`.`cod_prod`, `vp`.`des_prod`, `p`.`stock_prod`, `vp`.`stock_prod_bruto`;

SELECT 
	min(fecha_trans) AS `minFecha` 
FROM `transaccion` 
INNER JOIN `trans_detalle` ON id_trans = trans_detalle 
WHERE (`sucursal_trans` = 1) AND 
	  (`status_trans` = 1) AND 
      (`ope_trans` = 'E') AND 
      (`prod_detalle` = 633) AND 
      (`fecha_trans` BETWEEN '2020-10-15' AND '2020-10-15');


SELECT `id_prod`, `cod_prod`, `des_prod`, `fecha_trans`, `docref_trans`, `codigo_trans`, `ope_trans`, `id_tipom`, `des_tipom`, `id_tipod`, `des_tipod`, `ingreso_unidades`, `moneda`, `precio_compra_ext`, `precio_compra_soles`, `ingreso_valorizados`, `salidas_unidades`, `tipo`, `sucursal_trans` 
FROM (
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
) as sub WHERE (`sucursal_trans` = 1) AND (`id_prod` = '633') AND (`fecha_trans` BETWEEN '2020-03-01' AND '2020-04-01') ORDER BY `fecha_trans`;

select * from transaccion where  (`sucursal_trans` = 1) AND (`fecha_trans` BETWEEN '2020-09-01' AND '2020-09-30');

select * from salidas_ajustes;

SELECT 
	month(fecha_pedido) mes,
	concat(
			year(fecha_pedido),
            '-',
            month(fecha_pedido)
            ) mesAno,
	sum(total_pdetalle) AS `total` 
FROM `pedido` 
inner join pedido_detalle on id_pedido = pedido_pdetalle 
WHERE 
	(sucursal_pedido = 1) AND 
    (tipo_pedido = 'PR') AND 
    (year(fecha_pedido) = "2020") 
GROUP BY month(fecha_pedido),mesAno;

SELECT month(fecha_pedido) mes,
concat(
year(fecha_pedido),
'-',
month(fecha_pedido)
) mesAno,
sum(total_pdetalle) AS `total FROM `pedido` inner join `pedido_detalle ON id_pedido = pedido_pdetalle WHERE (sucursal_pedido = 1) AND (tipo_pedido = 'PR') AND (year(fecha_pedido) = "2020") GROUP BY month(fecha_pedido), mesAno;


select p.id_prod,p.des_prod 
from producto p ;

select id_prod,des_prod, stock_prod_bruto stock_total, stock_asignado, stock_prod stock_disponible, sucursal_prod  from v_productos;

-- Movimiento de productos

select 
	coalesce(( 
		select sum(td.cant_detalle)
		from transaccion t
		inner join trans_detalle td on t.id_trans = td.trans_detalle
		where fecha_trans < (
				select min(fecha_trans) 
				from transaccion t 
				inner join trans_detalle td on t.id_trans = td.trans_detalle 
				where t.ope_trans = 'E' and td.prod_detalle = 633 and status_trans = 1 and sucursal_trans = 1
		) and t.ope_trans = 'S' and td.prod_detalle = 633 and status_trans = 1 and sucursal_trans = 1
	),0) stock_inicial,
        coalesce(( 
		select sum(td.cant_detalle)
		from transaccion t
		inner join trans_detalle td on t.id_trans = td.trans_detalle
		where fecha_trans < (
				select min(fecha_trans) 
				from transaccion t 
				inner join trans_detalle td on t.id_trans = td.trans_detalle 
				where td.prod_detalle = 633 and status_trans = 1 and sucursal_trans = 1 and fecha_trans between '2019-11-01' and '2020-10-31'
		) and td.prod_detalle = 633
	),0) saldo_anterior,
    (			
			select sum(tdcc.cant_detalle) 
			from transaccion tcc 
			inner join trans_detalle tdcc on tcc.id_trans = tdcc.trans_detalle 
			where tcc.ope_trans = 'E' and tdcc.prod_detalle = 633 and tcc.status_trans = 1 and fecha_trans between '2019-11-01' and '2020-10-31' 
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
				where td.prod_detalle = 633 and t.status_trans = 1 and fecha_trans between '2019-11-01' and '2020-10-31'
		) and td.prod_detalle = 633
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
		where tcc.ope_trans = 'E' and tdcc.prod_detalle = 633 and tcc.status_trans = 1 and fecha_trans between '2019-11-01' and '2020-10-31' 
	) - sum(cant_detalle) stock_final  
from transaccion t 
inner join trans_detalle td on id_trans = trans_detalle 
inner join producto p on p.id_prod = td.prod_detalle
inner join v_productos vp on vp.id_prod = p.id_prod
where prod_detalle = 633 and ope_trans = 'S' and t.status_trans = 1 and fecha_trans between '2019-11-01' and '2020-10-31'
group by td.prod_detalle,p.stock_prod;



-- create view ent_sal_prod as 
select 
td.prod_detalle,
t.ope_trans,
sum(td.cant_detalle) cant_total,
coalesce(sum(si.stock_inicial),0) stock_inicial,
vp.stock_bruto,
vp.stock_asignado,
vp.stock_prod 
from transaccion t 
inner join trans_detalle td on id_trans = trans_detalle 
left join v_productos vp on vp.id_prod = td.prod_detalle
left join stock_prod_inicial si on td.prod_detalle = si.prod_detalle and t.fecha_trans = si.fecha_trans and t.sucursal_trans = si.sucursal_trans and t.ope_trans = si.ope_trans
where td.prod_detalle = 11 and t.status_trans = 1  
group by td.prod_detalle,t.ope_trans,vp.stock_prod,vp.stock_bruto,vp.stock_asignado;


select  id_prod,des_prod, ope_trans
from transaccion t 
inner join trans_detalle td on t.id_trans = td.trans_detalle
inner join v_productos vp on vp.id_prod = td.prod_detalle
where prod_detalle = 633;


