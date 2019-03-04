<?php
namespace app\components;
use Yii;
use yii\base\BaseObject;


class AutoIncrement extends BaseObject
{

  public function getAutoIncrement( $table ){
    $command = Yii::$app->db->createCommand('SHOW TABLE STATUS LIKE "'.$table.'"');

    $res=$command->queryOne();

    return !($res['Auto_increment']) ? 1 : $res['Auto_increment']++;
  }

}
