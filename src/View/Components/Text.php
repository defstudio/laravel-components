<?php


namespace DefStudio\Components\View\Components;


class Text extends Input
{
impostare gli attributi all'input e aggiungere dei campi container-class container-id per assegnare degli id ai contenitori
occhio che occorre unire gli attributi agli attributi di errore generati in ChecksError
    public string $label;

    public function __construct(string $name, string $label = '', string $id = '')
    {
        $this->id = $id;
        $this->name = $name;
        $this->label = $label;
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        return view('def-components::text');
    }
}
