    </main>
    </div> 
    
    <script>
        // Lucide iconlarını render et
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
        
        const quill = new Quill('#editor', {
            modules: {
                toolbar: [
                    [{ header: [1, 2, false] }],
                    ['bold', 'italic', 'underline'],
                    ['link', 'blockquote', 'code-block'],
                    [{ list: 'ordered' }, { list: 'bullet' }]
                ]
            },
            theme: 'snow'
        });

        const form = document.querySelector('#post-form');
        const bodyContent = document.querySelector('#body-content');

        if (form) {
            form.addEventListener('submit', function() {
                // Form gönderilmeden hemen önce, editörün HTML içeriğini gizli input'a kopyala.
                bodyContent.value = quill.root.innerHTML;
            });
        }
    </script>
</body>
</html>