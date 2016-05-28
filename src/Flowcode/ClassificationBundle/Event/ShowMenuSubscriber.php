<?php

namespace Flowcode\ClassificationBundle\Event;

use Flowcode\DashboardBundle\Event\ShowMenuEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Translation\TranslatorInterface;


/**
 * Created by PhpStorm.
 * User: juanma
 * Date: 5/28/16
 * Time: 12:20 PM
 */
class ShowMenuSubscriber implements EventSubscriberInterface
{
    protected $router;
    protected $translator;

    public function __construct(RouterInterface $router, TranslatorInterface $translator)
    {
        $this->router = $router;
        $this->translator = $translator;
    }

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return array(
            ShowMenuEvent::NAME => array('handler', 3),
        );
    }


    public function handler(ShowMenuEvent $event)
    {
        $menuOptions = $event->getMenuOptions();

        /* add default */
        $menuOptions[] = array(
            "icon" => "fa fa-tags",
            "url" => '#',
            "title" => $this->translator->trans('classification'),
            "submenu" => array(
                array(
                    "url" => $this->router->generate('admin_tag'),
                    "title" => $this->translator->trans('tags'),
                ),
                array(
                    "url" => $this->router->generate('admin_category'),
                    "title" => $this->translator->trans('categorys'),
                ),
                array(
                    "url" => $this->router->generate('admin_collection'),
                    "title" => $this->translator->trans('collections'),
                ),
            ),
        );

        $event->setMenuOptions($menuOptions);

    }
}