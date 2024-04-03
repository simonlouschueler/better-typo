<?php

Kirby::plugin('simonlou/better-typo-de', [
    'fieldMethods' => [
        'bettertypo' => function ($field) {
            $text = $field->value();

            // This callback function applies replacements outside HTML tags
            $safeReplace = function ($matches) {
                $segment = $matches[0];

                // Skip processing for HTML tags
                if (strpos($segment, '<') !== false && strpos($segment, '>') !== false) {
                    return $segment;
                }

                // Em dash
                $segment = str_replace(' - ', ' – ', $field->value);

                // Apostrophe
                $segment = str_replace(["'", "`", "´"], "’", $segment);

                // Double opening quote
                $segment = preg_replace('/(?<=^|\s|>|\n|\r)["”„«»]/u', '“', $segment);
                // Double closing quote
                $segment = preg_replace('/["“„«»](?=\s|[.,!?;:]|\s*$|<\/p>|<br>)/u', '”', $segment);

                // Single opening quote
                $segment = preg_replace('/(?<=^|\s|>|\n|\r)[\'’‚]/u', '‘', $segment);
                // Single closing quote
                $segment = preg_replace('/[\'‘‚](?=\s|[.,!?;:]|\s*$|<\/p>|<br>)/u', '’', $segment);

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

                return $segment;
            };

            // Split text by HTML tags and process each segment
            $text = preg_replace_callback('/([^<>]+)|(<[^<>]*>)/', $safeReplace, $text);

            return new Field($field->parent(), $field->key(), $text);
        },
        'bt' => function ($field) {
            // Reuse the 'bettertypo' method for the 'bt' alias
            return $field->bettertypo();
        }
    ]
]);