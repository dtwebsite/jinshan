@extends('backend.layouts.main')
@include('backend.layouts.process_create_modal')
@include('backend.layouts.process_edit_modal')
@yield('process_create_modal')
@yield('process_edit_modal')
@section('page_content')
<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
		<div class="x_title">
			<h2>製程列表<small>Process List</small></h2>
			<button class="btn btn-secondary ml-2 create" type="button" data-lang="zh" data-toggle="modal" data-target="#modal-create">新增製程</button>
			<small class="text-danger">*中英文版的製程圖片，需分開上傳</small>
			<div class="clearfix"></div>
		</div>
		<div class="x_content">
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>標題</th>
							<th>圖片</th>
							<th>狀態</th>
							<th>排序</th>
							<th>創建時間</th>
							<th>最後更新時間</th>
						</tr>
					</thead>
					<tbody class="process_list">

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
	process_list(data);
	function process_list(data){
		$.get('{{ asset('admin/process') }}',data,function(res){
			var process_data = '';
			var sequence = 1;
			$.each(res.data,function(k,v){
				var title = v.title||'';
				var img = v.img||'';
				process_data += '<tr>';
				process_data += 	'<th scope="row">'+sequence+'</th>';
				process_data += 	'<td>'+title+'</td>';
				process_data += 	'<td><img class="img-fluid" src="/'+img+'"></td>';
				if(v.status){
					status = '<span class="badge badge-success">啟用</span>'
				}else{
					status = '<span class="badge badge-danger">停用</span>'
				}
				process_data += 	'<td>'+status+'</td>';
				process_data += 	'<td>'+v.sort+'</td>';
				process_data += 	'<td>'+date_format(v.created_at)+'</td>';
				process_data += 	'<td>'+date_format(v.updated_at)+'</td>';
				process_data += 	'<td>';
				if(v.en_check){
					process_data +=	'<button type="button" class="btn btn-secondary edit" data-lang="en" data-toggle="modal" data-target="#modal-edit" data-process_id="'+v.process_id+'">編輯英文版</button>';
				}else{
					process_data +=	'<button type="button" class="btn btn-secondary create" data-toggle="modal" data-target="#modal-create" data-lang="en" data-process_id="'+v.process_id+'">新增英文版</button>';
				}
				process_data += '<button type="button" class="btn btn-success edit" data-lang="zh" data-toggle="modal" data-target="#modal-edit" data-process_id="'+v.process_id+'">修改</button>\
										<button type="button" class="btn btn-danger delete" data-process_id="'+v.process_id+'">刪除</button>';
				process_data += 	'</td>';
				process_data += '</tr>';
				sequence++;
			});
			$('.process_list').html(process_data);
			page(res);
			paginate();
			process_create();
			process_edit();
			process_delete();
		});
	}

	function paginate(){
		$('.paginate_button').click(function(){
			var datapage = $(this).data('id');
			var data = {};
			data.page = datapage;
			process_list(data);
		});
	}

	function process_delete(){
		$('.delete').click(function(){
			var delete_id = $(this).data('process_id');
			Swal.fire({
				title : '確定刪除此製程嗎？',
				text : '刪除將無法恢復他！',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: '確定刪除！',
				cancelButtonText: '取消刪除！',
			}).then(function(res) {
				if(res.value){
					var data = {process_id : delete_id , _method : 'DELETE',_token : '{{ csrf_token() }}'};
					var url = '{{ asset("admin/process")}}/'+delete_id;
					$.ajax({
						type:"POST",
						url:url,
						dataType:'json',
						data:data,
						success: function (e) {
							Swal.fire(
								e.message,
								'已刪除製程。',
								e.status
							);
							var data = {};
							process_list(data);
						}
					})
					return false;
				}
			})
		})
	}
</script>
@endpush