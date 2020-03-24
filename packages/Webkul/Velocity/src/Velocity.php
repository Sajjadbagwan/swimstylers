<?php

namespace Swim\Velocity;

use Swim\Category\Repositories\CategoryRepository as Category;

class Velocity
{
    /**
     * Content Type List
     *
     * @var mixed
     */
	protected $content_type = [
        // 'link' => 'Link CMS Page',
        // 'product' => 'Catalog Products',
        // 'static' => 'Static Content',
        'category' => 'Category Slug',
    ];

    /**
     * Catalog Product Type
     *
     * @var mixed
     */
	protected $catalog_type = [
        'new' => 'New Arrival',
        'offer' => 'Offered Product [Special]',
        'popular' => 'Popular Products',
        'viewed' => 'Most Viewed',
        'rated' => 'Most Rated',
        'custom' => 'Custom Selection',
    ];

	protected $category;

    /**
     * Create a new instance.
     *
     * @param  Swim\Category\Repositories\CategoryRepository  $category
     * @return void
     */
    public function __construct(
        Category $category
    ) {
        $this->category = $category;
    }

	public function getContentType() {
		return $this->content_type;
    }

    public function getCatalogType() {
		return $this->catalog_type;
    }
}