<table class="w-100 mb-3">
	<tr>
		<th class="border-top border-bottom border-left border-dark p-1">Produto</th>
		<th class="border-top border-bottom border-left border-dark p-1">Descrição</th>
		<th class="border-top border-bottom border-left border-dark p-1">Qtd</th>
		<th class="border-top border-bottom border-left border-dark p-1">Preço</th>
		<th class="border-top border-bottom border-left border-right border-dark p-1">Total</th>
	</tr>
	@foreach($order->items as $item)
	<tr>
		<td class="border-bottom border-left border-dark p-1">{{ $item->item_product->sku }}</td>
		<td class="border-bottom border-left border-dark p-1">{{ $item->item_product->description }}</td>
		<td class="border-bottom border-left border-dark p-1">{{ $item->qty }}</td>
		<td class="border-bottom border-left border-dark p-1">@currency($item->price)</td>
		<td class="border-bottom border-left border-dark border-right p-1">@currency($item->total)</td>
	</tr>
	@endforeach
</table>
<!--
<table class="w-100 mb-3">
	@include('pdf::pdf.tables.thead')
	<tbody>
		@foreach($order->items as $item)
		<tr>
			@if($setting_pdf_image->show)
			<td class="border-bottom border-left border-dark p-2">
				<img src="{{ url($item->item_product->image) }}" class="width-75">
			</td>
			@endif
			<td class="border-bottom border-dark {{ (!$setting_pdf_image->show)?'border-left':'' }} p-2">{{ $item->item_product->sku }}</td>
			<td class="border-bottom border-dark p-2">
				{{ $item->item_product->description }}
				<small class="text-info">{{ $item->observation }}</small>
			</td>
			@loader(['loader_path' => 'pdf.items.tr'])
			<td class="border-bottom border-dark text-center p-2">@currency($item->price)</td>
			@if($setting_pdf_discount->show)
			<td class="border-bottom border-dark text-center p-2">
				@currency($item->discount_value)<br>
				<small>(@percentage($item->discount))</small>
			</td>
			@endif
			@if($setting_pdf_addition->show)
			<td class="border-bottom border-dark text-center p-2">
				@currency($item->addition_value)<br>
				<small>(@percentage($item->addition))</small>
			</td>
			@endif
			@if($setting_pdf_taxes->show)
			<td class="border-bottom border-dark text-center p-2">
				@foreach($item->taxes as $tax)
				@currency($tax->value)<br>
				<small>{{ $tax->name }} - @percentage($tax->porcentage)</small>
				@endforeach
			</td>
			@endif
			<td class="border-bottom border-dark text-center p-2">@currency($item->price_net)</td>
			<td class="border-bottom border-dark text-center p-2">{{ $item->qty }}</td>
			<td class="border-bottom border-right border-dark text-center p-2">@currency($item->total)
			</td>
		</tr> 
		@endforeach
	</tbody>
</table>  -->