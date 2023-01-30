<?php

namespace App\Http\Controllers;

use Toyyibpay;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $donations = Donation::all();

        return view('donation.index', [
            'donations' => $donations,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('donation.make-donation');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $donations = new Donation();
        $donations->user_id = Auth::id();
        $donations->amount = $request->amount;
        $donations->save();
        return redirect()->route('create:fee', $donations);
    }

    /**
     * Display the specified resource.
     *\Http\RedirectResponse::route()
     * @param  \App\Models\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('app.donations.show', compact('donation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $donation = Donation::find(
            $id
        );
        return view('donation.update-donation', ['donation' => $donation]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $donation = Donation::find(
            $request->id
        );
        $donation->amount = $request->amount;
        $donation->save();
        return redirect('donation.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Donation $donation)
    {
        //
    }

    public function getBankFPX()
    {
        $ex = Toyyibpay::getBanksFPX();
        dd($ex);
    }
    public function createFee(Request $request, Donation $donations)
    {
        $code = 'eq04dj7l';

        $bill_object = [
            'billName' => 'Donation ',
            'billDescription' => 'Donation for FK student',
            'billPriceSetting' => 1,
            'billPayorInfo' => 1,
            'billAmount' => $donations->amount,
            'billExternalReferenceNo' => 'ABHDWUDB31NUJ',
            'billTo' => $donations->id,
            'billEmail' => 'test@gmail.com',
            'billPhone' => '0193883222',
        ];

        $data = Toyyibpay::createBill($code, (object)$bill_object);

        // $bill_code = $data[0]->BillCode;

        return redirect()->route('bill:payment', $code);
    }

    public function billPaymentLink($bill_code)
    {
        $data = Toyyibpay::billPaymentLink($bill_code);

        return redirect()->away("$data");
    }
}
