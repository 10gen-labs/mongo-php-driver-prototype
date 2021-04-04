--TEST--
MongoDB\Driver\Manager::addSubscriber() NOP if subscriber already registered
--SKIPIF--
<?php require __DIR__ . '/../utils/basic-skipif.inc'; ?>
<?php skip_if_not_live(); ?>
<?php skip_if_not_clean(); ?>
--FILE--
<?php

require_once __DIR__ . '/../utils/basic.inc';

class MySubscriber implements MongoDB\Driver\Monitoring\CommandSubscriber
{
    public function commandStarted(MongoDB\Driver\Monitoring\CommandStartedEvent $event)
    {
        printf("commandStarted: %s\n", $event->getCommandName());
    }

    public function commandSucceeded(MongoDB\Driver\Monitoring\CommandSucceededEvent $event)
    {
        printf("commandSucceeded: %s\n", $event->getCommandName());
    }

    public function commandFailed(MongoDB\Driver\Monitoring\CommandFailedEvent $event)
    {
        printf("commandFailed: %s\n", $event->getCommandName());
    }
}

$m = create_test_manager();

$pingCommand = new MongoDB\Driver\Command(['ping' => 1]);

$subscriber = new MySubscriber;

echo "adding subscriber twice\n";
$m->addSubscriber($subscriber);
$m->addSubscriber($subscriber);

printf("ping: %d\n", $m->executeCommand(DATABASE_NAME, $pingCommand)->toArray()[0]->ok);

?>
--EXPECT--
adding subscriber twice
commandStarted: ping
commandSucceeded: ping
ping: 1
