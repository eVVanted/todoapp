<?php


namespace MyApp\classes\dispatchers;


use MyApp\classes\events\Event;

interface EventDispatcherInterface
{
    public function dispatch(Event $event);

}