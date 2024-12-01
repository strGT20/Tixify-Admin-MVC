<?php
class Post extends Controller
{

   public function index()
   {
      // Load model
      $postModel = $this->loadModel('PostModel');
      // Get data from the model
      $posts = $postModel->getAll();      // Load the view
      $this->loadView('posts', ['posts' => $posts]);
   }


   public function create_form()
   {
      $this->loadView('insert_post');
   }


   public function create_process()
   {
      $postModel = $this->loadModel('PostModel');
      $title = addslashes($_POST['title']);
      $content = addslashes($_POST['content']);
      $postModel->insert($title, $content);
      header('Location: ?c=Post');
      exit;
   }


   public function edit()
   {
      $id = $_GET['id'];

      if (!$id) header('Location: index.php?c=Post');

      $postModel = $this->loadModel('PostModel');
      $post = $postModel->getById($id);

      if (!$post->num_rows) header('Location: index.php?c=Post');

      $this->loadView('edit', ['post' => $post->fetch_object()]);
   }


   public function update()
   {
      $postModel = $this->loadModel('PostModel');

      $id = $_POST['id'];
      $title = addslashes($_POST['title']);
      $content = addslashes($_POST['content']); //agar karakter aneh2 bisa kebaca, menghindari sql injection
      // $title = $_POST['title'];
      // $content = $_POST['content'];

      $postModel->update($id, $title, $content);
      header('Location: ?c=Post');
   }

   public function delete()
   {
      $id = $_POST['id'];

      $postModel = $this->loadModel('PostModel');
      $postModel->delete($id);

      // redirect to post list after delete
      header('location:?c=Post');
   }
}
