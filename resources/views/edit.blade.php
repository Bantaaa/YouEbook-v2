@extends('includes/layout')
@section('content')


<div class="flex justify-center items-center h-screen">
    <div class="bg-white shadow-lg rounded-lg p-6">
        <div class="container mt-5">
            <form action="{{ route('books.update',["book" => $book->id]) }}" method="POST">
                @csrf
                @method("PUT")
                @include("includes.form")
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-3">Submit</button>
            </form>
        </div>
    </div>
</div>



@endsection
