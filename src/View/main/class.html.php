<?php

$body = function () {
    echo <<<EOL
<img src="./Img/Homework1.png"/>
EOL;
};

$renderLayout(
    'main_template.html.php',
    [
        'title' => 'Схема взаимодействия классов',
        'body' => $body,
    ]
);
