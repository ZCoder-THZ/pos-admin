<?php

namespace App\Http\Controllers\Api;

use Storage;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    //
public function editProfile(Request $request)
{
    $user = User::find($request->userId);

    if (!$user) {
        return response()->json([
            "message" => "User not found"
        ], 404);
    }

    $updateData = [
        "name" => $request->name,
        "email" => $request->email,
        "phone" => $request->phone,
        "address" => $request->address,
    ];

    // Delete the old image from storage if it exists
    if ($user->image !== null) {
        Storage::delete($user->image);
    }

    // Upload the new image to storage if it was included in the request
    if ($request->hasFile('image')) {
        $imageName = uniqid() . '_' . $request->file('image')->getClientOriginalName();
        $updateData['image'] = $imageName;
        $request->file('image')->storeAs('public/users', $imageName);
    }

    // Update the user record in the database
    $user->update($updateData);

    return response()->json([
        "status"=>"success",
        "message" => "Profile updated successfully",
    ]);
}

}

