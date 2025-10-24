document.addEventListener('DOMContentLoaded', function() {
    // İçindekiler tablosunu oluştur ve sayfaya ekle
    createTableOfContents();

    // Kenar çubuklarını (sidebar) yapışkan hale getiren fonksiyonu başlat
    initializeStickySidebars();

    // Sayfa stillerini dinamik olarak ekle
    addSidebarStyles();
});

// Her iki kenar çubuğu için olay dinleyicilerini (event listener) kuran ana fonksiyon
function initializeStickySidebars() {
    const leftSidebar = document.getElementById('toc-container');
    const rightSidebar = document.querySelector('.post-sidebar-right');

    // Fonksiyonu her iki kenar çubuğu için de anında çalıştır
    if (leftSidebar) {
        updateSidebarPosition(leftSidebar);
    }
    if (rightSidebar) {
        updateSidebarPosition(rightSidebar);
    }

    // Scroll ve resize olayları için dinleyicileri ekle
    window.addEventListener('scroll', () => {
        if (leftSidebar) updateSidebarPosition(leftSidebar);
        if (rightSidebar) updateSidebarPosition(rightSidebar);
    });

    window.addEventListener('resize', () => {
        if (leftSidebar) updateSidebarPosition(leftSidebar);
        if (rightSidebar) updateSidebarPosition(rightSidebar);
    });
}

// Belirtilen bir kenar çubuğunun pozisyonunu güncelleyen fonksiyon
function updateSidebarPosition(sidebarElement) {
    if (!sidebarElement) return;

    // Öne çıkan görseli (featured image) bul
    const featuredImage = document.querySelector('.post-featured-image-container');
    let startPosition = 150; // Varsayılan başlangıç pozisyonu

    if (featuredImage) {
        const imageRect = featuredImage.getBoundingClientRect();
        const imageBottom = imageRect.bottom + window.scrollY;
        startPosition = imageBottom + 40; // Görselin 40px altından başla
    } else {
        // Eğer görsel yoksa, sayfa başlığının (post header) altından başla
        const postHeader = document.querySelector('.post-header');
        if (postHeader) {
            const headerRect = postHeader.getBoundingClientRect();
            const headerBottom = headerRect.bottom + window.scrollY;
            startPosition = headerBottom + 40;
        }
    }

    const scrollY = window.scrollY;

    if (scrollY < startPosition - 100) {
        // Henüz başlangıç pozisyonuna gelinmediyse, 'absolute' olarak ayarla
        sidebarElement.style.position = 'absolute';
        sidebarElement.style.top = startPosition + 'px';
    } else {
        // Başlangıç pozisyonu geçildiyse, 'fixed' olarak sabitle ve yukarıdan boşluk bırak
        sidebarElement.style.position = 'fixed';
        sidebarElement.style.top = '50px';
    }
}


function createTableOfContents() {
    // İçindekiler tablosu için konteyner oluştur
    const tocContainer = document.createElement('div');
    tocContainer.id = 'toc-container';
    tocContainer.style.cssText = `
        background-color: transparent;
        padding: 16px;
        max-height: calc(100vh - 40px);
        overflow-y: auto;
        position: absolute;
        width: 200px;
        left: calc((100% - var(--content-width)) / 2 - 250px);
        z-index: 100;
        font-family: 'Inter', -apple-system, sans-serif;
    `;

    // Post içeriğindeki tüm h2 ve h3 başlıkları bul
    const postContent = document.querySelector('.post-content');
    if (!postContent) return;

    const headings = postContent.querySelectorAll('h2, h3');

    if (headings.length === 0) {
        return; // İçerik yoksa oluşturma
    }

    // İçindekiler başlığı ekle
    const tocTitle = document.createElement('div');
    tocTitle.textContent = 'İçindekiler';
    tocTitle.style.cssText = `
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 1.2rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid var(--color-border);
        text-align: left;
        color: var(--color-primary);
    `;
    tocContainer.appendChild(tocTitle);

    // İçindekiler listesi oluştur
    const tocList = document.createElement('ul');
    tocList.style.cssText = `
        list-style: none;
        padding: 0;
        margin: 0;
    `;

    // Her başlık için bir liste elemanı oluştur
    headings.forEach((heading, index) => {
        // Başlığa benzersiz bir ID ver
        if (!heading.id) {
            heading.id = 'heading-' + index;
        }

        const listItem = document.createElement('li');
        listItem.style.cssText = `
            margin-bottom: 0.5rem;
            line-height: 1.25;
        `;

        const link = document.createElement('a');
        link.href = '#' + heading.id;
        link.textContent = heading.textContent;
        link.style.cssText = `
            color: var(--color-secondary);
            text-decoration: none;
            display: block;
            padding: 0.4rem 0;
            font-size: 0.75rem;
            padding-left: 0.5rem;
        `;

        // H3 başlıkları için iç girinti
        if (heading.tagName.toLowerCase() === 'h3') {
            listItem.style.paddingLeft = '0.75rem';
        }

        // Tıklama olayı
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const targetId = link.getAttribute('href');
            const targetElement = document.querySelector(targetId);

            if (targetElement) {
                // Pürüzsüz kaydırma
                window.scrollTo({
                    top: targetElement.offsetTop - 80,
                    behavior: 'smooth'
                });

                // Tüm linklerin aktif durumunu temizle
                document.querySelectorAll('#toc-container a').forEach(a => {
                    a.style.color = 'var(--color-secondary)';
                    a.style.fontWeight = 'normal';
                });

                // Bu linki aktif yap
                link.style.color = 'var(--color-primary)';
                link.style.fontWeight = '600';
            }
        });

        // Hover efekti
        link.addEventListener('mouseover', () => {
            if (link.style.fontWeight !== '600') {
                link.style.color = 'var(--color-primary)';
            }
        });

        link.addEventListener('mouseout', () => {
            if (link.style.fontWeight !== '600') {
                link.style.color = 'var(--color-secondary)';
            }
        });

        listItem.appendChild(link);
        tocList.appendChild(listItem);
    });

    tocContainer.appendChild(tocList);

    // İçindekiler tablosunu sayfaya ekle
    document.body.appendChild(tocContainer);

    // Scroll olayını dinle ve aktif başlığı güncelle
    window.addEventListener('scroll', () => {
        updateActiveHeading(headings);
    });

    updateActiveHeading(headings);
}

function updateActiveHeading(headings) {
    let activeHeading = null;

    headings.forEach((heading) => {
        const rect = heading.getBoundingClientRect();
        // Başlık viewport'un üst kısmına yakın mı?
        if (rect.top <= 100 && rect.bottom >= 0) {
            activeHeading = heading;
        }
    });

    if (activeHeading) {
        const activeLink = document.querySelector(`#toc-container a[href="#${activeHeading.id}"]`);
        if (activeLink) {
            document.querySelectorAll('#toc-container a').forEach(a => {
                a.style.color = '#a0a0a0';
                a.style.fontWeight = 'normal';
            });

            activeLink.style.color = '#ffffff';
            activeLink.style.fontWeight = '500';
        }
    }
}

function addSidebarStyles() {
    const mediaQueryStyle = document.createElement('style');
    mediaQueryStyle.textContent = `
        @media (max-width: 1400px) {
            #toc-container, .post-sidebar-right {
                display: none !important;
            }
        }
    `;
    document.head.appendChild(mediaQueryStyle);
}