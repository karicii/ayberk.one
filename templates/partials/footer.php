</main>
        
        <!-- Newsletter Section -->
        <div class="newsletter-section">
            <div class="newsletter-container">
                <div class="newsletter-content">
                    <h3><?= t('newsletter_title') ?></h3>
                    <p><?= t('newsletter_subtitle') ?></p>
                </div>
                <form action="/newsletter/subscribe" method="POST" class="newsletter-form">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">
                    <div class="newsletter-input-group">
                        <input 
                            type="email" 
                            name="email" 
                            placeholder="<?= t('newsletter_email') ?>" 
                            required
                            aria-label="<?= t('newsletter_email') ?>"
                        >
                        <button type="submit"><?= t('newsletter_subscribe') ?></button>
                    </div>
                </form>
            </div>
        </div>

        <footer class="site-footer">
            <div class="footer-content">
                <p>&copy; <?= date('Y') ?> Ayberk Arıcı. <?= t('all_rights') ?></p>
                <nav class="social-nav">
                    <ul>
                        <li><a href="/arsiv"><?= t('archive') ?></a></li>
                        <li><a href="/feed" target="_blank" rel="noopener noreferrer">RSS</a></li>
                        <li><a href="https://github.com/karicii" target="_blank" rel="noopener noreferrer">GitHub</a></li>
                        <li><a href="https://linkedin.com/in/karici" target="_blank" rel="noopener noreferrer">LinkedIn</a></li>
                    </ul>
                </nav>
            </div>
        </footer>
    
    <?= (!isset($isPostShowPage) || !$isPostShowPage) ? '</div>' : '' ?>

    <script src="/assets/js/app.js"></script>
    <script src="/assets/js/toc.js"></script>
</body>
</html>