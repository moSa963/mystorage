<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileImageController extends Controller
{
    public function show_group(Request $request, Group $group){
        if (Storage::exists('groups/'.$group->id)){
            return Storage::response('groups/'.$group->id, $group->name.$group->id);
        }
        
        return redirect("/images/user.png");
    }

    public function show_user(Request $request, User $user){

        if (Storage::exists('users/'.$user->username)){
            return Storage::response('users/'.$user->username);
        }

        return redirect("/images/user.png");
    }
}
