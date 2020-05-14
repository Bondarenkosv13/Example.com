<div class="container align-content-center  col-md-4">
    <?php if(!empty($_SESSION['error'])) { ?>
        <div class="alert alert-danger" role = "alert" ><?php
            echo $_SESSION['error'];
            unset($_SESSION['error']);?></div >
    <?php }?>
    <h1 class="text-center">User login</h1>
    <form method="POST" action="/auth">
        <div class="form-group">
            <label for="form-group">E-mail</label>
            <input type="email"
                   class="form-control"
                   name="email"
                   id="email"
                   placeholder="Enter your email"
                   value="<?php echo !empty($_SESSION['user_data']['email']) ? $_SESSION['user_data']['email'] : ''; ?>">
        </div>
        <div class="form-group">
            <label for="form-group">Password</label>
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
