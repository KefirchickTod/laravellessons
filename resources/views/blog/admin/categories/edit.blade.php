<?php
/** @var $item \App\Models\BlogCategory */
/** @var $categoryList */
?>
@extends('layouts.app')

@section('content')
    @if(!$item->exists)
        <form method="POST" action="{{route('blog.admin.categories.store')}}">
    @else
        <form method="POST" action="{{route('blog.admin.categories.update', $item->id)}}">
        @method('PATCH')
    @endif


        @csrf
        <div class="container">
            @php
                /** @var $errors \Illuminate\Support\ViewErrorBag */
            @endphp
            @if($errors->any())
                <div class="row justify-content-center">
                    <div class="col-md-11">
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss = 'alert' aria-label="Close" >
                                <span aria-hidden="true">*</span>
                            </button>
                            {{$errors->first()}}
                        </div>
                    </div>
                </div>
            @endif
            @if(session('success'))
                <div class="row justify-content-center">
                    <div class="col-md-11">
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss = 'alert' aria-label="Close" >
                                <span aria-hidden="true">*</span>
                            </button>
                            {{session('success')}}
                        </div>
                    </div>
                </div>
            @endif

            <div class="row justify-content-center">
                <div class="col-md-8">
                    @include('blog.admin.categories.include.item_edit_main_col')
                </div>
                <div class="col-md-3">
                    @include('blog.admin.categories.include.item_edit_add_col')
                </div>
            </div>
        </div>
    </form>
@endsection
