<?php

namespace app\components;

use Yii;

/**
 * User
 *
 * @property \Da\User\Model\User $identity
 */
class User extends \yii\web\User
{

    /**
     * @param string $permissionName
     * @param array $params
     * @param bool $allowCaching
     * @return bool
     * @throws \yii\base\InvalidConfigException
     */
    public function can($permissionName, $params = [], $allowCaching = true)
    {
        if (Yii::$app instanceof \yii\console\Application) {
            return true;
        }
        //if ($this->can('admin')) {
        //    return true;
        //}
        return parent::can($permissionName, $params, $allowCaching);
    }


    /**
     * @param bool $autoRenew
     * @return \yii\web\IdentityInterface|null
     * @throws \Throwable
     */
    public function getIdentity($autoRenew = true)
    {
        if (Yii::$app instanceof \yii\console\Application) {
            return null;
        }
        return parent::getIdentity($autoRenew);
    }

}