<?php

namespace Swim\Customer\Http\Controllers;

use Hash;
use Swim\Customer\Repositories\CustomerRepository;
use Swim\Product\Repositories\ProductReviewRepository;

/**
 * Customer controlller for the customer basically for the tasks of customers which will be
 * done after customer authentication.
 *
 * @author    Prashant Singh <prashant.singh852@Swim.com>
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
     * CustomerRepository object
     *
     * @var Object
     */
    protected $customerRepository;

    /**
     * ProductReviewRepository object
     *
     * @var array
     */
    protected $productReviewRepository;

    /**
     * Create a new controller instance.
     *
     * @param \Swim\Customer\Repositories\CustomerRepository     $customer
     * @param \Swim\Product\Repositories\ProductReviewRepository $productReview
     *
     * @return void
     */
    public function __construct(CustomerRepository $customerRepository, ProductReviewRepository $productReviewRepository)
    {
        $this->middleware('customer');

        $this->_config = request('_config');

        $this->customerRepository = $customerRepository;

        $this->productReviewRepository = $productReviewRepository;
    }

    /**
     * Taking the customer to profile details page
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $customer = $this->customerRepository->find(auth()->guard('customer')->user()->id);

        return view($this->_config['view'], compact('customer'));
    }

    /**
     * For loading the edit form page.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $customer = $this->customerRepository->find(auth()->guard('customer')->user()->id);

        return view($this->_config['view'], compact('customer'));
    }

    /**
     * Edit function for editing customer profile.
     *
     * @return response
     */
    public function update()
    {
        $id = auth()->guard('customer')->user()->id;

        $this->validate(request(), [
            'first_name'            => 'string',
            'last_name'             => 'string',
            'gender'                => 'required',
            'date_of_birth'         => 'date|before:today',
            'email'                 => 'email|unique:customers,email,' . $id,
            'password'              => 'confirmed|min:6|required_with:oldpassword',
            'oldpassword'           => 'required_with:password',
            'password_confirmation' => 'required_with:password',
        ]);

        $data = collect(request()->input())->except('_token')->toArray();

        if (isset ($data['date_of_birth']) && $data['date_of_birth'] == "") {
            unset($data['date_of_birth']);
        }

        if (isset ($data['oldpassword'])) {
            if ($data['oldpassword'] != "" || $data['oldpassword'] != null) {
                if (Hash::check($data['oldpassword'], auth()->guard('customer')->user()->password)) {
                    $data['password'] = bcrypt($data['password']);
                } else {
                    session()->flash('warning', trans('shop::app.customer.account.profile.unmatch'));

                    return redirect()->back();
                }
            } else {
                unset($data['password']);
            }
        }

        if ($this->customerRepository->update($data, $id)) {
            Session()->flash('success', trans('shop::app.customer.account.profile.edit-success'));

            return redirect()->route($this->_config['redirect']);
        } else {
            Session()->flash('success', trans('shop::app.customer.account.profile.edit-fail'));

            return redirect()->back($this->_config['redirect']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = auth()->guard('customer')->user()->id;

        $data = request()->all();

        $customerRepository = $this->customerRepository->findorFail($id);

        try {
            if (Hash::check($data['password'], $customerRepository->password)) {
                $orders = $customerRepository->all_orders->whereIn('status', ['pending', 'processing'])->first();

                if ($orders) {
                    session()->flash('error', trans('admin::app.response.order-pending'));

                    return redirect()->route($this->_config['redirect']);
                } else {
                    $this->customerRepository->delete($id);

                    session()->flash('success', trans('admin::app.response.delete-success', ['name' => 'Customer']));

                    return redirect()->route('customer.session.index');
                }
            } else {
                session()->flash('error', trans('shop::app.customer.account.address.delete.wrong-password'));

                return redirect()->back();
            }
        } catch (\Exception $e) {
            session()->flash('error', trans('admin::app.response.delete-failed', ['name' => 'Customer']));

            return redirect()->route($this->_config['redirect']);
        }
    }

    /**
     * Load the view for the customer account panel, showing approved reviews.
     *
     * @return \Illuminate\View\View
     */
    public function reviews()
    {
        $reviews = $this->productReviewRepository->getCustomerReview();

        return view($this->_config['view'], compact('reviews'));
    }
}
