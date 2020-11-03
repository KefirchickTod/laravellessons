<?php
/** @var $paginator \Illuminate\Pagination\LengthAwarePaginator */
?>
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
                    <a class="btn btn-primary" href="{{route('blog.admin.post.create')}}">Add new categories</a>
                </nav>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Is published</th>
                                <th>Author</th>
                                <th>Category </th>
                                <th>Created at</th>
                                <th>Published at</th>
                            </tr>

                            </thead>
                            <tbody>
                            @foreach($paginator as $item)
                                <tr
                                @if(!$item->published_at)
                                    style = "background: #8080805e"
                                @endif
                                >
                                    <td>{{$item->id}}</td>
                                    <td><a href="{{route('blog.admin.post.edit', $item->id)}}">{{$item->title}}</a></td>
                                    <td>{{$item->slug}}</td>
                                    <td>{{$item->is_published}}</td>
                                    <td>{{$item->user->name}}</td>
                                    <td>{{$item->category->title}}</td>
                                    <td>{{$item->careated_at}}</td>
                                    <td>{{($item->published_at ? $item->published_at->format('H:i') : '')}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{$paginator}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

