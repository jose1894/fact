<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <?php
          use mdm\admin\components\MenuHelper;
        ?>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    [
                      'label' => Yii::t('app','Set Up') , 'icon' => 'gears',
                      'items' => [
                        ['label' => Yii::t('empresa','Company'), 'url' => ['/empresa'], 'icon' => 'industry'],
                        ['label' => Yii::t('app', 'Maintenance'), 'icon' => 'gears',
                          'items' => [
                            ['label' => Yii::t('tipo_producto','Product types'), 'url' => ['/tipo-producto'], 'icon' => 'cube'],
                            ['label' => Yii::t('tipo_movimiento','Movement type'), 'url' => ['/tipo-movimiento'], 'icon' => 'exchange'],
                            ['label' => Yii::t('tipo_documento','Document type'), 'url' => ['/tipo-documento'], 'icon' => 'list'],
                            ['label' => Yii::t('zona','Zone'), 'url' => ['/zona'], 'icon' => 'map-signs'],
                            ['label' => Yii::t('condicionp','Payment condition'), 'url' => ['/cond-pago'], 'icon' => 'ticket'],
                            ['label' => Yii::t('unidad_medida','Unit of measurement'), 'url' => ['/unidad-medida'], 'icon' => 'balance-scale'],
                            ['label' => Yii::t('moneda','Currency'), 'url' => ['/moneda'], 'icon' => 'money'],
                            ['label' => Yii::t('almacen','Warehouse'), 'url' => ['/almacen'], 'icon' => 'archive'],
                            ['label' => Yii::t('app', 'Ubication tables'), 'icon' => 'globe',
                                'items' =>[
                                            ['label' => Yii::t('pais','Country'), 'url' => ['/pais'], 'icon' => 'ticket'],
                                            ['label' => Yii::t('provincia','Estate / Province'), 'url' => ['/provincia'], 'icon' => 'ticket'],
                                            ['label' => Yii::t('departamento','Department / County / Municipality'), 'url' => ['/departamento'], 'icon' => 'ticket'],
                                            ['label' => Yii::t('distrito','Disctrit / Parish'), 'url' => ['/distrito'], 'icon' => 'ticket'],
                                          ]
                            ]
                          ]
                        ],
                        ['label' => Yii::t('vendedor','Seller'), 'url' => ['/vendedor'], 'icon' => 'user'],
                        ['label' => Yii::t('cliente','Customer'), 'url' => ['/cliente'], 'icon' => 'users'],
                        ['label' => Yii::t('proveedor','Supplier'), 'url' => ['/proveedor'], 'icon' => 'suitcase'],
                        ['label' => Yii::t('producto','Product'), 'url' => ['/producto'], 'icon' => 'tags'],
                      ]
                    ],
                    ['label' => Yii::t('pedido','Order').'s', 'url' => ['/pedido'], 'icon' => 'inbox'],
                    ['label' => Yii::t('compra','Purchase order').'s', 'url' => ['/compra'], 'icon' => 'shopping-cart'],
                    ['label' => Yii::t('app','Inventory'), 'icon' => 'archive',
                      'items' =>[
                            [ 'label' => Yii::t('ingreso','Entry note'), 'url' => ['/nota-ingreso'],'icon' => 'download'],
                            [ 'label' => Yii::t('salida','Exit note'), 'url' => ['/nota-salida'],'icon' => 'upload'],
                          ]
                    ],
                    ['label' => 'Usuarios', 'options' => ['class' => 'header']],
                    [ 'label' => 'Administracion de usuarios', 'icon' => 'users',
                     'items' => [
                              [ 'label' => 'Usuarios', 'url' => ['/admin/user']],
                              [ 'label' => 'Rutas', 'url' => ['/admin/route']],
                              [ 'label' => 'Permisos', 'url' => ['/admin/permission']],
                              [ 'label' => 'Menus', 'url' => ['/admin/menu']],
                              [ 'label' => 'Roles', 'url' => ['/admin/role']],
                              [ 'label' => 'Asignaciones', 'url' => ['/admin/assignment']],
                      ],
                    ],
                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],

                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Some tools',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
