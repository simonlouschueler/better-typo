<?php

Kirby::plugin('simonlou/better-typo', [
    'fieldMethods' => [
        'bettertypo' => function ($field) {

            // Em dash
            $text = str_replace(' - ', ' – ', $field->value);

            // Apostrophe
            $text = str_replace(["'", "`", "´"], "’", $text);

            // Double opening quote
            $text = preg_replace('/(?<=^|\s|>|\n|\r)["”„]/u', '„', $text);
            // Double closing quote
            $text = preg_replace('/["“„](?=\s|[.,!?;:]|\s*$|<\/p>|<br>)/u', '“', $text);

            // Single opening quote
            $text = preg_replace('/(?<=^|\s|>|\n|\r)[\'’‚]/u', '‚', $text);
            // Single closing quote
            $text = preg_replace('/[\'‘‚](?=\s|[.,!?;:]|\s*$|<\/p>|<br>)/u', '‘', $text);

            // Opening guillemets
            $text = preg_replace('/(?<=^|\s|>|\n|\r)[«]/u', '»', $text);
            // Closing guillemets
            $text = preg_replace('/[»](?=\s|[.,!?;:]|\s*$|<\/p>|<br>)/u', '«', $text);

            return new Field($field->parent(), $field->key(), $text);
        },
        'bt' => function ($field) {
            // Reuse the 'bettertypo' method for the 'bt' alias
            return $field->bettertypo();
        }
    ]
]);