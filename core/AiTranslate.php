<?php

require_once __DIR__ . '/helpers/i18n.php';

class AiTranslate
{
    public static function generateButtons(string $postTitle, string $postSlug, string $baseUrl): string
    {
        $postUrl = $baseUrl . '/post/' . $postSlug;
        $encodedUrl = urlencode($postUrl);
        $encodedTitle = urlencode($postTitle);
        
        // Get current language
        $lang = get_lang();
        
        // Generate language-specific prompt
        $prompt = sprintf(t('ai_prompt'), $postUrl);
        
        $buttons = [
            [
                'name' => 'ChatGPT',
                'url' => "https://chat.openai.com/?q=" . urlencode($prompt)
            ],
            [
                'name' => 'Grok',
                'url' => "https://x.com/i/grok?q=" . urlencode($prompt)
            ],
            [
                'name' => 'Perplexity',
                'url' => "https://www.perplexity.ai/?q=" . urlencode($prompt)
            ],
            [
                'name' => 'Claude.ai',
                'url' => "https://claude.ai/new?q=" . urlencode($prompt)
            ]
        ];
        
        $html = '<div class="ai-translate-section">';
        $html .= '<div class="ai-translate-header">';
        $html .= '<span class="ai-translate-title">' . htmlspecialchars(t('ai_summarize_title')) . '</span>';
        $html .= '</div>';
        $html .= '<div class="ai-translate-buttons">';
        
        foreach ($buttons as $button) {
            $html .= sprintf(
                '<a href="%s" target="_blank" rel="noopener noreferrer" class="ai-translate-btn">
                    <span class="ai-name">%s</span>
                </a>',
                htmlspecialchars($button['url']),
                htmlspecialchars($button['name'])
            );
        }
        
        $html .= '</div>';
        $html .= '</div>';
        
        return $html;
    }
}
