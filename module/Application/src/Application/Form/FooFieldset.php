<?php

namespace Application\Form;

use Zend\Form\Element\Collection;
use Zend\Form\Element\Select;
use Zend\Form\Element\Text;
use Zend\Form\Fieldset;

final class FooFieldset extends Fieldset
{
    public function __construct(array $options = [])
    {
        parent::__construct('foo-fieldset', $options);

        $this->add([
            'type' => Text::class,
            'name' => 'fooText',
            'options' => [
                'label' => 'Some Text Element'
            ]
        ]);

        $this->add([
            'type' => Select::class,
            'name' => 'fooSelect',
            'options' => [
                'label' => 'Some Select Element',
                'value_options' => [
                    'foo' => 'Foo',
                    'bar' => 'Bar'
                ],
                'empty_option' => '--- Foo or Bar? ---'
            ]
        ]);

        $this->add([
            'type' => Collection::class,
            'name' => 'barCollection',
            'options' => [
                'label'                  => 'A Bar',
                'count'                  => 2,
                'should_create_template' => true,
                'allow_add'              => true,
                'template_placeholder'   => '__bar__',
                'target_element'         => [
                    'type' => BarFieldset::class
                ],
            ]
        ]);
    }
}
