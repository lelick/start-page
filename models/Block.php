<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%block}}".
 *
 * @property integer $id
 * @property integer $column
 * @property integer $order
 * @property string $title
 * @property integer $hidden
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property string $state
 *
 * @property State $state0
 * @property Link[] $links
 * @property UserSettingsBlock[] $userSettingsBlocks
 */
class Block extends \yii\db\ActiveRecord
{

    const STATUS_HIDDEN = 0;
    const STATUS_SHOW = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%block}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['column', 'order', 'hidden', 'created_at', 'updated_at'], 'integer'],
            [['column', 'title'], 'required'],
            [['title'], 'string', 'max' => 32],
            [['state'], 'string', 'max' => 64],
            ['order', 'default', 'value' => 1],
            ['hidden', 'in', 'range' => array_keys(self::getStatusesArray())],
            ['column', 'in', 'range' => array_keys(self::getColumnsArray())]
        ];
    }

    public function getStatusName()
    {
        $statuses = self::getStatusesArray();
        return isset($statuses[$this->status]) ? $statuses[$this->status] : '';
    }

    public static function getStatusesArray()
    {
        return [
            self::STATUS_HIDDEN => 'Скрыт',
            self::STATUS_SHOW => 'Отображается',
        ];
    }

    public static function getColumnsArray()
    {
        return [
            '1' => 'Первый',
            '2' => 'Второй',
            '3' => 'Третий',
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'column' => 'Столбец',
            'order' => 'Сортировка',
            'title' => 'Заголовок',
            'hidden' => 'Hidden',
            'state' => 'Оформление',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLinks()
    {
        return $this->hasMany(Link::className(), ['block_id' => 'id'])->orderBy('order');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserSettingsBlocks()
    {
        return $this->hasMany(UserSettingsBlock::className(), ['block_id' => 'id'])
            ->orderBy(['sort' => 'ASC']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getState0()
    {
        return $this->hasOne(State::className(), ['name' => 'state']);
    }

    public function getInfoLink()
    {
        return Link::find()->where(['block_id' => $this->id])->orderBy('order')->all();
    }

    public static function updateOrder($items = [])
    {
        if (!is_array($items))
            return false;

        foreach($items as $item)
        {
            $itemId = (int)str_replace('item', '', $item['id']);
            $block = self::findOne($itemId);

            $colId = (int)str_replace('column', '', $item['column']);
            $block->column = $colId==0?1:$colId;
            $block->order = $item['order'];
            if(!$block->save())
                return false;
        }
        return true;
    }

}
