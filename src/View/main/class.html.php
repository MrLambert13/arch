<?php

use asse
$body = function () {
    echo <<<EOL
<img alt="Схема взаимодействия классов" src="./Img/Homework1.png"/>
EOL;
};

$renderLayout(
    'main_template.html.php',
    [
        'title' => 'Схема взаимодействия классов',
        'body' => $body,
    ]
);
