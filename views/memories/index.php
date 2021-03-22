<div class="container__content d-flex flex-column align-items-center">
    <div class="container py-4">
        <a href="/memories/create" class="btn btn-success d-block mb-5 align-self-stretch"
        >Add a Memory</a
        >
        <h1 class="mb-4">Your Memories</h1>
        <form action="" class="align-self-stretch mb-4">
            <div class="input-group mb-3">
                <input type="submit" class="input-group-text btn btn-secondary" value="Search">
                <input
                        type="text"
                        class="form-control"
                        placeholder="Search memories"
                        name="search"
                        value="<?php echo $search ?>"/>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Date</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($memories as $key=>$memory) : ?>
                    <tr>
                        <th scope="row"><?php echo ++$key ?></th>
                        <td><?php echo $memory['title'] ?> </td>
                        <td><?php echo $memory['date_time'] ?> </td>
                        <td>
                            <a href=
                               <?php echo "/memories/details?id=" . $memory['id']; ?> id=

                                <?php echo $memory['id'] ?> class="btn btn-primary btn-sm">View Details</a>
                            <a href=
                               <?php echo "/memories/update?id=" . $memory['id']; ?> class="btn btn-sm
                               btn-dark ms-4">Edit</a>
                            <a href=
                               <?php echo "/memories/delete?id=" . $memory['id']; ?> class="ms-1 btn btn-sm
                               btn-danger">Remove</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

