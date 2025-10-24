<?php

// Get current language
function get_lang() {
    if (isset($_SESSION['lang'])) {
        return $_SESSION['lang'];
    }
    if (isset($_COOKIE['lang'])) {
        return $_COOKIE['lang'];
    }
    return 'tr'; // default
}

// Set language
function set_lang($lang) {
    $_SESSION['lang'] = $lang;
    setcookie('lang', $lang, time() + (86400 * 365), '/');
}

// Translate helper
function t($key) {
    $lang = get_lang();
    
    $translations = [
        'tr' => [
            // Navigation
            'home' => 'Anasayfa',
            'about' => 'Hakkımda',
            'contact' => 'İletişim',
            'notes' => 'Notlar',
            
            // Common
            'search' => 'Ara...',
            'read_more' => 'Devamını Oku',
            'all' => 'Tümü',
            
            // Notes
            'notes_title' => 'Notlar',
            'notes_subtitle' => 'Günlük kısa notlar.',
            'no_notes' => 'Henüz not eklenmemiş.',
            
            // Contact
            'contact_title' => 'Bana Ulaşın',
            'name' => 'Adınız Soyadınız',
            'email' => 'E-posta Adresiniz',
            'message' => 'Mesajınız',
            'send' => 'Gönder',
            
            // Footer
            'all_rights' => 'Tüm hakları saklıdır.',
            'archive' => 'Arşiv',
            
            // Newsletter
            'newsletter_title' => 'Bültene Abone Ol',
            'newsletter_subtitle' => 'Yeni yazılardan haberdar olmak için e-posta adresinizi bırakın.',
            'newsletter_email' => 'E-posta adresiniz',
            'newsletter_subscribe' => 'Abone Ol',
            
            // AI Translate
            'ai_summarize_title' => 'Bu İçeriği Yapay Zekâ (AI) ile Özetleyin:',
            'ai_prompt' => '%s adresindeki makaleyi kapsamlı bir şekilde özetle ve ana başlıklarını çıkar',
            
            // About Page
            'about_badge' => 'Hakkımda',
            'about_greeting' => 'Merhaba, ben Ayberk Arıcı.',
            'about_now_title' => 'Şu anda ne üzerinde çalışıyorum?',
            'about_journey_title' => 'Kariyer yolculuğu',
            'about_principles_title' => 'Çalışma ilkelerim',
            'about_toolbox_title' => 'Takım çantam',
            'about_cta_title' => 'Beraber çalışalım mı?',
            'about_cta_desc' => 'Yeni bir ürün fikriniz, mevcut SaaS uygulamanız ya da AI ile otomatikleştirmek istediğiniz süreçler varsa tanışalım.',
            'about_cta_button' => 'İletişim kur',
        ],
        'en' => [
            // Navigation
            'home' => 'Home',
            'about' => 'About',
            'contact' => 'Contact',
            'notes' => 'Notes',
            
            // Common
            'search' => 'Search...',
            'read_more' => 'Read More',
            'all' => 'All',
            
            // Notes
            'notes_title' => 'Notes',
            'notes_subtitle' => 'Daily short notes.',
            'no_notes' => 'No notes yet.',
            
            // Contact
            'contact_title' => 'Get in Touch',
            'name' => 'Your Name',
            'email' => 'Your Email',
            'message' => 'Your Message',
            'send' => 'Send',
            
            // Footer
            'all_rights' => 'All rights reserved.',
            'archive' => 'Archive',
            
            // Newsletter
            'newsletter_title' => 'Subscribe to Newsletter',
            'newsletter_subtitle' => 'Leave your email to stay updated with new posts.',
            'newsletter_email' => 'Your email address',
            'newsletter_subscribe' => 'Subscribe',
            
            // AI Translate
            'ai_summarize_title' => 'Summarize This Content with AI:',
            'ai_prompt' => 'Summarize the article at %s comprehensively and extract the main points',
            
            // About Page
            'about_badge' => 'About Me',
            'about_greeting' => 'Hello, I\'m Ayberk Arıcı.',
            'about_now_title' => 'What am I currently working on?',
            'about_journey_title' => 'Career Journey',
            'about_principles_title' => 'Work Principles',
            'about_toolbox_title' => 'My Toolbox',
            'about_cta_title' => 'Let\'s work together?',
            'about_cta_desc' => 'If you have a new product idea, an existing SaaS application, or processes you want to automate with AI, let\'s connect.',
            'about_cta_button' => 'Get in Touch',
        ],
        'fr' => [
            // Navigation
            'home' => 'Accueil',
            'about' => 'À Propos',
            'contact' => 'Contact',
            'notes' => 'Notes',
            
            // Common
            'search' => 'Rechercher...',
            'read_more' => 'Lire Plus',
            'all' => 'Tout',
            
            // Notes
            'notes_title' => 'Notes',
            'notes_subtitle' => 'Notes courtes quotidiennes.',
            'no_notes' => 'Aucune note pour le moment.',
            
            // Contact
            'contact_title' => 'Contactez-moi',
            'name' => 'Votre Nom',
            'email' => 'Votre Email',
            'message' => 'Votre Message',
            'send' => 'Envoyer',
            
            // Footer
            'all_rights' => 'Tous droits réservés.',
            'archive' => 'Archive',
            
            // Newsletter
            'newsletter_title' => 'S\'abonner à la Newsletter',
            'newsletter_subtitle' => 'Laissez votre email pour être informé des nouveaux articles.',
            'newsletter_email' => 'Votre adresse email',
            'newsletter_subscribe' => 'S\'abonner',
            
            // AI Translate
            'ai_summarize_title' => 'Résumez ce Contenu avec l\'IA:',
            'ai_prompt' => 'Résumez l\'article à %s de manière complète et extrayez les points principaux',
            
            // About Page
            'about_badge' => 'À Propos',
            'about_greeting' => 'Bonjour, je suis Ayberk Arıcı.',
            'about_now_title' => 'Sur quoi je travaille actuellement?',
            'about_journey_title' => 'Parcours Professionnel',
            'about_principles_title' => 'Mes Principes de Travail',
            'about_toolbox_title' => 'Ma Boîte à Outils',
            'about_cta_title' => 'Travaillons ensemble?',
            'about_cta_desc' => 'Si vous avez une nouvelle idée de produit, une application SaaS existante ou des processus que vous souhaitez automatiser avec l\'IA, connectons-nous.',
            'about_cta_button' => 'Contactez-moi',
        ]
    ];
    
    return $translations[$lang][$key] ?? $key;
}

// Helper for date formatting
function format_date($date, $format = 'short') {
    $lang = get_lang();
    $timestamp = is_numeric($date) ? $date : strtotime($date);
    
    if ($format === 'short') {
        $formats = [
            'tr' => 'd M Y',
            'en' => 'M d, Y',
            'fr' => 'd M Y'
        ];
        return date($formats[$lang] ?? 'd M Y', $timestamp);
    }
    
    return date('Y-m-d', $timestamp);
}
