<?php

namespace Application\View\Helper;

use InvalidArgumentException;
use RuntimeException;
use Zend\Form\Element\Collection;
use Zend\Form\ElementInterface;
use Zend\Form\LabelAwareInterface;
use Zend\Form\View\Helper\FormCollection;
use Zend\View\Renderer\PhpRenderer;

final class TemplatedFormCollection extends FormCollection
{
    /**
     * Where shall the template-data be inserted into
     *
     * @var string
     */
    protected $templateWrapper = '<span data-template="%s" data-replace="%s"></span>';

    /**
     * Invoke helper as function
     *
     * Proxies to {@link render()}.
     *
     * @param  ElementInterface|null $element
     * @param  string                $templatePartial
     * @param  bool                  $wrap
     *
     * @return string|FormCollection
     */
    public function __invoke(ElementInterface $element, $templatePartial, $wrap = true)
    {
        if (!$templatePartial) {
            throw new InvalidArgumentException('$templatePartial cannot be null');
        }

        $this->setShouldWrap($wrap);

        return $this->render($element, $templatePartial);
    }

    /**
     * Render a collection by iterating through all fieldsets and elements
     *
     * @param  ElementInterface $element
     * @param  string           $templatePartial Required Template Path for manual rendering of template elements
     *
     * @return string
     */
    public function render(ElementInterface $element, $templatePartial)
    {
        $renderer = $this->getView();
        if (!method_exists($renderer, 'plugin')) {
            // Bail early if renderer is not pluggable
            return '';
        }

        $markup         = '';
        $templateMarkup = '';
        $partialHelper  = $this->getPartialHelper();

        if ($element instanceof Collection && $element->shouldCreateTemplate()) {
            $templateMarkup = $this->renderTemplate($element, $templatePartial);
        }

        if ($element instanceof Collection) {
            foreach ($element->getIterator() as $collectionFieldset) {
                $markup .= $partialHelper($templatePartial, [
                    'collection' => $collectionFieldset
                ]);
            }
        } else {
            $markup .= $partialHelper($templatePartial, [
                'collection' => $element
            ]);
        }

        return $templateMarkup . $markup;
    }

    /**
     * Only render a template
     *
     * @param  Collection $collection
     * @param  string     $templatePartial
     *
     * @return string
     */
    public function renderTemplate(Collection $collection, $templatePartial)
    {
        $escapeHtmlAttribHelper = $this->getEscapeHtmlAttrHelper();
        $elementOrFieldset      = $collection->getTemplateElement();
        $partialHelper          = $this->getPartialHelper();
        $replaceIndex           = $collection->getTemplatePlaceholder();

        $templateMarkup = $partialHelper($templatePartial, [
            'collection' => $elementOrFieldset
        ]);

        return sprintf(
            $this->getTemplateWrapper(),
            $escapeHtmlAttribHelper($templateMarkup),
            $replaceIndex
        );
    }

    /**
     * @return \Zend\View\Helper\Partial
     */
    private function getPartialHelper()
    {
        /** @var PhpRenderer $renderer */
        $renderer = $this->getView();

        return $renderer->plugin('partial');
    }
}
