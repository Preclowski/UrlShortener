<?php
namespace Clearcode\UrlerBundle\Generator;

/**
 * Token generator based on uniqid php function.
 *
 * @package Clearcode\UrlerBundle\Services
 */
class SimpleTokenGenerator implements TokenGeneratorInterface
{
    /**
     * {@inheritDoc}
     */
    public function generate()
    {
        return substr(strrev(uniqid()), 0, 6);
    }
}
 