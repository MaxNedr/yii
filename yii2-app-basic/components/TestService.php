<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 15.01.2019
 * Time: 23:58
 */
namespace app\components;
use yii\base\Component;
use yii\widgets\DetailView;

class TestService extends Component
{
    public $property = 'default';

    public function start(){
        return $this->property;
    }
}