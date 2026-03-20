<?php
namespace App\Services;

use Framework\Database;

class TransactionService
{
    public function __construct(private Database $db)
    {
    }

    public function create(array $formData)
    {
        $formattedDate = "{$formData['date']} 00:00:00";
        $categoryId = $formData['category_id'] ?? null;

        $category = $this->db->query(
            "SELECT id FROM categories WHERE id = :id",
            ['id' => $categoryId]
        )->find();

        if (!$category) {
            $this->db->query(
                "INSERT INTO categories(name, user_id, icon, color) 
                VALUES(:name, :user_id, 'fas fa-tag', '#6366f1')",
                [
                    'name' => $categoryId,
                    'user_id' => $_SESSION['user']
                ]
            );
            $categoryId = $this->db->id();
            $category = ['id' => $categoryId];
        }

        $this->db->query(
            "INSERT INTO transactions(user_id, description, amount, date, category_id, transaction_type)
            VALUES(:user_id, :description, :amount, :date, :category_id, :transaction_type)",
            [
                'user_id' => $_SESSION['user'],
                'description' => $formData['description'],
                'amount' => $formData['amount'],
                'date' => $formattedDate,
                'category_id' => $category['id'] ?? null,
                'transaction_type' => $formData['transaction_type'] ?? 'expense'
            ]
        );
    }

    public function getUserTransactions(int $length, int $offset)
    {
        $searchTerm = addcslashes($_GET['s'] ?? '', '%_');
        $params = [
            'user_id' => $_SESSION['user'],
            'description' => "%{$searchTerm}%",
        ];

        $transactions = $this->db->query(
            "SELECT transactions.*, 
                    DATE_FORMAT(transactions.date, '%Y-%m-%d') as formatted_date,
                    categories.name as category_name
            FROM transactions
            JOIN categories ON transactions.category_id = categories.id
            WHERE transactions.user_id = :user_id
            AND transactions.description LIKE :description
            ORDER BY transactions.date DESC
            LIMIT {$length} OFFSET {$offset}",
            $params
        )->findAll();

        // Get receipts for each transaction
        $transactions = array_map(function (array $transaction) {
            $transaction['receipts'] = $this->db->query(
                "SELECT * FROM receipts WHERE transaction_id = :transaction_id",
                ['transaction_id' => $transaction['id']]
            )->findAll();
            return $transaction;
        }, $transactions);

        $transactionCount = $this->db->query(
            "SELECT COUNT(*) FROM transactions
            WHERE user_id = :user_id 
            AND description LIKE :description",
            $params
        )->count();

        return [$transactions, $transactionCount];
    }

    public function getUserTransaction(string $id)
    {
        return $this->db->query(
            "SELECT transactions.*, 
                    DATE_FORMAT(transactions.date, '%Y-%m-%d') as formatted_date,
                    categories.name as category_name
            FROM transactions
            LEFT JOIN categories ON transactions.category_id = categories.id
            WHERE transactions.id = :id AND transactions.user_id = :user_id",
            [
                'id' => $id,
                'user_id' => $_SESSION['user']
            ]
        )->find();
    }

    public function getTotalAmount()
    {
        $result = $this->db->query(
            "SELECT SUM(amount) as total FROM transactions WHERE user_id = :user_id",
            ['user_id' => $_SESSION['user']]
        )->find();

        return $result['total'] ?? 0;
    }
    public function getTotalIncome()
    {
        $result = $this->db->query(
            "SELECT SUM(amount) as total FROM transactions 
         WHERE user_id = :user_id 
         AND transaction_type = 'income'",
            ['user_id' => $_SESSION['user']]
        )->find();

        return $result['total'] ?? 0;
    }



    public function update(array $formData, int $id)
    {
        $formattedDate = "{$formData['date']} 00:00:00";
        $categoryId = $formData['category_id'] ?? null;

        // Check if category exists
        $category = $this->db->query(
            "SELECT id FROM categories WHERE id = :id",
            ['id' => $categoryId]
        )->find();

        if (!$category) {
            $this->db->query(
                "INSERT INTO categories(name, user_id, icon, color) 
                VALUES(:name, :user_id, 'fas fa-tag', '#6366f1')",
                [
                    'name' => $categoryId,
                    'user_id' => $_SESSION['user']
                ]
            );
            $categoryId = $this->db->id();
            $category = ['id' => $categoryId];
        }

        $this->db->query(
            "UPDATE transactions 
            SET description = :description, 
                amount = :amount, 
                date = :date,
                category_id = :category_id,
                transaction_type = :transaction_type
            WHERE id = :id AND user_id = :user_id",
            [
                'description' => $formData['description'],
                'amount' => $formData['amount'],
                'date' => $formattedDate,
                'category_id' => $category['id'] ?? null,
                'transaction_type' => $formData['transaction_type'] ?? 'expense',
                'id' => $id,
                'user_id' => $_SESSION['user']
            ]
        );
    }

    public function delete(int $id)
    {
        $this->db->query(
            "DELETE FROM transactions 
            WHERE id = :id AND user_id = :user_id",
            [
                'id' => $id,
                'user_id' => $_SESSION['user']
            ]
        );
    }

    public function getCategories()
    {
        return $this->db->query(
            "SELECT * FROM categories WHERE user_id = :user_id ORDER BY name ASC",
            ['user_id' => $_SESSION['user']]
        )->findAll();
    }
    public function getTopCategories(): array
    {
        return $this->db->query("
        SELECT categories.name, COUNT(transactions.id) AS count, SUM(transactions.amount) AS total
        FROM transactions
        JOIN categories ON transactions.category_id = categories.id
        GROUP BY categories.name
        ORDER BY total DESC
        LIMIT 5
    ")->findAll();


    }
}