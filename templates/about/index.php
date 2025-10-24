<?php require BASE_PATH . '/templates/partials/header.php'; ?>

<section class="about-hero">
    <span class="about-badge"><?= t('about_badge') ?></span>
    <h1><?= t('about_greeting') ?></h1>
    <p class="about-highlight"><?= htmlspecialchars($highlight) ?></p>
    <div class="about-hero-meta">
        <?php foreach ($focusAreas as $area): ?>
            <span><?= htmlspecialchars($area) ?></span>
        <?php endforeach; ?>
    </div>
</section>

<section class="about-stats">
    <?php foreach ($stats as $stat): ?>
        <article class="about-stat">
            <h3><?= htmlspecialchars($stat['value']) ?></h3>
            <span><?= htmlspecialchars($stat['label']) ?></span>
        </article>
    <?php endforeach; ?>
</section>

<section class="about-section">
    <h2><?= t('about_now_title') ?></h2>
    <div class="about-focus-list">
        <?php foreach ($now as $item): ?>
            <div class="about-focus-item">
                <p><?= htmlspecialchars($item) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section class="about-section">
    <h2><?= t('about_journey_title') ?></h2>
    <div class="about-timeline">
        <?php foreach ($timeline as $entry): ?>
            <div class="about-timeline-item">
                <span class="timeline-period"><?= htmlspecialchars($entry['period']) ?></span>
                <h3><?= htmlspecialchars($entry['title']) ?></h3>
                <p><?= htmlspecialchars($entry['description']) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section class="about-section">
    <h2><?= t('about_principles_title') ?></h2>
    <div class="about-values-grid">
        <?php foreach ($values as $value): ?>
            <article class="about-value">
                <h3><?= htmlspecialchars($value['title']) ?></h3>
                <p><?= htmlspecialchars($value['description']) ?></p>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<section class="about-section">
    <h2><?= t('about_toolbox_title') ?></h2>
    <div class="about-toolbox">
        <?php foreach ($toolbox as $group): ?>
            <div class="about-toolbox-card">
                <h3><?= htmlspecialchars($group['title']) ?></h3>
                <ul>
                    <?php foreach ($group['items'] as $item): ?>
                        <li><?= htmlspecialchars($item) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section class="about-cta">
    <div class="about-cta-content">
        <h2><?= t('about_cta_title') ?></h2>
        <p><?= t('about_cta_desc') ?></p>
        <a class="button button-primary" href="/contact">
            <span><?= t('about_cta_button') ?></span>
        </a>
    </div>
</section>

<?php require BASE_PATH . '/templates/partials/footer.php'; ?>
