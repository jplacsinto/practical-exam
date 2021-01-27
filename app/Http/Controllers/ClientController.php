<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interest;
use Illuminate\Support\Facades\Hash;
use App\User;

use App\Http\Requests\UserStoreRequest;

use Freshbitsweb\Laratables\Laratables;

use Illuminate\Support\Facades\Gate;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'first_name' => null,
            'last_name' => null,
            'contact_no' => null,
            'birthday' => null,
            'role_id' => null,
            'email' => null,
            'interests' => null,
            'allInterests' => Interest::pluck('name', 'id')->toArray(),
            'formAction' => route('clients.store')
        ];
        
        return view('auth.register', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $data = $request->all();

        $data['password'] = Hash::make($data['password']);

        $data['role_id'] = !empty($data['role_id']) && $data['role_id'] == 1 ? 1 : 2;

        $user = User::create($data);

        $interests = !empty($data['interests']) ? $data['interests'] : [];

        $user->interests()->sync($data['interests']);

        return redirect()->route('clients.index')->with('message', 'New client successfully created.');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, User $client)
    {
        $data = $client->toArray();

        $data['allInterests'] = Interest::pluck('name', 'id')->toArray();

        $data['interests'] = $client->interests->count() > 0 ? $client->interests->pluck('id')->toArray() : [];

        $data['formAction'] = route('clients.update', $client->id);

        $data['formMethod'] = 'PUT';

        return view('auth.register', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserStoreRequest $request, User $client)
    {
        $data = $request->all();

        if (!empty($data['change_pass'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
            unset($data['password_confirmation']);
        }

        $data['role_id'] = !empty($data['role_id']) && $data['role_id'] == 1 ? 1 : 2;

        $client->update($data);

        $interests = !empty($data['interests']) ? $data['interests'] : [];

        $client->interests()->sync($data['interests']);

        return redirect()->back()->with('message', 'Client successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $client)
    {
        $client->delete();
        return redirect()->back()->with('message', 'Client deleted successfully');
    }

    public function clientTable()
    {
        return Laratables::recordsOf(User::class);
    }
}
