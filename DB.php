<?php
/**
 * Обеспечивает работу с базой
 *
 * @author averveyko
 */
class DB {
    public $database = "sqlite:base/base.db";
    private $DBH;
    private $STHloadPage;
    
    function __construct() {
        try {
            //Открываем базу
            $this->DBH = new PDO($this->database);
            $this->DBH->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            //Подготавливаем запрос для получения страницы
            $this->STHloadPage = $this->DBH->prepare("SELECT name, title, content FROM pages WHERE name=:name;");
            $this->STHloadPage->setFetchMode(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo 'Houston, we have a problems, check PDOErrors.log';
            file_put_contents('logs/PDOErrors.log', $e->getMessage(), FILE_APPEND);
        }
    }
    function __destruct() {
        $this->DBH = null;
    }
    function loadPage($name) {
        //Загрузка страницы из базы
        try {
            $this->STHloadPage->bindParam(':name', $name, PDO::PARAM_STR);
            $this->STHloadPage->execute();
            return $row = $this->STHloadPage->fetch();
            
        } catch (PDOException $e) {
            echo 'Houston, we have a problems, check PDOErrors.log';
            file_put_contents('logs/PDOErrors.log', $e->getMessage(), FILE_APPEND);
        }
    }
    //Функции для админки
    function listOfPages(){
        try {
            $STHlistOfPages = $this->DBH->query("SELECT name, title FROM pages;");
            $STHlistOfPages->setFetchMode(PDO::FETCH_ASSOC);
            $STHlistOfPages->execute();
            $arrPages = [];

            while($row = $STHlistOfPages->fetch()) {  
                $arrPages[] = $row;
            }
            return $arrPages;
        } catch (PDOException $e) {
            echo 'Houston, we have a problems, check PDOErrors.log';
            file_put_contents('logs/PDOErrors.log', $e->getMessage(), FILE_APPEND);
        }
    }
    function updatePage($oldName, $newName, $newTitle, $newContent) {
        //Обновляет страницу
    }
}
?>
