<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=smartsoft", "root", "19022007QaZ");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $pdo->query("SELECT name_reviews, comment_reviews FROM reviews");
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    

    foreach ($reviews as $review) {
        echo '<div class="response">'; // Открываем
        
        echo '
        <div class="responseHead">
            <p class="responseTitle">' . htmlspecialchars($review['name_reviews']) . '</p>
        </div>
        <p class="responseText">' . htmlspecialchars($review['comment_reviews']) . '</p>
        ';
        
        echo '</div>'; // Закрываем
    }



} catch(PDOException $e) {
    echo "Ошибка: " . $e->getMessage();
}
?>