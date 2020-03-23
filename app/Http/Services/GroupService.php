<?php

namespace App\Http\Services;

use App\Group;
use App\GroupUser;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GroupService
{

    public $group_user;
    public $group;

    public function __construct()
    {
        $this->group = new Group;
        $this->group_user = new GroupUser;
    }

    /**
     * Fetch details of given group with its users.
     *
     * @param integer $group_id
     * @return void
     */
    public function fetchGroupDetail(int $group_id)
    {
        $validator = Validator::make(['group_id' => $group_id], [
            'group_id' => 'required|exists:groups,id',
        ]);

        if ($validator->errors()) {
            return response()->json(['message' => $validator->errors()->first()], 400);
        }

        return $this->group->where('group_id', $group_id)
            ->with('group_users.user')
            ->get();
    }

    /**
     * Fetch all Users of a given group in request
     *
     * @param integer $group_id
     * @return void
     */
    public function fetchGroupUsers(int $group_id)
    {

        $validator = Validator::make(['group_id' => $group_id], [
            'group_id' => 'required|exists:groups,id',
        ]);

        if (!$validator->validated()) {
            return response()->json($validator->errors(), 400);
        }
        return $this->group_user->where('group_id', $group_id)
            ->with('user')
            ->get();
    }

    /**
     * Fetch all groups of a given user in request
     *
     * @param integer $user_id
     * @return void
     */
    public function fetchGroupsByUser($user_id)
    {

        $validator = Validator::make(['user_id' => $user_id], [
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 400);
        }

        return $this->group_user->where('user_id', $user_id)
            ->with('groups')
            ->get();
    }

    /**
     * Create a new group
     *
     * @param Request $request
     * @return void
     */
    public function createGroup(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'user_id' => 'required|exists:users,id',
            ]);

            if ($validator->fails()) {
                return response()->json(['message' => $validator->errors()->first()], 400);
            }

            $group = $this->group->create($request->all());

            return response()->json(['message' => 'Group created', 'data' => $group], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }

    }

    /**
     * Update Group name
     *
     * @param Request $request
     * @return void
     */
    public function updateGroup(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'group_id' => 'required|exists:groups,id',
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 400);
        }

        $edit = $this->group->where('id', $request->group_id);
        $edit->update(['name' => $request->name]);

        $edit = $this->group->find($request->group_id);

        return response()->json(['message' => 'Record updated successful',
            'data' => $edit], 200);
    }

    /**
     * Delete a group by id
     *
     * @param [type] $group_id
     * @return void
     */
    public function deleteGroup($group_id)
    {
        $validator = Validator::make(['group_id' => $group_id], [
            'group_id' => 'required|exists:groups,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 400);
        }

        $to_delete = $this->group->find($group_id);
        $to_delete->delete();
        return response()->json(['message' => 'Group deleted successfully', 'data' => $to_delete], 200);

    }
}
