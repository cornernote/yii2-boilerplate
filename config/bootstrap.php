<?php

function debug($var, $name = null, $attributesOnly = true)
{
    $bt = debug_backtrace();
    $file = str_ireplace(dirname(dirname(__FILE__)), '', $bt[0]['file']);
    if (!class_exists('\yii\db\BaseActiveRecord', false))
        $attributesOnly = false;
    $name = $name ? '<b><span style="font-size:18px;">' . $name . ($attributesOnly ? ' [attributes]' : '') . '</span></b>:<br/>' : '';
    echo '<div style="background: #FFFBD6">';
    echo '<span style="font-size:12px;">' . $name . ' ' . $file . ' on line ' . $bt[0]['line'] . '</span>';
    echo '<div style="border:1px solid #000;">';
    echo '<pre>';
    if (is_scalar($var))
        var_dump($var);
    elseif ($attributesOnly && $var instanceof \yii\db\BaseActiveRecord)
        print_r($var->attributes);
    elseif ($attributesOnly && is_array($var) && current($var) instanceof \yii\db\BaseActiveRecord)
        foreach ($var as $_var)
            print_r($_var->attributes);
    else
        print_r($var);
    echo '</pre></div></div>';
}

Yii::setAlias('@app', dirname(dirname(__DIR__)));
Yii::setAlias('@web', dirname(__DIR__) . '/web');
Yii::setAlias('@workflowDefinitionNamespace', 'app\\models\\workflow');

Yii::$container->set('yii\bootstrap\ActiveForm', [
    'errorSummaryCssClass' => 'alert alert-danger error-summary',
]);

Yii::$container->set('yii\widgets\LinkPager', [
    'firstPageLabel' => Yii::t('app', 'First'),
    'lastPageLabel' => Yii::t('app', 'Last')
]);

Yii::$container->set('yii\bootstrap\Alert', [
    'closeButton' => ['label' => '<i class="fa fa-times"></i>'],
]);
