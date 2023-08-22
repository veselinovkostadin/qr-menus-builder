<?php

namespace Classes;

class Promotion
{
    private $name;
    private $discount;
    private $start_date;
    private $end_date;
    private $restaurant_id;

    public function __construct($name, $discount, $start_date, $end_date, $restaurant_id)
    {
        $this->setName($name)->setDiscount($discount)->setStartDate($start_date)->setEndDate($end_date)->setRestaurantId($restaurant_id);
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function setDiscount($discount)
    {
        $this->discount = $discount;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDiscount()
    {
        return $this->discount;
    }

    public function setStartDate($start_date)
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getStartDate()
    {
        return $this->start_date;
    }

    public function setEndDate($end_date)
    {
        $this->end_date = $end_date;

        return $this;
    }

    public function getEndDate()
    {
        return $this->end_date;
    }

    public function setRestaurantId($restaurant_id)
    {
        $this->restaurant_id = $restaurant_id;

        return $this;
    }

    public function getRestaurantId()
    {
        return $this->restaurant_id;
    }

}
