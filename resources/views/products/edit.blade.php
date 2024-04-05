<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Crud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="bg-dark py-3">
        <h3 class="text-white text-center">CRUD</h3>
    </div>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('products.show') }}" class="btn btn-dark">Back</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card order-0 shadow-lg my-4">
                    <div class="card-header bg-dark">
                        <h3 class="text-white text-center">Edit Product</h3>
                    </div>
                    <form enctype="multipart/form-data" action="{{ route('products.update', $product->id) }}"
                        method="post">
                        @method('put')
                        @csrf
                        <div class="card-body">

                            <div class="mb-3">
                                <label for="" class="form-label h5">Name</label>
                                <input value="{{ old('name', $product->name) }}" type="text"
                                    class="@error('name') is-invalid

                                @enderror form-control-lg form-control"
                                    placeholder="Name" name="name">
                                @error('name')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label h5">Code</label>
                                <input value="{{ old('code', $product->code) }}" type="text"
                                    class="@error('code') is-invalid
                                @enderror form-control form-control-lg"
                                    placeholder="Code" name="code">
                                @error('code')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label h5">Price</label>
                                <input value="{{ old('price', $product->price) }}" type="text"
                                    class="@error('price') is-invalid

                                @enderror form-control form-control-lg"
                                    placeholder="Price" name="price">
                                @error('price')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label h5">Description</label>
                                <textarea class="form-control" placeholder="Description" name="description"
                                    value="{{ old('description', $product->description) }}"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label h5">Image</label>
                                <input type="file" class="form-control form-control-lg" name="image">
                                @if ($product->image != '')
                                    <img class="w-50 my-3" src="{{ asset('uploads/products/' . $product->image) }}"
                                        alt="">
                                @endif

                            </div>

                            <div class="d-grid">
                                <button class="btn-btn-lg btn btn-primary">Update</button>
                            </div>

                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>


</body>

</html>
