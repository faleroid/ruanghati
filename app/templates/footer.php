</main> <footer>
        <p>&copy; <?= date('Y') ?> RuangHati | Temukan Sudut Pandang Barumu</p>
    </footer>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const notification = document.querySelector('.notification');

            if (notification) {
                setTimeout(() => {
                    notification.classList.add('fade-out');
                }, 3000);

                notification.addEventListener('transitionend', () => {
                    notification.remove();
                });
            }
        });
    </script>
</body>
</html>