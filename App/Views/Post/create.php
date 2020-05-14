<div class="container align-content-center  col-md-4">
    <?php if(!empty($_SESSION['error'])) { ?>
    <div class="alert alert-primary " style="text-align: center">
        <?php   echo $_SESSION['error'];
        unset($_SESSION['error']);?>
    </div>
    <?php }?>
    <h1 class="text-center">Create Post Form</h1>
    <form method="POST" action="/posts/store" enctype="multipart/form-data">
        <div class="form-group">
            <label for="form-group">Title</label>
            <input type="text"
                   class="form-control"
                   name="title"
                   id="title"
                   placeholder="Write title post"
                   value="<?=$title??null?>">
        </div>
        <?php if(!empty($error['title_error'])) { ?>
            <div class="alert alert-danger" role = "alert" ><?= $error['title_error'] ?></div >
        <?php }?>
        <div class="form-group">
            <label for="form-control">Image</label>
            <input type="file" class="form-control-file" name="image" id="image">
        </div>
        <div class="form-group">
            <label for="form-group">Content</label>
            <textarea name="content"
                      id="postContent"
                      class="form-control"
                      rows="10"><?=$content??null?></textarea>
        </div>
        <?php if(!empty($error['content_error'])) { ?>
            <div class="alert alert-danger" role = "alert" ><?= $error['content_error'] ?></div >
        <?php }?>
        <br>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>