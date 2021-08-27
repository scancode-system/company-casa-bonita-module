<table class="w-100 mb-3">
	<tr>
		<td class="text-center">
		{{ $company->company_info->fantasy_name ?? 'N/A' }} - {{ $setting_pdf->title }}
		</td>
	</tr>
	<tr>
		<td class="text-center">
		TELEFONE VENDAS: {{ $company->company_info->phone ?? 'N/A' }} E-MAIL: {{ $company->company_info->email ?? 'N/A' }}
		</td>
	</tr>
</table>
<table class="w-100 mb-3">
	<tr>
		<td>
		Pedido: {{ $order->id }} - {{ $order->closing_date ?? 'N/A' }}, feito por: {{ $order->order_saller->name }}
		</td>
	</tr>
	<tr>
		<td>
		Cliente: {{ $order->order_client->buyer ?? 'N/A' }} Razão Social: {{ $order->order_client->corporate_name ?? 'N/A' }} CPF/CNPJ: {{ $order->order_client->cpf_cnpj ?? 'N/A' }}
		</td>
	</tr>
</table>

<!--
<table class="w-100">
	<tr>
		<td>{{ $setting_pdf->title }}</td>
		<td class="text-right">Pedido: {{ $order->id }}</td>
	</tr>
</table>
<table class="w-100 mb-3">
	<tr>
		<td class="border border-dark align-top text-center">
			<p class="border-bottom border-dark p-1 mb-3 text-left">DADOS DA EMPRESA</p>
			<div class="text-center mb-3">
				<img src="{{ url($company->logo) }}" class="height-75">
			</div>
			<div>{{ $company->company_info->fantasy_name ?? 'N/A' }}</div>
			<div>{{ $company->company_info->email ?? 'N/A' }}</div>
			<div class="mb-3">{{ $company->company_info->phone ?? 'N/A' }}</div>
			<div class="mb-2">
				{{ $company->company_address->street ?? 'N/A' }}, 
				{{ $company->company_address->number ?? 'N/A' }} - 
				{{ $company->company_address->neighborhood ?? 'N/A' }}<br>
				{{ $company->company_address->city }}/{{ $company->company_address->st ?? 'N/A' }}<br>
				{{ $company->company_address->postcode ?? 'N/A' }}
			</div>
		</td>
		<td class="width-10"></td>
		<td class="border border-dark w-65 p-0 align-top pb-2">
			<p class="border-bottom border-dark p-1 mb-2 ">DADOS DO CLIENTE: {{ $order->order_client->client_id }}</p>
			<div class="px-2">
				<table class="w-100">
					<tr>
						<td class="w-50">
							<div>
								<strong>Razão Social:</strong><br>
								{{ $order->order_client->corporate_name ?? 'N/A' }}
							</div>
							<div>
								<strong>Nome Fantaisa:</strong><br>
								{{ $order->order_client->fantasy_name ?? 'N/A' }}
							</div>
							<div>
								<strong>CPF/CNPJ:</strong><br>
								{{ $order->order_client->cpf_cnpj ?? 'N/A' }}
							</div>
							<div>
								<strong>Comprador:</strong><br>
								{{ $order->order_client->buyer ?? 'N/A' }}
							</div>
							<div>
								<strong>Telefone:</strong><br>
								{{ $order->order_client->phone  ?? 'N/A' }}
							</div>
							<div>
								<strong>Email:</strong><br>
								{{ $order->order_client->email ?? 'N/A' }}
							</div>
						</td>
						<td class="w-50">
							<div>
								<strong>Rua:</strong><br>
								{{ $order->order_client->order_client_address->street ?? 'N/A' }}
							</div>
							<div>
								<strong>Número:</strong><br>
								{{ $order->order_client->order_client_address->number ?? 'N/A' }}
							</div>
							<div>
								<strong>Bairro:</strong><br>
								{{ $order->order_client->order_client_address->neighborhood ?? 'N/A' }}
							</div>
							<div>
								<strong>Cidade:</strong><br>
								{{ $order->order_client->order_client_address->city ?? 'N/A' }}
							</div>
							<div>
								<strong>Estado:</strong><br>
								{{ $order->order_client->order_client_address->st ?? 'N/A' }}
							</div>
							<div>
								<strong>CEP:</strong><br>
								{{ $order->order_client->order_client_address->postcode ?? 'N/A' }}
							</div>
						</td>
					</tr>
				</table>
			</div>
		</td>
	</tr>
</table>
<table class="w-100 mb-3">
	<tr>
		<td class="border border-dark">
			<p class="border-bottom border-dark p-1 mb-0" >Representante</p>
			<table class="w-100 m-2">
				<tr>
					<td><strong>Codigo: </strong>{{ $order->saller_id }}</td>
					<td><strong>Nome: </strong>{{ $order->order_saller->name }}</td>
					<td><strong>Email: </strong>{{ $order->order_saller->email }}</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<table class="w-100 mb-3">
	<tr>
		<td class="border border-dark">
			<p class="border-bottom border-dark p-1 mb-0" >Detalhes do Pedido</p>
			<table class="w-100 m-2">
				<tr>
					<td><strong>Pagamento: </strong>{{ $order->order_payment->description }}</td>
					<td><strong>Transportadora: </strong>{{ $order->order_shipping_company->description }}</td>
					<td><strong>Entrega: </strong>{{ $order->delivery_name }}</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

-->