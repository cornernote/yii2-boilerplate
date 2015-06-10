# Populate Select2 from Another Select2

`_form.php`

```php
        <?= $form->field($model, 'client_id')->widget(Select2::classname(), [
            'name' => 'class_name',
            'model' => $model,
            'attribute' => 'client_id',
            'data' => ArrayHelper::map(Client::find()->all(), 'client_id', 'label'),
            'options' => [
                'placeholder' => Yii::t('app', 'Type to autocomplete'),
                'multiple' => false,
            ],
            'pluginEvents' => [
                'select2:select' => 'function(e) { populateClientCode(e.params.data.id); }',
            ],
        ]); ?>
        
        <?= $form->field($model, 'client_code_id')->widget(Select2::classname(), [
            'name' => 'class_name',
            'model' => $model,
            'attribute' => 'client_code_id',
            'data' => ArrayHelper::map(ClientCode::find()->andWhere(['client_id' => $model->client_id])->all(), 'client_code_id', 'label'),
            'options' => [
                'placeholder' => Yii::t('app', 'Type to autocomplete'),
                'multiple' => false,
            ]
        ]); ?>

        <?php JavaScript::begin(); ?>
        <script>
            function populateClientCode(client_id) {
                var url = '<?= Url::to(['job/populate-client-code', 'client_id' => '-client_id-']) ?>';
                $('#job-client_code_id').find('option').remove().end();
                $.ajax({
                    url: url.replace('-client_id-', client_id),
                    success: function (data) {
                        $('#job-client_code_id').select2({
                            theme: 'krajee',
                            placeholder: 'Type to autocomplete',
                            language: 'en',
                            data: data.results
                        });
                    }
                });
            }
        </script>
        <?php JavaScript::end(); ?>
```


`Controller.php`

```php
    public function actionPopulateClientCode($client_id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $clientCodes = ClientCode::find()->andWhere(['client_id' => $client_id])->all();
        $results = [];
        $results[] = ['id' => '', 'text' => ''];
        foreach ($clientCodes as $clientCode) {
            $results[] = ['id' => $clientCode->client_code_id, 'text' => $clientCode->client_code];
        }
        return ['results' => $results];
    }
```
