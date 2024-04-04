<?php

Kirby::plugin('simonlou/better-typo', [
    'fieldMethods' => [
        'bettertypo' => function ($field) {
            $language = kirby()->option('simonlou.better-typo.language', 'en'); // Default is English
            
            $text = $field->value();

            // Function to safely replace typography outside of HTML tags
            $safeReplace = function ($matches) use ($language, $field) {
                // Directly return HTML tags unchanged
                if (strpos($matches[0], '<') !== false && strpos($matches[0], '>') !== false) {
                    return $matches[0];
                }

                $segment = $matches[0];

                // Replacements for all languages

                // Em dash
                $segment = str_replace(' - ', ' – ', $segment);

                // Apostrophe
                $segment = str_replace(["'", "`", "´"], "’", $segment);

                // Multiplication sign
                $segment = preg_replace('/(?<=\d)[Xx]|[Xx](?=\d)/u', '×', $segment);

                // Space before units
                $pattern = '/(\d(?:\.\d+)?)(\s?)(m|km|cm|mm|kg|g|mg|s|min|h|°C|K|L|mL|m³|km²|ha|J|kWh)(?![\d\w])/';
                $replacement = '$1 $3';                                         
                $segment = preg_replace($pattern, $replacement, $segment);

                // Spaces around Slash
                $segment = str_replace(' / ', '<<slash>>', $segment);
                $segment = str_replace('/', '&thinsp;/&thinsp;', $segment);
                $segment = str_replace('<<slash>>', '&thinsp;/&thinsp;', $segment);

                // Ellipsis
                $segment = str_replace('...', '…', $segment);

                // Replacements for different languages
                $replacements = [
                    'en' => function ($segment) {

                        // Double opening quote
                        $segment = preg_replace('/(?<=^|\s|>|\n|\r)["”„«»]/u', '“', $segment);
                        // Double closing quote
                        $segment = preg_replace('/["“„«»](?=\s|[.,!?;:]|\s*$|<\/p>|<br>)/u', '”', $segment);

                        // Single opening quote
                        $segment = preg_replace('/(?<=^|\s|>|\n|\r)[\'’‚]/u', '‘', $segment);
                        // Single closing quote
                        $segment = preg_replace('/[\'‘‚](?=\s|[.,!?;:]|\s*$|<\/p>|<br>)/u', '’', $segment);
                    
                        return $segment;
                    },
                    'de' => function ($segment) {

                        // Double opening quote
                        $segment = preg_replace('/(?<=^|\s|>|\n|\r)["”„]/u', '„', $segment);
                        // Double closing quote
                        $segment = preg_replace('/["“„](?=\s|[.,!?;:]|\s*$|<\/p>|<br>)/u', '“', $segment);

                        // Single opening quote
                        $segment = preg_replace('/(?<=^|\s|>|\n|\r)[\'’‚]/u', '‚', $segment);
                        // Single closing quote
                        $segment = preg_replace('/[\'‘‚](?=\s|[.,!?;:]|\s*$|<\/p>|<br>)/u', '‘', $segment);

                        // Opening guillemets
                        $segment = preg_replace('/(?<=^|\s|>|\n|\r)[«]/u', '»', $segment);
                        // Closing guillemets
                        $segment = preg_replace('/[»](?=\s|[.,!?;:]|\s*$|<\/p>|<br>)/u', '«', $segment);

                        return $segment;
                    }
                ];
                
                // Execute replacements for the selected language, defaulting to English if not found
                $replacementFunction = $replacements[$language] ?? $replacements['en'];
                return $replacementFunction($segment);
            };

            // Apply the safeReplace function only to text outside of HTML tags
            // This pattern matches texts outside of tags while avoiding HTML tags themselves
            $text = preg_replace_callback('/>.*?</s', function($matches) use ($safeReplace) {
                // Avoiding the first '>' and the last '<' of the match
                return '>' . substr($safeReplace([substr($matches[0], 1, -1)]), 0) . '<';
            }, '>' . $text . '<'); // Adding '>' at the beginning and '<' at the end to ensure the first and last texts are also processed

            // Removing the previously added '>' at the beginning and '<' at the end
            $text = substr($text, 1, -1);

            return new Field($field->parent(), $field->key(), $text);
        },
        'bt' => function ($field) {
            // Alias for 'bettertypo'
            return $field->bettertypo();
        }
    ]
]);