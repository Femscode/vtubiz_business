<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function fetchplan($type, $network = null)
    {

        $user = Auth::user();

        if ($type == "data") {
            if ($user->upgrade == 1) {

                $data = Data::where('network', $network)->where('user_id', $user->company_id)->where('status', 1)->orderBy('admin_price', 'ASC')->get();
            } else {
                $data = Data::where('network', $network)->where('user_id', 0)->where('status', 1)->orderBy('admin_price', 'ASC')->get();
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Plan type not specified!',
            ], 401);
        }
        return response()->json([
            'status' => true,
            'message' => 'Data Plans Fetched Successfully!',
            'data' => $data,

        ], 200);
    }
}
