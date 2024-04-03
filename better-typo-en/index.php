    <?php

Kirby::plugin('simonlou/better-typo', [
    'fieldMethods' => [
        'bettertypo' => function ($field) {

            // Em dash
            $text = str_replace(' - ', ' – ', $field->value);

            // Apostrophe
            $text = str_replace(["'", "`", "´"], "’", $text);

            // Double opening quote
            $text = preg_replace('/(?<=^|\s|>|\n|\r)["”„«»]/u', '“', $text);
            // Double closing quote
            $text = preg_replace('/["“„«»](?=\s|[.,!?;:]|\s*$|<\/p>|<br>)/u', '”', $text);

            // Single opening quote
            $text = preg_replace('/(?<=^|\s|>|\n|\r)[\'’‚]/u', '‘', $text);
            // Single closing quote
            $text = preg_replace('/[\'‘‚](?=\s|[.,!?;:]|\s*$|<\/p>|<br>)/u', '’', $text);

            // Multiplication sign
            $text = preg_replace('/(?<=\d)[Xx]|[Xx](?=\d)/u', '×', $text);

            // Space before units
            $pattern = '/(\d(?:\.\d+)?)(\s?)(m|km|cm|mm|kg|g|mg|s|min|h|°C|K|L|mL|m³|km²|ha|J|kWh)(?![\d\w])/';
            $replacement = '$1 $3';                                         
            $text = preg_replace($pattern, $replacement, $text);

            return new Field($field->parent(), $field->key(), $text);
        },
        'bt' => function ($field) {
            // Reuse the 'bettertypo' method for the 'bt' alias
            return $field->bettertypo();
        }
    ]
]);