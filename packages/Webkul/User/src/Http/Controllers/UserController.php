<?php

namespace Webkul\User\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Event;
use Webkul\User\Repositories\AdminRepository;
use Webkul\User\Repositories\RoleRepository;
use Webkul\User\Http\Requests\UserForm;
use Hash;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Facades\Auth;

/**
 * Admin user controller
 *
 * @author    Jitendra Singh <jitendra@webkul.com>
 * @copyright 2018 Webkul Software Pvt Ltd (http://www.webkul.com)
 */
class UserController extends Controller
{
    /**
     * Contains route related configuration
     *
     * @var array
     */
    protected $_config;

    /**
     * AdminRepository object
     *
     * @var Object
     */
    protected $adminRepository;

    /**
     * RoleRepository object
     *
     * @var Object
     */
    protected $roleRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\User\Repositories\AdminRepository $adminRepository
     * @param  \Webkul\User\Repositories\RoleRepository $roleRepository
     * @return void
     */
    public function __construct(
        AdminRepository $adminRepository,
        RoleRepository $roleRepository
    )
    {
        $this->adminRepository = $adminRepository;

        $this->roleRepository = $roleRepository;

        $this->_config = request('_config');

        $this->middleware('guest', ['except' => 'destroy']);
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
        $roles = $this->roleRepository->all();
        $userRole = Auth::guard('admin')->user()->role_id;
        if($userRole != 1){
        	unset($roles[0]);
        }
       	$levels = $this->adminRepository->getLevel();
        return view($this->_config['view'], compact('roles','levels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Webkul\User\Http\Requests\UserForm  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserForm $request)
    {
        $data = $request->all();
        if (isset($data['password']) && $data['password']) {
            $data['password'] = bcrypt($data['password']);
            $data['api_token'] = Str::random(80);
        }

        $file = $request->file('image');
        $image = '';
        if($file != ''){
        	$filename = 'profile-photo-' . time() . '.' . $file->getClientOriginalExtension();
	   		$image = $file->storeAs('avatar', $filename);
        }
        
        $adminData = [
            'name'          => $data['name'],
            'email'         => $data['email'],
            'password'      => $data['password'],
            'api_token'     => $data['api_token'],
            'role_id'       => $data['role_id'],
            'contact_number'=> $data['contact_number'],
            'image'         => $image,
        ];

        Event::dispatch('user.admin.create.before');

        $admin = $this->adminRepository->create($adminData);

        if($data['role_id'] != 1){
	       	$dbs_doc_file = $request->file('dbs_doc_file');
	       	if($dbs_doc_file != '' || $dbs_doc_file != null){
	       		$filename = 'profile-photo-' . time() . '.' . $dbs_doc_file->getClientOriginalExtension();
		    	$dbs_doc_file = $dbs_doc_file->storeAs('dbs_doc_file', $filename);
	       	}
	       	
	       	$ios_cert_file = $request->file('ios_cert_file');
	       	if($ios_cert_file != ''){
	       		$filename = 'profile-photo-' . time() . '.' . $ios_cert_file->getClientOriginalExtension();
		    	$ios_cert_file = $ios_cert_file->storeAs('ios_cert_file', $filename);
	       	}
		    
	       	$signed_contract_file = $request->file('signed_contract_file');
	       	if($signed_contract_file != ''){
	       		$filename = 'profile-photo-' . time() . '.' . $signed_contract_file->getClientOriginalExtension();
		    	$signed_contract_file = $signed_contract_file->storeAs('signed_contract_file', $filename);
	       	}

		    $detailData = [
	            'user_id'   			=> $admin->id,
	            'profile_dsec'			=> $data['profile_dsec'],
	            'dbs_doc_file'			=> $dbs_doc_file,
	            'ios_cert_file'			=> $ios_cert_file,
	            'signed_contract_file'	=> $signed_contract_file,
	            'max_teach_level_name'	=> $data['max_teach_level_name'],
	            'max_teach_level_stage'	=> $data['max_teach_level_stage'],
	            'job_title'				=> $data['job_title'],
	            'branch_id'				=> 1,//$data['branch_id'],
	        ];
	        
			\DB::table('admins_detail')->insert($detailData);
		}
        
        Event::dispatch('user.admin.create.after', $admin);

        session()->flash('success', trans('admin::app.response.create-success', ['name' => 'User']));

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param integer $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {

        $user 		= $this->adminRepository->findOrFail($id);
        $userdetail = $this->adminRepository->getDetail($id);
        $levels 	= $this->adminRepository->getLevel();
        $roles 		= $this->roleRepository->all();
       	
       	$userRole = Auth::guard('admin')->user()->role_id;
        if($userRole != 1){
        	unset($roles[0]);
        }
        
        return view($this->_config['view'], compact('user', 'roles','userdetail','levels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Webkul\User\Http\Requests\UserForm  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserForm $request, $id)
    {
        $data = $request->all();
        
        if (! $data['password']) {
            unset($data['password']);
        } else {
            $data['password'] = bcrypt($data['password']);
        }

        if (isset($data['status'])) {
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }

        Event::dispatch('user.admin.update.before', $id);
        
        $file = $request->file('image');
        if($file != ''){
        	$filename = 'profile-photo-' . time() . '.' . $file->getClientOriginalExtension();
	   		$data['image'] = $file->storeAs('avatar', $filename);
        }

        $admin = $this->adminRepository->update($data, $id);

        if($data['role_id'] != 1){

        	$detailData = [
	            'profile_dsec'			=> $data['profile_dsec'],
	            'max_teach_level_name'	=> $data['max_teach_level_name'],
	            'max_teach_level_stage'	=> $data['max_teach_level_stage'],
	            'job_title'				=> $data['job_title'],
	            'branch_id'				=> 1,//$data['branch_id'],
	        ];

	        $dbs_doc_file = $request->file('dbs_doc_file');
	       	if($dbs_doc_file != '' || $dbs_doc_file != null){
	       		$filename = 'profile-photo-' . time() . '.' . $dbs_doc_file->getClientOriginalExtension();
		    	$dbs_doc_file = $dbs_doc_file->storeAs('dbs_doc_file', $filename);
		    	$detailData['dbs_doc_file'] = $dbs_doc_file;
	       	}
	       	
	       	$ios_cert_file = $request->file('ios_cert_file');
	       	if($ios_cert_file != ''){
	       		$filename = 'profile-photo-' . time() . '.' . $ios_cert_file->getClientOriginalExtension();
		    	$ios_cert_file = $ios_cert_file->storeAs('ios_cert_file', $filename);
		    	$detailData['ios_cert_file'] = $ios_cert_file;
	       	}
		    
	       	$signed_contract_file = $request->file('signed_contract_file');
	       	if($signed_contract_file != ''){
	       		$filename = 'profile-photo-' . time() . '.' . $signed_contract_file->getClientOriginalExtension();
		    	$signed_contract_file = $signed_contract_file->storeAs('signed_contract_file', $filename);
		    	$detailData['signed_contract_file'] = $signed_contract_file;
	       	}

	       	\DB::table('admins_detail')->where('user_id', $id)->update($detailData);
	    }


        Event::dispatch('user.admin.update.after', $admin);

        session()->flash('success', trans('admin::app.response.update-success', ['name' => 'User']));

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function destroy($id)
    {
        $user = $this->adminRepository->findOrFail($id);

        if ($this->adminRepository->count() == 1) {
            session()->flash('error', trans('admin::app.response.last-delete-error', ['name' => 'Admin']));
        } else {
            Event::dispatch('user.admin.delete.before', $id);

            if (auth()->guard('admin')->user()->id == $id) {
                return response()->json([
                    'redirect' => route('super.users.confirm', ['id' => $id]),
                ]);
            }

            try {
                $this->adminRepository->delete($id);

                session()->flash('success', trans('admin::app.response.delete-success', ['name' => 'Admin']));

                Event::dispatch('user.admin.delete.after', $id);

                return response()->json(['message' => true], 200);
            } catch (Exception $e) {
                session()->flash('error', trans('admin::app.response.delete-failed', ['name' => 'Admin']));
            }
        }

        return response()->json(['message' => false], 400);
    }

    /**
     * Show the form for confirming the user password.
     *
     * @param integer $id
     * @return \Illuminate\View\View
     */
    public function confirm($id)
    {
    	$user = $this->adminRepository->findOrFail($id);

        return view($this->_config['view'], compact('user'));
    }

    /**
     * destroy current after confirming
     *
     * @return mixed
     */
    public function destroySelf()
    {
        $password = request()->input('password');

        if (Hash::check($password, auth()->guard('admin')->user()->password)) {
            if ($this->adminRepository->count() == 1) {
                session()->flash('error', trans('admin::app.users.users.delete-last'));
            } else {
                $id = auth()->guard('admin')->user()->id;

                Event::dispatch('user.admin.delete.before', $id);

                $this->adminRepository->delete($id);

                Event::dispatch('user.admin.delete.after', $id);

                session()->flash('success', trans('admin::app.users.users.delete-success'));

                return redirect()->route('admin.session.create');
            }
        } else {
            session()->flash('warning', trans('admin::app.users.users.incorrect-password'));

            return redirect()->route($this->_config['redirect']);
        }
    }
}
