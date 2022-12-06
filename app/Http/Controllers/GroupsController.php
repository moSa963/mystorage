<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use App\Http\Resources\GroupMemberResource;
use App\Http\Resources\GroupResource;
use App\Models\Group;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GroupsController extends Controller
{
    public function show(Request $request, Group $group){
        $this->authorize("view", $group);
        $group->load("user");

        return response()->json([
            'data' => [
                "group" => $group,
                "members" => GroupMemberResource::collection($group->users),
            ],
        ], 200);
    }

    public function index(){
        $groups = Group::select('groups.*', 'groups_users.is_read_only')
                            ->leftJoin('groups_users', 'groups_users.group_id', '=', 'groups.id')
                            ->where('groups_users.accepted', true)
                            ->where('groups_users.user_id', Auth::user()->id)
                            ->orWhere('groups.user_id', Auth::user()->id)
                            ->get();

        return response()->json([
            'data' => $groups,
        ], 200);
    }

    public function store(StoreGroupRequest $request){
        try{
            $group = $request->store(Auth::user());
        } catch(Exception $e){
            abort(403, "you have a group with the same name");
        }

        return new GroupResource($group);
    }

    public function update(UpdateGroupRequest $request, Group $group){

        $this->authorize("update", $group);

        $request->update($group);

        return response()->noContent();
    }

    public function destroy(Request $request, Group $group){
        $this->authorize("delete", $group);

        $group->delete();

        return response()->noContent();
    }
}
