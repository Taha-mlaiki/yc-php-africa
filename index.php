<?php
include "./inc/connDB.php";

$sql = "SELECT * FROM country WHERE continent_id = 1";

$res = mysqli_query($conn, $sql);
$countries = mysqli_fetch_all($res, MYSQLI_ASSOC);

?>

<?php include "./inc/header.php" ?>
<header class="d-flex justify-content-center container mt-3">
    <h1>Africa Géo-Junior</h1>
</header>
<main class="container mt-4">
    <div class="mb-5 d-flex mt-5">
        <div class="ms-auto">
            <button type="button" class="btn btn-md btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Create Country</button>
            <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Create Country</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="./actions/country/create.php">
                                <div class="mb-2">
                                    <label for="name" class="col-form-label">Name</label>
                                    <input type="text" name="name" class="form-control" id="name">
                                    <input type="hidden" name="continentId" value="1">
                                </div>
                                <div class="mb-2">
                                    <label for="imageUrl" class="col-form-label">image Url</label>
                                    <input type="url" name="imageUrl" class="form-control" id="imageUrl">
                                </div>
                                <div class="mb-2">
                                    <label for="langue" class="col-form-label">Language</label>
                                    <input type="text" name="langue" class="form-control" id="langue">
                                </div>
                                <div class="mb-2">
                                    <label for="population" class="col-form-label">Population</label>
                                    <input type="number" name="population" class="form-control" id="population">
                                </div>
                                <div class="mt-3 d-flex column-gap-2 justify-content-end">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <input type="submit" name="submit" class="btn btn-primary px-3" value="Create">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <?php foreach ($countries as $index => $country): ?>
            <div class="col-md-4 mb-4">
                <div class="card" style="width: 18rem;">
                    <?php if (!empty($country["image"])): ?>
                        <img src="<?php echo $country["image"]; ?>" class="card-img-top" alt="<?php echo $country['name']; ?>">
                    <?php else: ?>
                        <div class="position-relative">
                            <img src="./assets/bg-black.webp" class="card-img-top" alt="Placeholder">
                            <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark d-flex justify-content-center align-items-center text-white">
                                No Image
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title text-primary"><?php echo $country['name']; ?></h5>
                        <p class="card-text">Population: <span class="font-bold"><?php echo number_format($country["population"]); ?></span></p>
                        <div class="d-flex">
                            <p class="card-text">Language: <?php echo $country["langue"]; ?></p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-1">
                            <div class="d-flex">
                                <form action="./actions/country/delete.php" method="POST">
                                    <input type="hidden" class="d-none" name="countryId" value=<?php echo $country['id'] ?>>
                                    <button type="submit" class="bg-hidden bg-transparent border border-0">
                                        <img src="./assets/delete.svg" alt="" style="width: 20px;">
                                    </button>
                                </form>
                                <button type="button" class="border border-0 bg-transparent" data-bs-toggle="modal" data-bs-target="#updateModal<?php echo $index ?>">
                                    <img src="./assets/edit.svg" alt="" style="width: 20px;">
                                </button>
                                <div class="modal fade" id="updateModal<?php echo $index ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Country</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="./actions/country/update.php">
                                                    <div class="mb-2">
                                                        <label for="name<?php echo $index ?>" class="col-form-label">Name</label>
                                                        <input type="text" name="name" value='<?php echo $country['name']; ?>' class="form-control" id="name<?php echo $index ?>">
                                                        <input type="hidden" name="countryId" value=<?php echo $country['id']; ?>>
                                                    </div>
                                                    <div class="mb-2">
                                                        <label for="imageUrl<?php echo $index; ?>" class="col-form-label">Image URL</label>
                                                        <input type="url" value="<?php echo $country['image']; ?>" name="imageUrl" class="form-control" id="imageUrl<?php echo $index; ?>">
                                                    </div>
                                                    <div class="mb-2">
                                                        <label for="langue<?php echo $index ?>" class="col-form-label">Language</label>
                                                        <input type="text" name="langue" value=<?php echo $country['langue'] ?> class="form-control" id="langue<?php echo $index ?>">
                                                    </div>
                                                    <div class="mb-2">
                                                        <label for="population<?php echo $index ?>" class="col-form-label">Population</label>
                                                        <input type="number" name="population" value=<?php echo $country['population'] ?> class="form-control" id="population<?php echo $index ?>">
                                                    </div>
                                                    <div class="mt-3 d-flex column-gap-2 justify-content-end">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <input type="submit" name="submit" class="btn btn-primary px-3" value="Update">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a class="ms-auto" href="./pages/cities.php?<?php echo 'countryId=' . $country['id'] . "&countryName=" . $country['name'] ?>">
                                <button class="btn btn-primary">
                                    See Cities
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>
<?php include "./inc/footer.php" ?>