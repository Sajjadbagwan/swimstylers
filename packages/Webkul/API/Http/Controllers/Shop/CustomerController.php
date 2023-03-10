<?php

namespace Swim\API\Http\Controllers\Shop;

use Illuminate\Support\Facades\Event;
use Swim\Customer\Repositories\CustomerRepository;
use Swim\Customer\Repositories\CustomerGroupRepository;

/**
 * Customer controller
 *
 * @author    Jitendra Singh <jitendra@Swim.com>
 * @author    Vivek Sharma <viveksh047@Swim.com> @vivek-Swim
 * @copyright 2018 Swim Software Pvt Ltd (http://www.Swim.com)
 */
class CustomerController extends Controller
{
    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    /**
     * Repository object
     *
     * @var array
     */
    protected $customerRepository;

    /**
     * Repository object
     *
     * @var array
     */
    protected $customerGroupRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Swim\Customer\Repositories\CustomerRepository     $customerRepository
     * @param  \Swim\Customer\Repositories\CustomerGroupRepository     $customerGroupRepository
     * @return void
     */
    public function __construct(
        CustomerRepository $customerRepository,
        CustomerGroupRepository $customerGroupRepository
    )   {
        $this->_config = request('_config');

        $this->customerRepository = $customerRepository;

        $this->customerGroupRepository = $customerGroupRepository;
    }

    /**
     * Method to store user's sign up form data to DB.
     *
     * @return Mixed
     */
    public function create()
    {
        request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'email|required|unique:customers,email',
            'password' => 'confirmed|min:6|required'
        ]);

        $data = request()->input();

        $data = array_merge($data, [
                'password' => bcrypt($data['password']),
                'channel_id' => core()->getCurrentChannel()->id,
                'is_verified' => 1
            ]);

        $data['customer_group_id'] = $this->customerGroupRepository->findOneWhere(['code' => 'general'])->id;

        Event::dispatch('customer.registration.before');

        $customer = $this->customerRepository->create($data);

        Event::dispatch('customer.registration.after', $customer);

        return response()->json([
                'message' => 'Your account has been created successfully.'
            ]);
    }
}