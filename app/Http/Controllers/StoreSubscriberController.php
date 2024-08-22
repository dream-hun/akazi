<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class StoreSubscriberController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:subscribers',
        ]);
        $subscriber = Subscriber::create([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return to_route('faqs')->with('success', 'Thank you for subscribing to our newsletter.');
    }
}
