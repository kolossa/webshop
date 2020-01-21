<?php

namespace App\Discount;

/**
 * Class EloquentSpecialPriceRepository
 * @package App\SpecialPrice
 */
class EloquentDiscountTypeRepository implements IDiscountTypeRepository
{

    public function persist(\App\IEntity $entity)
    {

        $entity->save();
    }

    public function findByPk($id)
    {

        return DiscountType::find($id);
    }

    public function getDiscountTypeByDiscount(Discount $discount)
    {
        return DiscountType::where('id', $discount->discount_type_id)->first();
    }
}
