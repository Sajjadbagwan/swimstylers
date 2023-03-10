<?php

namespace Swim\Core\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Swim\Core\Models\Locale;
use Swim\Core\Helpers\Locales;

class TranslatableModel extends Model
{
    use Translatable;

    protected function getLocalesHelper(): Locales
    {
        return app(Locales::class);
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    protected function isKeyALocale($key)
    {
        $chunks = explode('-', $key);
        if (count($chunks) > 1) {
            if (Locale::where('code', '=', end($chunks))->first())
                return true;
        } else if (Locale::where('code', '=', $key)->first()) {
            return true;
        }

        return false;
    }

    /**
     * @return string
     */
    protected function locale()
    {
        if ($this->isChannelBased()) {
            return core()->getDefaultChannelLocaleCode();
        } else {
            if ($this->defaultLocale) {
                return $this->defaultLocale;
            }

            return config('translatable.locale')
                ?: app()->make('translator')->getLocale();
        }
    }

    /**
     * @return boolean
     */
    protected function isChannelBased()
    {
        return false;
    }
}