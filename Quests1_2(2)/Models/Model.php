<?php
namespace Models;

use mysqli;

class Model {
    private $connect;

    public function __construct() {
        $this->connect = self::dbСonnect();
    }

    private static function dbСonnect(): mysqli {
        $server_name = "localhost";
        $user_name = "root";
        $password = ""; // ПАРОЛЬ ДЛЯ ДОСТУПА
        $db_name = "smartsoft"; // НАЗВАНИЕ БД

        $connect = mysqli_connect($server_name, $user_name, $password, $db_name);
        if(!$connect) die("Connection failed");
        
        mysqli_set_charset($connect, "utf8");
        return $connect;
    }

    public function query(string $table): array {
        $sql = "SELECT * FROM `$table`";
        $result = mysqli_query($this->connect, $sql);
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function saveReview(string $name, string $comment): bool {
        $stmt = $this->connect->prepare("INSERT INTO reviews (name, comment) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $comment);
        return $stmt->execute();
    }
}

// сохранение
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['fullnameReview'])) {
    $model = new Model();
    
    $name = trim(htmlspecialchars($_POST['fullnameReview']));
    $comment = trim(htmlspecialchars($_POST['messageReview']));
    
    if (empty($name) || empty($comment)) {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Заполните все поля']);
        exit;
    }

    header('Content-Type: application/json');
    echo json_encode([
        'success' => $model->saveReview($name, $comment),
        'message' => 'Отзыв сохранён!'
    ]);
    exit;
}
?>