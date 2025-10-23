</main>
        
        <!-- Newsletter Section -->
        <div class="newsletter-section">
            <div class="newsletter-container">
                <div class="newsletter-content">
                    <h3>Bültene Abone Ol</h3>
                    <p>Yeni yazılardan haberdar olmak için e-posta adresinizi bırakın.</p>
                </div>
                <form action="/newsletter/subscribe" method="POST" class="newsletter-form">
                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?? '' ?>">
                    <div class="newsletter-input-group">
                        <input 
                            type="email" 
                            name="email" 
                            placeholder="E-posta adresiniz" 
                            required
                            aria-label="E-posta adresi"
                        >
                        <button type="submit">Abone Ol</button>
                    </div>
                </form>
            </div>
        </div>

        <footer class="site-footer">
            <div class="footer-content">
                <p>&copy; <?= date('Y') ?> Ayberk Arıcı. Tüm hakları saklıdır.</p>
                <nav class="social-nav">
                    <ul>
                        <li><a href="/arsiv">Arşiv</a></li>
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