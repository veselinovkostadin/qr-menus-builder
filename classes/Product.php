<?php

namespace Classes;


class Product
{

    private $name;
    private $picture;
    private $description;
    private $price;
    private $categoryId;
    private $type;


    public function __construct(string $name, $picture, string $description, $price, int $type)
    {
        $this->setName($name)->setPicture($picture)->setDescription($description)->setPrice($price)->setType($type);
    }
    public function setType(int $type)
    {
        $this->type = $type;
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }


    public function setPicture($picture)
    {

        $this->picture = $picture;

        return $this;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }


    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;

        return $this;
    }


    public function getName()
    {
        return $this->name;
    }
    public function getPicture()
    {
        return $this->picture;
    }
    public function getDescription()
    {
        return $this->description;
    }
    public function getPrice()
    {
        return $this->price;
    }

    public function getCategoryId()
    {
        return $this->categoryId;
    }
}
