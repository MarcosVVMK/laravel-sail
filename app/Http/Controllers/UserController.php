<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public readonly  User $user;

    public function __construct()
    {
        $this->user = new User();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $users = $this->user->all();

        return view('users', ['users' => $users ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view( 'user_create' );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $current_date = gmdate( 'Y-m-d h:i:s' );

        $store = $this->user->create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => password_hash( $request->input('password'), PASSWORD_DEFAULT ),
            'email_verified_at' => $current_date,
            'remeber_token' => '1',
            'created_at' => $current_date,
            'updated_at' => $current_date,
        ]);

        if ( $store ){
            return redirect()->back()->with('message', 'Successfully store!');
        }

        return redirect()->back()->with('message', 'Error store!');
    }

    /**
     * Display the specified resource.
     */
    public function show(user $user): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('user_show', ['user' => $user ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {

        return view('user_edit', ['user' => $user ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): \Illuminate\Http\RedirectResponse
    {
       $update = $this->user->where('id', $id )->update( $request->except([ '_token', '_method' ]));

       if ( $update ){
           return redirect()->back()->with('message', 'Successfully updated!');
       }

       return redirect()->back()->with('message', 'Error update!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
