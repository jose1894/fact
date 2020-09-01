<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Sign In';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>
<div class="container">
  <div class="row">
    <div class="col-xs-12 col-md-6 col-align col-align--center" style="height:300px">
        <div class="text-center" style="position: relative;
    top: 50%;
    -webkit-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);">

          <span class="fa-stack fa-4x text-center">
            <i class="fa fa-circle fa-stack-2x text-primary"></i>
            <i class="fa fa-laptop fa-stack-1x fa-inverse"></i>
          </span>
          <h1 class="text-center" style=""><b><?= Yii::t( 'app', Yii::$app->name ) ?></b></h1>
        </div>
    </div>
    <div class="col-xs-12 col-md-6">
      <div class="login-box">
          <div class="login-box-body">
              <p class="login-box-msg"><?= Yii::t( 'app', 'Sign in to start your session') ?></p>

              <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

              <?= $form
                  ->field($model, 'username', $fieldOptions1)
                  ->label(false)
                  ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>

              <?= $form
                  ->field($model, 'password', $fieldOptions2)
                  ->label(false)
                  ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

              <div class="row">
                  <!-- <div class="col-xs-8">
                      <?php /* $form->field($model, 'rememberMe')->checkbox() */?>
                  </div> -->
                  <!-- /.col -->
                  <div class="col-xs-offset-8 col-xs-4">
                      <?= Html::submitButton(Yii::t( 'app', 'Sign in' ), ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
                  </div>
                  <!-- /.col -->
              </div>


              <?php ActiveForm::end(); ?>

              <!--div class="social-auth-links text-center">
                  <p>- OR -</p>
                  <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in
                      using Facebook</a>
                  <a href="#" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i> Sign
                      in using Google+</a>
              </div-->
              <!-- /.social-auth-links -->

              <!-- <a href="#">I forgot my password</a><br>
              <a href="<?= Url::to(['site/signup'])?>" class="text-center">Register a new membership</a> -->

          </div>
          <!-- /.login-box-body -->
      </div><!-- /.login-box -->

    </div>
  </div>

</div>



</div>
