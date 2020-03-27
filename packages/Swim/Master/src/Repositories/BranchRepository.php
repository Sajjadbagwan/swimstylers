<?php

namespace Swim\Master\Repositories;

use Illuminate\Container\Container as App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Swim\Core\Eloquent\Repository;
use Swim\Master\Contracts\Branch;
use Swim\Master\Models\Branch as BranchModel;

/**
 * Order Repository
 *
 * @author    Jitendra Singh <jitendra@Swim.com>
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
 */
class BranchRepository extends Repository
{
    /**
     * branchRepository object
     *
     * @var Object
     */
    protected $branchRepository;

    /**
     * DownloadableLinkPurchasedRepository object
     *
     * @var Object
     */
  // protected $downloadableLinkPurchasedRepository;

    /**
     * Create a new repository instance.
     *
     * @param Swim\Master\Repositories\OrderItemRepository                 $orderItemRepository
     * @param Swim\Master\Repositories\DownloadableLinkPurchasedRepository $downloadableLinkPurchasedRepository
     *
     * @return void
     */
    public function __construct(
        BranchRepository $branchRepository,
        //DownloadableLinkPurchasedRepository $downloadableLinkPurchasedRepository,
        App $app
    ) {
        $this->branchRepository = $branchRepository;

        //$this->downloadableLinkPurchasedRepository = $downloadableLinkPurchasedRepository;

        parent::__construct($app);
    }

    /**
     * Specify Model class name
     *
     * @return Mixed
     */

    public function model()
    {
        return Branch::class;
    }

}
