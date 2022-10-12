@extends('layout.app')

@section('title', 'Blog Posts')

@section('content')

<div class="row">
  <div class="col-8">
    @forelse($posts as  $key => $post)
      @include('posts.partials.post')
    @empty
    No blog posts yet!
    @endforelse
  </div>
  <div class="col-4">
    <div class="container">
      <div class="row">
        <x-card title="Most Commented">
          <x-slot name="subtitle">
            What people are currently talking about          
          </x-slot>
          <x-slot name="items">
            @foreach($mostCommented as $post)
              <li class="list-group-item">
                <a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a>
              </li>
            @endforeach    
          </x-slot>
        </x-card>
      </div>
      
      <div class="row mt-4">
        <x-card title="Most Active" :items="collect($mostActive)->pluck('name')">
          <x-slot name="subtitle">
            Users with most posts written
          </x-slot>
        </x-card>
      </div>

      <div class="row mt-4">
        <x-card title="Most Active Last Month" :items="collect($mostActiveLastMonth)->pluck('name')">
          <x-slot name="subtitle">
            Users with most posts written in the last month
          </x-slot>
        </x-card>
      </div>
    </div>

  </div>
</div>

@endsection
