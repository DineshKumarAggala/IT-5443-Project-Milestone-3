        <!-- Footer -->
        <footer class="footer">
            <p>This is a class project for <a href="http://it5443.azurewebsites.net" target="_blank" class="footer-link">IT 5443</a></p>
            <p>&copy; 2025 Center for Applied Computing - Kennesaw State University</p>
        </footer>
    </div>

    <?php if (isset($additional_js)): ?>
        <?php foreach ($additional_js as $js): ?>
            <script src="<?php echo htmlspecialchars($js); ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>