<?php
Yii::setAlias('@app', dirname(dirname(__DIR__)));
Yii::setAlias('@web', dirname(__DIR__) . '/web');
Yii::setAlias('@workflowDefinitionNamespace', 'app\\models\\workflow');

\Yii::$container->set('yii\bootstrap\ActiveForm', [
    'errorSummaryCssClass' => 'alert alert-danger error-summary',
]);

\Yii::$container->set('yii\widgets\LinkPager', [
    'firstPageLabel' => Yii::t('app', 'First'),
    'lastPageLabel' => Yii::t('app', 'Last')
]);

\Yii::$container->set('yii\bootstrap\Alert', [
    'closeButton' => ['label' => '<i class="fa fa-times"></i>'],
]);
