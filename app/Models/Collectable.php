<?php

/**
 * Concrete collectable. Currently only used to produce dummy objects
 * from the example cover images so the overview page can be built
 * before the database layer exists.
 */
class Collectable extends BaseCollectable
{
    public function __construct(string $imageData = '', string $title = '')
    {
        $this->imageData = $imageData;
        $this->title     = $title;
    }

    /**
     * Build a dummy list of collectables from the example cover images.
     *
     * @return static[]
     */
    public static function dummyAll(): array
    {
        $objects = [];

        foreach (glob(COVERS_PATH . '/*.jpg') ?: [] as $path) {
            $filename = basename($path);

            $objects[] = new static(
                linkTo('image', 'cover', [rawurlencode($filename)]),
                self::titleFromFilename($filename)
            );
        }

        return $objects;
    }

    /**
     * Turn "dungeons-dragons-honor-among-thieves.jpg" into
     * "Dungeons Dragons Honor Among Thieves".
     */
    private static function titleFromFilename(string $filename): string
    {
        $name = pathinfo($filename, PATHINFO_FILENAME);
        $name = str_replace(['-', '_'], ' ', $name);

        return ucwords(trim($name));
    }
}
