# Many to Many Select2 Widget

## Example using Tags

`_form.php`

```php
    <?= $form->field($model, 'tag_ids')->widget(Select2::classname(), [
        'name' => 'class_name',
        'model' => $model,
        'attribute' => 'tag_ids',
        'data' => ArrayHelper::map(Tag::find()->all(), 'name', 'name'),
        'options' => [
            'placeholder' => Yii::t('app', 'Type to autocomplete'),
            'multiple' => true,
        ],
        'pluginOptions' => [
            'tags' => true,
        ],
    ]); ?>
```

`app/models/Post.php`

```php
    public $tag_ids;

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            'default' => ['...', 'tag_ids'],
            'create' => ['...', 'tag_ids'],
            'update' => ['...', 'tag_ids'],
        ];
    }

    public function rules()
    {
        $rules = parent::rules();
        $rules[] = [['tag_ids'], 'required'];
        return $rules;
    }

    public function afterSave($insert, $changedAttributes)
    {
        $tags = [];
        foreach ($this->tag_ids as $tag_name) {
            $tag = Tag::getTagByName($tag_name);
            if ($tag) {
                $tags[] = $tag;
            }
        }

        $this->linkAll('tags', $tags, [], true, true);
        parent::afterSave($insert, $changedAttributes);
    }
```

`app/models/Tag.php`

```php
    public static function getTagByName($name)
    {
        $tag = Tag::find()->where(['name' => $name])->one();
        if (!$tag) {
            $tag = new Tag();
            $tag->name = $name;
            $tag->save(false);
        }
        return $tag;
    }
```

`app/controllers/PostController.php`

```php
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'update';

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Post has been updated.'));
            return $this->redirect(['view', 'id' => $model->id, 'ru' => ReturnUrl::getRequestToken()]);
        } elseif (!\Yii::$app->request->isPost) {

            // set the tag_ids
            $model->tag_ids = ArrayHelper::map($model->tags, 'name', 'name');

            $model->load(Yii::$app->request->get());
        }

        return $this->render('update', compact('model'));
    }
```
