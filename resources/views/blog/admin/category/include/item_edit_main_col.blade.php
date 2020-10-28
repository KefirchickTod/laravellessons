@php /** @var $item \App\Models\BlogCategory */ @endphp
@php /** @var $categoryList  */ @endphp
<div class="row justify-content-center">
    <div class="col-md-12" >
        <div class="card" style="padding: 20px">
            <div class="card-title"></div>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-togle = "tab" href="#maindata" role = "tab">Main data
                    </a>
                </li>
            </ul>
            <br>
            <div class="tab-content">
                <div class="tab-pane active" id="maindata" role="tabpanel">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control" required value="{{$item->title}}">
                    </div>
                    <div class="form-group">
                        <label for="slug">Identification</label>
                        <input type="text" name="slug" id="slug" class="form-control" required value="{{$item->slug}}">
                    </div>
                    <div class="form-group">
                        <label for="parent_id">Parent</label>
                        <select class="form-control" name="parent_id" id="parent_id">
                            @foreach($categoryList as $category)
                                @php /** @var $category \App\Models\BlogCategory */ @endphp
                                <option value="{{$category->id}}" @if($category->id === $item->parent_id) selected @endif>{{$category->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description">{{$item->description}}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
