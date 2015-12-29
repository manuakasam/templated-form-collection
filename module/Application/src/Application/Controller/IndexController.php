<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Form\FormInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    /**
     * @var FormInterface
     */
    private $form;

    public function __construct(FormInterface $form)
    {
        $this->form = $form;
    }

    public function indexAction()
    {
        return new ViewModel();
    }

    public function formAction()
    {
        return new ViewModel([
            'form' => $this->form
        ]);
    }
}
