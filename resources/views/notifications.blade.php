@extends('includes.layout')
@section('content')
<div class="container h-screen px-4 py-8">
  <h1 class="mt-5 mb-4 text-3xl font-bold text-blue-700">Reservations</h1>

  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
    @foreach ($reservations as $reservation)
    <div class="col-md-4 mb-4">
      <div class="bg-white shadow rounded-lg p-4">
        <h5 class="text-xl font-bold mb-2">Reservation ID: {{ $reservation->id }}</h5>
        <p class="text-gray-700">Quantity: {{ $reservation->quantite }}</p>
        <h6 class="text-lg font-semibold mb-3">Books:</h6>
        <ul class="list-none">
          @foreach ($reservation->books as $book)
          <li class="mb-1">{{ $book->title }}</li>
          @endforeach
        </ul>

        <form action="{{ route('reservation.destroy', ['reservation'=> $reservation->id]) }}" method="POST" class="mt-4">
          @csrf
          @method('DELETE')
          <button type="submit" name="submit" class="bg-green-500 hover:bg-green-600 text-white text-sm px-4 py-2 rounded">emprunter</button>
        </form>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection
