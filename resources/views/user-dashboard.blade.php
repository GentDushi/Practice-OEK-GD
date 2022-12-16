<x-primary-layout>
    {{-- Logout button --}}
    <form style="float:right" method="POST" action="/logout">
        @csrf
        <input type="submit" value="Logout" />
    </form>
    <h2>Welcome</h2>

    <h4>Product List</h4>
    {{-- Show product list table --}}
    <table>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
        @foreach ($products as $item)
            <tr>
                {{-- Show image, name, price, actions(delete, edit) --}}
                <td><img src="{{ asset('/storage/' . $item->image_path) }}" width="105" height="100"></td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->price }}</td>
                <td>
                    {{-- Button to show the edit form --}}
                    <form class="d-inline-block" method="POST" action="/product/show-edit-form/{{ $item->id }}">
                        @csrf
                        <input type="submit" value="Edit" />
                    </form>
                    {{-- Button to delete product --}}
                    <form class="d-inline-block" method="POST" action="/product/delete/{{ $item->id }}">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Delete" />
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{-- Where the messages for the delete action will be displayed; both errors and informative --}}
    @if (session()->has('message_delete'))
        {{ session()->get('message_delete') }}
    @endif

    {{-- if there is a product to edit, show the form. The 'product' variable is set when the button 'Edit' is pressed in the product list --}}
    @if (isset($product))
        <hr>
        <p><strong>Edit a product</strong></p>
        {{-- Form to edit a selected product --}}
        <form method="POST" action="/product/edit/{{ $product->id }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" value="{{ $product->name }}"><br>
            <label for="price">Price:</label><br>
            <input type="number" id="price" name="price" value="{{ $product->price }}"><br>
            <label for="image">Select an image:</label>
            <input type="file" id="image" name="image"><br><br>
            <input type="submit" value="Edit form" />
        </form>
    @endif
    {{-- Where the messages for the edit action will be displayed; both errors and informative --}}
    @if (session()->has('message_edit'))
        {{ session()->get('message_edit') }}
    @endif
    <hr>
    <p><strong>Create a product</strong></p>
    {{-- Form to create a product --}}
    <form method="POST" action="/product/create" enctype="multipart/form-data">
        @csrf
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name"><br>
        <label for="price">Price:</label><br>
        <input type="number" id="price" name="price"><br>
        <label for="image">Select an image:</label>
        <input type="file" id="image" name="image"><br><br>
        <input type="submit" value="Create Product" />
    </form>
    {{-- Where the messages for the create action will be displayed; both errors and informative --}}
    @if (session()->has('message_create'))
        {{ session()->get('message_create') }}
    @endif

</x-primary-layout>
