<?php

class AiTranslate
{
    public static function generateButtons(string $postTitle, string $postSlug, string $baseUrl): string
    {
        $postUrl = $baseUrl . '/post/' . $postSlug;
        $encodedUrl = urlencode($postUrl);
        $encodedTitle = urlencode($postTitle);
        
        $buttons = [
            [
                'name' => 'ChatGPT',
                'url' => "https://chat.openai.com/?q=" . urlencode("$postUrl adresindeki makaleyi kapsamlı bir şekilde özetle ve ana başlıklarını çıkar")
            ],
            [
                'name' => 'Grok',
                'url' => "https://x.com/i/grok?q=" . urlencode("Bu makaleyi özetle: $postUrl")
            ],
            [
                'name' => 'Perplexity',
                'url' => "https://www.perplexity.ai/?q=" . urlencode("$postUrl linkindeki yazıyı özetle")
            ],
            [
                'name' => 'Claude.ai',
                'url' => "https://claude.ai/new?q=" . urlencode("Bu makaleyi özetle: $postUrl")
            ]
        ];
        
        $html = '<div class="ai-translate-section">';
        $html .= '<div class="ai-translate-header">';
        $html .= '<span class="ai-translate-title">Bu İçeriği Yapay Zekâ (AI) ile Özetleyin:</span>';
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
