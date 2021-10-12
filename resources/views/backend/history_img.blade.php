@extends('backend.layouts.main')
@include('backend.layouts.history_img_create_modal')
@include('backend.layouts.history_img_edit_modal')
@yield('history_img_create_modal')
@yield('history_img_edit_modal')
@section('page_content')
<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
		<div class="x_title">
			<h2>歷史照片<small>History Picture</small></h2>
			<button class="btn btn-secondary ml-2 create" type="button" data-toggle="modal" data-target="#modal-create">新增照片</button>
			<div class="clearfix"></div>
		</div>
		<div class="x_content">
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>照片</th>
							<th>排序</th>
							<th>創建時間</th>
							<th>最後更新時間</th>
						</tr>
					</thead>
					<tbody class="history_img">

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
	history_img(data);
	function history_img(data){
		$.get('{{ asset('admin/history_img') }}',data,function(res){
			var history_img_data = '';
			var sequence = 1;
			$.each(res.data,function(k,v){
				var img = v.img||'';
				history_img_data += '<tr>';
				history_img_data += 	'<th scope="row">'+sequence+'</th>';
				history_img_data += 	'<td><img class="img-fluid" src="/'+img+'"></td>';
				history_img_data += 	'<td>'+v.sort+'</td>';
				history_img_data += 	'<td>'+date_format(v.created_at)+'</td>';
				history_img_data += 	'<td>'+date_format(v.updated_at)+'</td>';
				history_img_data += 	'<td>';
				history_img_data += '<button type="button" class="btn btn-success edit" data-toggle="modal" data-target="#modal-edit" data-id="'+v.id+'">修改</button>\
										<button type="button" class="btn btn-danger delete" data-id="'+v.id+'">刪除</button>';
				history_img_data += 	'</td>';
				history_img_data += '</tr>';
				sequence++;
			});
			$('.history_img').html(history_img_data);
			page(res);
			paginate();
			history_img_create();
			history_img_edit();
			history_img_delete();
		});
	}

	function paginate(){
		$('.paginate_button').click(function(){
			var datapage = $(this).data('id');
			var data = {};
			data.page = datapage;
			history_img(data);
		});
	}

	function history_img_delete(){
		$('.delete').click(function(){
			var delete_id = $(this).data('id');
			Swal.fire({
				title : '確定刪除此照片嗎？',
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
					var url = '{{ asset("admin/history_img")}}/'+delete_id;
					$.ajax({
						type:"POST",
						url:url,
						dataType:'json',
						data:data,
						success: function (e) {
							Swal.fire(
								e.message,
								'已刪除照片。',
								e.status
							);
							var data = {};
							history_img(data);
						}
					})
					return false;
				}
			})
		})
	}
</script>
@endpush