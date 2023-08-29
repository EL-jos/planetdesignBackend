<?php

namespace App\Http\Controllers;

use App\Mail\QuoteSend;
use App\Models\Order;
use App\Models\Quote;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Quote $quote
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quote $quote)
    {
        if(!session()->has('user')){
            return redirect()->route('identification.page')->with('warnin', "Veillez vous connecter pour bénéficier pleinnement de nos fonctionnalités");
        }

        if($quote->delete()){
            return back()->with('success', "Devis supprimer avec succès");
        }
        return back()->with('error', "Impossible de supprimer devis");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function destroyAllQuoteOfThisUser(User $user)
    {
        if(!session()->has('user')){
            return redirect()->route('identification.page')->with('warning', "Veillez vous connecter pour bénéficier pleinnement de nos fonctionnalités");
        }

        if($user->quotes()->delete()){
            return back()->with('success', "Les Devis ont été supprimés avec succès");
        }
        return back()->with('error', "Impossible de supprimer les devis");

    }

    /**
     * @param Request $request
     * @param Quote $quote
     * @return Response
     */
    public function modifyQuantityOfQuote(Request $request, Quote $quote){
        //dd($quote);
        $newQuantity = $request->input('quantity');
        //dd($newQuantity, $quote);
        if ($newQuantity !== null) {
            if($quote->update(['quantity' => $newQuantity])){
                if($request->attributes->has('htmx')){
                    return view('layouts.quote.quantity', ['quote' => $quote, 'message' => "Quantité modifié avec succès", 'code' => 0]);
                }
            }else{
                return view('layouts.quote.quantity', ['quote' => $quote, 'message' => "Impossible de mettre à jour la quantité de ce devis", 'code' => 1]);
            }
        }else{
            return view('layouts.quote.quantity', ['quote' => $quote, 'message' => "Impossible de mettre à jour la quantité de ce devis", 'code' => 1]);
        }
    }

    /**
     * @param Request $request
     * @param User $user
     * @return Response
     */
    public function sendDevis(Request $request, User $user){
        //dd($request->all(), $user);
        if(!session()->has('user')){
            return redirect()->route('identification.page')->with('warning', "Veillez vous connecter pour bénéficier pleinnement de nos fonctionnalités");
        }

        $validators = Validator::make($request->all(), [
            'lastname' => 'required|min:3|exists:users,lastname',
            'firstname' => 'required|min:3|exists:users,firstname',
            'email' => 'required|email:rfc,dns|exists:users,email',
            'company' => 'nullable|min:10|max:50',
            'content' => 'required|min:3'
        ]);
        $errors = $validators->errors();
        if($validators->fails()){
            return back()->withErrors($errors)->withInput();
        }

        /**
         * @var Order $order
         */
        $order = Order::create([
            'id' => (string) Str::uuid(),
            'user_id' => $user->id,
            'content' => $request->input('content')
        ]);

        if($order){
            $quoteIds = collect([]);
            foreach ($user->quotes as $quote){
                $quoteIds->push($quote->id);
            }
            $order->quotes()->attach($quoteIds);
            Mail::to("commerciale@planetdesign.ma")->send(new QuoteSend($order));
            $user->quotes()->delete();

            return back()->with('success', "Votre devis a été soumi avec succès");
        }
    }
}
