<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * Return users list
     * @return Ilumnate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return $this->validResponse($users);
    }

    /**
     * Create an instance of users
     * @return Ilumnate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ];

        $this->validate($request, $rules);

        $fields = $request->all();
        $fields['password'] = Hash::make($request->password);

        $user = User::create($fields);

        return $this->successResponse($user, Response::HTTP_CREATED);
    }

    /**
     * Return user data
     * @return Ilumnate\Http\Response
     */
    public function show($userId)
    {
        $user = User::findOrFail($userId);
        return $this->successResponse($user);
    }

    /**
     * Update the information of an existing user
     * @return Ilumnate\Http\Response
     */
    public function update(Request $request, $userId)
    {
        $rules = [
            'name' => 'string|max:255',
            'email' => 'string|email|unique:users,email,' . $userId,
            'password' => 'min:8|confirmed',
        ];

        $this->validate($request, $rules);

        $user = User::findorFail($userId);

        $user->fill($request->all());

        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($user->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user->save();

        return $this->successResponse($user);
    }

    /**
     * Destroy an existing user
     * @return Ilumnate\Http\Response
     */
    public function destroy($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();
        return $this->successResponse($user);
    }

    /**
     * Identifies the user
     * @return Ilumnate\Http\Response
     */
    public function me(Request $request)
    {
        return $this->validResponse($request->user());
    }
}
