<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UpdatePassword;
use Illuminate\Support\Facades\Hash;

class UpdatePasswordController extends Controller
{
    public function update(Request $request, $id)
    {
        $changePassword = UpdatePassword::find($id);
        $changePassword->password = Hash::make($request->password);

        $changePassword->save();

        $response['message'] = 'Updated';

    }
}
