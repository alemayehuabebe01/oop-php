<?php  

require_once('Database.php');

class Post{

    private $db;
    public function __construct(){
        $this->db = new Database();
    }

    public function getPost(){
        $this->db->query("SELECT * FROM tbl_oop_post");
        return $this->db->resultset();
    }

    public function getPostById($id){
        $this->db->query("SELECT * FROM tbl_oop_post where id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    //insert data

    public function addPost($data){
        $this->db->query("INSERT INTO tbl_oop_post(title,content) VALUES(:title, :content)");
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':content', $data['content']);
    
    if( $this->db->execute()){   
            return true;
    }else{
        return false;
    }

    }

    //update the the database 

    public function updatePost($data){
        $this->db->query("UPDATE tbl_oop_post SET title = :title, content = :content where id = :id");
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':content', $data['content']);
    
    if( $this->db->execute()){   
            return true;
    }else{
        return false;
    }

    }


    // delete the recorded data
    public function deletePost($id){
        $this->db->query("DELETE FROM tbl_oop_post  where id = :id");
        $this->db->bind(':id', $id);
      
        if( $this->db->execute()){   
                return true;
        }else{
            return false;
        }

        }

  
}