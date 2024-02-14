<?php


namespace App\Http\Controllers;

use App\Models\BookReservation;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\controller\books;
use App\Models\Book;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = Reservation::all();
        return view('reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Implement logic to fetch necessary data (e.g., users, books) and return the create view
        return view('reservations.create');
    }



     public function store(Request $request)
     {
         $request->validate([
             'qte' => 'required|integer|min:1',
             'book_id' => 'required|exists:books,id',
             'date_rec' => 'required|date|after:now',
         ]);

         // Get the authenticated user's ID
         $userId = Auth::id();
         
         $book = Book::find($request->book_id);
         $wantedqte= $request->qte;
         $bookqte = $book->qte;
         if($wantedqte > $bookqte)
         {
            return redirect()->route('notifications')
                ->with('error', 'Not enough books in stock');
         }




         // Create the reservation
         $reservation = [
             'qte' => $request->qte,
             'user_id' => $userId,
             'date_rec' => $request->date_rec
         ];
         $reservation = Reservation::create($reservation);

         // Retrieve the ID of the last inserted reservation
         $reservationId = $reservation->id;

         // Create the book reservation
         $book_reservation = [
             'book_id' => $request->book_id,
             'reservation_id' => $reservationId,
         ];
         $bookReservation = BookReservation::create($book_reservation);

         return redirect()->route('notifications')
             ->with('success', 'Reservation created successfully.');
     }


    
    public function show($id)
    {
        $reservation = Reservation::all()->where(Auth::user()->id);
        return view('reservations.show', compact('reservation'));
    }

   
    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('reservations.edit', compact('reservation'));
    }
    public function notifications()
    {
        $userId = Auth::id();

// Retrieve reservations associated with the authenticated user
$reservations = Reservation::with('books')->where('user_id', $userId)->get();



        return view('notifications', compact('reservations'));

    }
   
    public function destroy($id)
    {
       
        Reservation::destroy($id);
        session()->flash('status', 'emprunte avec succes');
        return redirect()->route('notifications');
    }

}
