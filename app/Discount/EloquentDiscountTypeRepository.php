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
}
