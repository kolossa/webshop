<?php

namespace App\Discount;

/**
 * Interface IDiscountTypeRepository
 * @package App\Discount
 */
interface IDiscountTypeRepository
{

    public function persist(\App\IEntity $entity);

    public function findByPk($id);

    /**
     * @param Discount $discount
     * @return DiscountType
     */
    public function getDiscountTypeByDiscount(Discount $discount);

}
