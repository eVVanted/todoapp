<?php


namespace MyApp\classes\dispatchers;


use MyApp\classes\events\Event;

class EventDispatcher implements EventDispatcherInterface
{
    private $listeners = [];

    public function __construct(array $listeners)
    {
        $this->listeners = $listeners;
    }

    public function dispatch(Event $event)
    {
        $eventName = get_class($event);
        if (isset($this->listeners[$eventName])) {
            foreach ($this->listeners[$eventName] as $listenerClass) {
                $listener = new $listenerClass();
                $listener->handle($event);
            }
        }
    }

}