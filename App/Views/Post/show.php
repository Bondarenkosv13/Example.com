<div class="container-md">
    <h2 class="text-left"><?php echo $title ?? null; ?></h2>
    <h6 class="text-muted">Author:<?php echo $name ?? null; ?><br><small>Public
            date: <?php echo $created_at ?? null; ?></small></h6>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-6">
            <img src="/Assets/<?php echo $image;?>" alt="<?php echo $title ?? null; ?>">
        </div>
        <div class="col-md-4"></div>
    </div>
    <br>
    <p class="text-justify"><?php echo nl2br($content ?? null); ?></p>
</div>