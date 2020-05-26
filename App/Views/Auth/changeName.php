<div class="container align-content-center  col-md-4">
    <h1 class="text-center">Change full name</h1>
    <form method="POST" action="/user/updateName">
        <div class="form-group">
            <label for="form-group">First name</label>
            <input type="text"
                   class="form-control"
                   name="first_name"
                   id="first_name"
                   placeholder="Enter your name"
                   value="<?php echo !empty($data['first_name']) ? $data['first_name'] : ''; ?>">
            <?php if(!empty($error['first_name_error'])) { ?>
                <div class="alert alert-danger" role = "alert" ><?= $error['first_name_error'] ?></div >
            <?php }?>
        </div>
        <div class="form-group">
            <label for="form-group">Last name</label>
            <input type="text"
                   class="form-control"
                   name="last_name"
                   id="last_name"
                   placeholder="Enter your surname"
                   value="<?php echo !empty($data['last_name']) ? $data['last_name'] : '';?>">
            <?php if(!empty($error['last_name_error'])) { ?>
                <div class="alert alert-danger" role = "alert" ><?= $error['last_name_error'] ?></div >
            <?php }?>
            <div class="form-group">
                <label for="form-group">E-mail</label>
            <input type="email"
                   class="form-control"
                   name="email"
                   id="email"
                   placeholder="Enter your e-mail"
                   value="<?php echo !empty($data['email']) ? $data['email'] : 'Enter your email';?>">
            <?php if(!empty($error['email_error'])) { ?>
                <div class="alert alert-danger" role = "alert" ><?= $error['email_error'] ?></div >
            <?php }?>
        </div>
        <div class="form-group">
            <label for="form-group">Birthday</label>
            <input type="date"
                   class="form-control"
                   name="birthday"
                   id="birthday"
                   placeholder="Enter your birthday date"
                   value="<?php echo !empty($data['birthday']) ? $data['birthday'] : '';?>">
            <?php if(!empty($error['birthday_error'])) { ?>
                <div class="alert alert-danger" role = "alert" ><?= $error['birthday_error'] ?></div >
            <?php }?>
        </div>
        <div class="form-group">
            <label for="form-group">Your password</label>
            <input type="password"
                   class="form-control"
                   name="password"
                   id="password"
                   placeholder="Enter your password">
            <?php if(!empty($error['password'])) { ?>
                <div class="alert alert-danger" role = "alert" ><?= $error['password'] ?></div >
            <?php
                unset($error['password']);
            }?>
        </div>
        <button type="submit" class="btn btn-primary">Change</button>
    </form>
</div>