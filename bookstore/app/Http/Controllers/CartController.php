<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request) {
    $book = Book::find($request->id);
    $user = auth()->user();
    if($user->pay($book)){
        $newQuantity = $request->quantity + $user->number_of_copies($book);
    if($newQuantity > $book->number_of_copies) {
        session()->flash('waing','عدد النساخ'.($book->number_of_copies  - $user->number_of_copies($book)));
        return redirect()->back();
    }else {
        $user->updatePay($book,['number_of_copies' => $newQuantity]);
    }
    }else {
    $user->addBook($book,['number_of_copies' => $request->quantity]);
    }
    return redirect()->back();
    }

    public function viewCart()  {
        $items = auth()->user()->booksInCart;
        return view('cart',compact('items'));
    }
    public function removeOne(Book $book)  {
        $oldQuantity = auth()->user()->number_of_copies($book);
        if( $oldQuantity > 1) {
            auth()->user()->updatePay($book,['number_of_copies' => --$oldQuantity]);
        } else {
            auth()->user()->removeBook($book);
        }
        return redirect()->back();
    }
    public function removeAll(Book $book)  {
        auth()->user()->removeBook($book);
        return redirect()->back();
    }
}
