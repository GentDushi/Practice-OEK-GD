<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserDashboardController extends Controller
{
    // Create a product
    public function create(Request $request)
    {
        // Validate data
        $data = $request->validate([
            'name' => ['required'],
            'price' => ['required', 'integer'],
            'image' => ['required']
        ]);
        // Store image
        $data['image'] = $request->file('image')->store('images', 'public');
        // Create database entry
        Product::create([
            'name' => $data['name'],
            'price' => $data['price'],
            'image_path' => $data['image']
        ]);
        // Redirect to user-dashboard with success message
        return redirect()->route('user-dashboard')->with('message_create', 'Successfully created product');
    }

    // Update the product
    public function update(Request $request, Product $product)
    {
        // Validate the data
        $data = $request->validate([
            'name' => ['required'],
            'price' => ['required', 'integer'],
            'image' => ['nullable']
        ]);
        // Check if the request has an image
        // If there is an image, delete the old image and store the new image
        if ($request->file('image')) {  
            Storage::delete($product->image_path);
            $product->image_path = $request->file('image')->store('images', 'public');
            
        }

        $product->name = $data['name'];
        $product->price = $data['price'];

        $product->save();
        // Check if the product instance has been changed or not; if the user has changed anything before submitting
        if (!$product->wasChanged()) {
            // If the product has not been edited, inform the user
            return redirect()->route('user-dashboard')->with('message_edit', 'You have not edited the product');
        }

        return redirect()->route('user-dashboard')->with('message_edit', 'Successfully edited the product');
    }

    public function show_edit_form(Product $product)
    {
        // Return the product instance to the view
        return view('user-dashboard', [
            'product' => $product,
            'products' => Product::all(),
        ]);
    }

    public function delete(Product $product)
    {
        // Delete the product from the database
        $product->delete();
        if ($product) {
            // If successfully deleted, inform the user
            return redirect('user-dashboard')->with('message_delete', 'Successfully deleted product');
        } else {
            // If unsuccessful, inform the user
            return redirect('user-dashboard')->with('message_delete', 'Could not delete, something went wrong');
        }
    }

    public function show()
    {
        // Show all products
        return view('user-dashboard', [
            'products' => Product::all(),
        ]);
    }
}
