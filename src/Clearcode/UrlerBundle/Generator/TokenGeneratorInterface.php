<?php
namespace Clearcode\UrlerBundle\Generator;


interface TokenGeneratorInterface
{
    /**
     * Generate unique token for shortening url.
     *
     * @return mixed
     */
    public function generate();
} 