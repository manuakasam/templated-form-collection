<?php

namespace Application\Form;

use Zend\Form\Form;

final class FooForm extends Form
{
    public function __construct(array $options = [])
    {
        parent::__construct('foo-form', $options);

        $this->add([
            'name' => 'foo-fieldset',
            'type' => FooFieldset::class,
            'options' => [
                'use_as_base_fieldset' => true
            ]
        ]);
    }
}
