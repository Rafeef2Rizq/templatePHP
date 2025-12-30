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
        $formattedDateStart = "{$formData['start_date']} 00:00:00 ";
        $formattedDateEnd = "{$formData['end_date']} 23:59:59 ";
        $this->db->query("INSERT INTO Budgets(title,total_amount,start_date,end_date,user_id)
        VALUES(:title,:total_amount,:start_date,:end_date,:user_id)", [
            'title' => $formData['title'],
            'total_amount' => $formData['total_amount'],
            'start_date' => $formattedDateStart,
            'end_date' => $formattedDateEnd,
            'user_id' => $_SESSION['user'],

        ]);
    }
    public function getUserBudgets(int $length, int $offset)
    {
        $searchTerm = $_GET['s'] ?? '';

        $params = [
            'user_id' => $_SESSION['user'],
            'title' => "%{$searchTerm}%",
        ];


        $budgets = $this->db->query(
            "SELECT * FROM budgets
         WHERE user_id = :user_id 
         AND title LIKE :title
         ORDER BY created_at DESC
         LIMIT {$length} OFFSET {$offset}",
            $params
        )->findAll();


        $budgetCount = $this->db->query(
            "SELECT COUNT(*) FROM budgets
         WHERE user_id = :user_id 
         AND title LIKE :title",
            $params
        )->count();

        return [$budgets, $budgetCount];
    }
    public function getUserBudget(string $id)
    {
        return $this->db->query("SELECT *, DATE_FORMAT(start_date,'%Y-%m-%d') as formatted_date_start,
         DATE_FORMAT(end_date,'%Y-%m-%d') as formatted_date_end
        FROM budgets WHERE id=:id AND  user_id =:user_id", [
            'id' => $id,
            'user_id' => $_SESSION['user']
        ])->find();
    }
    public function update(array $formData, int $budgetId)
    {
        $formattedDateStart = "{$formData['start_date']} 00:00:00 ";
        $formattedDateEnd = "{$formData['end_date']} 23:59:59 ";
        $this->db->query(
            "UPDATE budgets SET title = :title, total_amount = :total_amount,
            start_date = :start_date, end_date = :end_date
            WHERE id = :id AND user_id = :user_id",
            [
                'title' => $formData['title'],
                'total_amount' => $formData['total_amount'],
                'start_date' => $formattedDateStart,
                'end_date' => $formattedDateEnd,
                'id' => $budgetId,
                'user_id' => $_SESSION['user'],
            ]
        );
    }
    public function delete(int $budgetId)
    {
        $this->db->query(
            "DELETE FROM budgets WHERE id = :id AND user_id = :user_id",
            [
                'id' => $budgetId,
                'user_id' => $_SESSION['user'],
            ]
        );
    }

}