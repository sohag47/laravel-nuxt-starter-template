<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Contracts\RepositoryInterface;
use App\Http\Resources\RoleCollection;
use App\Http\Resources\RoleResource;
use App\Http\Requests\StoreRoleRequest;
use App\Models\Role;
use App\Enums\CRUDStatus;

class RoleController extends ApiController
{
    private $repositoryInterface;
    private $role;
    private $model;
    private $message;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(RepositoryInterface $role)
    {
        $this->repositoryInterface = $role;
        $this->model = Role::class;
    }

    public function index()
    {
        $roles = $this->repositoryInterface->getAll($this->model);
        return $this->respondWithCollection($roles, RoleCollection::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        $this->role = $this->repositoryInterface->create([
            'role' => $request->role,
            'description' => $request->description,
            'is_active' => $request->is_active,
            'created_by' => $request->created_by,
        ], $this->model);
        return $this->respondWithItem($this->role->refresh(), RoleResource::class);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = $this->repositoryInterface->findById($id, $this->model);

        if(!$role){
            $this->message = CRUDStatus::NOTFOUND;
            return $this->respondWithArray(['data' => $this->message]);
        }
        return $this->respondWithItem($role, RoleResource::class);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRoleRequest $request, $id)
    {
        $role = $this->repositoryInterface->findById($id, $this->model);
        $this->role = $this->repositoryInterface->update([
            'role' => $request->role,
            'description' => $request->description,
            'is_active' => $request->is_active,
            'updated_by' => $request->updated_by,
        ], $role);
        return $this->respondWithItem($this->role, RoleResource::class);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = $this->repositoryInterface->findById($id, $this->model);
        
        if(!$role){
            $this->message = CRUDStatus::NOTFOUND;
            return $this->respondWithArray(['data' => $this->message]);
        }
        DB::transaction(function() use($id, $role){
            $this->repositoryInterface->delete($role);
        });
        $this->message = CRUDStatus::DELETE;
        return $this->respondWithArray(['data' => $this->message]);
    }
}
