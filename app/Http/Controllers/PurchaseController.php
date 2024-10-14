<?php

namespace App\Http\Controllers;

use App\Mail\OrderMail;
use App\Models\Book;
use App\Models\Shopping;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PurchaseController extends Controller
{

    public function sendOrderConfirmationMail($user,$order) {
        Mail::to($user->email)->send(new OrderMail($user,$order));
    }
    public function crateOrder(Request $request) {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $token = $provider->getAccessToken();
        $books = auth()->user()->booksInCart;
        foreach($books as $book) {
            $total = $book->price * $book->pivot->number_of_copies;
        }
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" =>  route('paypal.successOrder'),
                "cancel_url" => route('paypal.cancelOrder')
            ],
            "purchase_units" => [
                [
                "amount" =>  [
                    "currency_code" =>"USD",
                    "value"=> $total
                ],
                'description' => "Pay Books $ $total"
            ]
            ]
        ]);

        if(isset($response["id"]) && $response["id"] !== null) {
        foreach ($response["links"] as $link) {
            if($link["rel"] === "approve" ) {
                return redirect()->away($link["href"]);
            }
        }
        } else {
            return redirect()->route("payment.cancel");
        }
    }
    public function successOrder(Request $request) {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $token = $provider->getAccessToken();
        $response = $provider->captureAuthorizedPayment($request['token']);

        if(isset($response['status']) && $response['status'] == 'COMPLETED') {
                $user = auth()->user();
                $books = $user->booksInCart;
                $this->sendOrderConfirmationMail($user,$books);
                foreach($books as $book) {
                    $bookPrice = $book->price;
                    $purchaseTime = now();
                    $mainBook = Book::findOrFail($book->pivot->book_id);
                    $mainBook->update(['number_of_copies' => ($mainBook->number_of_copies - $book->pivot->number_of_copies)]);
                    $user->updatePay($book->id,['bought' => true, 'price' => $bookPrice, 'created_at' => $purchaseTime]);
                }
                session()->flesh('The Pay success');
                return redirect()->name('view.cart');
        } else {
            return redirect()->name('payment.cancel');
        }
    }

    public function cancelOrder() {
        session()->flesh('some Thing Wrong Try Agin');
        return redirect()->name('view.cart');
    }

    public function creditCheckout() {
        $user = auth()->user();
        $intent = $user->createSetupIntent();
        $books = $user->booksInCart;
        $total = 0;
        foreach($books as $book) {
            $total += $book->price * $book->pivot->number_of_copies;
        }
        return view('credit.checkout',compact('total','intent','user'));
    }

    public function purchase(Request $request) {
        $user = auth()->user();
        $paymentMethod = $request->payment_method;
        $books = $user->booksInCart;
        $total = 0;
        foreach($books  as $book) {
            $total += $book->price * $book->pivot->number_of_copies;
        }
        try {
        $user->createOrGetStripeCustomer();
        $user->updateDefaultPaymentMethod($paymentMethod);
        $options = [ 'return_url' => route('view.cart')];
        $user->charge($total * 100 , $paymentMethod,$options);
        } catch(\Exception $exe) {
            dd($exe->getMessage());
        return redirect('/cart')->withErrors(['flash_message' => __('There Are Error')]);
        }
        foreach($books as $book) {
            $bookPrice = $book->price;
            $purchaseTime = now();
            $mainBook = Book::findOrFail($book->pivot->book_id);
            $mainBook->update(['number_of_copies' => ($mainBook->number_of_copies - $book->pivot->number_of_copies)]);
            $user->updatePay($book,['bought' => true, 'price' => $bookPrice, 'created_at' => $purchaseTime]);
        }
        $this->sendOrderConfirmationMail($user,$books);
        session()->flash("flash_message",__('The Pay success'));
        return redirect()->route('view.cart');
    }


    public function myProduct()  {
        $user = auth()->user();
        $books = $user->parchedProduct;
        return view('books.myProduct',compact('books'));
    }

    public function allProduct(Request $request)  {
        $books = Shopping::with(['user','book'])->where('bought', true)->paginate($request->limit);
        return view('admin.books.allProduct',compact('books'));
    }

    public function searchDate(Request $request) {
        $date = $request->date ?? now()->format('d-m-Y');
        $books = Shopping::where('created_at','>=', $date)->paginate($request->limit);
        return view('admin.books.allProduct',compact('books'));
    }

}
