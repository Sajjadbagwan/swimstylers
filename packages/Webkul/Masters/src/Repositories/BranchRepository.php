<?php

namespace Webkul\Masters\Repositories;

use DB;
use Illuminate\Container\Container as App;
use Illuminate\Support\Facades\Event;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Webkul\Attribute\Repositories\AttributeRepository;
use Webkul\Core\Eloquent\Repository;
/*
use Webkul\Masters\Contracts\Branch;
use Webkul\Masters\Models\Branch as BranchModel;*/

/**
 * Branch Repository
 *
 * @author    Jitendra Singh <jitendra@webkul.com>
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class BranchRepository extends Repository
{
    /**
     * BranchRepository object
     *
     * @var Object
     */
    protected $branchRepository;

   
    /**
     * Create a new repository instance.
     *
     * @param Webkul\Masters\Repositories\BranchRepository  $branchRepository
     *
     * @return void
     */
    public function __construct(
        BranchRepository $branchRepository,
        App $app
    ) {
        $this->branchRepository = $branchRepository;
        
        parent::__construct($app);
    }

    /**
     * Specify Model class name
     *
     * @return Mixed
     */

    public function model()
    {
        //return Branch::class;
        return 'Webkul\Masters\Contracts\Branch';
    }

    /**
     * @param array $data
     *
     * @return mixed
    
    public function create(array $data)
    {
        DB::beginTransaction();

         try {
             Event::dispatch('checkout.branch.save.before', $data);

             $branch = $this->model->create(array_merge($data, ['increment_id' => $this->generateIncrementId()]));

         }catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }

        DB::commit();

        return $branch;
    } */

   
}
