<br><h1 class="text-center">Posts admin</h1><br>
<div class="container-md">
    <ul class="list-group">
        <li class="list-group-item bg-primary text-white">
            <div class="row">
                <p class="col-1 alert-link">#</p>
                <p class="col-2 alert-link">Date</p>
                <p class="col-7 alert-link">Name article</p>
                <p class="col-2 alert-link">Action</p>
            </div>
        </li>
    <?php
    $i=1;
    foreach ($posts as $post)
    {
    ?>
            <li class="list-group-item list-group-item-primary">
                <div class="row">
                    <p class="col-1"><?php echo $i; $i++; ?></p>
                    <small class="col-2"><?php echo $post['created_at']; ?></small>
                    <a class="col-7 font-weight-bold" href="/posts/<?php echo $post['id']?>" ><?php echo $post['title'] ?? null ?></a>
                   <div class="col-2">
                       <a href="posts/<?php echo $post['id'] ?>/edit" type="button" class="btn btn-primary">Edit</a>
                       <a href="posts/<?php echo $post['id'] ?>/delete" type="button" class="btn btn-primary">Delete</a>
                   </div>
                </div>
            </li>

    <?php }?>
    </ul>
</div>