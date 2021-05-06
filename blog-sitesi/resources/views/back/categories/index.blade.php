@extends('back.layouts.master');
@section('title', 'Tüm Makaleler');
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Yeni Kategori Oluştur</h6>
            </div>
            <div class="card-body">
                <form method="put" action="{{route('admin.category.create')}}">
                    @csrf
                    <div class="form-group">
                        <label>Kategori Adı:</label>
                        <input type="text" class="form-control" name="category" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Ekle</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Kategori Adı</th>
                                <th>Makale Sayısı</th>
                                <th>Durum</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td>{{$category->name}}</td>
                                <td>{{$category->articleCount()}}</td>
                                <td>
                                    <input class="switch" category-id="{{$category->id}}" type="checkbox"
                                        data-on="Aktif" data-off="Pasif" data-onstyle="success" data-offstyle="danger"
                                        @if($category->status==1)
                                    checked @endif data-toggle="toggle">
                                </td>
                                <td>
                                    <a category-id="{{$category->id}}" class="edit-click btn btn-sm btn-primary"><i class="fa fa-edit text-white" title="Kategoriyi Düzenle"></i></a>
                                    <a category-id="{{$category->id}}" category-count="{{$category->articleCount()}}" category-name="{{$category->name}}" class="remove-click btn btn-sm btn-danger"><i class="fa fa-times text-white" title="Kategoriyi Sil"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="editModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Kategoriyi Düzenle</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="PUT" action="{{route('admin.category.update')}}">
                    @csrf
                    <div class="form-group">
                        <label>Kategori Adı</label>
                        <input type="text" class="form-control" id="category" name="category">
                        <input type="hidden" name="id" id="category_id">
                    </div>
                    <div class="form-group">
                        <label>Kategori Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Kaydet</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="deleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Kategoriyi Sil</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div id="body" class="modal-body">
                <div class="alert alert-danger" id="articleAlert"></div>
            </div>
            <div class="modal-footer">
                <form method="put" action="{{route('admin.category.delete')}}">
                    @csrf
                    <input type="hidden" name="id" id="deleteId">
                    <button id="deleteButton" type="submit" class="btn btn-success">Sil</button>
                </form>
            </div>
            </form>
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
        $('.remove-click').click(function () {
            id = $(this)[0].getAttribute('category-id');
            count = $(this)[0].getAttribute('category-count');
            name = $(this)[0].getAttribute('category-name');
            if(id==1){
                $('#articleAlert').html(name+' kategorisi sabit kategoridir. Kategorisi silinen makaleler bu kategoriye taşınacaktır.');
                $('#body').show();
                $('#deleteButton').hide();
                $('#deleteModal').modal();
                return;
            }
            $('#deleteButton').show();
            $('#deleteId').val(id);
            $('#articleAlert').html('');
            $('#body').hide();
            if (count > 0) {
                $('#articleAlert').html('Bu kategoriye ait ' + count +
                    ' makale bulunmaktadır. Yinede silmek istediğinizden emin misiniz?');
                $('#body').show();
            }
            $('#deleteModal').modal();
        });

        $('.edit-click').click(function () {
            //alert("basıldı"); //id ile alınca tüm hepsinin gelmiyor name e göre almak lazım
            id = $(this)[0].getAttribute('category-id');
            //console.log(id);
            $.ajax({
                type: 'GET',
                url: '{{route('admin.category.getdata')}}',
                data: {
                    id: id
                },
                success: function (data) {
                    //console.log(data);
                    $('#category').val(data.name);
                    $('#slug').val(data.slug);
                    $('#category_id').val(data.id);
                    $('#editModal').modal();
                }
            })
        });
        $('.switch').change(function () {
            id = $(this)[0].getAttribute('category-id');
            statu = $(this).prop('checked');
            //alert(statu); return;
            $.get("{{route('admin.category.switch')}}", {
                id: id,
                statu: statu
            }, function (data, status) {
                //console.log(data); 
            });
        })
    })

</script>
@endsection
