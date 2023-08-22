<?php

namespace Classes;

use Classes\Restaurant;
use Classes\DB;

class RestaurantRepository extends DB
{

    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function save(Restaurant $restaurant)
    {
        $query = "INSERT INTO restaurant (name, phone, wifi_password, address, menu_language, user_id,qr_code,food,drink,UUID) VALUES (:name, :phone, :wifi_password, :address, :menu_language, :user_id, :qr_code,:food,:drink,:uuid)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':name' => $restaurant->getName(),
            ':phone' => $restaurant->getPhone(),
            ':wifi_password' => $restaurant->getWifiPassword(),
            ':address' => $restaurant->getAddress(),
            ':menu_language' => $restaurant->getMenuLanguage(),
            ':user_id' => $restaurant->getUserId(),
            ':qr_code' => $restaurant->getQrCode(),
            ':food' => $restaurant->getFood(),
            ':drink' => $restaurant->getDrink(),
            ':uuid' => $restaurant->getUUid()
        ]);
    }

    public function delete(int $id, int $userId)
    {
        $query = "DELETE FROM restaurant WHERE id = :id and user_id = :userId";
        $stmt = $this->db->prepare($query);
        $stmt->execute([':id' => $id, ":userId" => $userId]);
    }
}
