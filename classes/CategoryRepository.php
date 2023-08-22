<?php

namespace Classes;

use Classes\Category;
use Classes\DB;

class CategoryRepository
{
    private $db;

    public function __construct()
    {
        $this->db = DB::connect();
    }

    public function save(Category $category)
    {
        $query = "INSERT INTO categories (name, menu_id,belongs_to) VALUES (:name, :menu_id,:belongs)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':name' => $category->getName(),
            ':menu_id' => $category->getMenuId(),
            ':belongs' => $category->getParent()
        ]);
    }

    public function delete(int $id, int $userId)
    {
        $query = "DELETE categories FROM categories JOIN restaurant ON categories.menu_id = restaurant.id WHERE categories.id = :id and restaurant.user_id = :userId";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':id' => $id, ":userId" => $userId]);
    }
}
