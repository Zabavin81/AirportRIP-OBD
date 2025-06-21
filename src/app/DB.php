<?php
class DB
{
    public static function connect(): PDO
    {
        try {
            $db = new PDO(
              'mysql:host=mysql;dbname=my_db;charset=utf8mb4',
              'root',
              'root'
            );
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "✅ Подключение к БД успешно\n";
            return $db;
        } catch (PDOException $e) {
            echo "❌ Ошибка подключения: " . $e->getMessage();
            exit;
        }
    }
}
