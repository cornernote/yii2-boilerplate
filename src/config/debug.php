<?php

use yii\base\Model;
use yii\helpers\VarDumper;

// debug function for Yii2
function debug($var, $name = null, $attributesOnly = true)
{
    $cli = php_sapi_name() == 'cli';
    $bt = debug_backtrace();
    $file = str_ireplace(dirname(dirname(__FILE__)), '', $bt[0]['file']);
    if (!class_exists(Model::class, false)) {
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
    } elseif ($attributesOnly && $var instanceof Model) {
        $out = VarDumper::export($var->attributes);
    } elseif ($attributesOnly && is_array($var) && current($var) instanceof Model) {
        foreach ($var as $k => $_var) {
            $var[$k] = $_var->attributes;
        }
        $out = VarDumper::export($var);
    } else {
        $out = VarDumper::export($var);
    }
    if ($cli) {
        echo $out;
        echo "\n";
    } else {
        echo preg_replace('/&lt;\\?php<br \\/>/', '', highlight_string("<?php\n" . $out, true), 1);
        echo '</div>';
    }
}
