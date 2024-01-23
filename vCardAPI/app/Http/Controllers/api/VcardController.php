<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Http\Resources\VcardResource;
use App\Models\Transaction;
use App\Models\Vcard;
use Illuminate\Http\Request;

class VcardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get all vcards
        $vcards = Vcard::all();
        return $vcards;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // create a new vcard
        $vcard = Vcard::create($request->all());
        return new VcardResource($vcard);
    }

    /**
     * Display the specified resource.
     */
    public function show(Vcard $vcard)
    {
        // return a single vcard
        return new VcardResource($vcard);
    }
    public function show_me(Request $request)
    {
        return new VcardResource($request->user());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vcard $vcard)
    {
        // update a vcard
        $vcard->fill($request->all());
        $vcard->save();
        return new VcardResource($vcard);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vcard $vcard)
    {
        // delete a vcard
        $vcard->forceDelete();
        return new VcardResource($vcard);
    }
    public function delete(Vcard $vcard)
    {
        // delete a vcard
        $vcard->delete();
        return new VcardResource($vcard);
    }

    /**
     * Get all transactions of a vCard
     */
    public function getTransactionsOfvCard(Vcard $vCard)
    {
        // Fetch the transactions associated with the vCard
        $transactions = $vCard->transactions;

        // Sort the transactions by created_at in descending order
        $sortedTransactions = $transactions->sortByDesc('created_at');

        // Return the transactions as a collection of resources
        return TransactionResource::collection($sortedTransactions);
    }

    /**
     * Get last 5 unread TYPE C transactions of a vcard
     */
    public function getUnreadTransactionsOVcard(Vcard $vCard)
    {
        $unreadTransactions = $vCard->transactions()
            ->whereJsonContains('custom_options->isRead', false)
            ->orderBy('created_at', 'desc')
            ->take(5);

        $latestTransactions = Transaction::where('pair_vcard', $vCard->vcard)
            ->whereJsonContains('custom_options->isRead', false)
            ->orderBy('created_at', 'desc')
            ->take(5);

        $transactions = $unreadTransactions->union($latestTransactions)
            ->orderBy('created_at', 'desc') // Add this line to ensure the combined result is ordered
            ->get();

        return $transactions;
    }
}
