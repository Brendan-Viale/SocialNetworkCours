<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Social Network | Home</title>
</head>
<body>
  <h1>Social Network</h1>
  <h2>Home</h2>
  <p>Welcome <b><?= $user->getUsername(); ?></b>.</p>
  <a href="/logout">Logout</a>
  <hr>
  <?php foreach ($posts as $post): ?>
    <?php 
      $author = User::findById($post->getIdUser())[0]; 
      // Si on a cliqué sur le bouton Update une 1ère fois, affiche les textes normalement, sinon les affiche en tant qu'input
      if(!isset($_POST["updatable"]))
        echo "<h3>" . $post->getTitle() . "</h3>
          <p>" . $post->getContent() . "</p>
          <p><i>Author : " . $author['firstName'] . ' ' . $author['lastName'] . "</i></p><form method='POST' action='/'>";
      else if($_POST["postId"] === $post->getId())
        echo "<form method='post' action='/'>
            <label for='title'>Title</label>
            <input type='text' name='title' value='" . $post->getTitle() . "'><br>
            <label for='content'>Content</label>
            <input type='text' name='content' value='" . $post->getContent() . "'><br>
            <p><i>Author : " . $author['firstName'] . ' ' . $author['lastName'] . "</i></p>
          ";
      else 
        echo "<h3>" . $post->getTitle() . "</h3>
          <p>" . $post->getContent() . "</p>
          <p><i>Author : " . $author['firstName'] . ' ' . $author['lastName'] . "</i></p><form method='POST' action='/'>";
    // Si l'utilisateur connecté est l'auteur du Post, on ajoute les boutons Delete et Update
      if($_SESSION['id_connected_user'] === $author['id']){
        $update = isset($_POST['updatable']) ?  'update' : 'updatable';
        echo "
          <input type='hidden' name='postId' value=" . $post->getId() . ">
          <input type='submit' name='$update' value='Update'>
        </form>
        <form method='POST' action='/'>
          <input type='hidden' name='postId' value=" . $post->getId() . ">
          <input type='submit' name='delete' value='Delete'>
        </form>";
      }
    ?>
    <hr>
  <?php endforeach ?>
  <form action="/" method="post">
    <div>
      <label for="title">title : </label>
      <input type="text" id="title" name="title">
    </div>
    <br>
    <div>
      <label for="content">content : </label>
      <textarea id="content" name="content"></textarea>
    </div>
    <br>
    <div>
      <input type="submit" name="create" value="Submit">
    </div>
  </form>
</body>
</html>