@extends('backend.layouts.main')
@include('backend.layouts.contact_show_modal')
@yield('contact_show_modal')
@section('page_content')
<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
		<div class="x_title">
			<h2>回饋表單<small>Feedback Form</small></h2>
			<div class="clearfix"></div>
		</div>
		<div class="x_content">
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>公司名稱</th>
							<th>聯絡人</th>
							<th>電話</th>
							<th>地址</th>
							<th>狀態</th>
							<th>發送時間</th>
						</tr>
					</thead>
					<tbody class="contact_list">

					</tbody>
				</table>
			</div>
			<div>
    			<div class="dataTables_paginate paging_simple_numbers">
		    		<ul class="pagination"></ul>
		    	</div>
		    </div>
		    <div>
				<div class="list_total" role="status" aria-live="polite"></div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('script')
<script type="text/javascript">
	var data = {};
	contact_list(data);
	function contact_list(data){
		$.get('{{ asset('admin/contact') }}',data,function(res){
			var contact_data = '';
			var sequence = 1;
			$.each(res.data,function(k,v){
				var company = v.company||'';
				var contact_person = v.contact_person||'';
				var phone = v.phone||'';
				var address = v.address||'';
				contact_data += '<tr>';
				contact_data += 	'<th scope="row">'+sequence+'</th>';
				contact_data += 	'<td>'+company+'</td>';
				contact_data += 	'<td>'+contact_person+'</td>';
				contact_data += 	'<td>'+phone+'</td>';
				contact_data += 	'<td>'+address+'</td>';
				if(v.status){
					status = '<span class="badge badge-success">已聯絡</span>'
				}else{
					status = '<span class="badge badge-danger">未聯絡</span>'
				}
				contact_data += 	'<td class="status">'+status+'</td>';
				contact_data += 	'<td>'+date_format(v.created_at)+'</td>';
				contact_data += 	'<td>';
				contact_data +=			'<button type="button" class="btn btn-secondary show" data-toggle="modal" data-target="#modal-show" data-id="'+v.id+'">查看詳情</button>';
				contact_data +=			'<button type="button" class="btn btn-info edit" data-id="'+v.id+'">變更狀態</button>';
				contact_data += 	'</td>';
				contact_data += '</tr>';
				sequence++;
			});
			$('.contact_list').html(contact_data);
			page(res);
			paginate();
			contact_show();
			contact_edit();
		});
	}

	function paginate(){
		$('.paginate_button').click(function(){
			var datapage = $(this).data('id');
			var data = {};
			data.page = datapage;
			contact_list(data);
		});
	}

	function contact_edit(){
		$('.edit').click(function(){
			var contact_id = $(this).data('id');
			var status = 1;
			if($(this).parent().siblings('.status').text() == '已聯絡'){
				status = 0;
			}
			var data = {id : contact_id, status : status, _method : 'PUT', _token : '{{ csrf_token() }}'};
			$.ajax({
				type:"POST",
				url:'{{ asset("admin/contact")}}/'+contact_id,
				dataType:'json',
				data:data,
				success: function (e) {
					Swal.fire(
						e.message,
						'已修改狀態。',
						e.status
					);
					var data = {};
					contact_list(data);
				}
			})
		})
	}
</script>
@endpush