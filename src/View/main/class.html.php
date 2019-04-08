<?php
/** @var mixed $image */

$body = function () use ($image){
    echo <<<EOL
<img alt="Схема взаимодействия классов" src="%kernel.root_dir%/src/View/main/Img/Homework1.png" />
EOL;
};

$renderLayout(
    'main_template.html.php',
    [
        'title' => 'Схема взаимодействия классов',
        'body' => $body,
    ]
);
