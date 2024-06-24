<div class="bg-body-tertiary me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden">
    <a href="course.php?id=<?= $data['course_id'] ?>" class="product-link">
        <div class="my-3 p-3">
            <h2 class="display-5"><?= $data['course_title'] ?></h2>
            <p class="lead"><?= $data['course_lead'] ?></p>
        </div>
        <div class="bg-body shadow-sm mx-auto product-thumbnail">
            <img src="<?= $data['course_thumbnail'] ?>">
        </div>
    </a>
</div>