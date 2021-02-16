@isset($categories)
<div class="col-md-3">
    <div class="card">
        <div class="card-header">
            Kategoriler
        </div>
        <div class="list-group">
            @foreach($categories as $category)
            <li class="list-group-item">
                <a href="{{route('category',$category->slug)}}">{{$category->name}}</a> <span class="badge bg-success float-right text-white">{{$category->articleCount()}}</span>
            </li>
            @endforeach
        </div>
    </div>
</div>
@endif