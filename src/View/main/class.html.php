<?php
/** @var mixed $image */

$body = function () use ($image){
    echo <<<EOL
<img alt="Схема взаимодействия классов" src=$image />
EOL;
};

$renderLayout(
    'main_template.html.php',
    [
        'title' => 'Схема взаимодействия классов',
        'body' => $body,
    ]
);
