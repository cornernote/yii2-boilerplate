## Multi-Form Model

`app/models/form/PostForm.php`

```php
<?php

namespace app\models\form;

use app\models\Advertiser;
use app\models\Post;
use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

/**
 * PostForm is the model behind the post form.
 *
 * @property Post $post
 * @property Advertiser $advertiser
 */
class PostForm extends Model
{
    /**
     * @var Post
     */
    private $_post;

    /**
     * @var Advertiser
     */
    private $_advertiser;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Post', 'Advertiser'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    /**
     * @return bool
     */
    public function save()
    {
        if (!$this->post->save()) {
            return false;
        }
        $this->advertiser->post_id = $this->post->id;
        if (!$this->advertiser->save()) {
            return false;
        }
        return true;
    }

    /**
     * @return Post
     */
    public function getPost()
    {
        return $this->_post;
    }

    /**
     * @param Post|array $post
     */
    public function setPost($post)
    {
        if ($post instanceof ActiveRecord) {
            $this->_post = $post;
        } else if (is_array($post)) {
            $this->_post->setAttributes($post);
        }
    }

    /**
     * @return Advertiser
     */
    public function getAdvertiser()
    {
        if (!$this->_advertiser) {
            if ($this->post->isNewRecord) {
                $this->_advertiser = new Advertiser();
            } else {
                $this->_advertiser = Advertiser::find()->andWhere(['post_id' => $this->post->id])->one();
            }
        }
        return $this->_advertiser;
    }

    /**
     * @param Advertiser|array $advertiser
     */
    public function setAdvertiser($advertiser)
    {
        $this->advertiser->setAttributes($advertiser);
    }

    /**
     * @return array
     */
    public function getAllModels()
    {
        return [
            $this->post,
            $this->advertiser,
        ];
    }

}
```

`app/controllers/PostController.php`

```php
    public function actionCreate()
    {
        $model = new Post;
        $model->scenario = 'create';

        $postForm = new PostForm();
        $postForm->post = $model;
        $postForm->setAttributes(Yii::$app->request->post());

        if (Yii::$app->request->post() && $postForm->save()) {
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Post has been created.'));
            return $this->redirect(['view', 'id' => $postForm->post->id, 'ru' => ReturnUrl::getRequestToken()]);
        } elseif (!\Yii::$app->request->isPost) {
            $postForm->post->load(Yii::$app->request->get());
        }

        return $this->render('create', compact('postForm'));
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = 'update';

        $postForm = new PostForm();
        $postForm->post = $model;
        $postForm->setAttributes(Yii::$app->request->post());

        if (Yii::$app->request->post() && $postForm->save()) {
            Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Post has been updated.'));
            return $this->redirect(['view', 'id' => $postForm->post->id, 'ru' => ReturnUrl::getRequestToken()]);
        } elseif (!\Yii::$app->request->isPost) {
            $postForm->post->load(Yii::$app->request->get());
        }

        return $this->render('update', compact('postForm'));
    }
```

`app/views/post/create.php`, `app/views/post/update.php` and `app/views/post/_form.php`

- replace `$model` with `$postForm->post`
- change menu from `$this->render('_menu', compact('model'))` to `$this->render('_menu', ['model' => $postForm->post])`
- in `_form.php` change `$form->errorSummary($model);` to `$form->errorSummary($postForm->getAllModels());`

Now in the form you can use your other models as follows

```php
<?= $form->field($postForm->advertiser, 'name')->textInput(['maxlength' => true]) ?>
```
