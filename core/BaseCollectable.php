<?php

/**
 * Base class for anything that can be shown as a collectable item
 * (a cover image plus a title).
 *
 * Later this will inherit from Model (database backed) and will itself
 * be extended by concrete types (Movie, Game, ...). For now it just
 * holds the two display fields.
 */
abstract class BaseCollectable
{
    protected string $imageData = '';
    protected string $title     = '';

    public function getImageData(): string
    {
        return $this->imageData;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}
