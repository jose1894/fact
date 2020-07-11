<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?php echo Yii::$app->user->identity->profiles->nombre. " " . Yii::$app->user->identity->profiles->apellido?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <!--form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form-->
        <!-- /.search form -->
        <?php
          use mdm\admin\components\MenuHelper;
        ?>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Usuarios', 'options' => ['class' => 'header'] ],
                    [ 'label' => 'Administracion de usuarios', 'icon' => 'users',
                     'items' => [
                              [ 'label' => Yii::t('app','Users'), 'url' => ['/admin/user'], 'visible' => Yii::$app->user->can('/admin/user/index')],
                              [ 'label' => Yii::t('profile','Profiles'), 'url' => ['/profile/update'], 'visible' => Yii::$app->user->can('/profile/update')],
                              [ 'label' => 'Rutas', 'url' => ['/admin/route'], 'visible' => Yii::$app->user->can('/admin/route/index')],
                              [ 'label' => 'Permisos', 'url' => ['/admin/permission'], 'visible' => Yii::$app->user->can('/admin/permission/index')],
                              [ 'label' => 'Menus', 'url' => ['/admin/menu'], 'visible' => Yii::$app->user->can('/admin/menu/index')],
                              [ 'label' => 'Roles', 'url' => ['/admin/role'], 'visible' => Yii::$app->user->can('/admin/role/index')],
                              [ 'label' => 'Asignaciones', 'url' => ['/admin/assignment'], 'visible' => Yii::$app->user->can('/admin/assignment/index')],
                      ],
                    ],
                    ['label' => 'Menu', 'options' => ['class' => 'header']],
                    [
                      'label' => Yii::t('app','Set Up') , 'icon' => 'gears',
                      'items' => [
                        ['label' => Yii::t('empresa','Company'), 'url' => ['/empresa'], 'icon' => 'industry', 'visible' => Yii::$app->user->can('/empresa/index')],
                        ['label' => Yii::t('app', 'Maintenance'), 'icon' => 'gears',
                          'items' => [
                            ['label' => Yii::t('tipo_producto','Product types'), 'url' => ['/tipo-producto'], 'icon' => 'cube', 'visible' => Yii::$app->user->can('/tipo-producto/index')],
                            ['label' => Yii::t('transportista','Carrier'), 'url' => ['/transportista'], 'icon' => 'truck', 'visible' => Yii::$app->user->can('/transportista/index')],
                            ['label' => Yii::t('unidad_transporte','Transport unit'), 'url' => ['/unidad-transporte'], 'icon' => 'truck', 'visible' => Yii::$app->user->can('/unidad-transporte/index')],
                            ['label' => Yii::t('tipo_movimiento','Movement type'), 'url' => ['/tipo-movimiento'], 'icon' => 'exchange', 'visible' => Yii::$app->user->can('/tipo-movimiento/index')],
                            ['label' => Yii::t('tipo_documento','Document type'), 'url' => ['/tipo-documento'], 'icon' => 'list', 'visible' => Yii::$app->user->can('/tipo-documento/index')],
                            ['label' => Yii::t('serie','Series'), 'url' => ['/series'], 'icon' => 'tachometer', 'visible' => Yii::$app->user->can('/series/index')],
                            ['label' => Yii::t('zona','Zone'), 'url' => ['/zona'], 'icon' => 'map-signs', 'visible' => Yii::$app->user->can('/zona/index')],
                            ['label' => Yii::t('condicionp','Payment condition'), 'url' => ['/cond-pago'], 'icon' => 'ticket', 'visible' => Yii::$app->user->can('/cond-pago/index')],
                            ['label' => Yii::t('unidad_medida','Unit of measurement'), 'url' => ['/unidad-medida'], 'icon' => 'balance-scale', 'visible' => Yii::$app->user->can('/unidad-medida/index')],
                            ['label' => Yii::t('moneda','Currency'), 'url' => ['/moneda'], 'icon' => 'money', 'visible' => Yii::$app->user->can('/moneda/index')],
                            ['label' => Yii::t('almacen','Warehouse'), 'url' => ['/almacen'], 'icon' => 'archive', 'visible' => Yii::$app->user->can('/almacen/index')],
                            ['label' => Yii::t('app', 'Ubication tables'), 'icon' => 'globe',
                                'items' =>[
                                            ['label' => Yii::t('pais','Country'), 'url' => ['/pais'], 'icon' => 'ticket', 'visible' => Yii::$app->user->can('/pais/index')],
                                            ['label' => Yii::t('provincia','Estate / Province'), 'url' => ['/provincia'], 'icon' => 'ticket', 'visible' => Yii::$app->user->can('/provincia/index')],
                                            ['label' => Yii::t('departamento','Department / County / Municipality'), 'url' => ['/departamento'], 'icon' => 'ticket', 'visible' => Yii::$app->user->can('/departamento/index')],
                                            ['label' => Yii::t('distrito','Disctrit / Parish'), 'url' => ['/distrito'], 'icon' => 'ticket', 'visible' => Yii::$app->user->can('/distrito/index')],
                                          ]
                            ]
                          ]
                        ],
                        ['label' => Yii::t('vendedor','Seller'), 'url' => ['/vendedor'], 'icon' => 'user', 'visible' => Yii::$app->user->can('/vendedor/index')],
                        ['label' => Yii::t('cliente','Customer'), 'url' => ['/cliente'], 'icon' => 'users', 'visible' => Yii::$app->user->can('/cliente/index')],
                        ['label' => Yii::t('proveedor','Supplier'), 'url' => ['/proveedor'], 'icon' => 'suitcase', 'visible' => Yii::$app->user->can('/proveedor/index')],
                        ['label' => Yii::t('producto','Product'), 'url' => ['/producto'], 'icon' => 'tags', 'visible' => Yii::$app->user->can('/producto/index')],
                        ['label' => Yii::t('serie','Numeration'), 'url' => ['/numeracion'], 'icon' => 'tachometer', 'visible' => Yii::$app->user->can('/numeracion/index')],
                      ]
                    ],
                    ['label' => Yii::t('tipo_cambio', 'Exchange'), 'icon' => 'money', 'url' => ['/tipo-cambio/'], 'visible' => Yii::$app->user->can('/tipo-cambio/index')],
                    ['label' => Yii::t('app', 'Sales'), 'icon' => 'inbox',
                      'items' => [
                        ['label' => Yii::t('pedido','Order').'s', 'url' => ['/pedido'], 'icon' => 'inbox', 'visible' => Yii::$app->user->can('/pedido/index')],
                        [ 'label' => Yii::t('documento','Sales report'), 'url' => ['/documento/reporte-ventas'],'icon' => 'play-circle', 'visible' => Yii::$app->user->can('/documento/reporte-ventas')],
                        [ 'label' => Yii::t('documento','Orders to bill'), 'url' => ['/documento/pedidos-pendientes'],'icon' => 'play-circle', 'visible' => Yii::$app->user->can('/documento/pedidos-pendientes')],
                        [ 'label' => Yii::t('documento','Send proforma'), 'url' => ['/documento/proforma-pendientes'], 'icon' => 'check', 'visible' => Yii::$app->user->can('/documento/proforma-pendientes')],
                        [ 'label' => Yii::t('documento','Credit note'), 'url' => ['/nota-credito/index'], 'icon' => 'edit', 'visible' => Yii::$app->user->can('/nota-credito/index')],
                        [ 'label' => Yii::t('documento','Document list'), 'url' => ['/documento/listado-factura'], 'icon' => 'bar-chart-o', 'visible' => Yii::$app->user->can('/documento/listado-factura')],
                        [ 'label' => Yii::t('documento','Cancel documents'), 'url' => ['/documento/listado-anular-documento'], 'icon' => 'minus-circle', 'visible' => Yii::$app->user->can('/documento/listado-anular-documento')],

                      ]
                    ],
                    ['label' => Yii::t('app', 'Shopping'), 'icon' => 'shopping-cart',
                    'items' => [
                        ['label' => Yii::t('compra','Purchase order').'s', 'url' => ['/compra'], 'icon' => 'shopping-cart', 'visible' => Yii::$app->user->can('/compra/index')],
                      ]
                    ],
                    ['label' => Yii::t('app','Inventory'), 'icon' => 'archive',
                      'items' =>[
                            [ 'label' => Yii::t('ingreso','Entry note'), 'url' => ['/nota-ingreso'],'icon' => 'download', 'visible' => Yii::$app->user->can('/nota-ingreso/index')],
                            [ 'label' => Yii::t('salida','Exit note'), 'url' => ['/nota-salida'],'icon' => 'upload', 'visible' => Yii::$app->user->can('/nota-salida/index')],
                          [ 'label' => Yii::t('app','Product movement'), 'url' => ['/rpts/kardex'],'icon' => 'random', /*'visible' => Yii::$app->user->can('/site/kardex')*/],
                          ]
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
