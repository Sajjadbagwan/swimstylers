<?php

namespace Swim\CMS\Repositories;

use Illuminate\Support\Facades\Event;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Swim\Core\Eloquent\Repository;
use Swim\CMS\Models\CmsPageTranslation;

/**
 * CMS Reposotory
 *
 * @author  Jitendra Singh <jitendra@Swim.com>
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
 */
class CmsRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Swim\CMS\Contracts\CmsPage';
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        Event::dispatch('cms.pages.create.before');

        $model = $this->getModel();

        foreach (core()->getAllLocales() as $locale) {
            foreach ($model->translatedAttributes as $attribute) {
                if (isset($data[$attribute]))
                    $data[$locale->code][$attribute] = $data[$attribute];
            }
        }

        $page = parent::create($data);

        $page->channels()->sync($data['channels']);

        Event::dispatch('cms.pages.create.after', $page);

        return $page;
    }

    /**
     * @param array   $data
     * @param integer $id
     * @param string $attribute
     * @return mixed
     */
    public function update(array $data, $id, $attribute = "id")
    {
        $page = $this->find($id);

        Event::dispatch('cms.pages.update.before', $id);

        parent::update($data, $id, $attribute);

        $page->channels()->sync($data['channels']);

        Event::dispatch('cms.pages.update.after', $id);

        return $page;
    }

    /**
     * Checks slug is unique or not based on locale
     *
     * @param integer $id
     * @param string  $urlKey
     * @return boolean
     */
    public function isUrlKeyUnique($id, $urlKey)
    {
        $exists = CmsPageTranslation::where('cms_page_id', '<>', $id)
            ->where('url_key', $urlKey)
            ->limit(1)
            ->select(\DB::raw(1))
            ->exists();

        return $exists ? false : true;
    }

    /**
     * Retrive category from slug
     *
     * @param string $urlKey
     * @return mixed
     */
    public function findByUrlKeyOrFail($urlKey)
    {
        $page = $this->model->whereTranslation('url_key', $urlKey)->first();

        if ($page)
            return $page;

        throw (new ModelNotFoundException)->setModel(
            get_class($this->model), $urlKey
        );
    }
}