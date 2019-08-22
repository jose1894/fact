<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "numeracion".
 *
 * @property int $id_num ID UNICO
 * @property int $tipo_num TIPO NUMERACION
 * @property string $numero_num NUMERO NUMERACION
 * @property int $sucursal_num SUCURSAL NUMERACION
 * @property string $serie_num SERIE NUMERACION
 * @property int $status_num ESTATUS NUMERACION
 *
 * @property TipoDocumento $tipoNum
 */
class Numeracion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'numeracion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo_num', 'sucursal_num', 'status_num'], 'integer'],
            [['serie_num'], 'required'],
            [['numero_num'], 'string', 'max' => 10],
            [['serie_num'], 'string', 'max' => 4],
            [['tipo_num'], 'exist', 'skipOnError' => true, 'targetClass' => TipoDocumento::className(), 'targetAttribute' => ['tipo_num' => 'id_tipod']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_num' => Yii::t('numeracion', 'Id Num'),
            'tipo_num' => Yii::t('numeracion', 'Tipo Num'),
            'numero_num' => Yii::t('numeracion', 'Numero Num'),
            'sucursal_num' => Yii::t('numeracion', 'Sucursal Num'),
            'serie_num' => Yii::t('numeracion', 'Serie Num'),
            'status_num' => Yii::t('numeracion', 'Status Num'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoNum()
    {
        return $this->hasOne(TipoDocumento::className(), ['id_tipod' => 'tipo_num']);
    }
}
