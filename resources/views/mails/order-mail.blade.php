
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Books Store</title>
</head>
<body>
    <h2>{{__('Hollo').' '.$user->name}}</h2>
    <h2>{{__('We Get Your Order Seccussful')}}</h2>
    <table>
        <thead>
            <tr>
            <th>{{__("Title")}}</th>
            <th>{{__("Price")}}</th>
            <th>{{__("Number Of Copies")}}</th>
            <th>{{__("Total")}}</th>
        </tr>
        </thead>
        <tbody>
            @php($subTotal = 0)
            @foreach ($order as $product)
            <tr>
                <td>{{$product->title}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->pivot->number_of_copies}}</td>
                <td>{{$product->price * $product->pivot->number_of_copies}}</td>
                @php($subTotal += $product->price * $product->pivot->number_of_copies)
            </tr>
            @endforeach
            <tr class="mt-1">
                <td class="border border-t-2 border-slate-400 pt-2"></td>
                <td>{{__('Total').": ".$subTotal}}</td>

            </tr>
        </tbody>
    </table>
</body>
</html>
