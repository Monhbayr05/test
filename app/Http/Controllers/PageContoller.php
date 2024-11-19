<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PageContoller extends Controller
{
    public function index(){

        $products = Product::all();
        return view('admin.index' , compact('products'));
    }
    public function create(){
        return view('admin.create');
    }
    public function store(Request $request){
        $validatedData = $request->validate([
           'name' => 'required',
           'price' => 'required',
           'description' => 'required',
            'slug' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4070',
        ]);

        if($request->hasFile('image')){
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('images'), $filename);

            $validatedData['image'] = 'images/'. $filename;
        } else {
            $validatedData['image'] = null;
        }


        Product::query()->create([
            'name' => $validatedData['name'],
            'price' => $validatedData['price'],
            'description' => $validatedData['description'],
            'slug' => $validatedData['slug'],
            'image' => $validatedData['image'],
        ]);

        return redirect()->route('index')
            ->with('success','Product created successfully');
    }

    public function edit($id){
        $product = Product::query()->find($id);
        return view('admin.edit', compact('product'));
    }

    public function update(Request $request, $id){

        $product = Product::query()->find($id);

        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'slug' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4070',
        ]);

        if($request->hasFile('image')){
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('images'), $filename);

            $validatedData['image'] = 'images/'. $filename;
        } else {
            $validatedData['image'] = null;
        }
        $product->update([
            'name' => $validatedData['name'],
            'price' => $validatedData['price'],
            'description' => $validatedData['description'],
            'slug' => $validatedData['slug'],
            'image' => $validatedData['image'],
        ]);
        return redirect()->route('index')->with('success', 'Product updated successfully');
    }

    public function image($id)
    {
        $product = Product::query()->findOrFail($id);
        return view('admin.image', compact('product'));
    }
    public function imageStore(Request $request, $id){
        $product = Product::query()->findOrFail($id);

        if($request->hasFile('image')){
            $uploadPath = 'uploads/products/images/';

            $i = 1;
            foreach ($request->file('image') as $imageFile) {
                $extension = $imageFile->getClientOriginalExtension();
                $filename = time() . $i++ . '.' . $extension;
                $imageFile->move($uploadPath, $filename);
                $finalImagePathName = $uploadPath . $filename;

                $product->productImages()->create([
                    'product_id' => $product->id,
                    'image' => $finalImagePathName,
                ]);
            }
        }
        return redirect()->route('index')->with('success', 'Product updated successfully');
    }
    public function imageDestroy($id)
    {
        $image = ProductImage::query()->findOrFail($id);

        if (File::exists($image->image)) {
            File::delete($image->image);
        }

        $image->delete();

        return redirect()->back()->with('delete', 'Зураг амжилттай устлаа.');
    }

    public function destroy($id){
        $products = Product::query()->find($id);
        if(File::exists($products->image)){
            File::delete($products->image);
        }
        $products->delete();


        return redirect()->route('index')->with('messsage','Product Deleted Successfully');
    }
}
