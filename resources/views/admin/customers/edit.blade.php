@extends('admin.include.layout')
@section('main')
    <div class="wrapper">
        <main class="page-content">
            <div class="card-header py-3">
                <h6 class="mb-0">Chỉnh Sửa Thuộc Tính </h6>
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
                            <form method="POST" class="row g-3"
                                action="{{ route('customers.update', $customers->id) }}">
                                @method('PUT')
                                @csrf
                                <div class="col-12">
                                    <label class="form-label">Tên</label>
                                    <input type="text" class="form-control" placeholder="Tên danh mục" name="name"
                                        value="{{ $customers->name }}">
                                    <span style="color:red;">@error('name'){{ $message }} @enderror</span>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Slug</label>
                                    <input type="text" class="form-control" placeholder="Slug name" name="slug"
                                        value="{{ $customers->slug }}">
                                    <span style="color:red;">@error('slug'){{ $message }} @enderror</span>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Số điện thoại</label>
                                    <input value="{{ $customers->phone }}" type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                                       
                                    <span style="color:red;">@error('Phone'){{ $message }} @enderror</span>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Điểm Thưởng</label>
                                    <input value="{{ $customers->bonus_points }}" type="text" name="bonus_points" class="form-control" value="{{ old('phone') }}">
                                       
                                    <span style="color:red;">@error('bonus_points'){{ $message }} @enderror</span>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Địa chỉ</label>
                                    <input value="{{ $customers->address }}" type="text" name="address" class="form-control" value="{{ old('phone') }}">
                                       
                                    <span style="color:red;">@error('address'){{ $message }} @enderror</span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Thuộc người dùng</label>
                                    <select name="user_id" value="{{$customers->user->name}}"  class="form-select" id="inputGroupSelect02">
                      
                      @foreach($users as $user)
                     <option {{$user->id==$customers->user_id ?'selected' :''}} value="{{$user->id}}">{{$user->name}}</option>
                      @endforeach
              
                                         </select>
                                </div>
                                <div class="col-3">
                                    <div class="d-grid">
                                        <button class="btn btn-primary">Cập nhật</button>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="d-grid">
                                        <a href="{{ route('customers.index') }}" class="btn btn-danger">Trở về </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endsection
