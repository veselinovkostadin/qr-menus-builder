<?php

namespace Classes;

class Category
{
    private $name;
    private $menu_id;
    private $belongs;

    public function __construct($name, $menu_id, $belongs)
    {
        $this->setName($name)->setMenuId($menu_id)->setParent($belongs);
    }

    public function setParent($parent)
    {
        $this->belongs = $parent;
        return $this;
    }

    public function getParent()
    {
        return $this->belongs;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function setMenuId($menu_id)
    {
        $this->menu_id = $menu_id;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getMenuId()
    {
        return $this->menu_id;
    }
}
