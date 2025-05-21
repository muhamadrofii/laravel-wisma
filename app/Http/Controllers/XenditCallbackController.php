<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Kamar;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

// ...

class XenditCallbackController extends Controller
{
    public function handle(Request $request)
    {
        $getToken = $request->header('x-callback-token');
        $callbackToken = env('XENDIT_CALLBACK_TOKEN');

        if (!$callbackToken || $getToken !== $callbackToken) {
            return response()->json([
                'status' => 'Error',
                'message' => 'Token callback invalid or missing'
            ], Response::HTTP_FORBIDDEN);
        }

        $order = Order::where('external_id', $request->external_id)->first();

        // if ($order) {
        //     $order->update([
        //         'status' => $request->status === 'PAID' ? 'Completed' : 'Failed'
        //     ]);
        // }

        // batas

        if ($order) {
        $newOrderStatus = $request->status === 'PAID' ? 'Completed' : 'Failed';

            // Update status order
        $order->status = $newOrderStatus;

            // Jika status 'Completed' dan memiliki kamar_id, update juga status kamar
        if ($newOrderStatus === 'Completed' && $order->kamar_id) {
            $today = Carbon::now()->startOfDay();
            $checkinDate = $order->checkin ? Carbon::parse($order->checkin)->startOfDay() : null;

            if ($checkinDate && $checkinDate->greaterThan($today)) {
                $order->kamar()->update(['status' => 'terjadwal']);
            } else {
                $order->kamar()->update(['status' => 'telah dipesan']);
            }
        }

            $order->save();
        }


        return response()->json([
            'status' => Response::HTTP_OK,
            'message' => 'Callback processed successfully'
        ]);
    }
}


