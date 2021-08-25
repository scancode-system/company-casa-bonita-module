<thead>
	<tr>
		@if($setting_pdf_image->show)
		<th class="border-bottom border-top border-dark border-left p-2">Img</th>
		@endif
		<th class="border-bottom border-top border-dark {{ (!$setting_pdf_image->show)?'border-left':'' }} p-2">Ref</th>
		<th class="border-bottom border-top border-dark p-2">Descrição</th>
		@loader(['loader_path' => 'pdf.items.thead'])
		<th class="border-bottom border-top border-dark p-2 text-center">Prç Bru</th>
		@if($setting_pdf_discount->show)
		<th class="border-bottom border-top border-dark p-2 text-center">Desc</th>
		@endif
		@if($setting_pdf_addition->show)
		<th class="border-bottom border-top border-dark p-2 text-center">Acres</th>
		@endif
		@if($setting_pdf_taxes->show)
		<th class="border-bottom border-top border-dark p-2 text-center">Impostos</th>
		@endif
		<th class="border-bottom border-top border-dark p-2 text-center">Prç Liq</th>
		<th class="border-bottom border-top border-dark p-2 text-center">Quant</th>
		<th class="border-bottom border-top border-dark border-right p-2 text-center">Total</th>
	</tr>
</thead>  