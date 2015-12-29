<?php

namespace Application\Form;

use Zend\Form\Element\Text;
use Zend\Form\Fieldset;

final class BazFieldset extends Fieldset
{
    public function __construct(array $options = [])
    {
        parent::__construct('baz-fieldset', $options);

        $this->add([
            'type' => Text::class,
            'name' => 'bazText',
            'options' => [
                'label' => 'Bazinga!'
            ]
        ]);
    }
}
