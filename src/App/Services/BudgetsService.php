<?php
namespace App\Services;

use Framework\Database;

class BudgetsService
{
    public function __construct(private Database $db)
    {
    }

    public function create(array $formData)
    {
        $formattedDateStart = "{$formData['start_date']} 00:00:00";
        $formattedDateEnd = "{$formData['end_date']} 23:59:59";

        $this->db->query(
            "INSERT INTO budgets(limit_amount, start_date, end_date, category_id, user_id)
            VALUES(:limit_amount, :start_date, :end_date, :category_id, :user_id)",
            [
                'limit_amount' => $formData['limit_amount'],
                'start_date' => $formattedDateStart,
                'end_date' => $formattedDateEnd,
                'category_id' => $formData['category_id'],
                'user_id' => $_SESSION['user'],
            ]
        );
    }

    public function getUserBudgets(int $length, int $offset)
    {
        $searchTerm = $_GET['s'] ?? '';
        $params = ['user_id' => $_SESSION['user']];

        $budgets = $this->db->query(
            "SELECT budgets.*, c.name as category_name 
            FROM budgets
            JOIN categories c ON budgets.category_id = c.id
            WHERE budgets.user_id = :user_id
            ORDER BY budgets.created_at DESC
            LIMIT {$length} OFFSET {$offset}",
            $params
        )->findAll();

        $budgetCount = $this->db->query(
            "SELECT COUNT(*) FROM budgets
            JOIN categories c ON budgets.category_id = c.id
            WHERE budgets.user_id = :user_id",
            $params
        )->count();

        return [$budgets, $budgetCount];
    }

    public function getUserBudget(string $id)
    {
        return $this->db->query(
            "SELECT 
                budgets.*, 
                c.name as category_name, 
                DATE_FORMAT(budgets.start_date, '%Y-%m-%d') as formatted_date_start,
                DATE_FORMAT(budgets.end_date, '%Y-%m-%d') as formatted_date_end
            FROM budgets
            LEFT JOIN categories c ON budgets.category_id = c.id
            WHERE budgets.id = :id AND budgets.user_id = :user_id",
            [
                'id' => $id,
                'user_id' => $_SESSION['user']
            ]
        )->find();
    }


    public function update(array $formData, int $budgetId)
    {
        $formattedDateStart = "{$formData['start_date']} 00:00:00";
        $formattedDateEnd = "{$formData['end_date']} 23:59:59";

        $this->db->query(
            "UPDATE budgets 
            SET 
                limit_amount = :limit_amount,
                start_date = :start_date,
                end_date = :end_date,
                category_id = :category_id
            WHERE id = :id AND user_id = :user_id",
            [
                'limit_amount' => $formData['limit_amount'],
                'start_date' => $formattedDateStart,
                'end_date' => $formattedDateEnd,
                'category_id' => $formData['category_id'],
                'id' => $budgetId,
                'user_id' => $_SESSION['user'],
            ]
        );
    }

    public function getCategories()
    {
        return $this->db->query(
            "SELECT * FROM categories WHERE user_id = :user_id",
            ['user_id' => $_SESSION['user']]
        )->findAll();
    }

    public function getUserCategory(string $id)
    {
        return $this->db->query(
            "SELECT * FROM categories 
            WHERE id = :id AND user_id = :user_id",
            [
                'id' => $id,
                'user_id' => $_SESSION['user']
            ]
        )->find();
    }

    public function delete(int $id)
    {
        $this->db->query(
            "DELETE FROM budgets 
            WHERE id = :id AND user_id = :user_id",
            [
                'id' => $id,
                'user_id' => $_SESSION['user'],
            ]
        );
    }
    public function getActiveBudgets()
    {
        return $this->db->query(
            "SELECT budgets.*, c.name as category_name, SUM(t.amount) as spent
        FROM budgets
        LEFT JOIN categories c ON budgets.category_id = c.id
        LEFT JOIN transactions t 
            ON t.category_id = budgets.category_id
            AND t.date BETWEEN budgets.start_date AND budgets.end_date
        WHERE budgets.user_id = :user_id
        AND NOW() BETWEEN budgets.start_date AND budgets.end_date
        GROUP BY budgets.id",
            ['user_id' => $_SESSION['user']]
        )->findAll();
    }
}