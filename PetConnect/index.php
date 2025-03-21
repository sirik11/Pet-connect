<?php
include("includes/header.php");
include("includes/classes/User.php");
include("includes/classes/Post.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if(isset($_POST['post'])){
    $post = new Post($con, $userLoggedIn);
    $post-> submitPost($_POST['post_text'], 'none');
    header("Location: index.php");
}
?>
<div class="user_details column">
    <a href="<?php echo $userLoggedIn; ?>"> <img src="<?php echo $user['profile_pic']; ?>" class="profile_pic"> </a>
    <div class="user_details_left_right">
        <a href="<?php echo $userLoggedIn; ?>">
            <?php echo $user['first_name'] . " " . $user['last_name']; ?>
        </a>
        <br>
        <?php echo "Posts: " . $user['num_posts'] . "<br>"; // Corrected line
        echo "Likes: " . $user['num_likes']; ?>
    </div>
</div>
    <div class="main_column column">
        <form class="post_form" action="index.php" method="POST">
            <textarea name="post_text" id="post_text" placeholder="Got something to say?"> </textarea>
            <input type="submit" name="post" id="post_button" value="Post">


</form>
<?php
    $post = new Post($con, $userLoggedIn);
    $post->loadPostsFriends($userLoggedIn);
?>

</div>


</div>

</body>
</html>
