<?php

namespace Sebastienheyd\Boilerplate\View\Composers;

use Illuminate\View\View;

class CodemirrorComposer extends ComponentComposer
{
    protected $props = [
        'id',
        'theme',
        'value',
    ];

    public function compose(View $view)
    {
        parent::compose($view);

        $data = $view->getData();

        $view->with('value', $data['value'] ?? null);
        $view->with('id', $data['id'] ?? uniqid('codemirror_'));
        $view->with('theme', $data['theme'] ?? 'storm');
        $view->with('attributes', $this->attributes);
    }
}
