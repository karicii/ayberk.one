</main>
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