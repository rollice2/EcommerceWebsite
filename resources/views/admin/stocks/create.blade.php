@extends('admin.include.layout')

@section('main')
    <div class="wrapper">
        <main class="page-content">
            <div class="card-header py-3">
                <h6 class="mb-0">Thêm nhập kho</h6>
            </div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="col-12 col-lg-8 mx-auto d-flex">
                    <div class="card border shadow-none w-100">
                        <div class="card-body">
                            <form class="row g-3" method="POST" action="{{ route('stocks.store') }}"
                                enctype="multipart/form-data">
                                {{-- {{ csrf_field() }} --}}
                                @csrf
                                <div class="col-12">
                                    <label class="form-label">Tên sản phẩm</label>
                                    <select name="product_id" class="form-select">
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                    <span style="color:red;">@error('product_id'){{ $message }} @enderror</span>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Nhân viên nhập kho</label>
                                    <select name="employee_id" class="form-select">
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                        @endforeach
                                    </select>
                                    <span style="color:red;">@error('employee_id'){{ $message }} @enderror</span>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Nhà cung cấp</label>
                                    <select name="supplier_id" class="form-select">
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                        @endforeach
                                    </select>
                                    <span style="color:red;">@error('supplier_id'){{ $message }} @enderror</span>

                                </div>
                                <div class="col-12">
                                    <label class="form-label">Giá nhập</label>
                                    <input type="text" name="cost_price" class="form-control" placeholder="Số lượng"
                                        value="{{ old('phone') }}">
                                    <span style="color:red;">@error('phone'){{ $message }} @enderror</span>
                                    <br>
                                    <br>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary">Thêm mới</button>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="d-grid">
                                            <a href="{{ route('suppliers.index') }}" class="btn btn-danger">Trở
                                                về</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
