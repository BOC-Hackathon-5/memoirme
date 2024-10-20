<?php

namespace App\Hackathon;


use Illuminate\Config\Repository;
use Illuminate\Contracts\Container\Container;

abstract class ApiAction
{

    /**
     * The container instance.
     *
     * @var Container
     */
    protected Container $container;

    /**
     * The configuration repository instance.
     *
     * @var Repository
     */
    protected Repository $config;


    /**
     * Create a new manager instance.
     *
     * @param \Illuminate\Contracts\Container\Container $container
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function __construct( Container $container )
    {
        $this->container = $container;
        $this->config = $container->make( 'config' );
    }

    public abstract function get();
}
