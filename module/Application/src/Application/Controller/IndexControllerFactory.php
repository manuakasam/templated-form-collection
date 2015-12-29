<?php

namespace Application\Controller;

use Application\Form\FooForm;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

final class IndexControllerFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new IndexController(
            $serviceLocator->getServiceLocator()->get('FormElementManager')->get(FooForm::class)
        );
    }
}
