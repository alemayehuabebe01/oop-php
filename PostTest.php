<?php 

require_once('Post.php');

$p = new Post();

// select 

var_dump($p->getPost());
var_dump($p->getPostById(2));

//insert data to the data base

$data = ['title'=>'This is the new post inserted', 'content' => 'Enjoying the php oop'];
$p->addPost($data);
var_dump($p->getPost());

//update the post 


$data = ['id'=> 1, 'title'=>'updated one This is the new post inserted', 'content' => 'Enjoying the php oop'];
$p->updatePost($data);
var_dump($p->getPost());

//delete the post from  the table

$p->deletePost(4);
var_dump($p->getPost());