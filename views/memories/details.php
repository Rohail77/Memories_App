<div class="my-4">
    <img src="<?php echo "/images/memories/" . $memory['image'] ?>" class="details-img" alt=""/>
</div>

<div class="container pb-5">

    <div class="text-center mb-4">
        <p class="display-1 lh-1"><?php echo $memory['title'] ?></p>
        <p class="fs-5 lh-1"><?php echo $memory['date_time'] ?></p>
    </div>

    <div class="description text-center text-sm-start">
        <h1 class="mb-3">Description</h1>
        <p class="pb-4 border-bottom">
            <?php echo $memory['description'] ?>
        </p>
        <div class="d-flex align-items-end flex-wrap justify-content-between">
            <a href="/" class="link-primary h6 lh-1 me-4">Back to Home Page</a>
            <div class="mt-2">
                <a href=<?php echo "/memories/update?id=" . $memory['id'] ?> class="btn btn-dark me-1">Edit</a>
            </div>
        </div>
    </div>
</div>
