<?php

namespace App\Http\Controllers;

use App\Http\Services\GroupService;
use Illuminate\Http\Request;

class GroupsController extends Controller
{

    public $group_service;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->group_service = new GroupService;
    }

    /**
     * Undocumented function
     *
     * @param Integer $user_id
     * @return void
     */
    public function getGroupsByUser($user_id)
    {
        return $this->group_service->fetchGroupsByUser($user_id);
    }

    /**
     * Undocumented function
     *
     * @param Integer $group_id
     * @return void
     */
    public function getGroupUsers($group_id)
    {
        return $this->group_service->fetchGroupUsers($group_id);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function createGroup(Request $request)
    {
        return $this->group_service->createGroup($request);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function updateGroup(Request $request)
    {
        return $this->group_service->updateGroup($request);
    }

    /**
     * Undocumented function
     *
     * @param Integer $group_id
     * @return void
     */
    public function deleteGroup($group_id)
    {
        return $this->group_service->deleteGroup($group_id);
    }

}
