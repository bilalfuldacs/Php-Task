<?php 
class News extends Database {

    protected function show_news() {
        $sql = "select * FROM news";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $news = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Store news data in session
        session_start();
        $_SESSION['news'] = $news;

        // Redirect to news.php
        header("Location: ../views/news.php");
        exit();
    }
     protected function create_news($title, $description) {
        
        $sql = "insert INTO news (title, description) VALUES (?, ?)";
        $stmt = $this->connect()->prepare($sql);
        
        $stmt->bindParam(1, $title, PDO::PARAM_STR);
        $stmt->bindParam(2, $description, PDO::PARAM_STR);
        
        
        if ($stmt->execute()) {
            $_SESSION['news_create'] = "News created successfully";
                 $this->show_news();
        } else {
                       return "Error creating news.";
        }
    }

      protected function update_news($id,$title,$description) {
      
$sql = 'update news SET title = ?, description = ? WHERE id = ?';
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam(1,$title, PDO::PARAM_STR);
    $stmt->bindParam(2,$description, PDO::PARAM_STR);
    $stmt->bindParam(3,$id, PDO::PARAM_INT);
$result=$stmt->execute();

    if ($result) {
        $_SESSION['news_update'] = "News updated successfully";
        $this->show_news();
    } else {
        return "Error updating news.";
    }
}protected function delete_news($id) {
    $sql = 'DELETE FROM news WHERE id = ?';
    $stmt = $this->connect()->prepare($sql);
    $stmt->bindParam(1, $id, PDO::PARAM_INT);
    $result = $stmt->execute();

    if ($result) {
       
        $_SESSION['news_delete'] = "News successfully deleted.";
         $this->show_news();
    } else {
        $flash_message = "Error deleting news.";
        $_SESSION['flash_message'] = $flash_message;
    }
}

}
