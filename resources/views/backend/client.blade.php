@extends('backend.layouts.main')
@include('backend.layouts.client_create_modal')
@include('backend.layouts.client_edit_modal')
@yield('client_create_modal')
@yield('client_edit_modal')
@section('page_content')
<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
		<div class="x_title">
			<h2>客戶<small>Client</small></h2>
			<button class="btn btn-secondary ml-2 create" type="button" data-lang="zh" data-toggle="modal" data-target="#modal-create">新增客戶</button>
			<div class="clearfix"></div>
		</div>
		<div class="x_content">
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>圖片</th>
							<th>連結</th>
							<th>排序</th>
							<th>創建時間</th>
							<th>最後更新時間</th>
						</tr>
					</thead>
					<tbody class="client_list">

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
	client_list(data);
	function client_list(data){
		$.get('{{ asset('admin/client') }}',data,function(res){
			var client_data = '';
			var sequence = 1;
			$.each(res.data,function(k,v){
				var img = v.img||'';
				var link = v.link||'';
				client_data += '<tr>';
				client_data += 	'<th scope="row">'+sequence+'</th>';
				client_data += 	'<td><img class="img-fluid" src="/'+img+'"></td>';
				client_data += 	'<td>'+link+'</td>';
				client_data += 	'<td>'+v.sort+'</td>';
				client_data += 	'<td>'+date_format(v.created_at)+'</td>';
				client_data += 	'<td>'+date_format(v.updated_at)+'</td>';
				client_data += 	'<td>';
				client_data += '<button type="button" class="btn btn-success edit" data-toggle="modal" data-target="#modal-edit" data-id="'+v.id+'">修改</button>\
										<button type="button" class="btn btn-danger delete" data-id="'+v.id+'">刪除</button>';
				client_data += 	'</td>';
				client_data += '</tr>';
				sequence++;
			});
			$('.client_list').html(client_data);
			page(res);
			paginate();
			client_create();
			client_edit();
			client_delete();
		});
	}

	function paginate(){
		$('.paginate_button').click(function(){
			var datapage = $(this).data('id');
			var data = {};
			data.page = datapage;
			client_list(data);
		});
	}

	function client_delete(){
		$('.delete').click(function(){
			var delete_id = $(this).data('id');
			Swal.fire({
				title : '確定刪除此客戶嗎？',
				text : '刪除將無法恢復他！',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: '確定刪除！',
				cancelButtonText: '取消刪除！',
			}).then(function(res) {
				if(res.value){
					var data = {id : delete_id , _method : 'DELETE',_token : '{{ csrf_token() }}'};
					var url = '{{ asset("admin/client")}}/'+delete_id;
					$.ajax({
						type:"POST",
						url:url,
						dataType:'json',
						data:data,
						success: function (e) {
							Swal.fire(
								e.message,
								'已刪除客戶。',
								e.status
							);
							var data = {};
							client_list(data);
						}
					})
					return false;
				}
			})
		})
	}
</script>
@endpush