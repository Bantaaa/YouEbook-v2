<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookReservation;
use App\Models\Book;
use App\Models\Reservation;

class BookReservationController extends Controller
{
    
    public function index()
    {
        $bookReservations = BookReservation::all();
        return view('book_reservations.index', compact('bookReservations'));
    }

    
    public function create()
    {
        $books = Book::all();
        $reservations = Reservation::all();
        return view('book_reservations.create', compact('books', 'reservations'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'reservation_id' => 'required|exists:reservations,id',
        ]);

        BookReservation::create($request->all());

        return redirect()->route('book_reservations.index')
            ->with('success', 'Book reservation created successfully.');
    }

   
    public function show($id)
    {
        $bookReservation = BookReservation::findOrFail($id);
        return view('book_reservations.show', compact('bookReservation'));
    }

   
    public function edit($id)
    {
        $bookReservation = BookReservation::findOrFail($id);
        $books = Book::all();
        $reservations = Reservation::all();
        return view('book_reservations.edit', compact('bookReservation', 'books', 'reservations'));
    }

    
    public function update(Request $request, $id)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'reservation_id' => 'required|exists:reservations,id',
        ]);

        $bookReservation = BookReservation::findOrFail($id);
        $bookReservation->update($request->all());

        return redirect()->route('book_reservations.index')
            ->with('success', 'Book reservation updated successfully.');
    }

    
    public function destroy($id)
    {
        BookReservation::findOrFail($id)->delete();
        return redirect()->route('book_reservations.index')
            ->with('success', 'Book reservation deleted successfully.');
    }
}

