<?php

namespace app\models;

use Yii;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "job".
 *
 * @property int $id
 * @property int $category_id
 * @property int $user_id
 * @property string $title
 * @property string $description
 * @property string $type
 * @property string $requirements
 * @property string $salary_range
 * @property string $city
 * @property string $address
 * @property string $contact_email
 * @property string $contact_phone
 * @property int $is_published
 * @property string $created_at
 * @property int $is_deleted
 * @property string|null $deleted_at
 *
 * @property Category $category
 * @property User $user
 */
class Job extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'job';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'title', 'description', 'type', 'requirements', 'salary_range', 'city', 'address', 'contact_email', 'contact_phone'], 'required'],
            [['category_id', 'is_published', 'is_deleted'], 'integer'],
            [['description'], 'string'],
            [['created_at', 'deleted_at'], 'safe'],
            [['title', 'type', 'requirements', 'address', 'contact_email'], 'string', 'max' => 255],
            [['salary_range', 'city'], 'string', 'max' => 128],
            [['contact_phone'], 'string', 'max' => 16],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category name',
            'user_id' => 'User ID',
            'title' => 'Job Title',
            'description' => 'Description',
            'type' => 'Type',
            'requirements' => 'Requirements',
            'salary_range' => 'Salary Range',
            'city' => 'City',
            'address' => 'Address',
            'contact_email' => 'Contact Email',
            'contact_phone' => 'Contact Phone',
            'is_published' => 'Should be published',
            'created_at' => 'Created At',
            'is_deleted' => 'Is Deleted',
            'deleted_at' => 'Deleted At',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }


    public function beforeSave($insert)
    {
        $this->user_id = Yii::$app->user->identity->id;

        return parent::beforeSave($insert);
    }
}
