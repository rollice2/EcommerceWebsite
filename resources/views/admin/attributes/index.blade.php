@extends('admin.include.layout')
@section('main')
    <div class="wrapper">
        <main class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">eCommerce</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class=""><a href="javascript:;"><i class="fas fa-home"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Thuộc Tính</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <a href="{{ route('attributes.create') }}" class="btn btn-primary">Thêm thuộc tính</a>
                    </div>
                </div>
            </div>
            <!--end breadcrumb-->
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-12 d-flex">
                            <div class="card border shadow-none w-100">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="dataTable" class="table ">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Tên</th>
                                                    <th>Slug</th>
                                                    <th>Thuộc danh mục</th>
                                                    <th>Ngày tạo</th>
                                                    <th>Ngày cập nhật</th>
                                                    <th>Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($attributes as $attribute)
                                                    <tr>
                                                        <td>{{ $attribute->id }}</td>
                                                        <td>{{ $attribute->name }}</td>
                                                        <td>{{ $attribute->slug }}</td>
                                                        @if ($attribute->category)
                                                            <td>{{ $attribute->category->name }}</td>
                                                        @else
                                                            <td></td>
                                                        @endif
                                                        <td>{{ date('d-m-Y', strtotime($attribute->created_at)) }}</td>
                                                        <td>
                                                            @if ($attribute->updated_at != '')
                                                                {{ date('d-m-Y', strtotime($attribute->updated_at)) }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center gap-3 fs-6">
                                                                <a href="javascript:;" class="text-primary"
                                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                    title="" data-bs-original-title="View detail"
                                                                    aria-label="Views"><i class="bi bi-eye-fill"></i></a>
                                                                <a href="{{ route('attributes.edit', $attribute->id) }}"
                                                                    class="text-warning" data-bs-toggle="tooltip"
                                                                    data-bs-placement="bottom" title=""
                                                                    data-bs-original-title="Edit info" aria-label="Edit"><i
                                                                        class="bi bi-pencil-fill"></i></a>
                                                                <form
                                                                    action="{{ route('attributes.destroy', [$attribute->id]) }}"
                                                                    method="POST">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <a href="#"
                                                                        onclick="deleteAttributes({{ $attribute->id }})"
                                                                        class="text-danger" data-bs-toggle="modal"
                                                                        data-bs-target="#deleteAttributes"> <i
                                                                            class="bi bi-trash-fill"></i></a>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    {{-- Test Modal Delete --}}
                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteAttributes" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Bạn có muốn xóa không
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Hành động này sẽ không thể thu hồi !
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Hủy</button>
                                                    <form id="deleteForm" action="#" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">Xóa</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--  --}}
                                    <div class=" box-footer clearfix" style="float:right">
                                        {{-- {{ $attributes->links() }} --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
            </div>
        </main>
    </div>
@endsection
@section('scripts')
    <script>
        function deleteAttributes(id) {
            var url = '{{ route('attributes.index') }}' + '/' + id;
            $('#deleteForm').attr('action', url)
        }
    </script>
@endsection
