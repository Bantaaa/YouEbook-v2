@extends('includes.layout')
@section('content')
<div class="container mx-auto my-5 flex justify-center">
    <div class="w-1/2 bg-white rounded-lg shadow-md">
        <img src="https://source.unsplash.com/random/800x800?sig=incrementingIdentifier"  alt="...">
        <div class="p-4">
            <h5 class="text-xl font-bold">{{ $book->title }}</h5>
            <p class="text-gray-700">Price : £{{ $book->prix }}</p>

            <form action="{{ route('reservation.store') }}" method="POST" class="mt-4">
                @csrf
                <div class="mb-4">
                    <input type="hidden" name="book_id" value="{{$book->id  }}" >
                    <label for="quantity" class="block mb-1 font-medium">Quantity:</label>
                    <input type="number" class="w-full py-2 px-3 border border-gray-300 rounded focus:outline-none focus:border-blue-500" id="quantity" name="qte" value="1" min="1">
                </div>
                <div class="mb-4">
                    <label for="date_recuperation" class="block mb-1 font-medium">Date de récupération:</label>
                    <input type="datetime-local" class="w-full py-2 px-3 border border-gray-300 rounded focus:outline-none focus:border-blue-500" id="date_recuperation" name="date_rec" required>
                </div>
                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" name="submit" type="submit">Réserver</button>
                <a href="{{ route('books.edit', ['book' => $book->id]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" name="submit" type="submit">Modifier le livre</a>
            </form>
        </div>
    </div>
</div>
@endsection
