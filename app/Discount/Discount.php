<?php


namespace App\Discount;


use Illuminate\Database\Eloquent\Model;

class Discount extends Model implements \App\IEntity
{
    const TABLE_BOOKS_ASSIGN='discounts_books_assign';
    const TABLE_PUBLISHERS_ASSIGN='discounts_publishers_assign';
    const TABLE_DISCOUNTS_ASSIGN='discounts_assign';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'discounts';

    public function getId()
    {

        return $this->id;
    }

    public function books()
    {

        return $this->belongsToMany('App\Book\Book', 'discounts_books_assign');
    }

    public function publishers()
    {

        return $this->belongsToMany('App\Publisher\Publisher', 'discounts_publishers_assign');
    }

    public function discountType()
    {

        return $this->belongsTo('App\Discount\DiscountType');
    }

    public function relatedDiscounts()
    {

        return $this->belongsToMany('App\Discount\Discount', 'discounts_assign', 'discount_id', 'related_discount_id');
    }

}
