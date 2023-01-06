<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReadingRequest;
use App\Models\Reading;
use Illuminate\Http\Request;

class MeterReaderController extends Controller
{
    public function readingDashboard()
    {
        return view('meter-reader.dashboard');
    }
    
    public function createReading(ReadingRequest $request)
    {
        
        Reading::create([
            'reading_date' => $request->reading_date,
            'reading_value' => $request->reading_value,
            'customer_account_number' => $request->customer_account_number
        ]);

        return redirect()->route('dashboard')->with('success','Reading has been added successfully.');
    }
}