@extends('backend.layouts.main')
@include('backend.layouts.testing_equipment_create_modal')
@include('backend.layouts.testing_equipment_edit_modal')
@yield('testing_equipment_create_modal')
@yield('testing_equipment_edit_modal')
@section('page_content')
<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
		<div class="x_title">
			<h2>檢測設備<small>Testing Equipment</small></h2>
			<button class="btn btn-secondary ml-2 create" type="button" data-lang="zh" data-toggle="modal" data-target="#modal-create">新增檢測設備圖片</button>
			<div class="clearfix"></div>
		</div>
		<div class="x_content">
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>檢測設備圖片</th>
							<th>排序</th>
							<th>創建時間</th>
							<th>最後更新時間</th>
						</tr>
					</thead>
					<tbody class="testing_equipment_list">

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
	testing_equipment_list(data);
	function testing_equipment_list(data){
		$.get('{{ asset('admin/testing_equipment') }}',data,function(res){
			var testing_equipment_data = '';
			var sequence = 1;
			$.each(res.data,function(k,v){
				var img = v.img||'';
				testing_equipment_data += '<tr>';
				testing_equipment_data += 	'<th scope="row">'+sequence+'</th>';
				testing_equipment_data += 	'<td><img class="img-fluid" src="/'+img+'"></td>';
				testing_equipment_data += 	'<td>'+v.sort+'</td>';
				testing_equipment_data += 	'<td>'+date_format(v.created_at)+'</td>';
				testing_equipment_data += 	'<td>'+date_format(v.updated_at)+'</td>';
				testing_equipment_data += 	'<td>';
				testing_equipment_data += '<button type="button" class="btn btn-success edit" data-toggle="modal" data-target="#modal-edit" data-id="'+v.id+'">修改</button>\
										<button type="button" class="btn btn-danger delete" data-id="'+v.id+'">刪除</button>';
				testing_equipment_data += 	'</td>';
				testing_equipment_data += '</tr>';
				sequence++;
			});
			$('.testing_equipment_list').html(testing_equipment_data);
			page(res);
			paginate();
			testing_equipment_create();
			testing_equipment_edit();
			testing_equipment_delete();
		});
	}

	function paginate(){
		$('.paginate_button').click(function(){
			var datapage = $(this).data('id');
			var data = {};
			data.page = datapage;
			testing_equipment_list(data);
		});
	}

	function testing_equipment_delete(){
		$('.delete').click(function(){
			var delete_id = $(this).data('id');
			Swal.fire({
				title : '確定刪除此圖片嗎？',
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
					var url = '{{ asset("admin/testing_equipment")}}/'+delete_id;
					$.ajax({
						type:"POST",
						url:url,
						dataType:'json',
						data:data,
						success: function (e) {
							Swal.fire(
								e.message,
								'已刪除圖片。',
								e.status
							);
							var data = {};
							testing_equipment_list(data);
						}
					})
					return false;
				}
			})
		})
	}
</script>
@endpush