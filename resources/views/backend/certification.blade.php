@extends('backend.layouts.main')
@include('backend.layouts.certification_create_modal')
@include('backend.layouts.certification_edit_modal')
@yield('certification_create_modal')
@yield('certification_edit_modal')
@section('page_content')
<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
		<div class="x_title">
			<h2>認證列表<small>Certification List</small></h2>
			<button class="btn btn-secondary ml-2 create" type="button" data-toggle="modal" data-target="#modal-create">新增認證</button>
			<div class="clearfix"></div>
		</div>
		<div class="x_content">
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>認證圖片</th>
							<th>排序</th>
							<th>創建時間</th>
							<th>最後更新時間</th>
						</tr>
					</thead>
					<tbody class="certification_list">

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
	certification_list(data);
	function certification_list(data){
		$.get('{{ asset('admin/certification') }}',data,function(res){
			var certification_data = '';
			var sequence = 1;
			$.each(res.data,function(k,v){
				var img = v.img||'';
				certification_data += '<tr>';
				certification_data += 	'<th scope="row">'+sequence+'</th>';
				certification_data += 	'<td><img class="img-fluid" src="/'+img+'"></td>';
				certification_data += 	'<td>'+v.sort+'</td>';
				certification_data += 	'<td>'+date_format(v.created_at)+'</td>';
				certification_data += 	'<td>'+date_format(v.updated_at)+'</td>';
				certification_data += 	'<td>';
				certification_data += '<button type="button" class="btn btn-success edit" data-toggle="modal" data-target="#modal-edit" data-id="'+v.id+'">修改</button>\
										<button type="button" class="btn btn-danger delete" data-id="'+v.id+'">刪除</button>';
				certification_data += 	'</td>';
				certification_data += '</tr>';
				sequence++;
			});
			$('.certification_list').html(certification_data);
			page(res);
			paginate();
			certification_create();
			certification_edit();
			certification_delete();
		});
	}

	function paginate(){
		$('.paginate_button').click(function(){
			var datapage = $(this).data('id');
			var data = {};
			data.page = datapage;
			certification_list(data);
		});
	}

	function certification_delete(){
		$('.delete').click(function(){
			var delete_id = $(this).data('id');
			Swal.fire({
				title : '確定刪除此認證嗎？',
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
					var url = '{{ asset("admin/certification")}}/'+delete_id;
					$.ajax({
						type:"POST",
						url:url,
						dataType:'json',
						data:data,
						success: function (e) {
							Swal.fire(
								e.message,
								'已刪除認證。',
								e.status
							);
							var data = {};
							certification_list(data);
						}
					})
					return false;
				}
			})
		})
	}
</script>
@endpush