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
