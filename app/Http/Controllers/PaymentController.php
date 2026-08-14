<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Enrollment;
use App\Http\Requests\PaymentRequest;
class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::all();
        return view ('payments.index')->with('payments', $payments);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $enrollments = Enrollment::pluck('enroll_no','id');
        return view('payments.create', compact('enrollments'));
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(PaymentRequest $request)
{
    Payment::create($request->validated());

    return redirect()->route('payments.index')
                     ->with('flash_message', 'Payment Added Successfully!');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $payments = Payment::find($id);
        return view('payments.show')->with('payments', $payments);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $payments = Payment::find($id);
        $enrollments = Enrollment::pluck('enroll_no','id');
        return view('payments.edit', compact('payments','enrollments'));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(PaymentRequest $request, string $id)
{
    $payment = Payment::find($id);

    $payment->update($request->validated());

    return redirect()->route('payments.index')
                     ->with('flash_message', 'Payment Updated Successfully!');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Payment::destroy($id);
        return redirect('payments')->with('flash_message', 'Payment deleted!');
    }
}
