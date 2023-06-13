<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::where("user_id", auth()->id())->orderByDesc('id')->paginate(3);
        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Contact create';
        $route = route('contacts.store');
        $button = 'Register';
        return view('contacts.create', compact('title', 'route', 'button'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:100',
            'phone' => 'required|min:8|max:12',
            'image' => 'image|mimes:jpeg,jpg,png,gif,svg,webp'
        ]);
        $path = "public/contacts/no_image.png";
        if ($request->hasFile('image'))
            $path = $request->image->store('public/contacts');
        $contact = Contact::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'path' => $path,
        ]);
        $contact->save();
        return redirect()->route('contacts.index')->with('success', 'Stored with success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        $title = 'Contact edit';
        $route = route('contacts.update', ['contact' => $contact]);
        $button = 'Update';
        return view('contacts.edit', compact('title', 'route', 'button', 'contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'name' => 'required|min:2|max:100',
            'phone' => 'required|min:8|max:12',
            'image' => 'image|mimes:jpeg,jpg,png,gif,svg,webp'
        ]);
        $path = $contact->path;
        if ($request->hasFile('image')) {
            $contact->deleteImage();
            $path = $request->image->store('public/contacts');
        }
        $contact->fill([
            'name' => $request->name,
            'phone' => $request->phone,
            'path' => $path,
        ]);
        $contact->save();
        return redirect()->route('contacts.index')->with('success', 'Edited with success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        $contact->deleteImage();
        return redirect()->route('contacts.index')->with('success', 'Deleted with success');
    }
}
