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
}
