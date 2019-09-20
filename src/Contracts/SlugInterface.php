<?php


namespace MX13\Slugable\Contracts;


interface SlugInterface
{
    /**
     * Should return the slug column name
     *
     * @return string
     */
    public function getSlugableColumn(): string;
}