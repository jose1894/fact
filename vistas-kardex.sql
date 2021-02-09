    ALTER view entradas_ajustes as 
    select `p`.`id_prod` AS `id_prod`,`p`.`cod_prod` AS `cod_prod`,`p`.`des_prod` AS `des_prod`,`t`.`fecha_trans` AS `fecha_trans`,`t`.`docref_trans` AS `docref_trans`,concat(`tds`.`abrv_tipod`,`nd`.`serie_num`,'-',substr(`t`.`codigo_trans`,4,8)) AS `nro_doc`,'ENTRADA' AS `ope_trans`,`tm`.`id_tipom` AS `id_tipom`,`tm`.`des_tipom` AS `des_tipom`,`tds`.`id_tipod` AS `id_tipod`,`tds`.`des_tipod` AS `des_tipod`,`td`.`cant_detalle` AS `ingreso_unidades`,`m`.`des_moneda` AS `moneda`,sum(`td`.`costo_detalle`) AS `precio`,'' AS `salidas_unidades`,'' AS `tipo_pedido`,`t`.`sucursal_trans` AS `sucursal_trans`,`t`.`id_trans` AS `id_trans` 
    from (((((((`transaccion` `t` 
				join `trans_detalle` `td` on((`t`.`id_trans` = `td`.`trans_detalle`))) 
                join `producto` `p` on(((`p`.`id_prod` = `td`.`prod_detalle`) and (`t`.`sucursal_trans` = `p`.`sucursal_prod`)))) 
                join `tipo_movimiento` `tm` on(((`tm`.`id_tipom` = `t`.`tipo_trans`) and (`t`.`sucursal_trans` = `tm`.`sucursal_tipom`)))) 
                join `numeracion` `nd` on(((`t`.`numdoc_trans` = `nd`.`id_num`) and (`t`.`sucursal_trans` = `nd`.`sucursal_num`)))) 
                join `tipo_documento` `tds` on(((`nd`.`tipo_num` = `tds`.`id_tipod`) and (`t`.`sucursal_trans` = `tds`.`sucursal_tipod`)))) 
                join `moneda` `m` on(((`m`.`id_moneda` = `t`.`moneda_trans`) and (`t`.`sucursal_trans` = `m`.`sucursal_moneda`)))) 
                left join `documento` on(((`t`.`idrefdoc_trans` = `documento`.`id_doc`) and (`documento`.`status_doc` in (2,3)) and (`t`.`sucursal_trans` = `documento`.`sucursal_doc`)))) 
		where (`t`.`tipo_trans` in (1,5,9,11) and status_trans = 1) 
        group by `p`.`id_prod`,`p`.`cod_prod`,`p`.`des_prod`,`t`.`fecha_trans`,`t`.`docref_trans`,`tds`.`abrv_tipod`,`nd`.`serie_num`,`t`.`codigo_trans`,`tm`.`id_tipom`,`tm`.`des_tipom`,`tds`.`id_tipod`,`tds`.`des_tipod`,`td`.`cant_detalle`,`m`.`des_moneda`,`t`.`sucursal_trans`,`t`.`id_trans`;
    
    
    alter view entradas_compras as
    select `p`.`id_prod` AS `id_prod`,`p`.`cod_prod` AS `cod_prod`,`p`.`des_prod` AS `des_prod`,`t`.`fecha_trans` AS `fecha_trans`,`pr`.`nombre_prove` AS `nombre_prove`,concat(`tds`.`abrv_tipod`,`numeracion`.`serie_num`,'-',substr(`c`.`cod_compra`,4,8)) AS `nro_doc`,'ENTRADA' AS `ope_trans`,`tm`.`id_tipom` AS `id_tipom`,`tm`.`des_tipom` AS `des_tipom`,`tds`.`id_tipod` AS `id_tipod`,`tds`.`des_tipod` AS `des_tipod`,`td`.`cant_detalle` AS `ingreso_unidades`,`m`.`des_moneda` AS `des_moneda`,sum(`td`.`costo_detalle`) AS `precio`,'' AS `salidas_unidades`,'' AS `tipo_pedido`,`t`.`sucursal_trans` AS `sucursal_trans`,`t`.`id_trans` AS `id_trans` 
    from ((((((((((`transaccion` `t` 
					join `trans_detalle` `td` on((`t`.`id_trans` = `td`.`trans_detalle`))) 
                    join `compra` `c` on(((`c`.`id_compra` = `t`.`idrefdoc_trans`) and (`c`.`sucursal_compra` = `t`.`sucursal_trans`)))) 
                    join `compra_detalle` `cd` on((`c`.`id_compra` = `cd`.`compra_cdetalle`))) 
                    join `producto` `p` on(((`p`.`id_prod` = `td`.`prod_detalle`) and (`t`.`sucursal_trans` = `p`.`sucursal_prod`) and (`cd`.`prod_cdetalle` = `td`.`prod_detalle`)))) 
                    join `proveedor` `pr` on(((`pr`.`id_prove` = `c`.`provee_compra`) and (`pr`.`sucursal_prove` = `t`.`sucursal_trans`)))) 
                    join `tipo_movimiento` `tm` on(((`tm`.`id_tipom` = `t`.`tipo_trans`) and (`tm`.`sucursal_tipom` = `t`.`sucursal_trans`)))) 
                    left join `moneda` `m` on(((`t`.`moneda_trans` = `m`.`id_moneda`) and (`t`.`sucursal_trans` = `m`.`sucursal_moneda`)))) 
                    join `tipo_cambio` on(((`c`.`fecha_compra` = `tipo_cambio`.`fecha_tipoc`) and (`t`.`sucursal_trans` = `tipo_cambio`.`sucursal_tipoc`)))) 
                    join `numeracion` on(((`t`.`numdoc_trans` = `numeracion`.`id_num`) and (`t`.`sucursal_trans` = `numeracion`.`sucursal_num`)))) 
                    join `tipo_documento` `tds` on(((`numeracion`.`tipo_num` = `tds`.`id_tipod`) and (`t`.`sucursal_trans` = `tds`.`sucursal_tipod`)))) 
			where (`t`.`ope_trans` = 'E' and status_trans = 1) 
            group by `p`.`id_prod`,`p`.`cod_prod`,`p`.`des_prod`,`t`.`fecha_trans`,`pr`.`nombre_prove`,`tds`.`abrv_tipod`,`numeracion`.`serie_num`,`c`.`cod_compra`,`tm`.`id_tipom`,`tm`.`des_tipom`,`tds`.`id_tipod`,`tds`.`des_tipod`,`td`.`cant_detalle`,`m`.`des_moneda`,`t`.`sucursal_trans`,`t`.`id_trans`;
    
    alter view salidas_documentos as 
    select `producto`.`id_prod` AS `id_prod`,`producto`.`cod_prod` AS `cod_prod`,`producto`.`des_prod` AS `des_prod`,`t`.`fecha_trans` AS `fecha_trans`,`cliente`.`nombre_clte` AS `nombre_clte`,concat(`tipo_documento`.`abrv_tipod`,`numeracion`.`serie_num`,'-',substr(`documento`.`cod_doc`,4,8)) AS `nro_documento`,'SALIDA' AS `ope_trans`,`tipo_movimiento`.`id_tipom` AS `id_tipom`,`tipo_movimiento`.`des_tipom` AS `des_tipom`,`tds`.`id_tipod` AS `id_tipod`,`tds`.`des_tipod` AS `des_tipod`,'' AS `ingreso_unidades`,'' AS `moneda`,'' AS `precio`,`td`.`cant_detalle` AS `salidas_unidades`,`pedido`.`tipo_pedido` AS `tipo_pedido`,`t`.`sucursal_trans` AS `sucursal_trans`,`t`.`id_trans` AS `id_trans` 
    from ((((((((((`transaccion` `t` 
					join `trans_detalle` `td` on((`t`.`id_trans` = `td`.`trans_detalle`))) 
                    join `producto` on(((`td`.`prod_detalle` = `producto`.`id_prod`) and (`producto`.`status_prod` = 1) and (`t`.`sucursal_trans` = `producto`.`sucursal_prod`)))) 
                    join `tipo_movimiento` on(((`t`.`tipo_trans` = `tipo_movimiento`.`id_tipom`) and (`tipo_movimiento`.`status_tipom` = 1) and (`tipo_movimiento`.`id_tipom` not in (8,6)) and (`t`.`sucursal_trans` = `tipo_movimiento`.`sucursal_tipom`)))) join `documento` on(((`t`.`idrefdoc_trans` = `documento`.`id_doc`) and (`documento`.`status_doc` in (2,3)) and (`t`.`sucursal_trans` = `documento`.`sucursal_doc`)))) 
                    join `pedido` on(((`documento`.`pedido_doc` = `pedido`.`id_pedido`) and (`pedido`.`estatus_pedido` in (2,3,4)) and (`t`.`sucursal_trans` = `pedido`.`sucursal_pedido`)))) 
                    join `cliente` on(((`pedido`.`clte_pedido` = `cliente`.`id_clte`) and (`t`.`sucursal_trans` = `cliente`.`sucursal_clte`)))) 
                    join `numeracion` on(((`documento`.`numeracion_doc` = `numeracion`.`id_num`) and (`t`.`sucursal_trans` = `numeracion`.`sucursal_num`)))) 
                    join `numeracion` `nd` on(((`t`.`numdoc_trans` = `nd`.`id_num`) and (`t`.`sucursal_trans` = `nd`.`sucursal_num`)))) 
                    join `tipo_documento` on(((`numeracion`.`tipo_num` = `tipo_documento`.`id_tipod`) and (`t`.`sucursal_trans` = `tipo_documento`.`sucursal_tipod`)))) 
                    join `tipo_documento` `tds` on(((`nd`.`tipo_num` = `tds`.`id_tipod`) and (`t`.`sucursal_trans` = `tds`.`sucursal_tipod`)))) 
	where (`t`.`ope_trans` = 'S') and status_trans = 1
    group by `producto`.`id_prod`,`producto`.`cod_prod`,`producto`.`des_prod`,`t`.`fecha_trans`,`cliente`.`nombre_clte`,`tipo_documento`.`abrv_tipod`,`numeracion`.`serie_num`,`documento`.`cod_doc`,`tipo_movimiento`.`id_tipom`,`tipo_movimiento`.`des_tipom`,`tds`.`id_tipod`,`tds`.`des_tipod`,`pedido`.`tipo_pedido`,`td`.`cant_detalle`,`t`.`sucursal_trans`,`t`.`id_trans` order by `documento`.`cod_doc`,`producto`.`id_prod`;
    
    alter view entradas_documentos as 
    select `p`.`id_prod` AS `id_prod`,`p`.`cod_prod` AS `cod_prod`,`p`.`des_prod` AS `des_prod`,`t`.`fecha_trans` AS `fecha_trans`,`cliente`.`nombre_clte` AS `nombre_clte`,concat(`tds`.`abrv_tipod`,`nd`.`serie_num`,'-',substr(`d`.`cod_doc`,4,8)) AS `nro_doc`,'ENTRADA' AS `ope_trans`,`tm`.`id_tipom` AS `id_tipom`,`tm`.`des_tipom` AS `des_tipom`,`tds`.`id_tipod` AS `id_tipod`,`tds`.`des_tipod` AS `des_tipod`,`td`.`cant_detalle` AS `ingreso_unidades`,`moneda`.`des_moneda` AS `moneda`,sum(`td`.`costo_detalle`) AS `precio_compra_ext`,'' AS `salidas_unidades`,'' AS `tipo_pedido`,`t`.`sucursal_trans` AS `sucursal_trans`,`t`.`id_trans` AS `id_trans` 
    from ((((((((((`transaccion` `t` 
					join `trans_detalle` `td` on((`t`.`id_trans` = `td`.`trans_detalle`))) 
                    join `producto` `p` on(((`p`.`id_prod` = `td`.`prod_detalle`) and (`t`.`sucursal_trans` = `p`.`sucursal_prod`)))) 
                    join `tipo_movimiento` `tm` on(((`tm`.`id_tipom` = `t`.`tipo_trans`) and (`t`.`sucursal_trans` = `tm`.`sucursal_tipom`)))) 
                    join `numeracion` `nd` on(((`t`.`numdoc_trans` = `nd`.`id_num`) and (`t`.`sucursal_trans` = `nd`.`sucursal_num`)))) 
                    join `tipo_documento` `tds` on(((`nd`.`tipo_num` = `tds`.`id_tipod`) and (`t`.`sucursal_trans` = `tds`.`sucursal_tipod`)))) 
                    join `documento` `d` on(((`d`.`id_doc` = `t`.`idrefdoc_trans`) and (`t`.`sucursal_trans` = `d`.`sucursal_doc`)))) 
                    join `documento` `dp` on(((`dp`.`id_doc` = `d`.`docref_doc`) and (`dp`.`sucursal_doc` = `t`.`sucursal_trans`)))) 
                    join `pedido` on(((`dp`.`pedido_doc` = `pedido`.`id_pedido`) and (`pedido`.`sucursal_pedido` = `t`.`sucursal_trans`)))) 
                    join `moneda` on(((`moneda`.`id_moneda` = `t`.`moneda_trans`) and (`t`.`sucursal_trans` = `moneda`.`sucursal_moneda`)))) 
                    join `cliente` on(((`pedido`.`clte_pedido` = `cliente`.`id_clte`) and (`t`.`sucursal_trans` = `cliente`.`sucursal_clte`)))) 
	where (`t`.`tipo_trans` = 7) and status_trans = 1
    group by `p`.`id_prod`,`p`.`cod_prod`,`p`.`des_prod`,`t`.`fecha_trans`,`cliente`.`nombre_clte`,`tds`.`abrv_tipod`,`nd`.`serie_num`,`d`.`cod_doc`,`tm`.`id_tipom`,`tm`.`des_tipom`,`tds`.`id_tipod`,`tds`.`des_tipod`,`td`.`cant_detalle`,`moneda`.`des_moneda`,`t`.`sucursal_trans`,`t`.`id_trans`;
    
    alter view salidas_ajustes as 
    select `p`.`id_prod` AS `id_prod`,`p`.`cod_prod` AS `cod_prod`,`p`.`des_prod` AS `des_prod`,`t`.`fecha_trans` AS `fecha_trans`,`t`.`docref_trans` AS `docref_trans`,concat(`tds`.`abrv_tipod`,`nd`.`serie_num`,'-',substr(`t`.`codigo_trans`,4,8)) AS `codigo_trans`,'SALIDA' AS `ope_trans`,`tm`.`id_tipom` AS `id_tipom`,`tm`.`des_tipom` AS `des_tipom`,`tds`.`id_tipod` AS `id_tipod`,`tds`.`des_tipod` AS `des_tipod`,'' AS `ingreso_unidades`,'' AS `moneda`,'' AS `precio`,`td`.`cant_detalle` AS `salidas_unidades`,'' AS `tipo`,`t`.`sucursal_trans` AS `sucursal_trans`,`t`.`id_trans` AS `id_trans` 
    from ((((((`transaccion` `t` join `trans_detalle` `td` on((`t`.`id_trans` = `td`.`trans_detalle`))) 
				join `producto` `p` on(((`p`.`id_prod` = `td`.`prod_detalle`) and (`t`.`sucursal_trans` = `p`.`sucursal_prod`)))) 
                join `tipo_movimiento` `tm` on(((`tm`.`id_tipom` = `t`.`tipo_trans`) and (`t`.`sucursal_trans` = `tm`.`sucursal_tipom`)))) 
                join `numeracion` `nd` on(((`t`.`numdoc_trans` = `nd`.`id_num`) and (`t`.`sucursal_trans` = `nd`.`sucursal_num`)))) 
                join `tipo_documento` `tds` on(((`nd`.`tipo_num` = `tds`.`id_tipod`) and (`t`.`sucursal_trans` = `tds`.`sucursal_tipod`)))) 
                left join `documento` on(((`t`.`idrefdoc_trans` = `documento`.`id_doc`) and (`documento`.`status_doc` in (2,3)) and (`t`.`sucursal_trans` = `documento`.`sucursal_doc`)))) 
			where ((`t`.`tipo_trans` in (2,6,10)) and isnull(`documento`.`id_doc`) and status_trans = 1) 
            group by `p`.`id_prod`,`p`.`cod_prod`,`p`.`des_prod`,`t`.`fecha_trans`,`t`.`docref_trans`,`tds`.`abrv_tipod`,`nd`.`serie_num`,`t`.`codigo_trans`,`tm`.`id_tipom`,`tm`.`des_tipom`,`tds`.`id_tipod`,`tds`.`des_tipod`,`t`.`fecha_trans`,`td`.`cant_detalle`,`t`.`sucursal_trans`,`t`.`id_trans` order by `t`.`id_trans`;
    
    alter view salidas_proformas as 
    select `producto`.`id_prod` AS `id_prod`,`producto`.`cod_prod` AS `cod_prod`,`producto`.`des_prod` AS `des_prod`,`t`.`fecha_trans` AS `fecha_trans`,`cliente`.`nombre_clte` AS `nombre_clte`,concat(`tds`.`abrv_tipod`,`nd`.`serie_num`,'-',substr(`t`.`codigo_trans`,4,8)) AS `codigo_trans`,'SALIDA' AS `OPE_TRANS`,`tipo_movimiento`.`id_tipom` AS `id_tipom`,`tipo_movimiento`.`des_tipom` AS `des_tipom`,`tds`.`id_tipod` AS `id_tipod`,`tds`.`des_tipod` AS `des_tipod`,'' AS `ingreso_unidades`,'' AS `moneda`,'' AS `precio`,`td`.`cant_detalle` AS `salidas_unidades`,`pedido`.`tipo_pedido` AS `tipo_pedido`,`t`.`sucursal_trans` AS `sucursal_trans`,`t`.`id_trans` AS `id_trans` 
    from (((((((`transaccion` `t` 
				join `trans_detalle` `td` on((`t`.`id_trans` = `td`.`trans_detalle`))) 
                join `producto` on(((`td`.`prod_detalle` = `producto`.`id_prod`) and (`producto`.`status_prod` = 1) and (`t`.`sucursal_trans` = `producto`.`sucursal_prod`)))) 
                left join `tipo_movimiento` on(((`t`.`tipo_trans` = `tipo_movimiento`.`id_tipom`) and (`tipo_movimiento`.`status_tipom` = 1) and (`t`.`sucursal_trans` = `tipo_movimiento`.`sucursal_tipom`)))) 
                left join `pedido` on(((`pedido`.`id_pedido` = `t`.`idrefdoc_trans`) and (`pedido`.`estatus_pedido` = 3) and (`t`.`sucursal_trans` = `pedido`.`sucursal_pedido`)))) 
                join `cliente` on(((`pedido`.`clte_pedido` = `cliente`.`id_clte`) and (`t`.`sucursal_trans` = `cliente`.`sucursal_clte`)))) 
                join `numeracion` `nd` on(((`t`.`numdoc_trans` = `nd`.`id_num`) and (`t`.`sucursal_trans` = `nd`.`sucursal_num`)))) 
                join `tipo_documento` `tds` on(((`nd`.`tipo_num` = `tds`.`id_tipod`) and (`t`.`sucursal_trans` = `tds`.`sucursal_tipod`)))) 
	where ((`t`.`ope_trans` = 'S') and (`tipo_movimiento`.`id_tipom` = 8) and status_trans =1) 
    group by `producto`.`id_prod`,`producto`.`cod_prod`,`producto`.`des_prod`,`t`.`fecha_trans`,`cliente`.`id_clte`,`cliente`.`nombre_clte`,`tds`.`abrv_tipod`,`nd`.`serie_num`,`t`.`codigo_trans`,`t`.`id_trans`,`t`.`idrefdoc_trans`,`pedido`.`cod_pedido`,`tipo_movimiento`.`id_tipom`,`tipo_movimiento`.`des_tipom`,`tds`.`id_tipod`,`tds`.`des_tipod`,`pedido`.`tipo_pedido`,`td`.`cant_detalle`,`t`.`sucursal_trans`,`t`.`id_trans` order by `pedido`.`cod_pedido`,`producto`.`id_prod`;