<div class="container align-content-center  col-md-4">
    <?php if(!empty($_SESSION['error'])) { ?>
        <div class="alert alert-danger" role = "alert" ><?php
            echo $_SESSION['error'];
            unset($_SESSION['error']);?></div >
    <?php }?>
    <h1 class="text-center">Update password</h1>
    <form method="POST" action="/user/updatePassword">
        <div class="form-group">
            <label for="form-group">Write the old password</label>
            <input type="password"
                   class="form-control"
                   name="old_password"
                   id="old_password"
                   placeholder="Enter your password"
        </div>
        <br>
        <div class="form-group">
            <label for="form-group">Write the new password</label>
            <input type="password"
                   class="form-control"
                   name="new_password_1"
                   id="new_password_1"
                   placeholder="Enter your password"
        </div>
        <br>
        <div class="form-group">
            <label for="form-group">Repeat the new password</label>
            <input type="password"
                   class="form-control"
                   name="new_password_2"
                   id="new_password_2"
                   placeholder="Enter your password"
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>