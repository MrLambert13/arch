<?php


namespace Service\Authentication;


class Fieldset extends FieldComposite
{
    public function render(): string
    {
        // Обратите внимание, как комбинированный результат рендеринга потомков
        // включается в тег fieldset.
        $output = parent::render();

        return "<fieldset><legend>{$this->getTitle()}</legend>\n$output</fieldset>\n";
    }
}