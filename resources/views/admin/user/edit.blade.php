@extends('layouts.app')


@section('content')
    <h1>Cập nhật sản phẩm</h1>

    <form method="POST" action={{ route('products.update_product', ['id' => $product->id]) }} id="form-product">
        <div class="mb-3">
            <label for="name" class="form-label">Tên sản phẩm</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') ?? $product->name }}">
            <div class="invalid-feedback"></div>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Giá</label>
            <input type="text" name="price" class="form-control" id="price"
                value="{{ old('price') ?? $product->price }}">
            <div class="invalid-feedback"></div>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Ảnh</label>
            <input type="text" name="image" class="form-control" id="image"
                value="{{ old('image') ?? $product->image }}">
            <div class="invalid-feedback"></div>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea type="text" name="description" class="form-control" id="description">
                {{ old('description') ?? $product->description }}
            </textarea>
            <div class="invalid-feedback"></div>
        </div>

        @csrf
        <button type="submit" class="btn btn-success">Cập nhật</button>
    </form>
@endsection


@section('css')
@endsection

{{-- @section('script')
    <script>
        $(document).ready(function() {
            $('#form-product').submit(function(e) {
                e.preventDefault()
                const name = $('input[name="name"]').val()
                const price = $('input[name="price"]').val()
                const image = $('input[name="image"]').val()
                const description = $('textarea[name="description"]').val()
                const token = $(this).find('input[name="_token"]').val()

                $.ajax({
                    url: '/products',
                    type: 'POST',
                    data: {
                        name: name,
                        price: price,
                        image: image,
                        description: description,
                        _token: token
                    },
                    dataType: 'json',
                    success: function(res) {
                        window.location.href = '/products'
                    },
                    error: function(error) {
                        const errors = error.responseJSON.errors

                        if (Object.entries(errors).length > 0) {
                            Object.entries(errors).forEach(([key, value], index) => {
                                const el = $(`label[for="${key}"]`).next(
                                    '.form-control')
                                el.addClass('is-invalid')
                                el.next('.invalid-feedback').text(value[0])
                            })
                        }
                    }
                })
            })
        })
    </script>
@endsection --}}
