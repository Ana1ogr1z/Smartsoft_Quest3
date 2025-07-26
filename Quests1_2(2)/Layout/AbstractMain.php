<?php
namespace Layout;

include_once __DIR__ . "/../Models/Model.php";

use Models\Model;

abstract class AbstractMain{

    private $model = null;

    public function __construct() {
        $this->model = new Model();
    }

    public function render(): void{
        echo $this->getHeader();
        echo $this->hetLayout();
        echo $this->getFooter();
    }

protected function getHeader(): void{
    echo'<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Ярослав Шипилов">
        <title>Hello</title>
        <link rel="stylesheet" href="main.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css"> 
    </head>
    <body>
        <noscript>Включите JavaScript</noscript>
        <!--Заголовок-->
        <h1 style="text-align: center;">Тестовое задание СмартСофт</h1>';
}

protected function getFooter(): void {
    echo '<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="main.js"></script>
        <script src="reviewBlock.js"></script>
        </body>
    </html>';
}

abstract protected function getLayout(): void;

 public function view(): void
    {
        $this->getHeader();
        $this->getLayout();
        $this->getFooter();
    }
     private function getModel(): ?Model
    {
        if (!$this->model) {
            die("Model fail");
        }

        return $this->model;
    }

    
    protected function sql(string $table): array
    {
        $model = $this->getModel();

        return $model->query($table);
    }
}
?>