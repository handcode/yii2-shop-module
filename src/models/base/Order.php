<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace eluhr\shop\models\base;

use Yii;

/**
 * This is the base-model class for table "sp_order".
 *
 * @property string $id
 * @property string $paypal_id
 * @property string $paypal_token
 * @property string $paypal_payer_id
 * @property integer $is_executed
 * @property string $date_of_birth
 * @property string $internal_notes
 * @property string $customer_details
 * @property integer $discount_code_id
 * @property integer $info_mail_has_been_sent
 * @property string $first_name
 * @property string $surname
 * @property string $email
 * @property string $street_name
 * @property string $house_number
 * @property string $postal
 * @property string $city
 * @property integer $has_different_delivery_address
 * @property string $delivery_first_name
 * @property string $delivery_surname
 * @property string $delivery_street_name
 * @property string $delivery_house_number
 * @property string $delivery_postal
 * @property string $delivery_city
 * @property string $status
 * @property string $shipment_link
 * @property integer $paid
 * @property string $shipping_price
 * @property string $type
 * @property string $invoice_number
 * @property string $created_at
 * @property string $updated_at
 *
 * @property \eluhr\shop\models\DiscountCode $discountCode
 * @property \eluhr\shop\models\OrderItem[] $orderItems
 * @property \eluhr\shop\models\Variant[] $variants
 * @property string $aliasModel
 */
abstract class Order extends \eluhr\shop\models\ActiveRecord
{



    /**
    * ENUM field values
    */
    const STATUS_PENDING = 'PENDING';
    const STATUS_RECEIVED = 'RECEIVED';
    const STATUS_RECEIVED_PAID = 'RECEIVED PAID';
    const STATUS_IN_PROGRESS = 'IN PROGRESS';
    const STATUS_SHIPPED = 'SHIPPED';
    const STATUS_FINISHED = 'FINISHED';
    const TYPE_PAYPAL = 'PAYPAL';
    const TYPE_SAFERPAY = 'SAFERPAY';
    const TYPE_PAYREXX = 'PAYREXX';
    const TYPE_PREPAYMENT = 'PREPAYMENT';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sp_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'first_name', 'surname', 'email', 'street_name', 'house_number', 'postal', 'city'], 'required'],
            [['is_executed', 'discount_code_id', 'info_mail_has_been_sent', 'has_different_delivery_address', 'paid'], 'integer'],
            [['date_of_birth', 'created_at', 'updated_at','payment_details'], 'safe'],
            [['internal_notes','customer_details', 'status', 'type'], 'string'],
            [['shipping_price'], 'number'],
            [['id'], 'string', 'max' => 36],
            [['first_name', 'surname', 'email', 'street_name', 'house_number', 'postal', 'city', 'delivery_first_name', 'delivery_surname', 'delivery_street_name', 'delivery_house_number', 'delivery_postal', 'delivery_city'], 'string', 'max' => 45],
            [['shipment_link', 'invoice_number'], 'string', 'max' => 128],
            [['invoice_number'], 'unique'],
            [['id'], 'unique'],
            [['discount_code_id'], 'exist', 'skipOnError' => true, 'targetClass' => \eluhr\shop\models\DiscountCode::className(), 'targetAttribute' => ['discount_code_id' => 'id']],
            ['status', 'in', 'range' => [
                    self::STATUS_PENDING,
                    self::STATUS_RECEIVED,
                    self::STATUS_RECEIVED_PAID,
                    self::STATUS_IN_PROGRESS,
                    self::STATUS_SHIPPED,
                    self::STATUS_FINISHED,
                ]
            ],
            ['type', 'in', 'range' => [
                    self::TYPE_PAYPAL,
                    self::TYPE_SAFERPAY,
                    self::TYPE_PAYREXX,
                    self::TYPE_PREPAYMENT,
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('shop', 'ID'),
            'paypal_id' => Yii::t('shop', 'Paypal ID'),
            'paypal_token' => Yii::t('shop', 'Paypal Token'),
            'paypal_payer_id' => Yii::t('shop', 'Paypal Payer ID'),
            'is_executed' => Yii::t('shop', 'Is Executed'),
            'date_of_birth' => Yii::t('shop', 'Date Of Birth'),
            'internal_notes' => Yii::t('shop', 'Internal Notes'),
            'customer_details' => Yii::t('shop', 'Customer Details'),
            'discount_code_id' => Yii::t('shop', 'Discount Code ID'),
            'info_mail_has_been_sent' => Yii::t('shop', 'Info Mail Has Been Sent'),
            'first_name' => Yii::t('shop', 'First Name'),
            'surname' => Yii::t('shop', 'Surname'),
            'email' => Yii::t('shop', 'Email'),
            'street_name' => Yii::t('shop', 'Street Name'),
            'house_number' => Yii::t('shop', 'House Number'),
            'postal' => Yii::t('shop', 'Postal'),
            'city' => Yii::t('shop', 'City'),
            'has_different_delivery_address' => Yii::t('shop', 'Has Different Delivery Address'),
            'delivery_first_name' => Yii::t('shop', 'Delivery First Name'),
            'delivery_surname' => Yii::t('shop', 'Delivery Surname'),
            'delivery_street_name' => Yii::t('shop', 'Delivery Street Name'),
            'delivery_house_number' => Yii::t('shop', 'Delivery House Number'),
            'delivery_postal' => Yii::t('shop', 'Delivery Postal'),
            'delivery_city' => Yii::t('shop', 'Delivery City'),
            'status' => Yii::t('shop', 'Status'),
            'shipment_link' => Yii::t('shop', 'Shipment Link'),
            'paid' => Yii::t('shop', 'Paid'),
            'shipping_price' => Yii::t('shop', 'Shipping Price'),
            'type' => Yii::t('shop', 'Type'),
            'invoice_number' => Yii::t('shop', 'Invoice Number'),
            'created_at' => Yii::t('shop', 'Created At'),
            'updated_at' => Yii::t('shop', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscountCode()
    {
        return $this->hasOne(\eluhr\shop\models\DiscountCode::className(), ['id' => 'discount_code_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(\eluhr\shop\models\OrderItem::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVariants()
    {
        return $this->hasMany(\eluhr\shop\models\Variant::className(), ['id' => 'variant_id'])->viaTable('sp_order_item', ['order_id' => 'id']);
    }


    
    /**
     * @inheritdoc
     * @return \eluhr\shop\models\query\OrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \eluhr\shop\models\query\OrderQuery(get_called_class());
    }


    /**
     * get column status enum value label
     * @param string $value
     * @return string
     */
    public static function getStatusValueLabel($value){
        $labels = self::optsStatus();
        if(isset($labels[$value])){
            return $labels[$value];
        }
        return $value;
    }

    /**
     * column status ENUM value labels
     * @return array
     */
    public static function optsStatus()
    {
        return [
            self::STATUS_PENDING => Yii::t('shop', 'Pending'),
            self::STATUS_RECEIVED => Yii::t('shop', 'Received'),
            self::STATUS_RECEIVED_PAID => Yii::t('shop', 'Received Paid'),
            self::STATUS_IN_PROGRESS => Yii::t('shop', 'In Progress'),
            self::STATUS_SHIPPED => Yii::t('shop', 'Shipped'),
            self::STATUS_FINISHED => Yii::t('shop', 'Finished'),
        ];
    }

    /**
     * get column type enum value label
     * @param string $value
     * @return string
     */
    public static function getTypeValueLabel($value){
        $labels = self::optsType();
        if(isset($labels[$value])){
            return $labels[$value];
        }
        return $value;
    }

    /**
     * column type ENUM value labels
     * @return array
     */
    public static function optsType()
    {
        return [
            self::TYPE_PAYPAL => Yii::t('shop', 'PayPal'),
            self::TYPE_SAFERPAY => Yii::t('shop','Saferpay'),
            self::TYPE_PREPAYMENT => Yii::t('shop', 'Prepayment'),
            self::TYPE_PAYREXX => Yii::t('shop', 'Payrexx'),
        ];
    }

}
