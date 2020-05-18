<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property int $id ID UNICO
 * @property int $user_id ID USER
 * @property string $nombre NOMBRE USUARIO
 * @property string $apellido APELLIDO USUARIO
 * @property int $empresa EMPRESA USUARIO
 * @property int $sucursal SUCURSAL USUARIO
 *
 * @property User $user
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'empresa', 'sucursal'], 'integer'],
            [['user_id', 'nombre', 'apellido','empresa', 'sucursal'], 'required'],
            [['nombre', 'apellido'], 'string', 'max' => 50],

            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'empresa' => Yii::t('empresa','Company'),
            'sucursal' => Yii::t('sucursal','Branch office'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getEmpresa0()
    {
        return $this->hasOne(Empresa::className(), ['id_empresa' => 'empresa']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getSucursal0()
    {
        return $this->hasOne(Sucursal::className(), ['id_suc' => 'sucursal']);
    }
}
