<?php
Yii::setAlias('@app', dirname(dirname(__DIR__)));
Yii::setAlias('@web', dirname(__DIR__) . '/web');
Yii::setAlias('@workflowDefinitionNamespace', 'app\\models\\workflow');
\Yii::$container->set('yii\bootstrap\ActiveForm', [
    'errorSummaryCssClass' => 'alert alert-danger error-summary',
]);
