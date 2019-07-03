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

  public function getAutoIncrementPad( $table, $field, $value ){

    $command = Yii::$app->db->createCommand("SELECT MAX(id_pedido) AS maximo FROM {$table} WHERE $field = {$value}");

    $res=$command->queryOne();

    $res['maximo'] = (int) $res['maximo'];

    $cod =  is_null($res['maximo']) || $res['maximo'] == 0 ? 1 : ++$res['maximo'];

    return str_pad($cod,10,'0',STR_PAD_LEFT);
  }



}
