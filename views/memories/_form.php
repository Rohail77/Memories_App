
<?php  if ($errors) :?>
<div class="alert alert-danger" role="alert">
<?php foreach ($errors as $error) :?>
    <?php  echo  "<p>$error</p>"; ?>
    <?php endforeach;?>
</div>
<?php endif; ?>

<form method="POST" action="" enctype="multipart/form-data" class="mb-5">
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="<?php echo $title ?>" placeholder="Enter memory title"/>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="mb-3 form-control" id="description" name="description" ><?php echo $description ?></textarea>
    </div>

    <div class="mb-3">
        <label for="date_time" class="form-label">Date & Time</label>
        <input type="datetime-local" class="form-control" id="date_time" name="date_time" value="<?php echo $date_time?>"/>
    </div>

    <div class="mb-3">
        <label class="form-label" for="image"
        >Add Image</label
        >
        <input type="file" class="form-control" id="image" name="image"/>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>