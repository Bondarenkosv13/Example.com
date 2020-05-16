<div class="container-md"><br>
    <?php
    include_once dirname(__DIR__) . '/../../Config/constant.php';
    use App\Models\User;

    $posts = $posts??null;
    $users = new User();
    foreach ($posts as $post)
    {
        $user = $users->getUserFromId($post['user_id']);
        $post['name'] = $user['first_name'] . ' ' . $user['last_name'];
        ?>
        <h3 class="text-left"><?php echo $post['title']??null; ?></h3>
        <small class="text-muted">Author:<?php echo $post['name']??null;?> | Public date: <?php echo $post['created_at']??null;?></small>
        <br>
        <p class="text-justify lead" ><?php echo mb_strimwidth($post['content'], 0, 100, "..."); ?></p>
        <a class="btn btn-secondary" href="<?php  echo "http://" . $_SERVER['HTTP_HOST'] . "/posts/{$post['id']}"; ?>" role="button">View article</a>
        <hr>
    <?php } ?>
</div>