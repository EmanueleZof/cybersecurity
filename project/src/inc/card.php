<div class="col">
    <div class="card shadow-sm">
        <img class="card-img-top" src="<?= $thumb ?>">
        <div class="card-body">
            <p class="card-text fw-bold"><?= $title ?></p>
            <p class="card-text"><?= $lead ?></p>
            <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                    <a href="course.php?id=<?= $ID ?>" class="btn btn-sm btn-outline-secondary">Guarda</a>
                </div>
                <small class="text-body-secondary"><?= $time ?> mins</small>
            </div>
        </div>
    </div>
</div>