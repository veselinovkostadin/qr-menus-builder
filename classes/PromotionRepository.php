<?php

namespace Classes;

use Classes\Promotion;
use Classes\DB;

class PromotionRepository
{
    private $db;

    public function __construct()
    {
        $this->db = DB::connect();
    }

    public function save(Promotion $promotion)
    {
        $query = "INSERT INTO promotions (name, discount, start_date, end_date, restaurant_id) VALUES (:name, :discount, :start_date, :end_date, :restaurant_id)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':name' => $promotion->getName(),
            ':discount' => $promotion->getDiscount(),
            ':start_date' => $promotion->getStartDate(),
            ':end_date' => $promotion->getEndDate(),
            ':restaurant_id' => $promotion->getRestaurantId()
        ]);
    }

    public function delete(int $id, int $userId)
    {
        $query = "DELETE promotions FROM promotions JOIN restaurant ON promotions.restaurant_id = restaurant.id WHERE promotions.id = :id and restaurant.user_id = :userId";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':id' => $id, ":userId" => $userId]);
    }
    public function update($id, $userId, $name, $discount, $startDate, $endDate)
    {
        $query = "UPDATE promotions as p JOIN restaurant as r ON p.restaurant_id = r.id SET p.name = :name, p.discount = :discount, p.start_date = :start_date, p.end_date = :end_date WHERE p.id = :id and r.user_id = :userId";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ":id" => $id,
            ":userId" => $userId,
            ':name' => $name,
            ':discount' => $discount,
            ':start_date' => $startDate,
            ':end_date' => $endDate,
        ]);
    }
}
