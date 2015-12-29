<?php

namespace Application\Form;

use Zend\Form\Element\Collection;
use Zend\Form\Element\Text;
use Zend\Form\Fieldset;

final class BarFieldset extends Fieldset
{
    public function __construct(array $options = [])
    {
        parent::__construct('bar-fieldset', $options);

        $this->add([
            'type' => Text::class,
            'name' => 'barText',
            'options' => [
                'label' => 'Bar Text'
            ]
        ]);

        $this->add([
            'type' => Collection::class,
            'name' => 'bazCollection',
            'options' => [
                'label'                  => 'A Bar',
                'count'                  => 2,
                'should_create_template' => true,
                'allow_add'              => true,
                'should_wrap'            => false,
                'template_placeholder'   => '__baz__',
                'target_element'         => array(
                    'type' => BazFieldset::class
                ),
            ]
        ]);
    }
}
