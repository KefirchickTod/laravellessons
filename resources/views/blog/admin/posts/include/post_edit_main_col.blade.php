@php /** @var $item \App\Models\BlogCategory */ @endphp
@php /** @var $categoryList  */ @endphp
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card" style="padding: 20px">
            <div class="card-title"></div>
            <ul class="nav " id="myTab">
                <li class="nav-item">
                    <a class="nav-link" id="main-tab" data-togle="tab" href="#maindata" role="tab" aria-controls="home"
                       aria-selected="true">Main data
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" id="dop-data" data-togle="tab" href="#dop-data" role="tab"
                       aria-controls="dop" aria-selected="false">Dop data
                    </a>
                </li>
            </ul>
            <br>
            <div class="tab" id="myTabContent">
                <div class="tab-pane fade show active " id="maindata" role="tabpanel" aria-labelledby="main-tab">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control" required
                               value="{{$item->title}}">
                    </div>
                    <div class="form-group">
                        <label for="content_raw">Description</label>
                        <textarea class="form-control" name="content_raw"
                                  id="content_raw">{{old('content_raw', $item->content_raw)}}</textarea>
                    </div>
                </div>
                <div class="tab-pane fade show active" id="dop-data" role="tabpanel" aria-labelledby="dop-data">
                    <div class="form-group">
                        <label for="slug">Identification</label>
                        <input type="text" name="slug" id="slug" class="form-control" value="{{$item->slug}}">
                    </div>
                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select class="form-control" name="category_id" id="category_id">
                            @foreach($categoryList as $category)
                                @php /** @var $category \App\Models\BlogCategory */ @endphp
                                <option value="{{$category->id}}"
                                        @if($category->id === $item->category_id) selected @endif>{{$category->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="excerpt">Excerpt</label>
                        <textarea class="form-control" name="excerpt"
                                  id="excerpt">{{old('excerpt', $item->excerpt)}}</textarea>
                    </div>
                    <div class="form-check">

                        <input type="hidden" value="0" name="is_published">
                        <input type="checkbox" name="is_published"
                               value="1"
                               @if($item->is_published)
                               checked="checked"
                               @endif
                               class="form-check-input"
                               id="is_published">
                        <label class="form-check-input" for="is_published">Is published</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
