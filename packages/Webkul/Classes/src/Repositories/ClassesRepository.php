<?php

namespace Webkul\Classes\Repositories;

use Illuminate\Container\Container as App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Event;
use Webkul\Core\Eloquent\Repository;
use Webkul\Classes\Models\Classes;
use Webkul\Classes\Models\ClassesTranslation;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

/**
 * Classes Reposotory
 *
 * @author    Jitendra Singh <jitendra@webkul.com>
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class ClassesRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'Webkul\Classes\Contracts\Classes';
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        Event::dispatch('catalog.classes.create.before');

        if (isset($data['locale']) && $data['locale'] == 'all') {
            $model = app()->make($this->model());

            foreach (core()->getAllLocales() as $locale) {
                foreach ($model->translatedAttributes as $attribute) {
                    if (isset($data[$attribute])) {
                        $data[$locale->code][$attribute] = $data[$attribute];
                        $data[$locale->code]['locale_id'] = $locale->id;
                    }
                }
            }
        }

        $classes = $this->model->create($data);

        $this->uploadImages($data, $classes);

        if (isset($data['attributes'])) {
            $classes->filterableAttributes()->sync($data['attributes']);
        }

        Event::dispatch('catalog.classes.create.after', $classes);

        return $classes;
    }

    /**
     * Specify category tree
     *
     * @param integer $id
     * @return mixed
     */
    public function getClassesTree($id = null)
    {
        return $id
            ? $this->model::orderBy('position', 'ASC')->where('id', '!=', $id)->get()->toTree()
            : $this->model::orderBy('position', 'ASC')->get()->toTree();
    }

    /**
     * Specify category tree
     *
     * @param integer $id
     * @return mixed
     */
    public function getClassesTreeWithoutDescendant($id = null)
    {
        return $id
            ? $this->model::orderBy('position', 'ASC')->where('id', '!=', $id)->whereNotDescendantOf($id)->get()->toTree()
            : $this->model::orderBy('position', 'ASC')->get()->toTree();
    }

    /**
     * Get root categories
     *
     * @return mixed
     */
    public function getRootCategories()
    {
        return $this->getModel()->where('parent_id', NULL)->get();
    }

    /**
     * get visible Classes tree
     *
     * @param integer $id
     * @return mixed
     */
    public function getVisibleClassesTree($id = null)
    {
        static $classes = [];

        if(array_key_exists($id, $classes))
            return $classes[$id];

        return $classes[$id] = $id
                ? $this->model::orderBy('position', 'ASC')->where('status', 1)->descendantsOf($id)->toTree()
                : $this->model::orderBy('position', 'ASC')->where('status', 1)->get()->toTree();
    }

    /**
     * Checks slug is unique or not based on locale
     *
     * @param integer $id
     * @param string  $slug
     * @return boolean
     */
    public function isSlugUnique($id, $slug)
    {
        $exists = ClassesTranslation::where('classes_id', '<>', $id)
            ->where('slug', $slug)
            ->limit(1)
            ->select(DB::raw(1))
            ->exists();

        return $exists ? false : true;
    }

    /**
     * Retrive classes from slug
     *
     * @param string $slug
     * @return mixed
     */
    public function findBySlugOrFail($slug)
    {
        $class = $this->model->whereTranslation('slug', $slug)->first();

        if ($class) {
            return $class;
        }

        throw (new ModelNotFoundException)->setModel(
            get_class($this->model), $slug
        );
    }

    /**
     * @param string $urlPath
     *
     * @return mixed
     */
    public function findByPath(string $urlPath)
    {
        return $this->model->whereTranslation('url_path', $urlPath)->first();
    }

    /**
     * @param array $data
     * @param $id
     * @param string $attribute
     * @return mixed
     */
    public function update(array $data, $id, $attribute = "id")
    {
        $class = $this->find($id);

        Event::dispatch('catalog.classes.update.before', $id);

        $class->update($data);

        $this->uploadImages($data, $class);

        if (isset($data['attributes'])) {
            $class->filterableAttributes()->sync($data['attributes']);
        }

        Event::dispatch('catalog.classes.update.after', $id);

        return $class;
    }

    /**
     * @param $id
     * @return void
     */
    public function delete($id)
    {
        Event::dispatch('catalog.classes.delete.before', $id);

        parent::delete($id);

        Event::dispatch('catalog.classes.delete.after', $id);
    }

    /**
     * @param array $data
     * @param mixed $class
     * @return void
     */
    public function uploadImages($data, $class, $type = "image")
    {
        if (isset($data[$type])) {
            $request = request();

            foreach ($data[$type] as $imageId => $image) {
                $file = $type . '.' . $imageId;
                $dir = 'classes/' . $class->id;

                if ($request->hasFile($file)) {
                    if ($class->{$type}) {
                        Storage::delete($class->{$type});
                    }

                    $class->{$type} = $request->file($file)->store($dir);
                    $class->save();
                }
            }
        } else {
            if ($class->{$type}) {
                Storage::delete($class->{$type});
            }

            $class->{$type} = null;
            $class->save();
        }
    }

    public function getPartial($columns = null)
    {
        $classes = $this->model->all();
        $trimmed = array();

        foreach ($classes as $key => $class) {
            if ($class->name != null || $class->name != "") {
                $trimmed[$key] = [
                    'id' => $class->id,
                    'name' => $class->name,
                    'slug' => $class->slug
                ];
            }
        }

        return $trimmed;
    }
}