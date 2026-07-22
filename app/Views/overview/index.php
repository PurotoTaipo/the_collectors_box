<h1 class="overview-heading"><?= htmlspecialchars($title) ?></h1>

<ul class="overview-grid">
    <?php foreach ($objects as $object) : ?>
        <li class="collectable-card">
            <div class="collectable-cover">
                <img
                    src="<?= htmlspecialchars($object->getImageData()) ?>"
                    alt="<?= htmlspecialchars($object->getTitle()) ?>"
                    loading="lazy"
                >
            </div>
            <span class="collectable-title"><?= htmlspecialchars($object->getTitle()) ?></span>
        </li>
    <?php endforeach; ?>
</ul>
