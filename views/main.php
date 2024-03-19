<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Welcome to facebook v-1</h1>
    <form method="post">
        <button type="submit" name="disconnect">Se déconnecter</button>
    </form>
    <?php
        foreach($posts as $post){
            if(isset($_POST["edit"])){
                if($_POST["edit"]==$post["id"])
                    echo '<form method="post">
                        <input type="text" name="title" placeholder="Title" value="'. $post["Title"] .'"/>
                        <input type="text" name="content" placeholder="Content" value="'. $post["Content"] .'"/>
                        <button type="submit" name="confirm" value="' . $post["id"] . '">Confirmer</button>';
                else{
                    echo "<h2>" . $post["Title"] . "</h2>";
                    echo "<p>" . $post["Content"] . "</p>";
                    echo '<form method="post">';
                }
            }
            else{
                echo "<h2>" . $post["Title"] . "</h2>";
                echo "<p>" . $post["Content"] . "</p>";
                echo '<form method="post">';
            }
            
            if($post["User_idUser"] === $_SESSION["user"]){
            ?>
                    <button type="submit" name="edit" value="<?= $post["id"] ?>">Modifier</button>
                    <button type="submit" name="delete" value="<?= $post["id"] ?>">Supprimer</button>
                </form>
            <?php
            }
            echo "<hr>";
        }
    ?>
    <h2>
        Créez votre propre post, incroyable !
    </h2>
    <form method="post">
        <input type="text" name="title" placeholder="Title"/>
        <input type="text" name="content" placeholder="Content"/>
        <button type="submit" name="create">Créer post</button>
    </form>
</body>
</html>