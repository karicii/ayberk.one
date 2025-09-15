</main>
        </div>
    </div> 

    <script>
        // İkonları oluştur
        lucide.createIcons();

        // Quill editor script'i
        if (document.querySelector('#editor')) {
            const quill = new Quill('#editor', {
                modules: { toolbar: [ [{ header: [1, 2, false] }], ['bold', 'italic', 'underline'], ['link', 'blockquote', 'code-block'], [{ list: 'ordered' }, { list: 'bullet' }] ] },
                theme: 'snow'
            });
            const form = document.querySelector('#post-form');
            if (form) {
                form.addEventListener('submit', () => {
                    document.querySelector('#body-content').value = quill.root.innerHTML;
                });
            }
        }
    </script>
</body>
</html>