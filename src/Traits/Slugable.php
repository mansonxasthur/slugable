<?php


namespace MX13\Slugable\Traits;


trait Slugable
{
    /**
     * A setter for the slug attribute
     * @param string $value
     */
    public function setSlugAttribute(string $value)
    {
        if (static::whereSlug($slug = $this->setSlug($value))->exists()) { // check if the converted slug exists on the table
            $slug = $this->incrementSlug($slug, $this->getSlugableColumn()); // if exists it auto increments the slug
        }

        $this->attributes['slug'] = $slug; // assign the value to the slug attribute
    }

    /**
     * Auto increments the slug name
     *
     * @param string $slug
     * @param string $column
     *
     * @return string
     */
    private function incrementSlug(string $slug, string $column): string
    {
        $max = static::where($column, $this->{$column})->latest('id')->first();

        if ($max->id !== $this->id) {
            $max = $max->slug;
            if (is_numeric($max[-1])) {
                return preg_replace_callback('/(\d+)$/', function ($matches) {
                    return $matches[1] + 1;
                }, $max);
            }
            return "{$slug}-2";
        }
        return $slug;
    }

    /**
     * When the route key name called it should be the slug column name
     *
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return $this->getSlugColumn();
    }

    /**
     * Setting the slug from a given value
     *
     * @param string $value
     *
     * @return string
     */
    public function setSlug(string $value): string
    {
        $sanitizedValue = strip_tags($value);
        $cleanedText = str_replace(['|', '_', ':', '.'], ' ', $sanitizedValue); // remove unwanted characters in the slug name

        return preg_replace('/\s+/', '-', mb_strtolower(trim($cleanedText), 'UTF-8'));
    }
}