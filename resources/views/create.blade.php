@extends('includes/layout')
@section('content')

<div class="flex justify-center items-center h-screen">
  <div class="max-w-lg rounded overflow-hidden shadow-lg">
    <div class="px-6 py-4">
      <form class="w-full" action="{{ route('books.store') }}" method="POST">
        @csrf
        @include("includes.form")
        <input type="hidden" name="user_id" value=1>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-3">Submit</button>
      </form>
    </div>
  </div>
</div>

@endsection
