document.addEventListener('DOMContentLoaded', function() {
    // İçindekiler tablosunu oluştur ve sayfaya ekle
    createTableOfContents();

    // Sayfa stillerini dinamik olarak ekle
    addTocStyles();
    
    // Sayfa yüklendiğinde ve kaydırıldığında pozisyonu güncelle
    updateTocPosition();
    window.addEventListener('scroll', updateTocPosition);
    window.addEventListener('resize', updateTocPosition);
});

function updateTocPosition() {
    const tocContainer = document.getElementById('toc-container');
    if (!tocContainer) return;
    
    // Featured image'ı bul
    const featuredImage = document.querySelector('.post-featured-image-container');
    let startPosition = 150; // Varsayılan başlangıç pozisyonu
    
    if (featuredImage) {
        // Featured image'ın alt kenarını al
        const imageRect = featuredImage.getBoundingClientRect();
        const imageBottom = imageRect.bottom + window.scrollY;
        startPosition = imageBottom + 20; // Featured image'dan 20px sonra başla
    } else {
        // Featured image yoksa post header'ın altından başla
        const postHeader = document.querySelector('.post-header');
        if (postHeader) {
            const headerRect = postHeader.getBoundingClientRect();
            const headerBottom = headerRect.bottom + window.scrollY;
            startPosition = headerBottom + 20;
        }
    }
    
    const scrollY = window.scrollY;
    
    if (scrollY < startPosition - 100) {
        // Henüz başlangıç pozisyonuna gelmeden önce
        tocContainer.style.position = 'absolute';
        tocContainer.style.top = startPosition + 'px';
    } else {
        // Başlangıç pozisyonuna geldikten sonra fixed olarak takip et
        tocContainer.style.position = 'fixed';
        tocContainer.style.top = '20px';
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
        border-bottom: 1px solid #333;
        text-align: left;
        color: #ffffff;
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
            color: #a0a0a0;
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
                    a.style.color = '#a0a0a0';
                    a.style.fontWeight = 'normal';
                });
                
                // Bu linki aktif yap
                link.style.color = '#ffffff';
                link.style.fontWeight = '500';
            }
        });
        
        // Hover efekti
        link.addEventListener('mouseover', () => {
            if (link.style.fontWeight !== '500') {
                link.style.color = '#ffffff';
            }
        });
        
        link.addEventListener('mouseout', () => {
            if (link.style.fontWeight !== '500') {
                link.style.color = '#a0a0a0';
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
    
    // Sayfa yüklendiğinde aktif başlığı ayarla
    updateActiveHeading(headings);
}

function updateActiveHeading(headings) {
    // Viewport'da görünür olan başlıkları kontrol et
    let activeHeading = null;
    
    headings.forEach((heading) => {
        const rect = heading.getBoundingClientRect();
        // Başlık viewport'un üst kısmına yakın mı?
        if (rect.top <= 100 && rect.bottom >= 0) {
            activeHeading = heading;
        }
    });
    
    if (activeHeading) {
        // Aktif başlığın linkini bul ve vurgula
        const activeLink = document.querySelector(`#toc-container a[href="#${activeHeading.id}"]`);
        if (activeLink) {
            // Tüm linklerin aktif durumunu temizle
            document.querySelectorAll('#toc-container a').forEach(a => {
                a.style.color = '#a0a0a0';
                a.style.fontWeight = 'normal';
            });
            
            // Bu linki aktif yap
            activeLink.style.color = '#ffffff';
            activeLink.style.fontWeight = '500';
        }
    }
}

function addTocStyles() {
    // Mobil görünüm için stil
    const mediaQueryStyle = document.createElement('style');
    mediaQueryStyle.textContent = `
        @media (max-width: 1400px) {
            #toc-container {
                display: none !important;
            }
        }
    `;
    document.head.appendChild(mediaQueryStyle);
}