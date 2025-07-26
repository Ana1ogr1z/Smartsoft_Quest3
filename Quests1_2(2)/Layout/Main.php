<?php

namespace Layout;

include_once __DIR__ . "/AbstractMain.php";

use Layout\AbstractMain;

class Main extends AbstractMain {
    protected function getLayout(): void {
        echo $this->userInfoBlock();
        echo $this->orderBlock();
        echo $this->reviewsBlock();
        echo $this->reviewsMakeBlock();
    }

    private function userInfoBlock(): void {
        echo'
        <!--Первая форма ввода данных-->
        <form action="" method="" class="panel" id="user_info">
            <p></p>
            <div>   
                <label>Имя</label><br>
                <input minlength="3" type="text" required id="username" name="username"><br>
            </div>
            <div>
                <label>Фамилия</label><br>
                <input type="text" id="usersurname" name="usersurname"><br>
            </div>
            <div>
                <label>Почта</label><br>
                <input type="email" required id="email" name="email"><br>
            </div>
            <div>
                <label>Сообщение</label><br>
                <textarea required maxlength="80" id="message" name="message"></textarea><br>
            </div>
                <button type="submit" id="sendButton">Отправить</button>
            <p></p>
        </form>';
    }

    private function orderBlock(): void {
        echo '
        <!--Вторая форма ввода адреса-->
        <form action="" method="" class="panel" id="order_form">
            <p></p>
                <label style="font-size: 18px;"><b>Информация о заказе</b></label><br>
                <label style="color: lightgray; font-size: 12px;">Доставим за 2 дня</label>
            <p></p>
            <div>
                <label>Полное имя</label><br>
                <input minlength="3" type="text" required id="fullname" name="fullname"><br>
            </div>
            <div>
                <label>Адрес доставки</label><br>
                <input type="text" id="address" name="address"><br>
            </div>
            <div>
                <label>Комментарий к доставке</label><br>
                <textarea id="order_comm" name="order_comm"></textarea>
            </div>
            <div>
                <input required style="margin: 10px" type="checkbox" id="contract" name="contract">
                <label style="margin: 1px;" for="contract">Принять условия договoра-оферты</label>
            </div>
                <button type="button" id="click_order">Создать заказ</button>
            <p></p>
        </form>';
    }

private function list(): void
{
    $rows = $this->sql('reviews');
    $maxReviews = 6; // 2 строки × 3 столбца = 6 отзывов

    echo '<div id="reviews-container" class="reviews-container">';
    
    if (!empty($rows)) {
        $counter = 0;
        foreach ($rows as $row) {
            if ($counter >= $maxReviews) {
                break; // Прекращаем вывод после 6 отзывов
            }
            
            $name = htmlspecialchars($row['name'] ?? 'Аноним');
            $comment = htmlspecialchars($row['comment'] ?? 'Без комментария');
            
            echo '<div class="response">
                <strong class="responseTitle">' . $name . '</strong><br>
                <p class="responseText">' . $comment . '</p>
              </div>';
            
            $counter++;
        }
    } else {
        echo '<p>Пока нет отзывов</p>';
    }
    
    echo '</div>';
}

    private function reviewsMakeBlock(): void
{
    echo'<button type="button" style="width: 200px; height: 30px; margin-left: 45%;" id="makeReviewBlock" >Добавить отзыв</button>
    <form action="Models/Model.php" method="post" class="panel" id="reviewBlock" hidden>
            <p></p>
    <label class="responseTitle" style="margin-left: 2%;">Оставьте свой отзыв!</label>
    <p></p>
            <div>   
                <label>Полное имя</label><br>
                <input minlength="3" type="text" required id="fullnameReview" name="fullnameReview"><br>
            </div>
            <div>
                <label>Отзыв</label><br>
                <textarea required maxlength="80" id="messageReview" name="messageReview"></textarea><br>
            </div>
            <p></p>
                <button type="submit" id="sendButtonReview">Отправить отзыв</button>
            <p></p>
        </form>';
}

private function getRows(): void
{
    $rows = $this->sql('reviews');

    foreach ($rows as $row) {
        $name = htmlspecialchars($row['name'] ?? '');
        $comment = htmlspecialchars($row['comment'] ?? '');
        
        if (!empty($name) || !empty($comment)) {
            echo '<div class="review-line">' . $name . ': ' . $comment . '</div>';
        }
    }
}


    private function reviewsBlock(): void {
        echo '
    <div class="reviews-section">
        <h2 class="reviews-title">Отзывы</h2>
        <p class="reviews-subtitle">Популярные отзывы наших клиентов</p>';
        $this->list();
        echo'</div>';
    }
}

