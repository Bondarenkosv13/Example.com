<div class="container align-content-center  col-md-4">
    <h1 class="text-center">User login</h1>
    <form method="POST" action="/auth">
        <?php if(!empty($_SESSION['error'])) { ?>
            <div class="alert alert-danger" role = "alert" ><?= $_SESSION['error'] ?></div >
    <?php }?>
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="text"
                   class="form-control"
                   name="email"
                   id="email"
                   placeholder="Enter your email"
                   value="<?php echo !empty($_SESSION['user_data']['email']) ? $_SESSION['user_data']['email'] : ''; ?>">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password"
                   class="form-control"
                   name="password"
                   id="password"
                   placeholder="Enter your password"
                   value=""
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
