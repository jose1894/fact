<?php
dmstr\web\AdminLteAsset::register($this);
app\assets\AdminLtePluginAsset::register($this);
app\assets\AdminLteInitAsset::register($this);
app\assets\AppAsset::register($this);
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

dmstr\web\AdminLteAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
  <style media="screen">
  body {
    margin: 0 0;
  }
  .top-square{
    background:#3c8dbc;
    width: 100%;
    height: 80vh;
    position: absolute;
    transform: skewY(-5deg);
    top: -42px;
  }
  .login-page{
    /* width: 200px;
    height: 200px; */
    position:absolute;
    left: 50%;
    top:20%;
    transform: translate(-50%, -20%);
  }
  </style>
  <header>
      <div class="top-square">
      </div>
      <div class="login-page">
        <?php  $this->beginBody() ?>

            <?= $content ?>

        <?php $this->endBody() ?>
      </div>



  </header>
</body>
</html>
<?php $this->endPage() ?>
