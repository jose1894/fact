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

    public function beforeSave($insert)     
    {         
        if (parent::beforeSave($insert)) {             
            if ($this->isNewRecord) {                 
                // if it is new record save the current timestamp as created time                 
                $this->created_by = Yii::$app->user->id;
                $this->created_at = time();            
                return true;
            }                         
        
            // if it is new or update record save that timestamp as updated time            
            $this->updated_at = time();            
            $this->updated_by = Yii::$app->user->id;
            return true;         
        }         

        return false;   
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'empresa', 'sucursal'], 'integer'],
            [['user_id', 'nombre', 'apellido','empresa', 'sucursal'], 'required'],
            [['es_vendedor', 'vendedor'], 'integer'],
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
            'es_vendedor' => 'Es Vendedor',
            'vendedor' => Yii::t('vendedor', 'Seller'),
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
    public function getVendedor()
    {
        return $this->hasOne(Vendedor::className(), ['id_vendedor' => 'vendedor']);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getSucursal0()
    {
        return $this->hasOne(Sucursal::className(), ['id_suc' => 'sucursal']);
    }
}
