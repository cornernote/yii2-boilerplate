<?php

namespace app\db;


/**
 * Application ActiveRecord
 *
 * @package app\components
 */
class ActiveRecord extends \yii\db\ActiveRecord
{

    /**
     * Returns safeAttributes in the same order they are defined in the data source, which is required for code generation.
     *
     * @return array
     */
    public function safeAttributes()
    {
        $attributes = array();
        $_attributes = array_flip(parent::safeAttributes());
        foreach ($this->attributes as $k => $v) {
            if (isset($_attributes[$k])) {
                $attributes[] = $k;
            }
        }
        return $attributes;
    }


}