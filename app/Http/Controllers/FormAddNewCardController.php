<?php

namespace App\Http\Controllers;

use App\Models\FormAddNewCard;
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;
use Illuminate\View\View;


class FormAddNewCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(): View
    {
                 return view('formAdd', [
            'form_add_new_cards' => FormAddNewCard::with('user')->latest()->get(),
        ]);

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
     * 
     */
    public function store(Request $request): RedirectResponse
    {
                $validated = $request->validate([
            'description' => 'required|string|max:255',
        ]);
 
        $request->user()->form_add_new_cards()->create($validated);
 
        return redirect(route('dashboard'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FormAddNewCard  $formAddNewCard
     * @return \Illuminate\Http\Response
     */
    public function show(FormAddNewCard $formAddNewCard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FormAddNewCard  $formAddNewCard
     * @return \Illuminate\Http\Response
     */
    public function edit(FormAddNewCard $formAddNewCard): View
    {
        $this->authorize('update', $formAddNewCard);
 
        return view('formEdit', [
            'form_add_new_cards' => $formAddNewCard,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FormAddNewCard  $formAddNewCard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FormAddNewCard $formAddNewCard): RedirectResponse
    {
                $this->authorize('update', $formAddNewCard);
 
        $validated = $request->validate([
            'description' => 'required|string|max:255',
        ]);
 
        $formAddNewCard->update($validated);
 
        return redirect(route('dashboard'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FormAddNewCard  $formAddNewCard
     * @return \Illuminate\Http\Response
     */
    public function destroy(FormAddNewCard $formAddNewCard): RedirectResponse
    {
        $this->authorize('delete', $formAddNewCard);
 
        $formAddNewCard->delete();
 
        return redirect(route('dashboard'));
    }
}