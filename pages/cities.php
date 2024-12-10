<?php
include "../inc/connDB.php";

if (isset($_GET["countryId"]) && isset($_GET["countryName"])) {
    $countryId = $_GET["countryId"];
    $countryName = $_GET["countryName"];
    $sql = "SELECT * FROM city WHERE country_id = $countryId";
    $res = mysqli_query($conn, $sql);
    $cities = mysqli_fetch_all($res, MYSQLI_ASSOC);
} else {
    die("something went wrong");
}



?>

<?php include "../inc/header.php" ?>
<h1 class="text-center mt-4"><?php echo $countryName ?> Cities</h1>

<main class="container mt-5">
    <div class="mb-5 d-flex mt-5">
        <a href="../index.php">
            <button class="btn btn-secondary">
                Back To Countries
            </button>
        </a>
        <div class="ms-auto">
            <button type="button" class="btn btn-md btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Create city</button>
            <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Create City</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="../actions/cities/create.php">
                                <div class="mb-2">
                                    <label for="name" class="col-form-label">Name</label>
                                    <input type="text" name="name" class="form-control" id="name">
                                    <input type="hidden" name="countryId" value=<?php echo $countryId ?>>
                                </div>
                                <div class="mb-2">
                                    <label for="imageUrl" class="col-form-label">image Url</label>
                                    <input type="url" name="imageUrl" class="form-control" id="imageUrl">
                                </div>
                                <div class="mb-2">
                                    <label for="description" class="col-form-label">Description</label>
                                    <textarea type="text" name="description" class="form-control" id="description"></textarea>
                                </div>
                                <select class="form-select" name="type" aria-label="Default select example">
                                    <option value="Autre" selected>autre</option>
                                    <option value="Capital">Capital</option>
                                </select>
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
        <?php foreach ($cities as $index => $city): ?>
            <div class="mb-4 col-md-4">
                <div class="card" style="width: 18rem;">
                    <div class="relative">
                        <?php if ($city['type'] == "Capital"): ?>
                            <h1 class="badge text-bg-success position-absolute top-0 mt-2 me-2 end-0 z-3">
                                Capital
                            </h1>
                        <?php endif; ?>

                        <?php if (!empty($city["image"])): ?>
                            <img src="<?php echo $city["image"]; ?>" class="card-img-top" alt="<?php echo $city['name']; ?>">
                        <?php else: ?>
                            <div class="position-relative">
                                <img src="../assets/bg-black.webp" class="card-img-top" alt="Placeholder">
                                <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark d-flex justify-content-center align-items-center text-white">
                                    No Image
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-primary"><?php echo $city['name']; ?></h5>
                        <p class="card-text"><?php echo $city["description"] ?></p>
                        <div class="d-flex">
                            <form action="../actions/cities/delete.php" method="POST">
                                <input type="hidden" class="d-none" name="deleteCity" value=<?php echo $city['id'] ?>>
                                <button type="submit" class="bg-hidden bg-transparent border border-0">
                                    <img src="../assets/delete.svg" alt="" style="width: 20px;">
                                </button>
                            </form>
                            <button type="button" class="border border-0 bg-transparent" data-bs-toggle="modal" data-bs-target="#updateModal<?php echo $index; ?>">
                                <img src="../assets/edit.svg" alt="" style="width: 20px;">
                            </button>
                            <div class="modal fade" id="updateModal<?php echo $index; ?>" tabindex="-1" aria-labelledby="exampleModalLabel<?php echo $index; ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel<?php echo $index; ?>">Update a city</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="../actions/cities/update.php">
                                                <div class="mb-2">
                                                    <label for="name<?php echo $index; ?>" class="col-form-label">Name</label>
                                                    <input type="text" name="name" value="<?php echo $city['name']; ?>" class="form-control" id="name<?php echo $index; ?>">
                                                    <input type="hidden" name="cityId" value="<?php echo $city['id']; ?>">
                                                </div>
                                                <div class="mb-2">
                                                    <label for="imageUrl<?php echo $index; ?>" class="col-form-label">Image URL</label>
                                                    <input type="url" value="<?php echo $city['image']; ?>" name="imageUrl" class="form-control" id="imageUrl<?php echo $index; ?>">
                                                </div>
                                                <div class="mb-2">
                                                    <label for="description<?php echo $index; ?>" class="col-form-label">Description</label>
                                                    <textarea name="description" class="form-control" id="description<?php echo $index; ?>"><?php echo htmlspecialchars($city['description']); ?></textarea>
                                                </div>
                                                <select class="form-select" name="type">
                                                    <option value="Autre" <?php echo ($city["type"] == "Autre") ? 'selected' : ''; ?>>Autre</option>
                                                    <option value="Capital" <?php echo ($city["type"] == "Capital") ? 'selected' : ''; ?>>Capital</option>
                                                </select>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <input type="submit" name="submit" class="btn btn-primary px-3" value="Update">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    </div>
</main>
<?php include "../inc/footer.php" ?>