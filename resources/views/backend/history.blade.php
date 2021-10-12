@extends('backend.layouts.main')
@include('backend.layouts.history_create_modal')
@include('backend.layouts.history_edit_modal')
@yield('history_create_modal')
@yield('history_edit_modal')
@section('page_content')
<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
		<div class="x_title">
			<h2>歷史<small>History</small></h2>
			<button class="btn btn-secondary ml-2 create" type="button" data-lang="zh" data-toggle="modal" data-target="#modal-create">新增歷史</button>
			<div class="clearfix"></div>
		</div>
		<div class="x_content">
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>年份</th>
							<th>排序</th>
							<th>創建時間</th>
							<th>最後更新時間</th>
						</tr>
					</thead>
					<tbody class="history_list">

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
	history_list(data);
	function history_list(data){
		$.get('{{ asset('admin/history') }}',data,function(res){
			var history_data = '';
			var sequence = 1;
			$.each(res.data,function(k,v){
				var year = v.year||'';
				history_data += '<tr>';
				history_data += 	'<th scope="row">'+sequence+'</th>';
				history_data += 	'<td>'+year+'</td>';
				history_data += 	'<td>'+v.sort+'</td>';
				history_data += 	'<td>'+date_format(v.created_at)+'</td>';
				history_data += 	'<td>'+date_format(v.updated_at)+'</td>';
				history_data += 	'<td>';
				if(v.en_check){
					history_data +=	'<button type="button" class="btn btn-secondary edit" data-lang="en" data-toggle="modal" data-target="#modal-edit" data-hid="'+v.hid+'">編輯英文版</button>';
				}else{
					history_data +=	'<button type="button" class="btn btn-secondary create" data-toggle="modal" data-target="#modal-create" data-lang="en" data-hid="'+v.hid+'">新增英文版</button>';
				}
				history_data += '<button type="button" class="btn btn-success edit" data-lang="zh" data-toggle="modal" data-target="#modal-edit" data-hid="'+v.hid+'">修改</button>\
										<button type="button" class="btn btn-danger delete" data-hid="'+v.hid+'">刪除</button>';
				history_data += 	'</td>';
				history_data += '</tr>';
				sequence++;
			});
			$('.history_list').html(history_data);
			page(res);
			paginate();
			history_create();
			history_edit();
			history_delete();
		});
	}

	function paginate(){
		$('.paginate_button').click(function(){
			var datapage = $(this).data('id');
			var data = {};
			data.page = datapage;
			history_list(data);
		});
	}

	function history_delete(){
		$('.delete').click(function(){
			var delete_id = $(this).data('hid');
			Swal.fire({
				title : '確定刪除此歷史嗎？',
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
					var url = '{{ asset("admin/history")}}/'+delete_id;
					$.ajax({
						type:"POST",
						url:url,
						dataType:'json',
						data:data,
						success: function (e) {
							Swal.fire(
								e.message,
								'已刪除歷史。',
								e.status
							);
							var data = {};
							history_list(data);
						}
					})
					return false;
				}
			})
		})
	}
</script>
@endpush