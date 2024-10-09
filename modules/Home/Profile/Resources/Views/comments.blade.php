@extends('home.layouts.profile.master')

@php
    $active = 'comments';
@endphp

@section('profile_title', 'نظرات')

@section('profile_content')
    <div class="info-box p-4 m-4 w-100 row rounded" style="background-color: rgba(35,41,48,.1)">
        @if($user->comments->isEmpty())
            شما هیچ نظری ثبت نکرده اید.
        @endif
        @foreach($user->comments as $comment)
            <div class="menu-item w-100">
                <h5>
                    <a data-toggle="tooltip" title="{{ $comment->text }}" href="{{ route('home.foods.show', ['food' => $comment->food->slug]) }}">{{ $comment->food->title . '*' }}</a>
                    <span class="dots"></span>
                    <span class="price px-1">
                    <span class="number badge badge-info">{{ $comment->status }}</span>
                </span>
                </h5>
                <ul>
                    <li>
                        {{ $comment->created_at->diffForHumans() }}
                    </li>
                </ul>
            </div>
        @endforeach
    </div>
@endsection
