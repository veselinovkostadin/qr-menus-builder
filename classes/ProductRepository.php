<?php

namespace Classes;

use Classes\Product;
use Classes\DB;

class ProductRepository extends DB
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function save(Product $product)
    {
        $query = "INSERT INTO products (name,picture,description,price,category_id,belongs_to) VALUES (:name, :picture, :description, :price, :category_id,:belongs_to)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':name' => $product->getName(),
            ':picture' => $product->getPicture(),
            ':description' => $product->getDescription(),
            ':price' => $product->getPrice(),
            ':category_id' => $product->getCategoryId(),
            ":belongs_to" => $product->getType()
        ]);
    }

    public function delete(int $id)
    {
        $query = "DELETE FROM products WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':id' => $id]);
    }

    public function addToPromotion(int $id, int $promotionId, int $userId)
    {
        $query = "UPDATE products as p JOIN categories as c ON p.category_id = c.id
            JOIN restaurant as r ON c.menu_id = r.id SET promotion_id = :promotionId WHERE p.id = :id and r.user_id = :userId";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':promotionId' => $promotionId, ":id" => $id, ":userId" => $userId]);
    }
    public function removePromotion(int $id, int $userId)
    {
        $query = "UPDATE products as p JOIN categories as c ON p.category_id = c.id
        JOIN restaurant as r ON c.menu_id = r.id SET p.promotion_id = NULL WHERE p.id = :id and r.user_id = :userId";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':userId' => $userId, ":id" => $id]);
    }
}
