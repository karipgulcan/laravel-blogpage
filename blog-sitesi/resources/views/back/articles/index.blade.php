@extends('back.layouts.master');
@section('title', 'Tüm Makaleler');
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
        <h6 class="m-0 font-weight-bold float-right text-primary">{{$articles->count()}} Makale bulundu.
            <a href="{{route('admin.trashed.article')}}" class="btn btn-warning btn-sm"><i class="fa fa-trash"></i> Silinen Makaleler</a>
        </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Fotoğraf</th>
                        <th>Makale Başlığı</th>
                        <th>Kategori</th>
                        <th>Hit</th>
                        <th>Oluşturulma Tarihi</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($articles as $article)
                    <tr>
                        <td>
                            <img src="{{$article->image}}" width="200">
                        </td>
                        <td>{{$article->title}}</td>
                        <td>{{$article->getCategory->name}}</td>
                        <td>{{$article->hit}}</td>
                        <td>{{$article->created_at->diffForHumans()}}</td>
                        <td>
                            <input class="switch" article-id="{{$article->id}}" type="checkbox" data-on="Aktif"
                                data-off="Pasif" data-onstyle="success" data-offstyle="danger" @if($article->status==1)
                            checked @endif data-toggle="toggle">
                        </td>
                        <td>
                            <a href="" title="Görüntüle" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                            <a href="{{route('admin.makaleler.edit',$article->id)}}" title="Düzenle"
                                class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>
                            <!-- <form method="post" action="{{route('admin.makaleler.destroy',$article->id)}}"> Bu şekildede kullanılıyor
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
                            </form>
                            -->
                            <a href="{{route('admin.delete.article',$article->id)}}" title="Sil"
                                class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('css')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
    $(function () {
        $('.switch').change(function () {
            id = $(this)[0].getAttribute('article-id');
            statu = $(this).prop('checked');
            //alert(statu); return;
            $.get("{{route('admin.switch')}}", {
                id: id,
                statu: statu
            }, function (data, status) {
                //console.log(data); 
            });
        })
    })

</script>
@endsection
