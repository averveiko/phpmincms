<?php
/**
 * Обеспечивает работу с базой
 *
 * @author averveyko
 */
class DB {
    public $dsn = "sqlite:base/base.db";
    private $pdo;
    
    function __construct() {
        try {
            $this->pdo = new PDO($this->dsn);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);            
        } catch(PDOException $e) {
            file_put_contents('logs/PDOErrors.log', $e->getMessage(), FILE_APPEND);
        }
    }
    function __destruct() {
        $this->pdo = null;
    }
    function loadPage($name) {
        try {
            $stmt = $this->pdo->prepare("SELECT name, title, content FROM pages WHERE name=?");
            $stmt->execute([$name]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            file_put_contents('logs/PDOErrors.log', $e->getMessage(), FILE_APPEND);
        }
    }
    //Функции для админки
    function listOfPages(){
        try {
            $stmt = $this->pdo->query("SELECT name, title FROM pages");
            return $stmt->fetchAll();    
        } catch (PDOException $e) {
            file_put_contents('logs/PDOErrors.log', $e->getMessage(), FILE_APPEND);
        }
    }
    function updatePage($oldName, $newName, $newTitle, $newContent) {
        //Обновляет страницу
        try {
            $stmt = $this->pdo->prepare("UPDATE PAGES SET name=?, title=?, content=? WHERE name=?");
            $stmt->execute(array($newName, $newTitle, $newContent, $oldName));
        } catch (PDOException $e) {
            file_put_contents('logs/PDOErrors.log', $e->getMessage(), FILE_APPEND);
        }
    }   
}
?>
