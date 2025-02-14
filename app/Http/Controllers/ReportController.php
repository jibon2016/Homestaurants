<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    // report form
    public function reportForm() {
        return view('report');
    }

    // Send report

    public function sendReport(Request $request){

        $userId = auth()->user()->id;
        $formFields = $request->validate([
            'order_id' => 'string|required',
            'report_on' => 'string|required',
            'details' => 'required',
        ]);

        $formFields['order_id'] = $request->input('order_id') . 'U' . $userId;

        Report::create($formFields);

        return redirect()->back()->with('message', 'Your report has been successfully submitted. We will back you soon.');
    }
}
