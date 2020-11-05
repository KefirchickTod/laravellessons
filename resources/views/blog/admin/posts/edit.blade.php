<?php
/** @var $item \App\Models\BlogPost */
/** @var $categoryList */
?>
@extends('layouts.app')

@section('content')
    @if(!$item->exists)
        <form method="POST" action="{{route('blog.admin.post.store')}}">
            @else
                <form method="POST" action="{{route('blog.admin.post.update', $item->id)}}">
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
                                        <button type="button" class="close" data-dismiss='alert' aria-label="Close">
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
                                        <button type="button" class="close" data-dismiss='alert' aria-label="Close">
                                            <span aria-hidden="true">*</span>
                                        </button>
                                        {{session('success')}}
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                @include('blog.admin.posts.include.post_edit_main_col')
                            </div>
                            <div class="col-md-3">
                                @include('blog.admin.posts.include.post_edit_add_col')
                            </div>
                        </div>
                    </div>
                </form>
        </form>

        @if($item->exists)
            <br>
            <form method="post" action="{{route('blog.admin.post.destroy', $item->id)}}">

                @method("DELETE")
                @csrf
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card card-body">
                                <div class="card-body ml-auto">
                                    <button type="submit" class="btn btn-link">Delete</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
            </form>
        @endif
@endsection
