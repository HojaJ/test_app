<?php

namespace App\Http\Controllers\Api;
use App\Http\Resources\UserResource;
use App\Http\Resources\UsersResource;
use App\Models\User;


class UserController extends ApiBaseController
{
    public function index ()
    {
        try {
            $users = User::latest()->get();
            return $this->successResponse([
                'data' => UsersResource::collection($users)
            ]);
        } catch (\Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            return $this->successResponse([
                'data' => new UserResource(User::find($id))
            ]);
        } catch (\Exception $e){
            return $this->errorResponse($e->getMessage());
        }
    }
    public function store($request) {}
    public function create(){}
    public function edit($id){}
    public function update($request, $id){}
    public function destroy($id){}
}
