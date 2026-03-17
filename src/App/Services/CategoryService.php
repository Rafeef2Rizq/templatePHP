<?php
namespace App\Services;

use Framework\Database;
class CategoryService
{
    public function __construct(private Database $db)
    {

    }
    public function create(array $formData)
    {

        $this->db->query("INSERT INTO categories(name,icon,color,is_default,user_id)
        VALUES(:name,:icon,:color,:is_default,:user_id)", [
            'name' => $formData['name'],
            'icon' => $formData['icon'],
            'color' => $formData['color'],
            'is_default' => isset($formData['is_default']) ? (int) $formData['is_default'] : 0,
            'user_id' => $_SESSION['user'],

        ]);
    }
    public function getUserCategories(int $length, int $offset)
    {
        $searchTerm = $_GET['s'] ?? '';

        $params = [
            'user_id' => $_SESSION['user'],
            'category_id' => "%{$searchTerm}%",
        ];


        $categories = $this->db->query(
            "SELECT * FROM categories
         WHERE user_id = :user_id 
         AND id LIKE :category_id
         ORDER BY created_at DESC
         LIMIT {$length} OFFSET {$offset}",
            $params
        )->findAll();


        $categoryCount = $this->db->query(
            "SELECT COUNT(*) FROM categories
         WHERE user_id = :user_id 
         AND id LIKE :category_id",
            $params
        )->count();

        return [$categories, $categoryCount];
    }
    public function getUserCategory(string $id)
    {
        return $this->db->query("SELECT *
        FROM categories WHERE id=:id AND  user_id =:user_id", [
            'id' => $id,
            'user_id' => $_SESSION['user']
        ])->find();
    }
    public function update(array $formData, int $categoryId)
    {
        $this->db->query(
            "UPDATE categories SET  name = :name,
            icon = :icon, color = :color, is_default = :is_default
            WHERE id = :id AND user_id = :user_id",
            [
                'name' => $formData['name'],
                'icon' => $formData['icon'],
                'color' => $formData['color'],
                'is_default' => isset($formData['is_default']) ? (int) $formData['is_default'] : 0,
                'user_id' => $_SESSION['user'],
            ]
        );
    }
    public function delete(int $categoryId)
    {
        $this->db->query(
            "DELETE FROM categories WHERE id = :id AND user_id = :user_id",
            [
                'id' => $categoryId,
                'user_id' => $_SESSION['user'],
            ]
        );
    }

}