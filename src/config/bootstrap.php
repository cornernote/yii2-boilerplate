<?php

if (!function_exists('debug')) {
    function debug($var, $name = null, $attributesOnly = true)
    {
        $cli = php_sapi_name() == 'cli';
        $bt = debug_backtrace();
        $file = str_ireplace(dirname(dirname(__FILE__)), '', $bt[0]['file']);
        if (!class_exists(\yii\base\Model::class, false)) {
            $attributesOnly = false;
        }
        if ($cli) {
            $name = $name ? '===' . $name . ($attributesOnly ? ' [attributes]' : '') . '===' . "\n" : '';
            echo $name . $file . ':' . $bt[0]['line'] . "\n";
        } else {
            $name = $name ? '<b><span style="font-size:18px;">' . $name . ($attributesOnly ? ' [attributes]' : '') . '</span></b>:<br/>' : '';
            echo '<div style="background: #FFFBD6; border:1px solid #aaaaaa;">';
            echo '<h4 style="margin: 0; padding: 5px; border-bottom: 1px solid #aaaaaa;">' . $name . $file . ':' . $bt[0]['line'] . '</h4>';
        }
        if (is_scalar($var)) {
            ob_start();
            var_dump($var);
            $out = ob_get_clean();
        } elseif ($attributesOnly && $var instanceof \yii\base\Model) {
            $out = \yii\helpers\VarDumper::export($var->attributes);
        } elseif ($attributesOnly && is_array($var) && current($var) instanceof \yii\base\Model) {
            foreach ($var as $k => $_var) {
                $var[$k] = $_var->attributes;
            }
            $out = \yii\helpers\VarDumper::export($var);
        } else {
            $out = \yii\helpers\VarDumper::export($var);
        }
        if ($cli) {
            echo $out;
            echo "\n";
        } else {
            echo preg_replace('/&lt;\\?php<br \\/>/', '', highlight_string("<?php\n" . $out, true), 1);
            echo '</div>';
        }
    }
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
