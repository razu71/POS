@if(isset($number) && isset($product))
    @for($i=0;$i<$number;$i++)
            <div class="print-barcoad" style="padding: 30px;border:1px solid #e5e5e5;margin-bottom:30px;">
                @if(isset($business))<p>{{allsetting()['title']}}</p>@endif
                @if(isset($name))<p>{{$product->title}}</p>@endif
                @if(isset($price))<p class="mb-15">Price:{{priceCalculation($product->price,$product->discount,$product->discount_type)}} {{allsetting()['currency']}}</p>@endif
                <h5>{!! DNS1D::getBarcodeHTML($product->sku, 'C128A') !!}</h5>
            </div>
        </div>
    @endfor

    {{Form::close()}}
@endif