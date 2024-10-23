<?php

chdir(__DIR__);

require 'vendor/autoload.php';

(static function () {
    $builder = new \DI\ContainerBuilder();
    $container = $builder->build();
    $plugin = $container->get(\iTexMoNotifier\Plugin::class);

    try {
        $plugin->run();

        // cleanup plugin log
        $container->get(\iTexMoNotifier\Service\LogCleaner::class)->clean();
    } catch (Exception $e) {
        $logger = new \iTexMoNotifier\Service\Logger();
        $logger->error($e->getMessage());
        $logger->debug($e->getTraceAsString());
    }
})();
