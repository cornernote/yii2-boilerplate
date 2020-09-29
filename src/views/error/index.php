<?php
/**
 * @var $this yii\web\View
 * @var $name string
 * @var $message string
 * @var $exception Exception
 */

use bedezign\yii2\audit\Audit;

//try {
//    $entry_id = Audit::getInstance()->getEntry()->id;
//} catch (\Exception $e) {
//    $entry_id = null;
//}

$errorCode = property_exists($exception, 'statusCode') ? Yii::t('app', 'Error') . ' ' . $exception->statusCode : Yii::t('app', 'Internal Error');
$this->title = $errorCode;
?>

<div class="container-fluid">
    <h1><?= $errorCode ?></h1>
    <h3><?= $message ?></h3>
</div>
