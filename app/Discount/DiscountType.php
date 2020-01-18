<?php


namespace App\Discount;


use Illuminate\Database\Eloquent\Model;

class DiscountType extends Model implements \App\IEntity
{
    const TYPE_PERCENTAGE = 'percentage';
    const TYPE_FIX = 'fix';
    const TYPE_PACKAGE = 'package';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'discount_types';

    public $incrementing = false;

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return IDiscountRule
     */
    public function getDiscountRule(){

        switch ($this->type){
            case self::TYPE_PERCENTAGE:
                return new DiscountRulePercentage();
            case self::TYPE_FIX:
                return new DiscountRuleFix();
            case self::TYPE_PACKAGE:
                return new DiscountRulePackage();
            default:
                throw new \BadMethodCallException();
        }
    }
}
