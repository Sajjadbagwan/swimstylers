<?php

namespace Swim\Classes\Http\Controllers;

use Illuminate\Support\Facades\Event;
use Swim\Classes\Repositories\ClassesRepository;
use Swim\Classes\Models\ClassesTranslation;
use Swim\Attribute\Repositories\AttributeRepository;

/**
 * Catalog Classes controller
 *
 * @author    Jitendra Singh <jitendra@Swim.com>
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
 */
class ClassesController extends Controller
{
    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    /**
     * CategoryRepository object
     *
     * @var Object
     */
    protected $classesRepository;

    /**
     * AttributeRepository object
     *
     * @var Object
     */
    protected $attributeRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Swim\Category\Repositories\CategoryRepository   $categoryRepository
     * @param  \Swim\Attribute\Repositories\AttributeRepository $attributeRepository
     * @return void
     */
    public function __construct(
        ClassesRepository $classesRepository,
        AttributeRepository $attributeRepository
    )
    {
        $this->classesRepository = $classesRepository;

        $this->attributeRepository = $attributeRepository;

        $this->_config = request('_config');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view($this->_config['view']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = $this->classesRepository->getClassesTree(null, ['id']);

        $attributes = $this->attributeRepository->findWhere(['is_filterable' =>  1]);

        return view($this->_config['view'], compact('classes', 'attributes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate(request(), [
            'slug' => ['required', 'unique:classes_translations,slug', new \Swim\Core\Contracts\Validations\Slug],
            'name' => 'required',
            'image.*' => 'mimes:jpeg,jpg,bmp,png',
            'description' => 'required_if:display_mode,==,description_only,products_and_description'
        ]);

        if (strtolower(request()->input('name')) == 'root') {
            $classesTransalation = new ClassesTranslation();

            $result = $classesTransalation->where('name', request()->input('name'))->get();

            if(count($result) > 0) {
                session()->flash('error', trans('admin::app.response.create-root-failure'));

                return redirect()->back();
            }
        }

        $classes = $this->classesRepository->create(request()->all());

        session()->flash('success', trans('admin::app.response.create-success', ['name' => 'Classes']));

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $class = $this->classesRepository->findOrFail($id);

        $classes = $this->classesRepository->getClassesTreeWithoutDescendant($id);

        $attributes = $this->attributeRepository->findWhere(['is_filterable' =>  1]);

        return view($this->_config['view'], compact('class', 'classes', 'attributes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $locale = request()->get('locale') ?: app()->getLocale();

        $this->validate(request(), [
            $locale . '.slug' => ['required', new \Swim\Core\Contracts\Validations\Slug, function ($attribute, $value, $fail) use ($id) {
                if (! $this->categoryRepository->isSlugUnique($id, $value)) {
                    $fail(trans('admin::app.response.already-taken', ['name' => 'Category']));
                }
            }],
            $locale . '.name' => 'required',
            'image.*' => 'mimes:jpeg,jpg,bmp,png'
        ]);

        $this->categoryRepository->update(request()->all(), $id);

        session()->flash('success', trans('admin::app.response.update-success', ['name' => 'Category']));

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = $this->categoryRepository->findOrFail($id);

        if(strtolower($category->name) == "root") {
            session()->flash('warning', trans('admin::app.response.delete-category-root', ['name' => 'Category']));
        } else {
            try {
                Event::dispatch('catalog.category.delete.before', $id);

                $this->categoryRepository->delete($id);

                Event::dispatch('catalog.category.delete.after', $id);

                session()->flash('success', trans('admin::app.response.delete-success', ['name' => 'Category']));

                return response()->json(['message' => true], 200);
            } catch(\Exception $e) {
                session()->flash('error', trans('admin::app.response.delete-failed', ['name' => 'Category']));
            }
        }

        return response()->json(['message' => false], 400);
    }

    /**
     * Remove the specified resources from database
     *
     * @return response \Illuminate\Http\Response
     */
    public function massDestroy() {
        $suppressFlash = false;

        if (request()->isMethod('delete') || request()->isMethod('post')) {
            $indexes = explode(',', request()->input('indexes'));

            foreach ($indexes as $key => $value) {
                try {
                    Event::dispatch('catalog.category.delete.before', $value);

                    $this->categoryRepository->delete($value);

                    Event::dispatch('catalog.category.delete.after', $value);
                } catch(\Exception $e) {
                    $suppressFlash = true;

                    continue;
                }
            }

            if (! $suppressFlash)
                session()->flash('success', trans('admin::app.datagrid.mass-ops.delete-success'));
            else
                session()->flash('info', trans('admin::app.datagrid.mass-ops.partial-action', ['resource' => 'Attribute Family']));

            return redirect()->back();
        } else {
            session()->flash('error', trans('admin::app.datagrid.mass-ops.method-error'));

            return redirect()->back();
        }
    }
}