<table class="mb-3">
	<tr>
		<td>
			TOTAL: @currency($order->total)
		</td>
	</tr>
</table>
<table class="mb-5">
	<tr>
		<td>
			ESTOU DE ACORDO COM O PEDIDO:<br>
			CASO NECESSÁRIO RECEBEREI EM DUAS ENTREGAS.<br>
			**** OS PREÇOS ACIMA ESTÃO SUJEITOS A TRIBUTAÇÃO DE IPI ****
		</td>
	</tr>
</table>
<table class="mt-5 w-100 mb-5">
	<tr>
		<td class="border-bottom border-dark" style="width: 23%;">
			&nbsp;
		</td>
		<td style="width:3%">&nbsp;</td>
		<td class="border-bottom border-dark" style="width: 23%;">
			&nbsp;
		</td>
		<td style="width:%3">&nbsp;</td>
		<td class="border-bottom border-dark" style="width: 23%;">
			&nbsp;
		</td>
		<td style="width:3%">&nbsp;</td>
		<td class="border-bottom border-dark" style="width: 22%;">
			&nbsp;
		</td>
	</tr>
	<tr>
		<td>
			NOME COMPRADOR
		</td>
		<td style="width:10px">&nbsp;</td>
		<td>
			ASSINATURA
		</td>
		<td style="width:10px">&nbsp;</td>
		<td>
			TELEFONE
		</td>
		<td style="width:10px">&nbsp;</td>
		<td>
			E-MAIL
		</td>
	</tr>
</table>
<table class="w-50 mb-5">
	<tr>
		<td class="border-bottom border-dark">&nbsp;</td>
	</tr>
	<tr>
		<td>
			TRANSPORTADORA
		</td>
	</tr>
</table>
<table class="mb-3">
	<tr>
		<td>
			Pedidos mínimo R$1.500,00 - 30/60/90/120 ACIMA 6.000<br>
			Pagamento antecipado com 5% de DESCONTO.
		</td>
	</tr>
</table>
<table class="w-100">
	<tr>
		<td>Observações:</td>
	</tr>
	<tr>
		<td>
			<div class="w-100 border border-dark" style="min-height: 250px; border-radius:10px">
			{{ $order->observation }}
			</div>	
		</td>
	</tr>
</table>
<!--
<table class="w-100 mb-3">
	<tr>
		<td class="border border-dark height-75 width-130 text-center">
			Total bruto<br>
			@currency($order->total_gross)
		</td>
		<td class="text-center fs-30">-</td>
		<td class="border border-dark height-75 width-130 text-center">
			Desconto<br>
			@currency($order->discount_value)
		</td>
		<td class="text-center fs-30">+</td>
		<td class="border border-dark height-75 width-130 text-center">
			Acréscimo<br>
			@currency($order->addition_value)
		</td>
		<td class="text-center fs-30">+</td>
		<td class="border border-dark height-75 width-130 text-center">
			Impostos<br>
			@currency($order->tax_value)
		</td>
		<td class="text-center fs-30">=</td>
		<td class="border border-dark height-75 width-130 text-center">
			Total<br>
			@currency($order->total)
		</td>
	</tr>
</table>
<table class="w-100 mb-3">
	<tr>
		<td class="border border-dark p-2"> 
			<strong>OBSERVAÇÔES:</strong><br>
			<p class="p-0 mb-0">{!! nl2br($setting_pdf->global_observation) !!}</p>
			@if(!is_null($order->observation))
			<p class="mb-0 mt-3">{{ $order->observation }} </p>
			@endif
		</td>
	</tr>
</table>
<table class="w-100 mb-3">
	<tr>
		<td class="border border-dark p-2">
			<strong>TERMODE RESPONSABILIDADE:</strong><br>
			<p class="mb-0">{!! nl2br($setting_pdf->statement_responsibility) !!}</p>
		</td>
	</tr>
</table>
<p class="text-center fs-20 mb-0">São Paulo, {{ $order->closing_date ?? 'N/A' }}</p>
<p class="text-center fs-15">De acordo:</p>
<table class="w-50 m-auto">
	<tr>
		<td class="border-bottom border-dark height-75">
			@if($order->signature_check)
			<img src="data:image/png;base64, {{ $order->signature }}" width="100%"/>
			@endif
		</td>
	</tr>
</table>
-->