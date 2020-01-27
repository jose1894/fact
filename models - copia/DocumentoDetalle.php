<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "documento_detalle".
 *
 * @property int $id_ddetalle ID UNICO
 * @property int $prod_ddetalle PRODUCTO DOCUMENTO DETALLE
 * @property string $cant_ddetalle CANTIDAD DOCUMENTO DETALLE
 * @property string $precio_ddetalle PRECIO DOCUMENTO DETALLE
 * @property string $descu_ddetalle DESCUENTO % DOCUMENTO DETALLE
 * @property string $impuesto_ddetalle IMPUESTO DOCUMENTO DETALLE
 * @property int $status_ddetalle ESTATUS DOCUMENTO DETALLE
 * @property int $documento_ddetalle DOCUMENTO DETALLE
 * @property string $plista_ddetalle PRECIO LISTA DOCUMENTO DETALLE
 * @property string $total_ddetalle TOTAL DOCUMENTO DETALLE
 *
 * @property Producto $prodDdetalle
 * @property Documento $documentoDdetalle
 */
class DocumentoDetalle extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'documento_detalle';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prod_ddetalle'], 'required'],
            [['prod_ddetalle', 'status_ddetalle', 'documento_ddetalle'], 'integer'],
            [['cant_ddetalle', 'precio_ddetalle', 'descu_ddetalle', 'impuesto_ddetalle', 'plista_ddetalle', 'total_ddetalle'], 'number'],
            [['prod_ddetalle'], 'exist', 'skipOnError' => true, 'targetClass' => Producto::className(), 'targetAttribute' => ['prod_ddetalle' => 'id_prod']],
            [['documento_ddetalle'], 'exist', 'skipOnError' => true, 'targetClass' => Documento::className(), 'targetAttribute' => ['documento_ddetalle' => 'id_doc']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_ddetalle' => Yii::t('documento', 'Id Ddetalle'),
            'prod_ddetalle' => Yii::t('documento', 'Prod Ddetalle'),
            'cant_ddetalle' => Yii::t('documento', 'Cant Ddetalle'),
            'precio_ddetalle' => Yii::t('documento', 'Precio Ddetalle'),
            'descu_ddetalle' => Yii::t('documento', 'Descu Ddetalle'),
            'impuesto_ddetalle' => Yii::t('documento', 'Impuesto Ddetalle'),
            'status_ddetalle' => Yii::t('documento', 'Status Ddetalle'),
            'documento_ddetalle' => Yii::t('documento', 'Documento Ddetalle'),
            'plista_ddetalle' => Yii::t('documento', 'Plista Ddetalle'),
            'total_ddetalle' => Yii::t('documento', 'Total Ddetalle'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProdDdetalle()
    {
        return $this->hasOne(Producto::className(), ['id_prod' => 'prod_ddetalle']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentoDdetalle()
    {
        return $this->hasOne(Documento::className(), ['id_doc' => 'documento_ddetalle']);
    }
}
